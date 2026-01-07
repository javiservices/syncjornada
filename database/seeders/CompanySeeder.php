<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Company::create([
            'name' => 'SyncJornada Demo',
            'email' => 'demo@syncjornada.com',
            'phone' => '+34 123 456 789',
            'address' => 'Calle Ficticia 123, Madrid, España',
        ]);
    }
}
