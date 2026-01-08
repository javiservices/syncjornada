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
            $table->decimal('check_in_latitude', 10, 8)->nullable()->after('check_in');
            $table->decimal('check_in_longitude', 11, 8)->nullable()->after('check_in_latitude');
            $table->decimal('check_out_latitude', 10, 8)->nullable()->after('check_out');
            $table->decimal('check_out_longitude', 11, 8)->nullable()->after('check_out_latitude');
            $table->string('ip_address')->nullable()->after('location');
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
            $table->dropColumn([
                'check_in_latitude',
                'check_in_longitude',
                'check_out_latitude',
                'check_out_longitude',
                'ip_address',
                'user_agent',
                'employee_confirmed',
                'is_locked'
            ]);
        });
    }
};
