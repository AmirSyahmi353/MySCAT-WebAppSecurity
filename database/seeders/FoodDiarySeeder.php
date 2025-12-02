<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FoodDiary;
use Carbon\Carbon;

class FoodDiarySeeder extends Seeder
{
    public function run(): void
    {
        // Use ONE user ID for all 5 diary entries
        $userId = '673b4c28f452ce98e25b764d';  // <-- replace with real user _id

        for ($i = 1; $i <= 5; $i++) {

            FoodDiary::create([
                'user_id' => $userId,
                'entries' => [
                    'day1' => [
                        [
                            'meal' => 'breakfast',
                            'time' => '08:0' . rand(0,9) . ' AM',
                            'food' => 'Roti Canai',
                            'portion' => rand(1,2) . ' piece(s)',
                            'drink' => 'Teh Tarik',
                            'image' => 'uploads/food/roti_canai.jpg',
                        ],
                        [
                            'meal' => 'lunch',
                            'time' => '12:' . rand(10,59),
                            'food' => 'Nasi Goreng Ayam',
                            'portion' => '1 plate',
                            'drink' => 'Sirap Bandung',
                            'image' => 'uploads/food/nasi_goreng.jpg',
                        ],
                    ],

                    'day2' => [
                        [
                            'meal' => 'breakfast',
                            'time' => '07:' . rand(10,59),
                            'food' => 'Sandwich Telur',
                            'portion' => rand(1,3) . ' pcs',
                            'drink' => 'Milo',
                            'image' => 'uploads/food/sandwich.jpg',
                        ]
                    ],

                    'day3' => [
                        [
                            'meal' => 'dinner',
                            'time' => '07:' . rand(10,59),
                            'food' => 'Tomyam Seafood',
                            'portion' => '1 bowl',
                            'drink' => 'Air Suam',
                            'image' => 'uploads/food/tomyam.jpg',
                        ]
                    ]
                ],

                // Each diary has different timestamp
                'submitted_at' => Carbon::now()->subDays(5 - $i)
            ]);

        }
    }
}
