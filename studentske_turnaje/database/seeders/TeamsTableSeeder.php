<?php

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $teams = [
            [
                'user_id' => 1,
                'name' => 'Sk Telecom',
                'description' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. 
                Mauris metus. Duis sapien nunc, commodo et, interdum suscipit, sollicitudin et, dolor. 
                Praesent vitae arcu tempor neque lacinia pretium. Aenean placerat. In enim a arcu imperdiet malesuada. 
                Maecenas libero. Nullam at arcu a est sollicitudin euismod. 
                Integer rutrum, orci vestibulum ullamcorper ultricies, lacus quam ultricies odio, vitae placerat pede sem sit amet enim. 
                Fusce tellus odio, dapibus id fermentum quis, suscipit id erat. Fusce consectetuer risus a nunc.'
            ],
            [
                'user_id' => 2,
                'name' => 'G2',
                'description' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. 
                Mauris metus. Duis sapien nunc, commodo et, interdum suscipit, sollicitudin et, dolor. 
                Praesent vitae arcu tempor neque lacinia pretium. Aenean placerat. In enim a arcu imperdiet malesuada. 
                Maecenas libero. Nullam at arcu a est sollicitudin euismod. 
                Integer rutrum, orci vestibulum ullamcorper ultricies, lacus quam ultricies odio, vitae placerat pede sem sit amet enim. 
                Fusce tellus odio, dapibus id fermentum quis, suscipit id erat. Fusce consectetuer risus a nunc.'
            ],
            [
                'user_id' => 10,
                'name' => 'momoos test teams',
                'description' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. 
                Mauris metus. Duis sapien nunc, commodo et, interdum suscipit, sollicitudin et, dolor. 
                Praesent vitae arcu tempor neque lacinia pretium. Aenean placerat. In enim a arcu imperdiet malesuada. 
                Maecenas libero. Nullam at arcu a est sollicitudin euismod. 
                Integer rutrum, orci vestibulum ullamcorper ultricies, lacus quam ultricies odio, vitae placerat pede sem sit amet enim. 
                Fusce tellus odio, dapibus id fermentum quis, suscipit id erat. Fusce consectetuer risus a nunc.'
            ],
            [
                'user_id' => 3,
                'name' => 'Team 4',
                'description' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. 
                Mauris metus. Duis sapien nunc, commodo et, interdum suscipit, sollicitudin et, dolor. 
                Praesent vitae arcu tempor neque lacinia pretium. Aenean placerat. In enim a arcu imperdiet malesuada. 
                Maecenas libero. Nullam at arcu a est sollicitudin euismod. 
                Integer rutrum, orci vestibulum ullamcorper ultricies, lacus quam ultricies odio, vitae placerat pede sem sit amet enim. 
                Fusce tellus odio, dapibus id fermentum quis, suscipit id erat. Fusce consectetuer risus a nunc.'
            ],
            [
                'user_id' => 4,
                'name' => 'Team 5',
                'description' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. 
                Mauris metus. Duis sapien nunc, commodo et, interdum suscipit, sollicitudin et, dolor. 
                Praesent vitae arcu tempor neque lacinia pretium. Aenean placerat. In enim a arcu imperdiet malesuada. 
                Maecenas libero. Nullam at arcu a est sollicitudin euismod. 
                Integer rutrum, orci vestibulum ullamcorper ultricies, lacus quam ultricies odio, vitae placerat pede sem sit amet enim. 
                Fusce tellus odio, dapibus id fermentum quis, suscipit id erat. Fusce consectetuer risus a nunc.'
            ],
            [
                'user_id' => 5,
                'name' => 'Team 6',
                'description' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. 
                Mauris metus. Duis sapien nunc, commodo et, interdum suscipit, sollicitudin et, dolor. 
                Praesent vitae arcu tempor neque lacinia pretium. Aenean placerat. In enim a arcu imperdiet malesuada. 
                Maecenas libero. Nullam at arcu a est sollicitudin euismod. 
                Integer rutrum, orci vestibulum ullamcorper ultricies, lacus quam ultricies odio, vitae placerat pede sem sit amet enim. 
                Fusce tellus odio, dapibus id fermentum quis, suscipit id erat. Fusce consectetuer risus a nunc.'
            ],
            [
                'user_id' => 6,
                'name' => 'Team 7',
                'description' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. 
                Mauris metus. Duis sapien nunc, commodo et, interdum suscipit, sollicitudin et, dolor. 
                Praesent vitae arcu tempor neque lacinia pretium. Aenean placerat. In enim a arcu imperdiet malesuada. 
                Maecenas libero. Nullam at arcu a est sollicitudin euismod. 
                Integer rutrum, orci vestibulum ullamcorper ultricies, lacus quam ultricies odio, vitae placerat pede sem sit amet enim. 
                Fusce tellus odio, dapibus id fermentum quis, suscipit id erat. Fusce consectetuer risus a nunc.'
            ],
            [
                'user_id' => 7,
                'name' => 'Team 8',
                'description' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. 
                Mauris metus. Duis sapien nunc, commodo et, interdum suscipit, sollicitudin et, dolor. 
                Praesent vitae arcu tempor neque lacinia pretium. Aenean placerat. In enim a arcu imperdiet malesuada. 
                Maecenas libero. Nullam at arcu a est sollicitudin euismod. 
                Integer rutrum, orci vestibulum ullamcorper ultricies, lacus quam ultricies odio, vitae placerat pede sem sit amet enim. 
                Fusce tellus odio, dapibus id fermentum quis, suscipit id erat. Fusce consectetuer risus a nunc.'
            ],
            [
                'user_id' => 8,
                'name' => 'Team 9',
                'description' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. 
                Mauris metus. Duis sapien nunc, commodo et, interdum suscipit, sollicitudin et, dolor. 
                Praesent vitae arcu tempor neque lacinia pretium. Aenean placerat. In enim a arcu imperdiet malesuada. 
                Maecenas libero. Nullam at arcu a est sollicitudin euismod. 
                Integer rutrum, orci vestibulum ullamcorper ultricies, lacus quam ultricies odio, vitae placerat pede sem sit amet enim. 
                Fusce tellus odio, dapibus id fermentum quis, suscipit id erat. Fusce consectetuer risus a nunc.'
            ],
            [
                'user_id' => 9,
                'name' => 'Team 10',
                'description' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. 
                Mauris metus. Duis sapien nunc, commodo et, interdum suscipit, sollicitudin et, dolor. 
                Praesent vitae arcu tempor neque lacinia pretium. Aenean placerat. In enim a arcu imperdiet malesuada. 
                Maecenas libero. Nullam at arcu a est sollicitudin euismod. 
                Integer rutrum, orci vestibulum ullamcorper ultricies, lacus quam ultricies odio, vitae placerat pede sem sit amet enim. 
                Fusce tellus odio, dapibus id fermentum quis, suscipit id erat. Fusce consectetuer risus a nunc.'
            ],
            [
                'user_id' => 22,
                'name' => 'Admin team',
                'description' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. 
                Mauris metus. Duis sapien nunc, commodo et, interdum suscipit, sollicitudin et, dolor. 
                Praesent vitae arcu tempor neque lacinia pretium. Aenean placerat. In enim a arcu imperdiet malesuada. 
                Maecenas libero. Nullam at arcu a est sollicitudin euismod. 
                Integer rutrum, orci vestibulum ullamcorper ultricies, lacus quam ultricies odio, vitae placerat pede sem sit amet enim. 
                Fusce tellus odio, dapibus id fermentum quis, suscipit id erat. Fusce consectetuer risus a nunc.'
            ]
        ];
        
        foreach ($teams as $team => $value){
            Team::create($value);
        }
    }
}
