<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\IncidentAlert;

class IncidentAlertSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        IncidentAlert::create([
            'message' => 'Debido a un incidente de seguridad, se restauró la base de datos desde una copia de respaldo limpia. Algunos datos recientes pueden haber sido perdidos. Si tienes preguntas, contacta al administrador.',
            'type' => 'warning',
            'active' => true,
        ]);
    }
}