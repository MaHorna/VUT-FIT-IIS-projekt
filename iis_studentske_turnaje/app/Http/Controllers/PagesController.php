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
            'users' => User::latest()->paginate(),
            'teams' => Team::latest()->paginate()
        ]);
    }
    public function login() {
	    return view('pages.login');
    }
    public function admin() {
	    return view('pages.admin');
    }
    public function loged_user() {
	    return view('pages.loged_user');
    }
    public function nonuser() {
	    return view('pages.nonuser');
    }
    public function profile() {
	    return view('pages.profile');
    }
    public function team_create() {
	    return view('pages.team_create');
    }
    public function tour_create() {
	    return view('pages.tour_create');
    }
    public function my_tour() {
	    return view('pages.my_tour');
    }
    public function tournaments() {
	    return view('pages.tournaments');
    }
    public function users() {
	    return view('pages.users');
    }
    public function teams() {
	    return view('pages.teams');
    }
    public function tournament($id) {
	    return view('pages.tournament');
    }
    public function user($id) {
	    return view('pages.user');
    }
    public function team($id) {
	    return view('pages.team');
    }
}
