<?php

namespace App\Http\Controllers;

use App\Models\TimeEntry;
use App\Models\Company;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TimeEntryExportController extends Controller
{
    public function export(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'company_id' => 'nullable|exists:companies,id',
            'user_id' => 'nullable|exists:users,id',
            'format' => 'required|in:csv',
        ]);

        $user = auth()->user();
        $query = TimeEntry::with(['user.company', 'audits.user']);

        // Filtrar por fechas
        $query->whereBetween('date', [$request->start_date, $request->end_date]);

        // Aplicar restricciones según el rol
        if ($user->role === 'manager') {
            $query->whereHas('user', function($q) use ($user) {
                $q->where('company_id', $user->company_id);
            });
        } elseif ($user->role === 'employee') {
            $query->where('user_id', $user->id);
        }

        // Filtros adicionales (solo para admin)
        if ($user->role === 'admin' && $request->filled('company_id')) {
            $query->whereHas('user', function($q) use ($request) {
                $q->where('company_id', $request->company_id);
            });
        }

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        $entries = $query->orderBy('date', 'desc')->get();

        return $this->exportCsv($entries);
    }

    private function exportCsv($entries)
    {
        $filename = 'registro_jornada_' . now()->format('Y-m-d_His') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function() use ($entries) {
            $file = fopen('php://output', 'w');
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            
            fputcsv($file, [
                'Fecha', 'Empleado', 'NIF/NIE', 'Empresa', 'CIF', 'Hora Entrada', 'Lat Entrada', 'Lon Entrada',
                'Hora Salida', 'Lat Salida', 'Lon Salida', 'Horas Totales', 'Remoto', 'IP', 'Confirmado', 'Notas', 'Modificaciones'
            ], ';');

            foreach ($entries as $entry) {
                $checkIn = $entry->check_in ? Carbon::parse($entry->check_in)->format('H:i:s') : '';
                $checkOut = $entry->check_out ? Carbon::parse($entry->check_out)->format('H:i:s') : '';
                
                $hoursWorked = '';
                if ($entry->check_in && $entry->check_out) {
                    $diff = Carbon::parse($entry->check_in)->diffInMinutes(Carbon::parse($entry->check_out));
                    $hours = floor($diff / 60);
                    $minutes = $diff % 60;
                    $hoursWorked = "{$hours}h {$minutes}min";
                }

                $modifications = $entry->audits->count() > 1 ? 'Sí (' . ($entry->audits->count() - 1) . ')' : 'No';

                fputcsv($file, [
                    Carbon::parse($entry->date)->format('d/m/Y'),
                    $entry->user->name,
                    $entry->user->nif ?? '',
                    $entry->user->company->name ?? '',
                    $entry->user->company->cif ?? '',
                    $checkIn,
                    $entry->check_in_latitude ?? '',
                    $entry->check_in_longitude ?? '',
                    $checkOut,
                    $entry->check_out_latitude ?? '',
                    $entry->check_out_longitude ?? '',
                    $hoursWorked,
                    $entry->remote_work ? 'Sí' : 'No',
                    $entry->ip_address ?? '',
                    $entry->employee_confirmed ? 'Sí' : 'No',
                    $entry->notes ?? '',
                    $modifications
                ], ';');
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
