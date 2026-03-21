<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // RGPD Art. 7: Prueba de consentimiento — cuándo aceptó la política de privacidad
            $table->timestamp('data_consent_at')->nullable()->after('updated_at');

            // AEPD: Consentimiento explícito separado para geolocalización
            $table->boolean('geolocation_consent')->default(false)->after('data_consent_at')
                  ->comment('Consentimiento explícito RGPD para captura de coordenadas GPS');

            // Gestión de cuentas inactivas — datos mínimos (Art. 5.1.e RGPD)
            $table->timestamp('last_login_at')->nullable()->after('geolocation_consent');

            // Soft delete: periodo de recuperación 30 días antes de anonimizar
            $table->softDeletes()->after('last_login_at');

            // Registro de anonimización (datos personales borrados, registros laborales conservados)
            $table->timestamp('anonymized_at')->nullable()->after('deleted_at');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['data_consent_at', 'geolocation_consent', 'last_login_at', 'anonymized_at']);
            $table->dropSoftDeletes();
        });
    }
};
