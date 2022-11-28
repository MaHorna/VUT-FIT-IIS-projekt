<?php

namespace Database\Seeders;

use App\Models\Contest;
use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ContestsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $contests = [
            [
                'tournament_id' => 2,
                'contestant1_id' => 1,
                'contestant2_id' => 2,
                'date' => DateTime::createFromFormat('Y-m-d H:i', '2022-01-25 11:00'),
                'score1' => 12,
                'score2' => 5
            ],
            [
                'tournament_id' => 1,
                'contestant1_id' => 2,
                'contestant2_id' => 1,
                'date' => DateTime::createFromFormat('Y-m-d H:i', '2022-11-19 14:38'),
                'score1' => 8,
                'score2' => 13
            ]
        ];

        foreach ($contests as $contest => $value){
            Contest::create($value);
        }
    }
}
