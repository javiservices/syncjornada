<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Break extends Model
{
    protected $fillable = [
        'time_entry_id',
        'break_start',
        'break_end',
        'reason',
        'notes',
    ];

    protected $casts = [
        'break_start' => 'datetime',
        'break_end' => 'datetime',
    ];

    public function timeEntry(): BelongsTo
    {
        return $this->belongsTo(TimeEntry::class);
    }

    /**
     * Get duration in minutes
     */
    public function getDurationInMinutes(): int
    {
        if (!$this->break_end) {
            return 0;
        }
        return $this->break_start->diffInMinutes($this->break_end);
    }
}
