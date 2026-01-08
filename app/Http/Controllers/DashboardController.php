<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TimeEntry;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        // Set timezone if user has company
        if ($user->company && $user->company->timezone) {
            date_default_timezone_set($user->company->timezone);
        }
        
        // Recent time entries
        $timeEntries = TimeEntry::where('user_id', $user->id)
            ->latest()
            ->take(10)
            ->get();
        
        // Check if currently checked in
        $today = now()->toDateString();
        $lastEntry = TimeEntry::where('user_id', $user->id)
            ->where('date', $today)
            ->latest()
            ->first();
        $isCheckedIn = $lastEntry && !$lastEntry->check_out;
        
        // Statistics for today
        $todayEntries = TimeEntry::where('user_id', $user->id)
            ->where('date', $today)
            ->whereNotNull('check_out')
            ->get();
        
        $minutesToday = 0;
        foreach ($todayEntries as $entry) {
            $checkIn = Carbon::parse($entry->check_in);
            $checkOut = Carbon::parse($entry->check_out);
            $minutesToday += $checkIn->diffInMinutes($checkOut);
        }
        $hoursToday = [
            'hours' => floor($minutesToday / 60),
            'minutes' => $minutesToday % 60
        ];
        
        // Statistics for this week
        $startOfWeek = now()->startOfWeek();
        $weekEntries = TimeEntry::where('user_id', $user->id)
            ->where('date', '>=', $startOfWeek->toDateString())
            ->whereNotNull('check_out')
            ->get();
        
        $minutesWeek = 0;
        foreach ($weekEntries as $entry) {
            $checkIn = Carbon::parse($entry->check_in);
            $checkOut = Carbon::parse($entry->check_out);
            $minutesWeek += $checkIn->diffInMinutes($checkOut);
        }
        $hoursWeek = [
            'hours' => floor($minutesWeek / 60),
            'minutes' => $minutesWeek % 60
        ];
        
        // Statistics for this month
        $startOfMonth = now()->startOfMonth();
        $monthEntries = TimeEntry::where('user_id', $user->id)
            ->where('date', '>=', $startOfMonth->toDateString())
            ->whereNotNull('check_out')
            ->get();
        
        $minutesMonth = 0;
        $daysWorked = $monthEntries->pluck('date')->unique()->count();
        foreach ($monthEntries as $entry) {
            $checkIn = Carbon::parse($entry->check_in);
            $checkOut = Carbon::parse($entry->check_out);
            $minutesMonth += $checkIn->diffInMinutes($checkOut);
        }
        $hoursMonth = [
            'hours' => floor($minutesMonth / 60),
            'minutes' => $minutesMonth % 60
        ];
        
        // Pending check-outs (entries without check_out)
        $pendingCheckouts = TimeEntry::where('user_id', $user->id)
            ->whereNull('check_out')
            ->count();
        
        // Datos para gráficos - últimos 7 días
        $last7Days = [];
        $hoursPerDay = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $last7Days[] = $date->format('d/m');
            
            $dayEntries = TimeEntry::where('user_id', $user->id)
                ->whereDate('date', $date->toDateString())
                ->whereNotNull('check_out')
                ->get();
            
            $minutesDay = 0;
            foreach ($dayEntries as $entry) {
                $checkIn = Carbon::parse($entry->check_in);
                $checkOut = Carbon::parse($entry->check_out);
                $minutesDay += $checkIn->diffInMinutes($checkOut);
            }
            $hoursPerDay[] = round($minutesDay / 60, 2);
        }
        
        // Estadísticas para managers/admins
        $teamStats = null;
        if (in_array($user->role, ['manager', 'admin'])) {
            $companyId = $user->company_id;
            
            // Empleados activos hoy
            $activeToday = TimeEntry::whereDate('date', $today)
                ->whereNotNull('check_in')
                ->whereNull('check_out')
                ->whereHas('user', function($q) use ($companyId) {
                    $q->where('company_id', $companyId);
                })
                ->count();
            
            // Total empleados
            $totalEmployees = \App\Models\User::where('company_id', $companyId)
                ->where('role', 'employee')
                ->count();
            
            // Fichajes pendientes hoy
            $pendingToday = TimeEntry::whereDate('date', $today)
                ->whereNull('check_out')
                ->whereHas('user', function($q) use ($companyId) {
                    $q->where('company_id', $companyId);
                })
                ->count();
            
            $teamStats = [
                'active_today' => $activeToday,
                'total_employees' => $totalEmployees,
                'pending_today' => $pendingToday,
            ];
        }
        
        return view('dashboard', compact(
            'timeEntries',
            'isCheckedIn',
            'hoursToday',
            'hoursWeek',
            'hoursMonth',
            'daysWorked',
            'pendingCheckouts',
            'lastEntry',
            'last7Days',
            'hoursPerDay',
            'teamStats',
            'weekEntries'
        ));
    }
}
