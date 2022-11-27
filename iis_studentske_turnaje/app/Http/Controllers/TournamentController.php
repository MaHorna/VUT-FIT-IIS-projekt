<?php

namespace App\Http\Controllers;


use App\Models\Team;
use App\Models\User;
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
            'teams' => Team::all(),
            'contests' => Contest::where(['tournament_id' => $tournament->id])->get(),
            'lastRound' => Contest::where(['tournament_id' => $tournament->id])->max('round'),
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
        return;
    }

    private function addContestantToBracket($contestants, $contests, $iteration, $positon){
        $result = count($contests) / (2**($iteration + 1)); // n / 2^(I + 1)

        $contests[$positon]->contestant1_id = $contestants[$positon]->id;
        if ((count($contests) * 2) - 1 - $positon < count($contestants)) {
            $contests[$positon]->contestant2_id = $contestants[(count($contests) * 2) - 1 - $positon]->id;
        } 
        $contests[$positon]->update();
        
        $contests[$positon + $result]->contestant1_id = $contestants[$positon + $result]->id;
        if ((count($contests) * 2) - 1 - $positon - $result < count($contestants)) {
            $contests[$positon + $result]->contestant2_id = $contestants[(count($contests) * 2) - 1 - $positon - $result]->id;
        } 
        $contests[$positon + $result]->update();

        if ($result > 1) {
            $iteration++;
            $this->addContestantToBracket($contestants, $contests, $iteration, $positon);
            $this->addContestantToBracket($contestants, $contests, $iteration, $positon + $result);
        }
        return;
    }

    // Store tournament data
    public function start(Tournament $tournament)
    {
        // Make sure logged in user is owner
        if ($tournament->user_id != auth()->id() && Auth::user()->role == 0) {
            abort(403, 'Unauthorized Action');
        }

        $contestants = Contestant::where(['tournament_id' => $tournament->id])->get();

        $round = 2;
        $count = count($contestants);
        if ($count > 0) {
            while ($count > 2**$round) {
                $round++;
            }
        }
        //dd($count, $round, (2**$round));
        
        if ($count == 0 || $count == 1) {
            return back()->with('message', 'You need at least 2 contestants');
        }
        elseif ($count == 2) {
            $fields = [
                'tournament_id' => $tournament->id,
                'contest_child_id' => null,
                'round' => 1,
                'contestant1_id' => $contestants[0]->id,
                'contestant2_id' => $contestants[1]->id
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

            $contests = Contest::where([
                'tournament_id' => $tournament->id,
                'round' => 1,
            ])->get();
    
            $this->addContestantToBracket($contestants, $contests, 0, 0);
        }

        $tournament->status = 'ongoing';
        $tournament->save();

        return back()->with('message', 'Tournament has started');
    }



}
