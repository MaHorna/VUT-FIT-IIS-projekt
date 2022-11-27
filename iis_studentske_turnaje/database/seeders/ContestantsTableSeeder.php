<?php

namespace Database\Seeders;

use App\Models\Contestant;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ContestantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $contestants = [
            [
                'tournament_id' => 2,
                'team_id' => 1,
                'user_id' => 1,
                'isteam' => true
            ],
            [
                'tournament_id' => 1,
                'team_id' => 2,
                'user_id' => 2,
                'isteam' => true
            ],
            [
                'tournament_id' => 3,
                'user_id' => 1,
                'isteam' => false
            ],
            [
                'tournament_id' => 3,
                'user_id' => 2,
                'isteam' => false
            ],
            [
                'tournament_id' => 3,
                'user_id' => 3,
                'isteam' => false
            ],
            [
                'tournament_id' => 3,
                'user_id' => 4,
                'isteam' => false
            ],
            [
                'tournament_id' => 3,
                'user_id' => 5,
                'isteam' => false
            ],
            [
                'tournament_id' => 3,
                'user_id' => 6,
                'isteam' => false
            ],
            [
                'tournament_id' => 3,
                'user_id' => 7,
                'isteam' => false
            ],
            [
                'tournament_id' => 3,
                'user_id' => 8,
                'isteam' => false
            ],
            [
                'tournament_id' => 3,
                'user_id' => 9,
                'isteam' => false
            ],
            [
                'tournament_id' => 3,
                'user_id' => 10,
                'isteam' => false
            ],
            [
                'tournament_id' => 3,
                'user_id' => 11,
                'isteam' => false
            ],
            [
                'tournament_id' => 3,
                'user_id' => 12,
                'isteam' => false
            ],
            [
                'tournament_id' => 3,
                'user_id' => 13,
                'isteam' => false
            ],
            [
                'tournament_id' => 3,
                'user_id' => 14,
                'isteam' => false
            ],
            [
                'tournament_id' => 3,
                'user_id' => 15,
                'isteam' => false
            ],
            [
                'tournament_id' => 3,
                'user_id' => 16,
                'isteam' => false
            ],
            [
                'tournament_id' => 3,
                'user_id' => 17,
                'isteam' => false
            ]
        ];

        foreach ($contestants as $contestant => $value){
            Contestant::create($value);
        }
    }
}
