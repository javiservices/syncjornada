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
        Schema::table('time_entries', function (Blueprint $table) {
            $table->string('ip_address')->nullable()->after('check_out_longitude');
            $table->text('user_agent')->nullable()->after('ip_address');
            $table->boolean('employee_confirmed')->default(true)->after('user_agent'); // Confirmación del empleado
            $table->boolean('is_locked')->default(false)->after('employee_confirmed'); // Registro bloqueado (>4 años o por auditoría)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('time_entries', function (Blueprint $table) {
            $table->dropColumn(['ip_address', 'user_agent', 'employee_confirmed', 'is_locked']);
        });
    }
};
