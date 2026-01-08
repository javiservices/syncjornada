<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Schedule automatic locking of old time entries (compliance with 4-year retention)
Schedule::command('timeentries:lock-old')->monthly();

// Schedule daily database backup at 2:00 AM
Schedule::command('backup:database')->dailyAt('02:00');

// Schedule cleanup of old backups (keep 30 days) - runs daily at 3:00 AM
Schedule::command('backup:clean')->dailyAt('03:00');

// Send daily check-in reminders at 8:00 AM
Schedule::command('reminders:daily-checkin')->dailyAt('08:00');

// Send missing check-out reminders at 7:00 PM
Schedule::command('reminders:missing-checkout')->dailyAt('19:00');

