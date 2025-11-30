<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Demographic;
use App\Models\User;

class DemographicSeeder extends Seeder
{
    public function run(): void
    {
        // Fetch ALL patient users (you added 5 in UserSeeder)
        $patients = User::where('role', 'patient')->get();

        if ($patients->count() < 1) {
            echo "❌ No patient users found. Please run UserSeeder first.\n";
            return;
        }

        // Predefined demographic field sets
        $races       = ['Malay', 'Chinese', 'Indian'];
        $occupations = ['Student', 'Engineer', 'Nurse', 'Teacher', 'Technician'];
        $educations  = ['Diploma', 'Bachelor Degree', 'Master Degree'];
        $income      = ['Below RM2000', 'RM2000 - RM4000', 'RM4000 - RM6000'];

        foreach ($patients as $i => $patient) {

            // Create or update demographic record for each patient
            Demographic::updateOrCreate(
                ['user_id' => $patient->_id],   // Prevent duplicate demographic records
                [
                    'full_name'  => $patient->name,
                    'age'        => rand(20, 50),
                    'gender'     => $i % 2 === 0 ? 'Female' : 'Male',
                    'race'       => $races[$i % count($races)],
                    'postcode'   => (string) rand(40000, 60000),
                    'occupation' => $occupations[$i % count($occupations)],
                    'education'  => $educations[$i % count($educations)],
                    'email'      => $patient->email,
                    'height_cm'  => rand(150, 180),
                    'weight_kg'  => rand(45, 85),
                    'income'     => $income[$i % count($income)],
                ]
            );
        }

        echo "✅ DemographicSeeder completed for {$patients->count()} patient users.\n";
    }
}
