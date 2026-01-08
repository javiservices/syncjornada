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
        'checkout_notification_time'
    ];

    protected $casts = [
        'enable_checkin_notifications' => 'boolean',
        'enable_checkout_notifications' => 'boolean',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
