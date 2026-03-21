<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

/**
 * RGPD Art. 17 — Derecho de supresión.
 *
 * Anonimiza definitivamente las cuentas que fueron marcadas para eliminación
 * hace más de 30 días (periodo de recuperación tras la solicitud del usuario).
 * Los registros de jornada permanecen vinculados al ID del usuario anonimizado
 * para cumplir la retención obligatoria de 4 años (RD-ley 8/2019).
 */
class GdprAnonymizeUsers extends Command
{
    protected $signature   = 'gdpr:anonymize-users {--dry-run : Solo muestra qué cuentas se anonimizarían sin ejecutar cambios}';
    protected $description = 'Anonimiza cuentas eliminadas hace más de 30 días (RGPD Art. 17 + RD-ley 8/2019)';

    public function handle(): int
    {
        $cutoff = now()->subDays(30);

        $users = User::onlyTrashed()
            ->whereNull('anonymized_at')
            ->where('deleted_at', '<=', $cutoff)
            ->get();

        if ($users->isEmpty()) {
            $this->info('No hay cuentas pendientes de anonimizar.');
            return self::SUCCESS;
        }

        $this->info("Cuentas a anonimizar: {$users->count()}");

        if ($this->option('dry-run')) {
            $this->table(['ID', 'Email', 'Eliminado el'], $users->map(fn ($u) => [
                $u->id, $u->email, $u->deleted_at->format('d/m/Y'),
            ]));
            $this->warn('[dry-run] No se han realizado cambios.');
            return self::SUCCESS;
        }

        foreach ($users as $user) {
            $user->anonymize();
            $this->line("  ✓ Cuenta ID {$user->id} anonimizada.");
        }

        $this->info("Anonimización completada: {$users->count()} cuenta(s).");
        return self::SUCCESS;
    }
}
