<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

/**
 * RGPD Art. 5.1.e — Limitación del plazo de conservación (minimización de datos).
 * AEPD: La geolocalización de empleados es un dato especialmente sensible.
 *
 * El RD-ley 8/2019 exige conservar los registros de jornada 4 años, pero
 * NO exige conservar las coordenadas GPS ese tiempo; solo la hora de entrada/salida.
 * Por ello, eliminamos los datos de geolocalización de registros con más de 1 año
 * conservando el resto de campos (fecha, entrada, salida, etc.).
 */
class GdprPurgeGeolocation extends Command
{
    protected $signature   = 'gdpr:purge-geolocation {--years=1 : Purgar geolocalización de registros con más de N años}
                                                      {--dry-run : Solo muestra cuántos registros se verían afectados}';
    protected $description = 'Elimina coordenadas GPS de registros de jornada antiguos (RGPD minimización de datos)';

    public function handle(): int
    {
        $years  = (int) $this->option('years');
        $cutoff = now()->subYears($years)->toDateString();

        $count = DB::table('time_entries')
            ->where('date', '<=', $cutoff)
            ->where(function ($q) {
                $q->whereNotNull('check_in_latitude')
                  ->orWhereNotNull('check_in_longitude')
                  ->orWhereNotNull('check_out_latitude')
                  ->orWhereNotNull('check_out_longitude');
            })
            ->count();

        if ($count === 0) {
            $this->info("No hay registros con geolocalización anteriores a {$years} año(s).");
            return self::SUCCESS;
        }

        $this->info("Registros con geolocalización a purgar (anteriores al {$cutoff}): {$count}");

        if ($this->option('dry-run')) {
            $this->warn('[dry-run] No se han realizado cambios.');
            return self::SUCCESS;
        }

        DB::table('time_entries')
            ->where('date', '<=', $cutoff)
            ->update([
                'check_in_latitude'   => null,
                'check_in_longitude'  => null,
                'check_out_latitude'  => null,
                'check_out_longitude' => null,
            ]);

        $this->info("✓ Geolocalización eliminada de {$count} registro(s).");
        return self::SUCCESS;
    }
}
