<?php

namespace App\Console\Commands;

use App\Models\CompanyRequest;
use Illuminate\Console\Command;

/**
 * RGPD Art. 5.1.e — Limitación del plazo de conservación.
 *
 * Las solicitudes de acceso (company_requests) contienen datos personales de
 * contacto (nombre, email, teléfono). Una vez rechazadas o transcurrido 1 año
 * sin respuesta, no existe base legal para conservarlos.
 * Este comando las elimina (soft-delete) para su posterior borrado definitivo.
 */
class GdprPurgeCompanyRequests extends Command
{
    protected $signature   = 'gdpr:purge-company-requests {--months=12 : Purgar solicitudes con más de N meses}
                                                           {--dry-run : Solo muestra cuántas se verían afectadas}';
    protected $description = 'Elimina solicitudes de empresa antiguas sin base legal de conservación (RGPD Art. 5.1.e)';

    public function handle(): int
    {
        $months = (int) $this->option('months');
        $cutoff = now()->subMonths($months);

        // Solicitudes rechazadas o pendientes sin resolución tras N meses
        $query = CompanyRequest::whereIn('status', ['rejected', 'pending'])
            ->where('created_at', '<=', $cutoff);

        $count = $query->count();

        if ($count === 0) {
            $this->info("No hay solicitudes antiguas a purgar.");
            return self::SUCCESS;
        }

        $this->info("Solicitudes a eliminar ({$months} meses sin actividad): {$count}");

        if ($this->option('dry-run')) {
            $this->warn('[dry-run] No se han realizado cambios.');
            return self::SUCCESS;
        }

        $query->delete(); // Soft-delete (SoftDeletes trait)

        $this->info("✓ {$count} solicitud(es) marcadas para eliminación.");
        return self::SUCCESS;
    }
}
