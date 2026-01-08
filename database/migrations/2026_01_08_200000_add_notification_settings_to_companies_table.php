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
            $table->boolean('enable_checkin_notifications')->default(true)->after('timezone');
            $table->boolean('enable_checkout_notifications')->default(true)->after('enable_checkin_notifications');
            $table->time('checkin_notification_time')->default('08:00:00')->after('enable_checkout_notifications');
            $table->time('checkout_notification_time')->default('19:00:00')->after('checkin_notification_time');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn([
                'enable_checkin_notifications',
                'enable_checkout_notifications',
                'checkin_notification_time',
                'checkout_notification_time'
            ]);
        });
    }
};
