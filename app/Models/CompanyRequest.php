<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyRequest extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'company_name',
        'contact_name',
        'email',
        'phone',
        'employees',
        'message',
        'status',
        'admin_notes',
        'consent_given_at',
    ];

    protected $casts = [
        'created_at'       => 'datetime',
        'updated_at'       => 'datetime',
        'consent_given_at' => 'datetime',
        // RGPD Art. 32 — cifrado de datos de contacto
        'phone'            => 'encrypted',
        'message'          => 'encrypted',
        'admin_notes'      => 'encrypted',
    ];
}
