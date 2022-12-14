<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        User::factory(20)->create();

        $this->call(UsersTableSeeder::class);

        $this->call(TeamsTableSeeder::class);

        $this->call(TeamusersTableSeeder::class);

        $this->call(TournamentsTableSeeder::class);

        $this->call(ContestantsTableSeeder::class);

        $this->call(ContestsTableSeeder::class);



    }
}
