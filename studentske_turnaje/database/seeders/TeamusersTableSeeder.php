<?php

namespace Database\Seeders;

use App\Models\Teamuser;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TeamusersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $teamusers = [
            [
                'team_id' => 1,
                'user_id' => 1
            ],
            [
                'team_id' => 1,
                'user_id' => 2
            ],
            [
                'team_id' => 1,
                'user_id' => 3
            ],
            [
                'team_id' => 1,
                'user_id' => 4
            ],
            [
                'team_id' => 1,
                'user_id' => 5
            ],
            [
                'team_id' => 3,
                'user_id' => 10
            ],
            [
                'team_id' => 3,
                'user_id' => 11
            ],
            [
                'team_id' => 3,
                'user_id' => 12
            ],
            [
                'team_id' => 3,
                'user_id' => 13
            ],
            [
                'team_id' => 3,
                'user_id' => 14
            ],
            [
                'team_id' => 4,
                'user_id' => 3
            ],
            [
                'team_id' => 5,
                'user_id' => 4
            ],
            [
                'team_id' => 6,
                'user_id' => 5
            ],
            [
                'team_id' => 7,
                'user_id' => 6
            ],
            [
                'team_id' => 8,
                'user_id' => 7
            ],
            [
                'team_id' => 9,
                'user_id' => 8
            ],
            [
                'team_id' => 10,
                'user_id' => 9
            ],
            [
                'team_id' => 11,
                'user_id' => 22
            ]
        ];

        foreach ($teamusers as $teamUser => $value){
            Teamuser::create($value);
        }
    }
}
