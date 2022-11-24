<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tournament;
use Illuminate\Http\Request;

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
}
