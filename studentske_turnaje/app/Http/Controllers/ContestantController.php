<?php

/***********************************************************************
* FILENAME : ContestantController.php
*
* DESCRIPTION : Create and destroy methods for contestant model
*
* PUBLIC FUNCTIONS :
*   store(Request)
*       author: xkanda01
*       returns: success message
*   destroy_team(Tournament)
*       author: xkanda01
*       returns: success message
*   destroy_user(Tournament)
*       author: xkanda01
*       returns: success message
*
* AUTHOR : Dávid Kán (xkanda01)
***********************************************************************/

namespace App\Http\Controllers;

use App\Models\Contestant;
use App\Models\Tournament;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class ContestantController extends Controller
{
    // Store contestant data
    public function store(Request $request)
    {
        // check if received data are correct  
        $formFields = $request->validate([ 
            'tournament_id' => 'required',
            'team_id',
            'user_id',
            'isteam' => 'required',
        ]);


        $formFields['team_id'] = $request['team_id'];
        $formFields['user_id'] = $request['user_id'];
        if ($request['isteam'] == 1) {
            $formFields['user_id'] = null;
        }
        if ($request['isteam'] == 0) {
            $formFields['team_id'] = null;
        }
        Contestant::create($formFields);       
        return redirect('/')->with('message', 'Successfully joined tournament.');
    }
    
    // Delete team contestant
    public function destroy_team(Tournament $tournament){
        $contestant = DB::table('teams')
            ->join('contestants', 'contestants.user_id', '=', 'teams.user_id')
            ->where('tournament_id', $tournament->id)
            ->where('teams.user_id', Auth::user()->id)
            ->first();
        $contestant->delete();
        return redirect('/')
            ->with('message', 'Successfully left tournament.');
    }

    // Delete user contestant
    public function destroy_user(Tournament $tournament){
        $contestant = Contestant::where('tournament_id', $tournament->id)->where('user_id', Auth::user()->id)->first();
        $contestant->delete();
        return redirect('/')
            ->with('message', 'Successfully left tournament.');
    }
}
