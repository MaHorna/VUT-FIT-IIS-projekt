<?php

namespace App\Http\Controllers;


use App\Models\Team;
use App\Models\Contest;
use App\Models\Contestant;
use App\Models\Tournament;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TournamentController extends Controller
{
    // Show all tournaments
    public function index()
    {
        return view('tournaments.index', 
        [
            'tournaments' => Tournament::latest()->filter(request(['search']))->paginate(),
        ]);
    }

    // Show single tounament
    public function show(Tournament $tournament)
    {
        $is_registered_leader = false;
        if (Auth::check()) {
            if(DB::table('teams')
                ->join('contestants', 'contestants.user_id', '=', 'teams.user_id')
                ->where('tournament_id', $tournament->id)
                ->where('teams.user_id', Auth::user()->id)
                ->exists())
            {
                $is_registered_leader = true;
            }
        }
        $is_team_leader = false;
        if (Auth::check()) {
            if(DB::table('teams')
                ->where('user_id', Auth::user()->id)
                ->exists())
            {
                $is_team_leader = true;
            }
        }
        $is_registered_user = false;
        if (Auth::check()) {
            if(DB::table('contestants')
                ->where('tournament_id', $tournament->id)
                ->where('user_id', Auth::user()->id)
                ->exists())
            {
                $is_registered_user = true;
            }
        }
        return view('tournaments.show', 
        [
            'tournament' => $tournament,
            'is_registered_leader' => $is_registered_leader,
            'is_team_leader' => $is_team_leader,
            'is_registered_user' => $is_registered_user,
            'teams' => Team::all()
        ]);

    }

    // Show create tournament form
    public function create()
    {
        return view('tournaments.create');
    }

    // Store tournament data
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name' => ['required', Rule::unique('tournaments', 'name')],
            'game' => 'required',
            'start_date' => 'required',
            'prize' => 'required',
            'num_participants' => 'required',
            'teams_allowed' => 'required',
            'description',
            'logo' => 'required',
        ]);

        // if ($request->hasFile('logo')) {
        //     $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        // }
       
        $formFields['user_id'] = auth()->id();

        Tournament::create($formFields);

        return redirect('/')->with('message', 'Tournament created succesfully.');
    }

    // Show Edit tournament form
    public function edit(Tournament $tournament){
        // Make sure logged in user is owner
        if ($tournament->user_id != auth()->id() && Auth::user()->role == 0) {
            abort(403, 'Unauthorized Action');
        }

        return view('tournaments.edit', ['tournament' => $tournament]);
    }

    // Store tournament data
    public function update(Request $request, Tournament $tournament)
    {
        // Make sure logged in user is owner
        if ($tournament->user_id != auth()->id() && Auth::user()->role == 0) {
            abort(403, 'Unauthorized Action');
        }

        $formFields = $request->validate([
            'name' => ['required'],
            'game' => 'required',
            'start_date' => 'required',
            'prize' => 'required',
            'num_participants' => 'required',
            'teams_allowed' => 'required',
            'description',
            'logo' => 'required',
        ]);

        // if ($request->hasFile('logo')) {
        //     $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        // }

        $tournament->update($formFields);

        return back()->with('message', 'Tournament updated succesfully.');
    }

    // Delete tournament
    public function destroy(Tournament $tournament){
        // Make sure logged in user is owner
        if ($tournament->user_id != auth()->id() && Auth::user()->role == 0) {
            abort(403, 'Unauthorized Action');
        }

        $tournament->delete();

        return redirect('/')
            ->with('message', 'Tournament deleted succesfully.');
    }


    private function bracket($tournament_id, $round, $next_id){
        $fields = [
            'tournament_id' => $tournament_id,
            'contest_child_id' => $next_id,
            'round' => $round,
        ];

        $contest = Contest::create($fields);

        $round--;

        if ($round > 0) {
            $this->bracket($tournament_id, $round, $contest->id);
            $this->bracket($tournament_id, $round, $contest->id);
        }
    }

    // Store tournament data
    public function start(Tournament $tournament)
    {
        // Make sure logged in user is owner
        if ($tournament->user_id != auth()->id() && Auth::user()->role == 0) {
            abort(403, 'Unauthorized Action');
        }

        $formFields['status'] = 'ongoing';
        $tournament->update($formFields);

        $contestants = Contestant::where(['tournament_id' => $tournament->id])->get();
        //dd($contestantss);


        $round = 2;
        $count = count($contestants);
        if ($count > 0) {
            while (ceil($count/2) > ($round^2)-1) {
                $round++;
            }
        }
        
        if ($count == 0 || $count == 1) {
            // error
        }
        elseif ($count == 2) {
            $fields = [
                'tournament_id' => $tournament->id,
                'contest_child_id' => null,
                'round' => 1,
            ];
            $contest = Contest::create($fields);
        }
        else {
            $fields = [
                'tournament_id' => $tournament->id,
                'contest_child_id' => null,
                'round' => $round,
            ];
            $contest = Contest::create($fields);
            $round--;
            $this->bracket($tournament->id, $round, $contest->id);
            $this->bracket($tournament->id, $round, $contest->id);
        }

        $contests = Contest::where([
            'tournament_id' => $tournament->id,
            'round' => 1,
        ])->get();

        // Tu by mala byt tiez rekurzia ale uz neviem 
        $first = true;
        for ($i=0; $i < count($contests)/2; $i++) { 
            $contest[$i]->contestant1_id = $contestants[$i]->id;
            if ($contestants[$i] != null) {
                $contest[$i]->contestant2_id = $contestants[(count($contests) * 2) -$i]->id;
            }
            $contest[(count($contests)/2)+$i]->contestant1_id = $contestants[$i+1]->id;
            if ($contestants[(count($contests) * 2) -$i -1] != null) {
                $contest[(count($contests)/2)+$i]->contestant2_id = $contestants[(count($contests) * 2) -$i -1]->id;
            }
            
        }

        return back()->with('message', 'Tournament status changed to ongoing.');
    }



}
