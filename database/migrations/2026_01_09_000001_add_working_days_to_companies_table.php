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
            // Por defecto: [1,2,3,4,5] (lunes a viernes)
            $table->json('working_days')->default('[1,2,3,4,5]')->after('checkout_notification_time');
        });
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
