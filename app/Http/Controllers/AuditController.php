<?php

namespace App\Http\Controllers;

use App\Models\TimeEntryAudit;
use Illuminate\Http\Request;

class AuditController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        
        $query = TimeEntryAudit::with(['timeEntry.user', 'user'])
            ->orderBy('created_at', 'desc');

        // Restricciones por rol
        if ($user->role === 'employee') {
            $query->whereHas('timeEntry', function($q) use ($user) {
                $q->where('user_id', $user->id);
            });
        } elseif ($user->role === 'manager') {
            $query->whereHas('timeEntry.user', function($q) use ($user) {
                $q->where('company_id', $user->company_id);
            });
        }

        // Filtros
        if ($request->filled('user_id')) {
            $query->whereHas('timeEntry', function($q) use ($request) {
                $q->where('user_id', $request->user_id);
            });
        }

        if ($request->filled('date_from')) {
            $query->whereHas('timeEntry', function($q) use ($request) {
                $q->where('date', '>=', $request->date_from);
            });
        }

        if ($request->filled('date_to')) {
            $query->whereHas('timeEntry', function($q) use ($request) {
                $q->where('date', '<=', $request->date_to);
            });
        }

        if ($request->filled('action')) {
            $query->where('action', $request->action);
        }

        $audits = $query->paginate(50);

        // Get users for filter (admin/manager only)
        $users = [];
        if (in_array($user->role, ['admin', 'manager'])) {
            $usersQuery = \App\Models\User::where('role', 'employee');
            if ($user->role === 'manager') {
                $usersQuery->where('company_id', $user->company_id);
            }
            $users = $usersQuery->orderBy('name')->get();
        }

        return view('audits.index', compact('audits', 'users'));
    }
}
