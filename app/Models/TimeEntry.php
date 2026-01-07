<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimeEntry extends Model
{
    protected $fillable = [
        'user_id', 
        'date', 
        'check_in', 
        'check_out', 
        'notes', 
        'remote_work',
        'check_in_latitude',
        'check_in_longitude',
        'check_out_latitude',
        'check_out_longitude'
    ];

    protected $casts = [
        'check_in' => 'datetime',
        'check_out' => 'datetime',
        'remote_work' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
