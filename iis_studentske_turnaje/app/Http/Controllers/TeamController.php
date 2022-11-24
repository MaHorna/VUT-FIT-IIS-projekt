<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TeamController extends Controller
{
    // Show all teams
    public function index()
    {
        return view('teams.index', 
        [
            'teams' => Team::latest()->filter(request(['search']))->paginate(1),
        ]);
    }

    // Show single team
    public function show(Team $team)
    {
        return view('teams.show', 
        [
            'team' => $team
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
            'num_participants' => 'required',
            'description' => 'required'
        ]);

        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

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
            'num_participants' => 'required',
            'description' => 'required'
        ]);

        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $team->update($formFields);

        return back()->with('message', 'Team updated succesfully.');
    }

    // Delete team
    public function destroy(Team $team){
        $team->delete();

        return redirect('/')
            ->with('message', 'Team deleted succesfully.');
    }

}
