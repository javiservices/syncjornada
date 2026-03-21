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

// Check every minute for check-in reminders (commands verify if it's time for each company)
Schedule::command('reminders:daily-checkin')->everyMinute();

// Check every minute for check-out reminders (commands verify if it's time for each company)
Schedule::command('reminders:missing-checkout')->everyMinute();

// ── RGPD / LOPDGDD ────────────────────────────────────────────────────────────
// Anonimizar cuentas eliminadas hace más de 30 días (Art. 17 RGPD)
Schedule::command('gdpr:anonymize-users')->daily();

// Purgar coordenadas GPS de registros con más de 1 año (Art. 5.1.e RGPD - minimización)
Schedule::command('gdpr:purge-geolocation --years=1')->monthly();

// Purgar solicitudes de empresa rechazadas/sin respuesta tras 12 meses (Art. 5.1.e RGPD)
Schedule::command('gdpr:purge-company-requests --months=12')->monthly();

