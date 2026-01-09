<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'name', 
        'cif', 
        'email', 
        'phone', 
        'address', 
        'timezone',
        'enable_checkin_notifications',
        'enable_checkout_notifications',
        'checkin_notification_time',
        'checkout_notification_time',
        'working_days'
    ];

    protected $casts = [
        'enable_checkin_notifications' => 'boolean',
        'enable_checkout_notifications' => 'boolean',
        'working_days' => 'array',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function holidays()
    {
        return $this->hasMany(CompanyHoliday::class);
    }

    /**
     * Calcular días laborables entre dos fechas según configuración de empresa
     */
    public function calculateWorkingDays($startDate, $endDate)
    {
        $start = \Carbon\Carbon::parse($startDate);
        $end = \Carbon\Carbon::parse($endDate);
        $workingDays = $this->working_days ?? [1, 2, 3, 4, 5];
        
        // Obtener festivos en el rango
        $holidays = $this->holidays()
            ->whereBetween('date', [$start, $end])
            ->pluck('date')
            ->map(fn($date) => $date->format('Y-m-d'))
            ->toArray();
        
        $count = 0;
        $current = $start->copy();
        
        while ($current->lte($end)) {
            $dayOfWeek = $current->dayOfWeek;
            $dateStr = $current->format('Y-m-d');
            
            // Si es día laboral y no es festivo
            if (in_array($dayOfWeek, $workingDays) && !in_array($dateStr, $holidays)) {
                $count++;
            }
            $current->addDay();
        }
        
        return $count;
    }
}
