<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Demographic;
use Illuminate\Support\Str;

class DemographicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Demographic::create([
            'user_id'     => '692b053e14293b11ff09f35e',  // Replace with real existing user_id (Mongo ObjectId)
            'full_name'   => 'Test Patient',
            'age'         => 25,
            'gender'      => 'Female',
            'race'        => 'Malay',
            'postcode'    => '53100',
            'occupation'  => 'Student',
            'education'   => 'Bachelor Degree',
            'email'       => 'patient@example.com',
            'height_cm'   => 160,
            'weight_kg'   => 55,
            'income'      => 'Below RM2000',
        ]);

        Demographic::create([
            'user_id'     => '677123abc123456789000002', 
            'full_name'   => 'John Doe',
            'age'         => 30,
            'gender'      => 'Male',
            'race'        => 'Chinese',
            'postcode'    => '43000',
            'occupation'  => 'Engineer',
            'education'   => 'Master Degree',
            'email'       => 'john@example.com',
            'height_cm'   => 170,
            'weight_kg'   => 70,
            'income'      => 'RM2000 - RM4000',
        ]);

        Demographic::create([
            'user_id'     => '677123abc123456789000003',
            'full_name'   => 'Jane Doe',
            'age'         => 28,
            'gender'      => 'Female',
            'race'        => 'Indian',
            'postcode'    => '41000',
            'occupation'  => 'Nurse',
            'education'   => 'Diploma',
            'email'       => 'jane@example.com',
            'height_cm'   => 165,
            'weight_kg'   => 60,
            'income'      => 'RM4000 - RM6000',
        ]);
    }
}
