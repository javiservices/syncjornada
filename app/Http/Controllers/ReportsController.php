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

        $timeEntries = $query->orderBy('date', 'desc')->paginate(20);

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
}
