<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TimeEntry;
use Carbon\Carbon;

class TimeEntryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        $query = TimeEntry::with('user');

        // Todos los usuarios solo ven sus propios registros en esta vista
        // Para ver registros de otros usuarios, usar /reports
        $query->where('user_id', $user->id);

        // Filtros
        if ($request->filled('date_from')) {
            $query->where('date', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->where('date', '<=', $request->date_to);
        }
        if ($request->filled('remote_work') && $request->remote_work !== 'all') {
            $query->where('is_remote', $request->boolean('remote_work'));
        }

        $timeEntries = $query->orderBy('date', 'desc')->paginate(25);

        return view('time-entries.index', compact('timeEntries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'remote_work' => 'boolean',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'notes' => 'nullable|string|max:255',
        ]);

        $user = auth()->user();
        
        // Set timezone if user has company
        if ($user->company && $user->company->timezone) {
            date_default_timezone_set($user->company->timezone);
        }
        
        $today = Carbon::today()->toDateString();

        $lastEntry = TimeEntry::where('user_id', $user->id)->where('date', $today)->latest()->first();

        if ($lastEntry && !$lastEntry->check_out) {
            // Cerrar la entrada abierta con ubicación
            $updateData = ['check_out' => now()];
            if ($request->filled('latitude') && $request->filled('longitude')) {
                $updateData['check_out_latitude'] = $request->latitude;
                $updateData['check_out_longitude'] = $request->longitude;
            }
            if ($request->filled('notes')) {
                $updateData['notes'] = $request->notes;
            }
            $lastEntry->update($updateData);
            return redirect()->back()->with('success', 'Check out registrado.');
        } else {
            // Crear nueva entrada con ubicación
            $createData = [
                'user_id' => $user->id,
                'date' => $today,
                'check_in' => now(),
                'remote_work' => $request->boolean('remote_work'),
            ];
            if ($request->filled('latitude') && $request->filled('longitude')) {
                $createData['check_in_latitude'] = $request->latitude;
                $createData['check_in_longitude'] = $request->longitude;
            }
            if ($request->filled('notes')) {
                $createData['notes'] = $request->notes;
            }
            TimeEntry::create($createData);
            return redirect()->back()->with('success', 'Check in registrado.');
        }
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = auth()->user();
        $query = TimeEntry::with('user');

        // Aplicar restricciones según el rol
        if ($user->role === 'employee') {
            // Employee puede editar solo sus propios registros para agregar notas
            $query->where('user_id', $user->id);
        } elseif ($user->role === 'manager') {
            // Manager puede editar registros de su empresa
            $query->whereHas('user', function($q) use ($user) {
                $q->where('company_id', $user->company_id);
            });
        }
        // Admin puede editar todos

        $timeEntry = $query->findOrFail($id);
        return view('time-entries.edit', compact('timeEntry'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = auth()->user();

        // Validación diferente según el rol
        if ($user->role === 'employee') {
            // Employee solo puede editar notas
            $request->validate([
                'notes' => 'nullable|string|max:255',
            ]);
        } else {
            // Manager y Admin pueden editar todo
            $request->validate([
                'check_in' => 'nullable|date_format:H:i',
                'check_out' => 'nullable|date_format:H:i|after:check_in',
                'remote_work' => 'boolean',
                'notes' => 'nullable|string|max:255',
            ]);
        }

        $query = TimeEntry::with('user');

        // Aplicar restricciones según el rol
        if ($user->role === 'employee') {
            // Employee puede editar solo sus propios registros
            $query->where('user_id', $user->id);
        } elseif ($user->role === 'manager') {
            // Manager puede editar registros de su empresa
            $query->whereHas('user', function($q) use ($user) {
                $q->where('company_id', $user->company_id);
            });
        }
        // Admin puede editar todos

        $timeEntry = $query->findOrFail($id);

        // Optional: Prevent editing if more than 24 hours old
        if ($timeEntry->created_at->diffInHours(now()) > 24) {
            return redirect()->back()->with('error', 'No puedes editar entradas de más de 24 horas.');
        }

        // Actualizar solo los campos permitidos según el rol
        if ($user->role === 'employee') {
            $timeEntry->update($request->only(['notes']));
        } else {
            $timeEntry->update($request->only(['check_in', 'check_out', 'remote_work', 'notes']));
        }

        // Redirigir según el origen
        if ($request->get('from') === 'reports') {
            return redirect()->route('reports.index')->with('success', 'Entrada actualizada.');
        }
        
        return redirect()->route('time-entries.index')->with('success', 'Entrada actualizada.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = auth()->user();

        // Solo admin puede eliminar
        if ($user->role !== 'admin') {
            abort(403, 'Solo los administradores pueden eliminar registros.');
        }

        $timeEntry = TimeEntry::findOrFail($id);

        // Optional: Prevent deleting if more than 24 hours old
        if ($timeEntry->created_at->diffInHours(now()) > 24) {
            return redirect()->back()->with('error', 'No puedes eliminar entradas de más de 24 horas.');
        }

        $timeEntry->delete();
        return redirect()->route('time-entries.index')->with('success', 'Entrada eliminada.');
    }
}
