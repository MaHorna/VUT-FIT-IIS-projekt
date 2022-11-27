<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Team;
use App\Models\User;
use App\Models\Teamuser;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class TeamController extends Controller
{
    // Show all teams
    public function index()
    {
        return view('teams.index', 
        [
            'teams' => Team::latest()->filter(request(['search']))->paginate(),
        ]);
    }

    // Show single team
    public function show(Team $team)
    {
        if (Auth::check()) {
            $team_users = DB::table('teams')
                ->join('teamusers', 'teamusers.team_id', '=', 'teams.id')  
                ->join('users','teamusers.user_id', '=', 'users.id')
                ->where('teams.id',$team->id)
                ->get();

        }
        return view('teams.show', 
        [
            'team_users' => $team_users,
            'team' => $team,
            'users' => User::latest()->filter(request(['search']))->get(),
        ]);
    }

    // Show create team form
    public function create()
    {
        return view('teams.create');
    }

    // Store team data
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name' => ['required', Rule::unique('teams', 'name')],
            'logo' => 'required',
        ]);

        $formFields['user_id'] = auth()->id();
        $formFields['description'] = $request['description'];

        Team::create($formFields);

        return redirect('/')->with('message', 'Team created succesfully.');
    }

    // Show Edit team form
    public function edit(Team $team){
        return view('teams.edit', ['team' => $team]);
    }

    // Store team data
    public function update(Request $request, Team $team)
    {
        $formFields = $request->validate([
            'name' => ['required'],
            'logo' => 'required',
        ]);

        $formFields['description'] = $request['description'];

        $team->update($formFields);

        return redirect('/')->with('message', 'Team updated succesfully.');
    }

    // Delete team
    public function destroy(Team $team){
        $team->delete();

        return redirect('/')
            ->with('message', 'Team deleted succesfully.');
    }

    // Add user
    public function add_user(Request $request)
    {

        // if ($request->hasFile('logo')) {
        //     $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        // }

        $formFields['user_id'] = $request['user_id'] ;
        $formFields['team_id'] = $request['team_id'] ;

        Teamuser::create($formFields);

        return back()->with('message', 'player add succesfully.');
    }


}
