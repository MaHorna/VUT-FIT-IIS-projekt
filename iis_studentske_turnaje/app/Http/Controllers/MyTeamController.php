<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;

class MyTeamController extends Controller
{
    // Show my teams
    public function index()
    {
        return view('my_teams.index', 
        [
            'teams' => Team::latest()->filter(request(['search']))->paginate(),
        ]);
    }

    // Show single team
    public function show(Team $team)
    {
        return view('my_teams.show', 
        [
            'team' => $team,
            'users' => User::latest()->filter(request(['search']))->get(),
        ]);
    }

    
}
