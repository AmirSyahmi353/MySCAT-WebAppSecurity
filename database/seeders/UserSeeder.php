<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin user
        User::create([
            'name'     => 'Admin',
            'email'    => 'admin@example.com',
            'password' => Hash::make('password'),
            'role'     => 'admin',
            'status'   => 'active',
        ]);

        // Dietitian user
        User::create([
            'name'     => 'Dietitian',
            'email'    => 'dietitian@example.com',
            'password' => Hash::make('password'),
            'role'     => 'dietitian',
            'status'   => 'active',
        ]);

        // Patient user
        User::create([
            'name'     => 'Patient',
            'email'    => 'patient@example.com',
            'password' => Hash::make('password'),
            'role'     => 'patient',
            'status'   => 'active',
        ]);
    }
}
