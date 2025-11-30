<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Result;

class ResultSeeder extends Seeder
{
    public function run(): void
    {
        // Example 1: Normal craving user
        Result::create([
            'user_id'     => '692b053e14293b11ff09f35e',   // Replace with a real user ID
            'totalScore'  => 30,
            'maxScore'    => 150,
            'level'       => 'Normal',
            'answers'     => json_encode([
                "1" => "1", "2" => "1", "3" => "1", "4" => "1", "5" => "1",
                "6" => "1", "7" => "1", "8" => "1", "9" => "1", "10" => "1",
                "11" => "1", "12" => "1", "13" => "1", "14" => "1", "15" => "1",
                "16" => "1", "17" => "1", "18" => "1", "19" => "1", "20" => "1",
                "21" => "1", "22" => "1", "23" => "1", "24" => "1", "25" => "1",
                "26" => "1", "27" => "1", "28" => "1", "29" => "1", "30" => "1",
            ]),
        ]);

        // Example 2: High craving user
        Result::create([
            'user_id'     => '692b9270559048deb80305ef',  // Replace with a real user ID
            'totalScore'  => 90,
            'maxScore'    => 150,
            'level'       => 'High',
            'answers'     => json_encode([
                "1" => "3", "2" => "2", "3" => "3", "4" => "2", "5" => "3",
                "6" => "3", "7" => "2", "8" => "3", "9" => "3", "10" => "3",
                "11" => "2", "12" => "3", "13" => "3", "14" => "3", "15" => "3",
                "16" => "2", "17" => "3", "18" => "3", "19" => "3", "20" => "3",
                "21" => "2", "22" => "3", "23" => "3", "24" => "3", "25" => "3",
                "26" => "3", "27" => "3", "28" => "3", "29" => "3", "30" => "3",
            ]),
        ]);
    }
}
