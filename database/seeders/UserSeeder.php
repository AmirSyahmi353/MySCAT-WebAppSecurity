<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        /** ---------------------
         *  ADMIN USER
         * --------------------- */
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name'     => 'Admin',
                'password' => Hash::make('password'),
                'role'     => 'admin',
                'status'   => 'active',
            ]
        );

        /** ---------------------
         *  DIETITIAN USER
         * --------------------- */
        User::updateOrCreate(
            ['email' => 'dietitian@example.com'],
            [
                'name'     => 'Dietitian',
                'password' => Hash::make('password'),
                'role'     => 'dietitian',
                'status'   => 'active',
            ]
        );

        /** ---------------------
         *  5 PATIENT USERS
         * --------------------- */
        $patients = [
            ['name' => 'Patient One',   'email' => 'patient1@example.com'],
            ['name' => 'Patient Two',   'email' => 'patient2@example.com'],
            ['name' => 'Patient Three', 'email' => 'patient3@example.com'],
            ['name' => 'Patient Four',  'email' => 'patient4@example.com'],
            ['name' => 'Patient Five',  'email' => 'patient5@example.com'],
        ];

        foreach ($patients as $p) {
            User::updateOrCreate(
                ['email' => $p['email']], // unique
                [
                    'name'     => $p['name'],
                    'password' => Hash::make('password'),
                    'role'     => 'patient',
                    'status'   => 'active',
                ]
            );
        }
    }
}
