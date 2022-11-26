<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Contestant;
use Illuminate\Http\Request;

class ContestantController extends Controller
{
    // Store contestant data
    public function store(Request $request)
    {
        //dd($request);
        $formFields = $request->validate([
            'tournament_id' => 'required',
            'team_id',
            'user_id',
            'isteam' => 'required',
        ]);
    
        $formFields['user_id'] = $request['user_id'];
        //dd($formFields['user_id']);
        Contestant::create($formFields);

        return redirect('/')->with('message', 'Successfully joined tournament.');
    }
    
    // Delete tournament
    public function destroy(Contestant $contestant){
        $contestant->delete();

        return redirect('/')
            ->with('message', 'Successfully left tournament.');
    }
}
