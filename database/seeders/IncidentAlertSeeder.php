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
            'title' => '¡Aviso Importante!',
            'message' => '<strong>Aviso Importante:</strong> Hemos detectado un intento de ataque a nuestros sistemas. Como medida preventiva, hemos restaurado la base de datos desde una copia de seguridad limpia y segura. Es posible que algunos registros recientes se hayan perdido. Si tienes alguna duda, por favor contacta al administrador.',
            'type' => 'warning',
            'active' => true,
        ]);
    }
}