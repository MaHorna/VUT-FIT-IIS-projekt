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

        User::factory(10)->create();

        $this->call(TeamsTableSeeder::class);

        $this->call(TournamentsTableSeeder::class);

        $this->call(ContestsTableSeeder::class);

        // Matches::factory(10)->create();

        // Tournament::factory(10)->create();

        // Team::create([
        //     'leader_id' => 1,
        //     'user_id' => 1,
        //     'name' => 'Team liquid',
        //     'description' => 'asdasd',
        // ]);

        // Matches::create([
        //     'tournament_id' => 1,
        //     'team_id' => 1,
        //     'start_date' => 2022-11-11,
        //     'score' => 11
        // ]);

        //Tournament::factory()->create();

        //Team::factory()->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
