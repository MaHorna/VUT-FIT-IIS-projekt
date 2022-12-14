<?php
/***********************************************************************
* FILENAME : AdminController.php
*
* DESCRIPTION : Functions for showing not yet approved tournaments or users. Also update function for approving tournaments
*
* PUBLIC FUNCTIONS :
*   showTournaments()
*       author: xkanda01
*       returns: tournaments list
*   showUsers()
*       author: xkanda01
*       returns: user list
*   updateTournaments(Tournament)
*       author: xkanda01
*       returns: success message
*
* AUTHOR : Dávid Kán (xkanda01)
***********************************************************************/
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
