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
        $my_non_registered_teams = null;
        if (Auth::check()) {
            $my_non_registered_teams = Team::where('user_id', Auth::user()->id)->whereNotIn('id', function($query) use ($tournament) {
                $query->select('team_id')->from('contestants')->where('tournament_id', $tournament->id);
            })->get();
        }
        $contestants = null;
        if ($tournament->teams_allowed == 1){
            $contestants = Contestant::where('tournament_id', $tournament->id)->join('teams', 'contestants.team_id', '=', 'teams.id')->get();
        } else {
            $contestants = Contestant::where('tournament_id', $tournament->id)->join('users', 'contestants.user_id', '=', 'users.id')->get();
        }
        
        return view('tournaments.show', 
        [
            'tournament' => $tournament,
            'is_registered_leader' => $is_registered_leader,
            'is_team_leader' => $is_team_leader,
            'is_registered_user' => $is_registered_user,
            'contestants' => $contestants,
            'my_non_registered_teams' => $my_non_registered_teams,
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
            'logo' => 'required',
        ]);
       
        $formFields['user_id'] = auth()->id();
        $formFields['description'] = $request->description;

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
            'logo' => 'required',
        ]);

        $formFields['description'] = $request->description;

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

    // Recursive function for generating bracket
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

    // Recursive function for adding contestants into bracket
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

    // Generate bracket
    public function start(Tournament $tournament)
    {
        // Make sure logged in user is owner
        if ($tournament->user_id != auth()->id() && Auth::user()->role == 0) {
            abort(403, 'Unauthorized Action');
        }

        $contestants = Contestant::where(['tournament_id' => $tournament->id])->get();

        if (count($contestants) < $tournament->num_participants) {
            return back()->with('message', 'You need at least ' . $tournament->num_participants . ' contestants. You have now '.count($contestants));
        }

        $round = 2;
        $count = count($contestants);
        if ($count > 0) {
            while ($count > 2**$round) {
                $round++;
            }
        }
        
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
        $round1 = 1;

        $autowinners = Contest::where(['tournament_id' => $tournament->id])
            ->where(['round' => $round1])
            ->where(['contestant2_id' => NULL])
            ->get();

        foreach ($autowinners as $autowinner) {
            $contest_child = Contest::find($autowinner->contest_child_id);

            if (!is_null($contest_child)) {
                if (is_null($contest_child->contestant1_id)) {
                    $contest_child->contestant1_id = $autowinner->contestant1_id;
                }
                elseif (is_null($contest_child->contestant2_id)) {
                    $contest_child->contestant2_id = $autowinner->contestant1_id;
                }
                $contest_child->update();
            }
        }

        return back()->with('message', 'Tournament has started');
    }


    // Show harmonogram
    public function harmonogram()
    {
        $my_matches1 = Contest::join('contestants', 'contestants.id', '=', 'contests.contestant1_id')
            ->join('users', 'users.id', '=', 'contestants.user_id')
            ->join('tournaments', 'tournaments.id', '=', 'contestants.tournament_id')
            ->where(['users.id' => auth()->id()])
            ->orderBy('contests.date', 'ASC')
            ->get();
        $my_matches2 = Contest::join('contestants', 'contestants.id', '=', 'contests.contestant2_id')
            ->join('users', 'users.id', '=', 'contestants.user_id')
            ->join('tournaments', 'tournaments.id', '=', 'contestants.tournament_id')
            ->where(['users.id' => auth()->id()])
            ->orderBy('contests.date', 'ASC')
            ->get();

        $my_matches = Contest::leftjoin('contestants as con2', 'con2.id', '=', 'contests.contestant2_id')
            ->leftjoin('contestants as con1', 'con1.id', '=', 'contests.contestant1_id')
            ->join('users', 'users.id', '=', 'con1.user_id')
            ->join('tournaments', 'tournaments.id', '=', 'contests.tournament_id')
            ->where(['users.id' => auth()->id()])
            ->orderBy('contests.date', 'ASC')
            ->get();


        $my_team_matches1 = Contest::join('contestants', 'contestants.id', '=', 'contests.contestant1_id')
            ->join('teams', 'teams.id', '=', 'contestants.team_id')
            ->join('tournaments', 'tournaments.id', '=', 'contestants.tournament_id')
            ->join('teamusers', 'teams.id', '=', 'teamusers.team_id')
            ->join('users', 'teamusers.user_id', '=', 'users.id')
            ->where(['users.id' => auth()->id()])
            ->orderBy('contests.date', 'ASC')
            ->select('contests.tournament_id', 'tournaments.name', 'contests.date', 'contests.score1', 'contests.score2', 'contests.round')
            ->get();
        $my_team_matches2 = Contest::join('contestants', 'contestants.id', '=', 'contests.contestant2_id')
            ->join('teams', 'teams.id', '=', 'contestants.team_id')
            ->join('tournaments', 'tournaments.id', '=', 'contestants.tournament_id')
            ->join('teamusers', 'teams.id', '=', 'teamusers.team_id')
            ->join('users', 'users.id', '=', 'teamusers.user_id')
            ->where(['users.id' => auth()->id()])
            ->orderBy('contests.date', 'ASC')
            ->select('contests.tournament_id', 'tournaments.name', 'contests.date', 'contests.score1', 'contests.score2', 'contests.round')
            ->get();

        $my_team_matches = $my_team_matches1->union($my_team_matches2);
        $merged = $my_team_matches1->merge($my_team_matches2);

        $my_team_matches = $merged->all();
        
        

        $my_team_matches = Contest::leftjoin('contestants as con2', 'con2.id', '=', 'contests.contestant2_id')
            ->leftjoin('contestants as con1', 'con1.id', '=', 'contests.contestant1_id')
            ->leftjoin('teams as team1', 'team1.id', '=', 'con1.team_id')
            ->leftjoin('teams as team2', 'team2.id', '=', 'con2.team_id')
            ->leftjoin('teamusers as tu1', 'team1.id', '=', 'tu1.team_id')
            ->leftjoin('teamusers as tu2', 'team2.id', '=', 'tu2.team_id')
            ->leftjoin('users as user1', 'user1.id', '=', 'tu1.user_id')
            ->leftjoin('users as user2', 'user2.id', '=', 'tu2.user_id')
            ->leftjoin('tournaments as tour1', 'tour1.id', '=', 'con1.tournament_id')
            ->leftjoin('tournaments as tour2', 'tour2.id', '=', 'con2.tournament_id')
            ->where(['user1.id' => auth()->id()])
            ->orWhere(['user2.id' => auth()->id()])
            ->orderBy('contests.date', 'ASC')
            ->get();

        
        return view('tournaments.harmonogram', 
        [
            'my_team_matches' => $my_team_matches,
            'my_matches' => $my_matches,
        ]);
    }

    // Show my tournaments
    public function my_tour()
    {
        $my_hosted_tournaments = 
            Tournament::where(['user_id' => auth()->id()])
            ->get();
        $my_played_tournaments = 
            Tournament::join('contestants','contestants.tournament_id', '=', 'tournaments.id')
            ->where(['contestants.user_id' => auth()->id()])
            ->select('tournaments.id', 'tournaments.name', 'tournaments.start_date', 'tournaments.logo', 'tournaments.status', 'tournaments.teams_allowed', 'tournaments.game')
            ->get();
        $my_team_tournaments = 
            Tournament::join('contestants','contestants.tournament_id', '=', 'tournaments.id')
            ->join('teams', 'teams.id', '=' , 'contestants.team_id')
            ->join('teamusers', 'teamusers.team_id', '=', 'teams.id')
            ->join('users', 'users.id', '=', 'teamusers.user_id')
            ->where(['users.id' => auth()->id()])
            ->select('tournaments.id', 'tournaments.name', 'tournaments.start_date', 'tournaments.logo', 'tournaments.status', 'tournaments.teams_allowed', 'tournaments.game')
            ->get();
        return view('tournaments.my_tour', 
        [
            'my_hosted_tournaments' => $my_hosted_tournaments,
            'my_player_tournaments' => $my_played_tournaments,
            'my_team_tournaments' => $my_team_tournaments,
        ]);
    }

    // Update score and date 
    public function updatescore(Contest $contest, Request $request){
        if (!is_null($request->score1)) $contest->score1 = $request->score1;
        if (!is_null($request->score2)) $contest->score2 = $request->score2;
        if (!is_null($request->date)) $contest->date = $request->date;

        $contest->update();

        //return back()->with('message', 'Contest score updated succesfully.');
        return response()->json(['success'=>'Data is successfully added', 
        'score1' => (is_null($contest->score1))? NULL : $contest->score1, 
        'score2' => (is_null($contest->score2))? NULL : $contest->score2]);
    }

    // Update winner
    public function updatewinner(Contest $contest, Request $request){
        $contest_child = Contest::find($contest->contest_child_id);
        $next_pos = 0;
        $winner = 0;
        if (!is_null($contest_child)) {
            if ($request->winner == 1) {
                $winner = $contest->contestant1_id;
            }
            else if ($request->winner == 2) {
                $winner = $contest->contestant2_id;
            }

            if (is_null($contest_child->contestant1_id) || $contest->contestant1_id == $contest_child->contestant1_id 
            || $contest->contestant2_id == $contest_child->contestant1_id) {
                $contest_child->contestant1_id = $winner;
                $next_pos = 1;
            }
            elseif (is_null($contest_child->contestant2_id) || $contest->contestant1_id == $contest_child->contestant2_id 
            || $contest->contestant2_id == $contest_child->contestant2_id) {
                $contest_child->contestant2_id = $winner;
                $next_pos = 2;
            }

            $contest_child->update();

            $user1 = User::join('contestants', 'contestants.user_id', '=', 'users.id')
                ->where('contestants.tournament_id', $contest->tournament_id)
                ->join('contests', 'contestants.id', '=', 'contests.contestant1_id')
                ->where('contestants.id', $contest->contestant1_id)
                ->select('users.id', 'users.name',)
                ->first();
            $user2 = User::join('contestants', 'contestants.user_id', '=', 'users.id')
                ->where('contestants.tournament_id', $contest->tournament_id)
                ->join('contests', 'contestants.id', '=', 'contests.contestant2_id')
                ->where('contestants.id', $contest->contestant2_id)
                ->select('users.id', 'users.name',)
                ->first();

            return response()->json(['success'=>'Data is successfully added', 
            'url' => url('/users'),
            'winner' => $request->winner, 
            'next_pos' => $next_pos, 
            'user1_name' => (is_null($user1))? "-" : $user1->name, 
            'user2_name' => (is_null($user2))? "-" : $user2->name,
            'user1_id' => (is_null($user1))? NULL : $user1->id, 
            'user2_id' => (is_null($user2))? NULL : $user2->id,
            'next_id' => $contest_child->id]);

        }

        return response()->json(['success'=>'Data is successfully added', 
        'url' => url('/users'),
        'winner' => $request->winner, 
        'next_pos' => $NULL,
        'user1_name' => NULL, 
        'user2_name' => NULL,
        'user1_id' => NULL, 
        'user2_id' => NULL,
        'next_id' => NULL]);

    }

    // Change tournament state to finished
    public function end(Tournament $tournament){
        // Make sure logged in user is owner
        if ($tournament->user_id != auth()->id() && Auth::user()->role == 0) {
            abort(403, 'Unauthorized Action');
        }

        $tournament->status = 'finished';
        $tournament->update();

        return back()->with('message', 'Tournament finished.');
    }
}
