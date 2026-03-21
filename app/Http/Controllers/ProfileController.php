<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * RGPD Art. 17 (Derecho de supresión) + RD-ley 8/2019 (retención 4 años).
     *
     * No se hace hard-delete porque los registros de jornada son de obligada
     * conservación durante 4 años. En su lugar:
     *  1. Se anonimiza la cuenta (nombre, email, NIF → valores neutros).
     *  2. Se marca con soft-delete para el periodo de recuperación (30 días).
     * Los registros de jornada permanecen ligados al ID anónimo para cumplir la ley laboral.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        // Anonimizar datos personales identificativos manteniendo registros laborales
        $user->anonymize();

        // Soft-delete: marca deleted_at para posible recuperación en 30 días
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    /**
     * RGPD Art. 7 (Consentimiento) — actualiza el consentimiento de geolocalización.
     */
    public function updateGeolocationConsent(Request $request): RedirectResponse
    {
        $request->validate([
            'geolocation_consent' => ['required', 'boolean'],
        ]);

        $request->user()->update([
            'geolocation_consent' => $request->boolean('geolocation_consent'),
        ]);

        return Redirect::route('profile.edit')->with('status', 'geolocation-updated');
    }

    /**
     * RGPD Art. 20 (Portabilidad de datos).
     * Devuelve todos los datos personales del usuario autenticado en JSON.
     */
    public function exportData(Request $request): Response
    {
        $user = $request->user()->load([
            'timeEntries.breaks',
            'vacationRequests',
        ]);

        $data = [
            'exportado_el'   => now()->toIso8601String(),
            'base_legal'     => 'RGPD Art. 20 — Derecho a la portabilidad',
            'responsable'    => 'SyncJornada — syncjornada@gmail.com',
            'datos_personales' => [
                'id'                    => $user->id,
                'nombre'                => $user->name,
                'email'                 => $user->email,
                'nif'                   => $user->nif,
                'empresa_id'            => $user->company_id,
                'rol'                   => $user->role,
                'horas_diarias'         => $user->expected_daily_hours . 'h ' . $user->expected_daily_minutes . 'm',
                'consentimiento_datos'  => $user->data_consent_at?->toIso8601String(),
                'consentimiento_gps'    => $user->geolocation_consent,
                'ultimo_acceso'         => $user->last_login_at?->toIso8601String(),
                'cuenta_creada'         => $user->created_at->toIso8601String(),
            ],
            'registros_jornada' => $user->timeEntries->map(fn ($e) => [
                'fecha'            => $e->date,
                'entrada'          => $e->check_in?->toIso8601String(),
                'salida'           => $e->check_out?->toIso8601String(),
                'trabajo_remoto'   => $e->remote_work,
                'notas'            => $e->notes,
                'latitud_entrada'  => $e->check_in_latitude,
                'longitud_entrada' => $e->check_in_longitude,
                'latitud_salida'   => $e->check_out_latitude,
                'longitud_salida'  => $e->check_out_longitude,
                'pausas'           => $e->breaks->map(fn ($b) => [
                    'inicio' => $b->break_start->toIso8601String(),
                    'fin'    => $b->break_end?->toIso8601String(),
                    'motivo' => $b->reason,
                ]),
            ]),
            'solicitudes_vacaciones' => $user->vacationRequests->map(fn ($v) => [
                'desde'   => $v->start_date,
                'hasta'   => $v->end_date,
                'dias'    => $v->days,
                'motivo'  => $v->reason,
                'estado'  => $v->status,
            ]),
        ];

        return response(
            json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE),
            200,
            [
                'Content-Type'        => 'application/json; charset=utf-8',
                'Content-Disposition' => 'attachment; filename="mis-datos-syncjornada-' . now()->format('Y-m-d') . '.json"',
            ]
        );
    }
}
