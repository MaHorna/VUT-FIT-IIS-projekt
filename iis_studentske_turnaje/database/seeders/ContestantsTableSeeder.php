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
                'teamuser_id' => 1,
                'team_id' => 1,
                'isteam' => true
            ],
            [
                'tournament_id' => 1,
                'teamuser_id' => 2,
                'team_id' => 2,
                'isteam' => true
            ]
        ];

        foreach ($contestants as $contestant => $value){
            Contestant::create($value);
        }
    }
}
