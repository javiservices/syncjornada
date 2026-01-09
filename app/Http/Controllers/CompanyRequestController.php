<?php

namespace App\Http\Controllers;

use App\Models\CompanyRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
            'plan' => 'required|in:1-5,6-10,11-15',
            'message' => 'nullable|string|max:1000',
        ]);

        $companyRequest = CompanyRequest::create($validated);

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

        return back()->with('success', 'Estado actualizado correctamente');
    }
}
