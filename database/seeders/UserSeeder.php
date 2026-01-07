<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'name' => 'Admin User',
            'email' => 'admin@syncjornada.com',
            'password' => bcrypt('password'),
            'company_id' => 1,
            'role' => 'admin',
        ]);

        \App\Models\User::create([
            'name' => 'Manager User',
            'email' => 'manager@syncjornada.com',
            'password' => bcrypt('password'),
            'company_id' => 1,
            'role' => 'manager',
        ]);

        \App\Models\User::create([
            'name' => 'Employee User',
            'email' => 'employee@syncjornada.com',
            'password' => bcrypt('password'),
            'company_id' => 1,
            'role' => 'employee',
        ]);
    }
}
