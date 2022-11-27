<?php

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
        $formFields = $request->validate([
            'tournament_id' => 'required',
            'team_id',
            'user_id',
            'isteam' => 'required',
        ]);
        $formFields['user_id'] = $request['user_id'];
        Contestant::create($formFields);
        return redirect('/')->with('message', 'Successfully joined tournament.');
    }
    
    // Delete team contestant
    public function destroy_team(Tournament $tournament){
        $id_contestant = 1;
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
