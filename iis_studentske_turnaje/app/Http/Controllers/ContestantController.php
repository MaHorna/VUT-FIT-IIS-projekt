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
        $formFields = $request->validate([
            'turnaj_id' => 'required',
            'team_id',
            'user_id',
            'isteam' => 'required',
        ]);
    
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
