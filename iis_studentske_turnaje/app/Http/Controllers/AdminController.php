<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tournament;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // Show all tournaments
    public function showTournaments()
    {
        return view('admin.showTournaments', 
        [
            'tournaments' => Tournament::latest()->filter(request(['search']))->paginate(),
        ]);
    }

    //Show all users
    public function showUsers()
    {
        return view('admin.showUsers', 
        [
            'users' => User::latest()->filter(request(['search']))->paginate(),
        ]);
    }

    // Approve tournament
    public function updateTournaments(Tournament $tournament)
    {
        // Make sure logged in user is owner
        if (Auth::user()->role == 0) {
            abort(403, 'Unauthorized Action');
        }
        
        $tournament->approved = 1;
        $tournament->save();

        return back()->with('message', 'Tournament approved.');
    }
}
