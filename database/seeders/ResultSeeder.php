<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Result;

class ResultSeeder extends Seeder
{
    public function run(): void
    {
        // Get ALL patient users
        $patients = User::where('role', 'patient')->get();

        if ($patients->count() < 1) {
            echo "❌ No patient users found. Please seed UserSeeder first.\n";
            return;
        }

        $index = 1;

        foreach ($patients as $patient) {

            // Alternate: Normal for odd-numbered patients, High for even-numbered
            $isNormal = $index % 2 !== 0;

            $score = $isNormal ? 30 : 90;
            $level = $isNormal ? "Normal" : "High";
            $answerValue = $isNormal ? "1" : "3";

            Result::updateOrCreate(
                ['user_id' => $patient->id], // Prevent duplicates
                [
                    'totalScore' => $score,
                    'maxScore' => 150,
                    'level' => $level,
                    'answers' => array_fill_keys(range(1, 30), $answerValue),
                ]
            );

            $index++;
        }

        echo "✅ ResultSeeder completed for {$patients->count()} patient users.\n";
    }
}
