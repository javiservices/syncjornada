<?php

namespace App\Http\Controllers;

use App\Mail\VacationRequestCreated;
use App\Mail\VacationRequestReviewed;
use App\Models\User;
use App\Models\VacationRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class VacationRequestController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        if ($user->role === 'admin' || $user->role === 'manager') {
            $vacationRequests = VacationRequest::with(['user', 'reviewer'])
                ->whereHas('user', function ($query) use ($user) {
                    $query->where('company_id', $user->company_id);
                })
                ->orderBy('created_at', 'desc')
                ->paginate(20);
        } else {
            $vacationRequests = VacationRequest::with('reviewer')
                ->where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->paginate(20);
        }
        
        return view('vacation-requests.index', compact('vacationRequests'));
    }

    public function create()
    {
        return view('vacation-requests.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'nullable|string|max:500',
        ]);

        $start = Carbon::parse($validated['start_date']);
        $end = Carbon::parse($validated['end_date']);
        
        // Calcular días laborables
        $days = 0;
        $current = $start->copy();
        while ($current->lte($end)) {
            if ($current->isWeekday()) {
                $days++;
            }
            $current->addDay();
        }

        $vacationRequest = VacationRequest::create([
            'user_id' => Auth::id(),
            'start_date' => $start,
            'end_date' => $end,
            'days' => $days,
            'reason' => $validated['reason'],
            'status' => 'pending',
        ]);

        // Enviar email a los gerentes de la empresa
        $managers = User::where('company_id', Auth::user()->company_id)
            ->whereIn('role', ['manager', 'admin'])
            ->get();

        foreach ($managers as $manager) {
            Mail::to($manager->email)->send(new VacationRequestCreated($vacationRequest));
        }

        return redirect()->route('vacation-requests.index')
            ->with('success', 'Solicitud de vacaciones enviada correctamente.');
    }

    public function show(VacationRequest $vacationRequest)
    {
        $user = Auth::user();
        
        // Verificar permisos
        if ($vacationRequest->user_id !== $user->id && 
            ($user->role !== 'admin' && $user->role !== 'manager')) {
            abort(403);
        }
        
        if (($user->role === 'manager' || $user->role === 'admin') && 
            $vacationRequest->user->company_id !== $user->company_id) {
            abort(403);
        }

        return view('vacation-requests.show', compact('vacationRequest'));
    }

    public function edit(VacationRequest $vacationRequest)
    {
        if (!$vacationRequest->canBeEditedBy(Auth::user())) {
            abort(403, 'No puedes editar esta solicitud.');
        }

        return view('vacation-requests.edit', compact('vacationRequest'));
    }

    public function update(Request $request, VacationRequest $vacationRequest)
    {
        if (!$vacationRequest->canBeEditedBy(Auth::user())) {
            abort(403, 'No puedes editar esta solicitud.');
        }

        $validated = $request->validate([
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'nullable|string|max:500',
        ]);

        $start = Carbon::parse($validated['start_date']);
        $end = Carbon::parse($validated['end_date']);
        
        $days = 0;
        $current = $start->copy();
        while ($current->lte($end)) {
            if ($current->isWeekday()) {
                $days++;
            }
            $current->addDay();
        }

        $vacationRequest->update([
            'start_date' => $start,
            'end_date' => $end,
            'days' => $days,
            'reason' => $validated['reason'],
        ]);

        return redirect()->route('vacation-requests.index')
            ->with('success', 'Solicitud actualizada correctamente.');
    }

    public function destroy(VacationRequest $vacationRequest)
    {
        if (!$vacationRequest->canBeEditedBy(Auth::user())) {
            abort(403, 'No puedes eliminar esta solicitud.');
        }

        $vacationRequest->delete();

        return redirect()->route('vacation-requests.index')
            ->with('success', 'Solicitud eliminada correctamente.');
    }

    public function approve(Request $request, VacationRequest $vacationRequest)
    {
        $user = Auth::user();
        
        if (!$vacationRequest->canBeReviewedBy($user)) {
            abort(403, 'No tienes permisos para aprobar solicitudes.');
        }
        
        if ($vacationRequest->user->company_id !== $user->company_id) {
            abort(403);
        }

        $validated = $request->validate([
            'manager_notes' => 'nullable|string|max:500',
        ]);

        $vacationRequest->update([
            'status' => 'approved',
            'reviewed_by' => $user->id,
            'reviewed_at' => now(),
            'manager_notes' => $validated['manager_notes'] ?? null,
        ]);

        Mail::to($vacationRequest->user->email)->send(new VacationRequestReviewed($vacationRequest));

        return back()->with('success', 'Solicitud aprobada correctamente.');
    }

    public function reject(Request $request, VacationRequest $vacationRequest)
    {
        $user = Auth::user();
        
        if (!$vacationRequest->canBeReviewedBy($user)) {
            abort(403, 'No tienes permisos para rechazar solicitudes.');
        }
        
        if ($vacationRequest->user->company_id !== $user->company_id) {
            abort(403);
        }

        $validated = $request->validate([
            'manager_notes' => 'nullable|string|max:500',
        ]);

        $vacationRequest->update([
            'status' => 'rejected',
            'reviewed_by' => $user->id,
            'reviewed_at' => now(),
            'manager_notes' => $validated['manager_notes'] ?? null,
        ]);

        Mail::to($vacationRequest->user->email)->send(new VacationRequestReviewed($vacationRequest));

        return back()->with('success', 'Solicitud rechazada correctamente.');
    }
}
