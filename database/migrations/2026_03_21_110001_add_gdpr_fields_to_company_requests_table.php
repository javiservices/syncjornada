<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('company_requests', function (Blueprint $table) {
            // RGPD Art. 7: Registro de consentimiento en formulario de contacto
            $table->timestamp('consent_given_at')->nullable()->after('admin_notes')
                  ->comment('Timestamp en que el solicitante marcó la casilla de consentimiento');

            // Soft delete: derecho de supresión (Art. 17 RGPD)
            $table->softDeletes()->after('consent_given_at');
        });
    }

    public function down(): void
    {
        Schema::table('company_requests', function (Blueprint $table) {
            $table->dropColumn('consent_given_at');
            $table->dropSoftDeletes();
        });
    }
};
