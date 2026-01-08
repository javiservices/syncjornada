<?php

namespace App\Http\Controllers;

use App\Models\Break;
use App\Models\TimeEntry;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BreakController extends Controller
{
    /**
     * Start a break
     */
    public function start(Request $request, TimeEntry $timeEntry)
    {
        // Verificar que el usuario es propietario del time entry
        if ($timeEntry->user_id !== auth()->id()) {
            abort(403);
        }

        // Verificar que hay un check-in pero no check-out
        if (!$timeEntry->check_in || $timeEntry->check_out) {
            return back()->with('error', 'No puedes iniciar una pausa si no estás fichado.');
        }

        // Verificar que no hay una pausa activa
        $activeBreak = $timeEntry->breaks()->whereNull('break_end')->first();
        if ($activeBreak) {
            return back()->with('error', 'Ya tienes una pausa activa.');
        }

        $request->validate([
            'reason' => 'nullable|string|max:255',
        ]);

        Break::create([
            'time_entry_id' => $timeEntry->id,
            'break_start' => now(),
            'reason' => $request->reason ?? 'Descanso',
        ]);

        return back()->with('success', 'Pausa iniciada correctamente.');
    }

    /**
     * End a break
     */
    public function end(TimeEntry $timeEntry)
    {
        // Verificar que el usuario es propietario del time entry
        if ($timeEntry->user_id !== auth()->id()) {
            abort(403);
        }

        // Buscar pausa activa
        $activeBreak = $timeEntry->breaks()->whereNull('break_end')->first();
        
        if (!$activeBreak) {
            return back()->with('error', 'No tienes ninguna pausa activa.');
        }

        $activeBreak->update([
            'break_end' => now(),
        ]);

        return back()->with('success', 'Pausa finalizada correctamente.');
    }

    /**
     * Delete a break (only if created today)
     */
    public function destroy(Break $break)
    {
        // Verificar permisos
        if ($break->timeEntry->user_id !== auth()->id()) {
            abort(403);
        }

        // Solo permitir eliminar pausas del mismo día
        if (!$break->created_at->isToday()) {
            return back()->with('error', 'Solo puedes eliminar pausas del día actual.');
        }

        $break->delete();

        return back()->with('success', 'Pausa eliminada correctamente.');
    }
}
