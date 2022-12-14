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
            
        ];

        foreach ($contests as $contest => $value){
            Contest::create($value);
        }
    }
}
