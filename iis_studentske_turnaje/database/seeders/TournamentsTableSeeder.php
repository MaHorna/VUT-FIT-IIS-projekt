<?php

namespace Database\Seeders;

use DateTime;
use App\Models\Tournament;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TournamentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tournaments = [
            [
                'user_id' => 1,
                'name' => 'Xpeke cup',
                'status' => 'preparing',
                'game' => 'Chess',
                'start_date' => DateTime::createFromFormat('Y-m-d H:i', '2022-11-19 14:38'),
                'prize' => '1 ticket to Brazil',
                'num_participants' => 14,
                'teams_allowed' => true,
                'description' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. 
                Mauris metus. Duis sapien nunc, commodo et, interdum suscipit, sollicitudin et, dolor. 
                Praesent vitae arcu tempor neque lacinia pretium. Aenean placerat. In enim a arcu imperdiet malesuada. 
                Maecenas libero. Nullam at arcu a est sollicitudin euismod. 
                Integer rutrum, orci vestibulum ullamcorper ultricies, lacus quam ultricies odio, vitae placerat pede sem sit amet enim. 
                Fusce tellus odio, dapibus id fermentum quis, suscipit id erat. Fusce consectetuer risus a nunc.'
            ],
            [
                'user_id' => 1,
                'name' => 'Legends of league',
                'status' => 'preparing',
                'game' => 'League of legends',
                'start_date' => DateTime::createFromFormat('Y-m-d H:i', '2022-06-20 13:00'),
                'prize' => '500$',
                'num_participants' => 24,
                'teams_allowed' => true,
                'description' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. 
                Mauris metus. Duis sapien nunc, commodo et, interdum suscipit, sollicitudin et, dolor. 
                Praesent vitae arcu tempor neque lacinia pretium. Aenean placerat. In enim a arcu imperdiet malesuada. 
                Maecenas libero. Nullam at arcu a est sollicitudin euismod. 
                Integer rutrum, orci vestibulum ullamcorper ultricies, lacus quam ultricies odio, vitae placerat pede sem sit amet enim. 
                Fusce tellus odio, dapibus id fermentum quis, suscipit id erat. Fusce consectetuer risus a nunc.'
            ],
            [
                'user_id' => 22,
                'name' => 'Real tournament',
                'status' => 'preparing',
                'game' => 'League of legends',
                'start_date' => DateTime::createFromFormat('Y-m-d H:i', '2022-06-20 13:00'),
                'prize' => '$500',
                'num_participants' => 5,
                'teams_allowed' => false,
            ],
            [
                'user_id' => 22,
                'name' => 'Golf cup',
                'status' => 'preparing',
                'game' => 'Golf with friends',
                'start_date' => DateTime::createFromFormat('Y-m-d H:i', '2022-12-12 12:00'),
                'prize' => 'Golden ball',
                'num_participants' => 5,
                'teams_allowed' => true,
            ]
        ];

        foreach ($tournaments as $tournament => $value){
            Tournament::create($value);
        }
    }
}
