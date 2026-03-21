<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\VacationRequest;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'company_id',
        'role',
        'nif',
        'expected_daily_hours',
        'expected_daily_minutes',
        'notify_on_daily_hours_completion',
        'incident_alert_shown',
        'data_consent_at',
        'geolocation_consent',
        'last_login_at',
        'anonymized_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at'               => 'datetime',
            'password'                        => 'hashed',
            'notify_on_daily_hours_completion' => 'boolean',
            'geolocation_consent'             => 'boolean',
            'data_consent_at'                 => 'datetime',
            'last_login_at'                   => 'datetime',
            'anonymized_at'                   => 'datetime',
            // RGPD Art. 32 — NIF/DNI cifrado AES-256
            'nif'                             => 'encrypted',
        ];
    }

    /**
     * RGPD Art. 17 + RD-ley 8/2019: Anonimiza los datos personales identificativos
     * manteniendo los registros de jornada (obligación legal 4 años).
     * Se llama cuando el usuario ejerce el derecho de supresión.
     */
    public function anonymize(): void
    {
        $this->forceFill([
            'name'                => 'Empleado Anonimizado',
            'email'               => 'anonimizado_' . $this->id . '@eliminado.local',
            'password'            => Hash::make(Str::random(64)),
            'nif'                 => null,
            'remember_token'      => null,
            'email_verified_at'   => null,
            'geolocation_consent' => false,
            'anonymized_at'       => now(),
        ])->saveQuietly(); // saveQuietly para no disparar observers de auditoría
    }

    /** ¿La cuenta ha sido anonimizada? */
    public function isAnonymized(): bool
    {
        return $this->anonymized_at !== null;
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function timeEntries()
    {
        return $this->hasMany(TimeEntry::class);
    }

    public function vacationRequests()
    {
        return $this->hasMany(VacationRequest::class);
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }
}
