<?php

namespace App\Http\Controllers;

use App\Models\TimeEntry;
use App\Models\User;
use App\Models\Company;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class StatisticsController extends Controller
{
    public function index(Request $request)
    {
        $authUser = auth()->user();

        // Fechas por defecto: mes actual
        $dateFrom = $request->input('date_from', now()->startOfMonth()->format('Y-m-d'));
        $dateTo = $request->input('date_to', now()->format('Y-m-d'));

        // Obtener listas para filtros según rol
        if ($authUser->role === 'admin') {
            $companies = Company::all();
            $users = User::with('company')->orderBy('name')->get();
        } else {
            $companies = collect();
            $users = User::where('company_id', $authUser->company_id)->orderBy('name')->get();
        }

        // Si se seleccionó un usuario, mostrar sus estadísticas
        $selectedUser = null;
        $statistics = null;

        if ($request->filled('user_id')) {
            $query = User::with('company');
            
            if ($authUser->role === 'manager') {
                $query->where('company_id', $authUser->company_id);
            }
            
            $selectedUser = $query->find($request->user_id);

            if ($selectedUser) {
                $statistics = $this->calculateStatistics($selectedUser->id, $dateFrom, $dateTo);
            }
        }

        return view('statistics.index', compact('users', 'companies', 'selectedUser', 'statistics', 'dateFrom', 'dateTo'));
    }

    private function calculateStatistics($userId, $dateFrom, $dateTo)
    {
        $entries = TimeEntry::where('user_id', $userId)
            ->whereBetween('date', [$dateFrom, $dateTo])
            ->orderBy('date', 'desc')
            ->get();

        // Total horas trabajadas
        $totalMinutes = 0;
        $completedEntries = $entries->where('check_out', '!=', null);
        
        foreach ($completedEntries as $entry) {
            if ($entry->check_in && $entry->check_out) {
                $checkIn = Carbon::parse($entry->check_in);
                $checkOut = Carbon::parse($entry->check_out);
                $totalMinutes += $checkIn->diffInMinutes($checkOut);
            }
        }

        $totalHours = floor($totalMinutes / 60);
        $totalMinutesRemainder = $totalMinutes % 60;

        // Días trabajados
        $daysWorked = $entries->pluck('date')->unique()->count();

        // Promedio horas por día
        $avgMinutesPerDay = $daysWorked > 0 ? $totalMinutes / $daysWorked : 0;
        $avgHours = floor($avgMinutesPerDay / 60);
        $avgMinutes = round($avgMinutesPerDay % 60);

        // Trabajo remoto vs presencial
        $remoteEntries = $entries->where('remote_work', true)->count();
        $officeEntries = $entries->where('remote_work', false)->count();
        $remotePercentage = $entries->count() > 0 ? round(($remoteEntries / $entries->count()) * 100) : 0;

        // Fichajes pendientes (sin check-out)
        $pendingCheckouts = $entries->whereNull('check_out')->count();

        // Total de descansos
        $totalBreaks = DB::table('time_entry_breaks')
            ->whereIn('time_entry_id', $entries->pluck('id'))
            ->whereNotNull('break_end')
            ->count();

        // Horas por semana
        $weeklyData = [];
        $weekGroups = $completedEntries->groupBy(function($entry) {
            return Carbon::parse($entry->date)->format('Y-W');
        });

        foreach ($weekGroups as $week => $weekEntries) {
            $weekMinutes = 0;
            foreach ($weekEntries as $entry) {
                if ($entry->check_in && $entry->check_out) {
                    $checkIn = Carbon::parse($entry->check_in);
                    $checkOut = Carbon::parse($entry->check_out);
                    $weekMinutes += $checkIn->diffInMinutes($checkOut);
                }
            }
            $weeklyData[] = [
                'week' => $week,
                'hours' => round($weekMinutes / 60, 2),
                'label' => 'Semana ' . explode('-', $week)[1]
            ];
        }

        // Horas por día de la semana
        $dayOfWeekData = [];
        $dayGroups = $completedEntries->groupBy(function($entry) {
            return Carbon::parse($entry->date)->dayOfWeekIso; // 1=Lunes, 7=Domingo
        });

        $dayNames = ['', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];
        
        for ($i = 1; $i <= 7; $i++) {
            $dayEntries = $dayGroups->get($i, collect());
            $dayMinutes = 0;
            
            foreach ($dayEntries as $entry) {
                if ($entry->check_in && $entry->check_out) {
                    $checkIn = Carbon::parse($entry->check_in);
                    $checkOut = Carbon::parse($entry->check_out);
                    $dayMinutes += $checkIn->diffInMinutes($checkOut);
                }
            }
            
            $dayOfWeekData[] = [
                'day' => $dayNames[$i],
                'hours' => round($dayMinutes / 60, 2),
                'entries' => $dayEntries->count()
            ];
        }

        // Entrada más temprana y salida más tardía
        $earliestCheckIn = null;
        $latestCheckOut = null;

        foreach ($completedEntries as $entry) {
            if ($entry->check_in) {
                $time = Carbon::parse($entry->check_in)->format('H:i');
                if (!$earliestCheckIn || $time < $earliestCheckIn) {
                    $earliestCheckIn = $time;
                }
            }
            if ($entry->check_out) {
                $time = Carbon::parse($entry->check_out)->format('H:i');
                if (!$latestCheckOut || $time > $latestCheckOut) {
                    $latestCheckOut = $time;
                }
            }
        }

        return [
            'total_hours' => $totalHours,
            'total_minutes' => $totalMinutesRemainder,
            'days_worked' => $daysWorked,
            'avg_hours' => $avgHours,
            'avg_minutes' => $avgMinutes,
            'remote_entries' => $remoteEntries,
            'office_entries' => $officeEntries,
            'remote_percentage' => $remotePercentage,
            'pending_checkouts' => $pendingCheckouts,
            'total_breaks' => $totalBreaks,
            'total_entries' => $entries->count(),
            'completed_entries' => $completedEntries->count(),
            'weekly_data' => $weeklyData,
            'day_of_week_data' => $dayOfWeekData,
            'earliest_check_in' => $earliestCheckIn,
            'latest_check_out' => $latestCheckOut,
        ];
    }
}
