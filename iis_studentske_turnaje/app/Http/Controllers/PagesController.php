<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use App\Models\Tournament;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    // Show all listings
    public function index(Request $request)
    {

        return view('pages.index', 
        [
            'tournaments' => Tournament::latest()->filter(request(['search']))->paginate(),
            'users' => User::latest()->filter(request(['search']))->paginate(),
            'teams' => Team::latest()->filter(request(['search']))->paginate(),
            // 'users' => User::latest()->paginate(),
            // 'teams' => Team::latest()->paginate()
        ]);
    }
}
