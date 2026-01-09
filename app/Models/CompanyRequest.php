<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyRequest extends Model
{
    protected $fillable = [
        'company_name',
        'contact_name',
        'email',
        'phone',
        'employees',
        'message',
        'status',
        'admin_notes',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
