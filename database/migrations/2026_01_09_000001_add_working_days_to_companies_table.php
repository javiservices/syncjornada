<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            // JSON array con días laborables [0=domingo, 1=lunes, ..., 6=sábado]
            $table->json('working_days')->nullable()->after('checkout_notification_time');
        });
        
        // Establecer valor por defecto [1,2,3,4,5] (lunes a viernes) para registros existentes
        \DB::table('companies')->update(['working_days' => json_encode([1,2,3,4,5])]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn('working_days');
        });
    }
};
