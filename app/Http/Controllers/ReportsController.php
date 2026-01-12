<?php

namespace App\Http\Controllers;

use App\Models\TimeEntry;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $query = TimeEntry::with('user.company');

        // Aplicar filtros según el rol
        if ($user->role === 'manager') {
            // Manager solo ve su empresa
            $query->whereHas('user', function($q) use ($user) {
                $q->where('company_id', $user->company_id);
            });
        }
        // Admin ve todo (sin restricciones)

        // Filtros
        if ($request->filled('company_id')) {
            $query->whereHas('user', function($q) use ($request) {
                $q->where('company_id', $request->company_id);
            });
        }
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }
        if ($request->filled('date_from')) {
            $query->where('date', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->where('date', '<=', $request->date_to);
        }
        if ($request->filled('remote_work') && $request->remote_work !== 'all') {
            $query->where('remote_work', $request->boolean('remote_work'));
        }

        $timeEntries = $query->orderBy('date', 'desc')->paginate(20)->appends($request->except('page'));

        // Obtener listas para filtros
        if ($user->role === 'admin') {
            $companies = \App\Models\Company::all();
            $users = \App\Models\User::all();
        } else {
            $companies = collect(); // Manager no necesita filtro de empresas
            $users = \App\Models\User::where('company_id', $user->company_id)->get();
        }

        return view('reports.index', compact('timeEntries', 'users', 'companies'));
    }

    public function create()
    {
        // Solo admins pueden crear registros
        if (auth()->user()->role !== 'admin') {
            abort(403, 'No tienes permiso para realizar esta acción');
        }

        return view('reports.create');
    }

    public function store(Request $request)
    {
        // Solo admins pueden crear registros
        if (auth()->user()->role !== 'admin') {
            abort(403, 'No tienes permiso para realizar esta acción');
        }

        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'check_in_date' => 'required|date',
            'check_in_time' => 'required|date_format:H:i',
            'check_out_date' => 'nullable|date',
            'check_out_time' => 'nullable|date_format:H:i',
            'remote_work' => 'boolean',
            'notes' => 'nullable|string|max:500',
        ]);

        // Construir datetime completo
        $checkIn = $validated['check_in_date'] . ' ' . $validated['check_in_time'] . ':00';
        
        $data = [
            'user_id' => $validated['user_id'],
            'date' => $validated['check_in_date'],
            'check_in' => $checkIn,
            'remote_work' => $request->boolean('remote_work'),
            'notes' => $validated['notes'] ?? null,
            'ip_address' => $request->ip(),
            'user_agent' => 'Admin manual entry',
            'employee_confirmed' => true,
        ];

        // Si hay check_out, agregarlo
        if ($request->filled('check_out_date') && $request->filled('check_out_time')) {
            $data['check_out'] = $validated['check_out_date'] . ' ' . $validated['check_out_time'] . ':00';
        }

        TimeEntry::create($data);

        return redirect()->route('reports.index')
            ->with('success', 'Registro creado correctamente');
    }

    public function destroy(TimeEntry $timeEntry)
    {
        // Solo admins pueden eliminar
        if (auth()->user()->role !== 'admin') {
            abort(403, 'No tienes permiso para realizar esta acción');
        }

        $userName = $timeEntry->user->name;
        $date = $timeEntry->date;
        
        $timeEntry->delete();

        return redirect()->route('reports.index')
            ->with('success', "Registro de {$userName} del {$date} eliminado correctamente");
    }
}
