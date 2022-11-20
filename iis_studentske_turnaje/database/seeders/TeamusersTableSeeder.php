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
                'team_id' => 2,
                'user_id' => 1
            ],
            [
                'team_id' => 1,
                'user_id' => 2
            ]
        ];

        foreach ($teamusers as $teamUser => $value){
            Teamuser::create($value);
        }
    }
}
