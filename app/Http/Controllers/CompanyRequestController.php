<?php

namespace App\Http\Controllers;

use App\Models\CompanyRequest;
use App\Models\Company;
use App\Models\User;
use App\Mail\CompanyRequestApproved;
use App\Mail\CompanyRequestRejected;
use App\Mail\CompanyRequestReceived;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class CompanyRequestController extends Controller
{
    public function create()
    {
        return view('company-request.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'contact_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'employees' => 'required|integer|min:1|max:15',
            'message' => 'nullable|string|max:1000',
        ]);

        $companyRequest = CompanyRequest::create($validated);

        // Enviar confirmación al solicitante indicando que hemos recibido la solicitud
        try {
            Mail::to($companyRequest->email)->send(new CompanyRequestReceived($companyRequest));
        } catch (\Throwable $e) {
            // No interrumpir el flujo si falla el envío; opcional: loguear
            // logger()->error('Error sending company request received email: '.$e->getMessage());
        }

        // Opcional: Enviar email de notificación al admin
        // Mail::to(config('mail.admin_email'))->send(new NewCompanyRequest($companyRequest));

        return redirect()->route('company-request.success')
            ->with('success', '¡Solicitud enviada exitosamente!');
    }

    public function success()
    {
        return view('company-request.success');
    }

    public function index()
    {
        // Solo para admin - verificar rol directamente
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Acceso denegado.');
        }
        
        $requests = CompanyRequest::latest()->paginate(20);
        return view('company-request.index', compact('requests'));
    }

    public function updateStatus(Request $request, CompanyRequest $companyRequest)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,approved,rejected',
            'admin_notes' => 'nullable|string',
        ]);

        $companyRequest->update($validated);

        // Si se aprueba la solicitud, crear la empresa con los datos proporcionados
            if (isset($validated['status']) && $validated['status'] === 'approved') {
                $companyData = [
                    'name' => $companyRequest->company_name,
                    'email' => $companyRequest->email,
                    'phone' => $companyRequest->phone,
                ];

                $company = Company::where('email', $companyData['email'])
                    ->orWhere('name', $companyData['name'])
                    ->first();

                if (! $company) {
                    $company = Company::create($companyData);
                }

                // Crear usuario manager para la empresa
                $plainPassword = Str::random(8);
                $user = User::where('email', $companyRequest->email)->first();
                if (! $user) {
                    $user = User::create([
                        'name' => $companyRequest->contact_name ?? $companyRequest->email,
                        'email' => $companyRequest->email,
                        'password' => $plainPassword,
                        'company_id' => $company->id,
                        'role' => 'manager',
                    ]);
                } else {
                    // Si ya existía usuario, asignarle company/role si no los tiene
                    if (! $user->company_id) {
                        $user->company_id = $company->id;
                    }
                    if ($user->role !== 'manager') {
                        $user->role = 'manager';
                    }
                    $user->save();
                }

                // Generar token de restablecimiento de contraseña
                $token = Password::broker()->createToken($user);
                $resetUrl = url(route('password.reset', ['token' => $token, 'email' => $user->email], false));

                // Enviar correo de aprobación con credenciales y enlace de cambio de contraseña
                Mail::to($companyRequest->email)->send(new CompanyRequestApproved($company, $user, $plainPassword, $resetUrl));
            }

            // Si se rechaza, enviar correo indicando motivo (si lo hay)
            if (isset($validated['status']) && $validated['status'] === 'rejected') {
                Mail::to($companyRequest->email)->send(new CompanyRequestRejected($companyRequest));
            }

        return back()->with('success', 'Estado actualizado correctamente');
    }
}
