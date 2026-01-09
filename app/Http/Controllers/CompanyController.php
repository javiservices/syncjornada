<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\CompanyHoliday;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        $query = Company::query();

        // Managers solo ven su propia empresa
        if ($user->role === 'manager') {
            $query->where('id', $user->company_id);
        }

        // Filtros (solo para admin)
        if ($user->role === 'admin') {
            if ($request->filled('name')) {
                $query->where('name', 'like', '%' . $request->name . '%');
            }
            if ($request->filled('email')) {
                $query->where('email', 'like', '%' . $request->email . '%');
            }
        }

        $companies = $query->paginate(20);
        return view('companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = auth()->user();
        if ($user->role !== 'admin') {
            abort(403, 'Solo los administradores pueden crear empresas.');
        }
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        if ($user->role !== 'admin') {
            abort(403, 'Solo los administradores pueden crear empresas.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'cif' => 'nullable|string|max:20',
            'email' => 'required|email|unique:companies',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
        ]);

        Company::create($request->all());
        return redirect()->route('companies.index')->with('success', 'Empresa creada.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $company = Company::findOrFail($id);
        $user = auth()->user();

        if ($user->role === 'manager' && $company->id !== $user->company_id) {
            abort(403, 'Solo puedes ver tu propia empresa.');
        }

        return view('companies.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $company = Company::findOrFail($id);
        $user = auth()->user();

        if ($user->role === 'manager' && $company->id !== $user->company_id) {
            abort(403, 'Solo puedes editar tu propia empresa.');
        }

        return view('companies.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $company = Company::findOrFail($id);
        $user = auth()->user();

        if ($user->role === 'manager' && $company->id !== $user->company_id) {
            abort(403, 'Solo puedes editar tu propia empresa.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'cif' => 'nullable|string|max:20',
            'email' => 'required|email|unique:companies,email,' . $id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'timezone' => 'nullable|string|max:50',
            'enable_checkin_notifications' => 'nullable|boolean',
            'enable_checkout_notifications' => 'nullable|boolean',
            'checkin_notification_time' => 'nullable|date_format:H:i',
            'checkout_notification_time' => 'nullable|date_format:H:i',
        ]);

        $data = $request->all();
        // Convert checkboxes to boolean
        $data['enable_checkin_notifications'] = $request->has('enable_checkin_notifications');
        $data['enable_checkout_notifications'] = $request->has('enable_checkout_notifications');

        $company->update($data);
        return redirect()->route('companies.index')->with('success', 'Empresa actualizada.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = auth()->user();
        if ($user->role !== 'admin') {
            abort(403, 'Solo los administradores pueden eliminar empresas.');
        }

        $company = Company::findOrFail($id);
        $company->delete();
        return redirect()->route('companies.index')->with('success', 'Empresa eliminada.');
    }

    /**
     * Update vacation settings for the company
     */
    public function updateVacationSettings(Request $request, Company $company)
    {
        $user = auth()->user();
        
        // Verificar permisos
        if ($user->role !== 'admin' && $user->role !== 'manager') {
            abort(403, 'No tienes permisos para modificar esta configuración.');
        }
        
        if ($user->role === 'manager' && $user->company_id !== $company->id) {
            abort(403, 'Solo puedes modificar la configuración de tu propia empresa.');
        }

        $validated = $request->validate([
            'working_days' => 'nullable|array',
            'working_days.*' => 'integer|between:0,6',
            'holidays' => 'nullable|array',
            'holidays.*.date' => 'required|date',
            'holidays.*.name' => 'required|string|max:255',
        ]);

        // Actualizar días laborables
        $company->working_days = $validated['working_days'] ?? [1, 2, 3, 4, 5];
        $company->save();

        // Eliminar festivos existentes que no están en la lista
        $existingIds = collect($validated['holidays'] ?? [])
            ->filter(fn($h) => isset($h['id']))
            ->pluck('id')
            ->toArray();
        
        $company->holidays()->whereNotIn('id', $existingIds)->delete();

        // Actualizar o crear festivos
        foreach ($validated['holidays'] ?? [] as $holidayData) {
            if (isset($holidayData['id'])) {
                // Actualizar existente
                CompanyHoliday::where('id', $holidayData['id'])
                    ->where('company_id', $company->id)
                    ->update([
                        'date' => $holidayData['date'],
                        'name' => $holidayData['name'],
                    ]);
            } else {
                // Crear nuevo
                $company->holidays()->create([
                    'date' => $holidayData['date'],
                    'name' => $holidayData['name'],
                ]);
            }
        }

        return redirect()->route('companies.show', $company->id)
            ->with('success', 'Configuración de vacaciones actualizada correctamente.');
    }
}
