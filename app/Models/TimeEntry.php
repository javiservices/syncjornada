<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TimeEntry extends Model
{
    protected $fillable = [
        'user_id', 
        'date', 
        'check_in', 
        'check_out', 
        'notes', 
        'remote_work',
        'location',
        'check_in_latitude',
        'check_in_longitude',
        'check_out_latitude',
        'check_out_longitude',
        'ip_address',
        'user_agent',
        'employee_confirmed',
        'is_locked'
    ];

    protected $casts = [
        'check_in' => 'datetime',
        'check_out' => 'datetime',
        'remote_work' => 'boolean',
        'employee_confirmed' => 'boolean',
        'is_locked' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function audits(): HasMany
    {
        return $this->hasMany(TimeEntryAudit::class);
    }

    public function breaks(): HasMany
    {
        return $this->hasMany(Break::class);
    }

    /**
     * Calculate net worked minutes (excluding breaks)
     */
    public function getNetWorkedMinutes(): int
    {
        if (!$this->check_in || !$this->check_out) {
            return 0;
        }

        $totalMinutes = $this->check_in->diffInMinutes($this->check_out);
        $breakMinutes = $this->breaks()->sum(function($break) {
            return $break->getDurationInMinutes();
        });

        return max(0, $totalMinutes - $breakMinutes);
    }
}
