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
        Schema::table('users', function (Blueprint $table) {
            // Eliminar el campo decimal/integer previo
            $table->dropColumn('expected_daily_hours');
            
            // Añadir los nuevos campos
            $table->unsignedTinyInteger('expected_daily_hours')->default(8)->after('role');
            if (!Schema::hasColumn('users', 'expected_daily_minutes')) {
                $table->unsignedTinyInteger('expected_daily_minutes')->default(0)->after('expected_daily_hours');
            }
            if (!Schema::hasColumn('users', 'notify_on_daily_hours_completion')) {
                $table->boolean('notify_on_daily_hours_completion')->default(false)->after('expected_daily_minutes');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['expected_daily_hours', 'expected_daily_minutes', 'notify_on_daily_hours_completion']);
            $table->decimal('expected_daily_hours', 4, 2)->default(8.00)->after('role');
        });
    }
};
