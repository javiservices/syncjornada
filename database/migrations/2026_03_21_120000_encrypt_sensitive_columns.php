<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Cifrado AES-256-CBC (via APP_KEY) de columnas con datos personales sensibles.
 *
 * RGPD Art. 25 (Privacy by Design) + Art. 32 (Seguridad del tratamiento)
 * LOPDGDD 3/2018 — medida técnica de seguridad.
 *
 * Columnas cifradas:
 *   users              → nif
 *   time_entries       → check_in/out_latitude, check_in/out_longitude, ip_address, user_agent, notes
 *   vacation_requests  → reason, manager_notes
 *   company_requests   → phone, message, admin_notes
 *
 * NO se cifra email (necesario para autenticación por WHERE) ni name (búsquedas).
 */
return new class extends Migration
{
    public function up(): void
    {
        // ── 1. Cambio de tipos para alojar texto cifrado ─────────────────────────
        Schema::table('users', function (Blueprint $table) {
            $table->text('nif')->nullable()->change();
        });

        Schema::table('time_entries', function (Blueprint $table) {
            $table->text('check_in_latitude')->nullable()->change();
            $table->text('check_in_longitude')->nullable()->change();
            $table->text('check_out_latitude')->nullable()->change();
            $table->text('check_out_longitude')->nullable()->change();
            $table->text('ip_address')->nullable()->change();
        });

        Schema::table('company_requests', function (Blueprint $table) {
            $table->text('phone')->nullable()->change();
        });

        // ── 2. Migrar datos existentes a cifrado ─────────────────────────────────

        // users.nif
        DB::table('users')->whereNotNull('nif')->chunkById(100, function ($rows) {
            foreach ($rows as $row) {
                DB::table('users')->where('id', $row->id)->update([
                    'nif' => Crypt::encryptString($row->nif),
                ]);
            }
        });

        // time_entries: coordenadas GPS (24 filas existentes)
        DB::table('time_entries')
            ->where(function ($q) {
                $q->whereNotNull('check_in_latitude')
                  ->orWhereNotNull('check_in_longitude')
                  ->orWhereNotNull('check_out_latitude')
                  ->orWhereNotNull('check_out_longitude');
            })
            ->chunkById(100, function ($rows) {
                foreach ($rows as $row) {
                    DB::table('time_entries')->where('id', $row->id)->update([
                        'check_in_latitude'   => $row->check_in_latitude   !== null ? Crypt::encryptString((string) $row->check_in_latitude)   : null,
                        'check_in_longitude'  => $row->check_in_longitude  !== null ? Crypt::encryptString((string) $row->check_in_longitude)  : null,
                        'check_out_latitude'  => $row->check_out_latitude  !== null ? Crypt::encryptString((string) $row->check_out_latitude)  : null,
                        'check_out_longitude' => $row->check_out_longitude !== null ? Crypt::encryptString((string) $row->check_out_longitude) : null,
                    ]);
                }
            });

        // time_entries: ip_address, user_agent, notes
        foreach (['ip_address', 'user_agent', 'notes'] as $col) {
            DB::table('time_entries')->whereNotNull($col)->chunkById(100, function ($rows) use ($col) {
                foreach ($rows as $row) {
                    DB::table('time_entries')->where('id', $row->id)->update([
                        $col => Crypt::encryptString($row->{$col}),
                    ]);
                }
            });
        }

        // vacation_requests: reason, manager_notes
        foreach (['reason', 'manager_notes'] as $col) {
            DB::table('vacation_requests')->whereNotNull($col)->chunkById(100, function ($rows) use ($col) {
                foreach ($rows as $row) {
                    DB::table('vacation_requests')->where('id', $row->id)->update([
                        $col => Crypt::encryptString($row->{$col}),
                    ]);
                }
            });
        }

        // company_requests: phone, message, admin_notes
        foreach (['phone', 'message', 'admin_notes'] as $col) {
            DB::table('company_requests')->whereNotNull($col)->chunkById(100, function ($rows) use ($col) {
                foreach ($rows as $row) {
                    DB::table('company_requests')->where('id', $row->id)->update([
                        $col => Crypt::encryptString($row->{$col}),
                    ]);
                }
            });
        }
    }

    public function down(): void
    {
        // Descifrar GPS y restaurar tipos originales
        DB::table('time_entries')
            ->whereNotNull('check_in_latitude')
            ->chunkById(100, function ($rows) {
                foreach ($rows as $row) {
                    try {
                        DB::table('time_entries')->where('id', $row->id)->update([
                            'check_in_latitude'   => $row->check_in_latitude   ? Crypt::decryptString($row->check_in_latitude)   : null,
                            'check_in_longitude'  => $row->check_in_longitude  ? Crypt::decryptString($row->check_in_longitude)  : null,
                            'check_out_latitude'  => $row->check_out_latitude  ? Crypt::decryptString($row->check_out_latitude)  : null,
                            'check_out_longitude' => $row->check_out_longitude ? Crypt::decryptString($row->check_out_longitude) : null,
                        ]);
                    } catch (\Exception) {}
                }
            });

        // Descifrar resto de columnas text
        foreach (['ip_address', 'user_agent', 'notes'] as $col) {
            DB::table('time_entries')->whereNotNull($col)->chunkById(100, function ($rows) use ($col) {
                foreach ($rows as $row) {
                    try { DB::table('time_entries')->where('id', $row->id)->update([$col => Crypt::decryptString($row->{$col})]); } catch (\Exception) {}
                }
            });
        }
        foreach (['reason', 'manager_notes'] as $col) {
            DB::table('vacation_requests')->whereNotNull($col)->chunkById(100, function ($rows) use ($col) {
                foreach ($rows as $row) {
                    try { DB::table('vacation_requests')->where('id', $row->id)->update([$col => Crypt::decryptString($row->{$col})]); } catch (\Exception) {}
                }
            });
        }
        foreach (['phone', 'message', 'admin_notes'] as $col) {
            DB::table('company_requests')->whereNotNull($col)->chunkById(100, function ($rows) use ($col) {
                foreach ($rows as $row) {
                    try { DB::table('company_requests')->where('id', $row->id)->update([$col => Crypt::decryptString($row->{$col})]); } catch (\Exception) {}
                }
            });
        }
        DB::table('users')->whereNotNull('nif')->chunkById(100, function ($rows) {
            foreach ($rows as $row) {
                try { DB::table('users')->where('id', $row->id)->update(['nif' => Crypt::decryptString($row->nif)]); } catch (\Exception) {}
            }
        });

        // Restaurar tipos de columna originales
        Schema::table('time_entries', function (Blueprint $table) {
            $table->decimal('check_in_latitude', 10, 8)->nullable()->change();
            $table->decimal('check_in_longitude', 11, 8)->nullable()->change();
            $table->decimal('check_out_latitude', 10, 8)->nullable()->change();
            $table->decimal('check_out_longitude', 11, 8)->nullable()->change();
            $table->string('ip_address')->nullable()->change();
        });
        Schema::table('users', function (Blueprint $table) {
            $table->string('nif')->nullable()->change();
        });
        Schema::table('company_requests', function (Blueprint $table) {
            $table->string('phone')->nullable()->change();
        });
    }
};
