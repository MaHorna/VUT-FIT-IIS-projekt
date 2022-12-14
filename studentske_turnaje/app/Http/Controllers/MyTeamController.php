<?php
/***********************************************************************
* FILENAME : MyTeamController.php
*
* DESCRIPTION : functions managing my_teams page
*
* PUBLIC FUNCTIONS :
*   index()
*       author: xmadun01
*       returns: redirects to page with all of my teams
*   show(Team)
*       author: xmadun01
*       returns: redirects to page with the teams
*
* AUTHOR : Andrej Madunický - xmadun01
***********************************************************************/
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
