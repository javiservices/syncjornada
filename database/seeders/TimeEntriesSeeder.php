<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TimeEntriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener el primer usuario employee
        $employee = \App\Models\User::where('role', 'employee')->first();

        if ($employee) {
            // Crear 50 registros de time entries para el employee
            for ($i = 0; $i < 50; $i++) {
                $date = Carbon::now()->subDays($i);
                $checkIn = Carbon::now()->subDays($i)->setHour(rand(8, 10))->setMinute(rand(0, 59));
                $checkOut = (rand(0, 1)) ? $checkIn->copy()->addHours(rand(7, 9))->addMinutes(rand(0, 59)) : null;

                \App\Models\TimeEntry::create([
                    'user_id' => $employee->id,
                    'date' => $date->toDateString(),
                    'check_in' => $checkIn,
                    'check_out' => $checkOut,
                    'remote_work' => rand(0, 1),
                    'check_in_latitude' => rand(0, 1) ? 40.4168 + (rand(-100, 100) / 1000) : null,
                    'check_in_longitude' => rand(0, 1) ? -3.7038 + (rand(-100, 100) / 1000) : null,
                    'check_out_latitude' => $checkOut && rand(0, 1) ? 40.4168 + (rand(-100, 100) / 1000) : null,
                    'check_out_longitude' => $checkOut && rand(0, 1) ? -3.7038 + (rand(-100, 100) / 1000) : null,
                    'notes' => rand(0, 2) ? 'Nota de prueba #' . ($i + 1) . ' - ' . ['Trabajo desde casa', 'Reunión importante', 'Proyecto urgente'][rand(0, 2)] : null,
                ]);
            }
        }
    }
}