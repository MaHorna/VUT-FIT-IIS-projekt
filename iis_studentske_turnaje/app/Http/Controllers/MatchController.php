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

class MatchController extends Controller
{
    public static function show_data(Contest $contest, Tournament $tournament)
    {
        $data1_is_null = 1;
        $data2_is_null = 1;
        $id1 = "";
        $id2 = "";
        $name1 = "";
        $name2 = "";
        $link1 = "";
        $link2 = "";
        $score1 = "";
        $score2 = "";

        if ($tournament->teams_allowed == true)
        {
            $link1 = "/teams";
            $link2 = "/teams";
            $team1 = Team::join('contestants', 'contestants.team_id', '=', 'teams.id')
                ->where('contestants.tournament_id', $tournament->id)
                ->join('contests', 'contestants.id', '=', 'contests.contestant1_id')
                ->where('contestants.id', $contest->contestant1_id)
                ->select('teams.id', 'teams.name',)
                ->first();
            if(!is_null($team1)){
                $data1_is_null = 0;
                $id1 = $team1->id;
                $name1 = $team1->name;
                $link1 .= "/".$id1;
                $score1 = $contest->score1;
            }
            $team2 = Team::join('contestants', 'contestants.team_id', '=', 'teams.id')
                ->where('contestants.tournament_id', $tournament->id)
                ->join('contests', 'contestants.id', '=', 'contests.contestant2_id')
                ->where('contestants.id', $contest->contestant2_id)
                ->select('teams.id', 'teams.name',)
                ->first();
            if(!is_null($team2)){
                $data2_is_null = 0;
                $id2 = $team2->id;
                $name2 = $team2->name;
                $link2 .= "/".$id2;
                $score2 = $contest->score2;
            }
        }
        else 
        {
            $link1 = "/users";
            $link2 = "/users";
            $user1 = User::join('contestants', 'contestants.user_id', '=', 'users.id')
                ->where('contestants.tournament_id', $tournament->id)
                ->join('contests', 'contestants.id', '=', 'contests.contestant1_id')
                ->where('contestants.id', $contest->contestant1_id)
                ->select('users.id', 'users.name',)
                ->first();
            if(!is_null($user1)){
                $data1_is_null = 0;
                $id1 = $user1->id;
                $name1 = $user1->name;
                $link1 .= "/".$id1;
                $score1 = $contest->score1;
            }
            $user2 = User::join('contestants', 'contestants.user_id', '=', 'users.id')
                ->where('contestants.tournament_id', $tournament->id)
                ->join('contests', 'contestants.id', '=', 'contests.contestant2_id')
                ->where('contestants.id', $contest->contestant2_id)
                ->select('users.id', 'users.name',)
                ->first();
            if(!is_null($user2)){
                $data2_is_null = 0;
                $id2 = $user2->id;
                $name2 = $user2->name;
                $link2 .= "/".$id2;
                $score2 = $contest->score2;
            }
        }

        return array(
            'data1_is_null' => $data1_is_null,
            'data2_is_null' => $data2_is_null,
            'id1' => $id1,
            'id2' => $id2,
            'name1' => $name1,
            'name2' => $name2,
            'link1' => $link1,
            'link2' => $link2,
            'score1' => $score1,
            'score2' => $score2,
        );
    }

    public function get_popup_data(Request $request)
    {

    
        $contest = Contest::find($request->match_id);
        $tournament = Tournament::find($contest->tournament_id);
        $data1_is_null = 1;
        $data2_is_null = 1;
        $id1 = "";
        $id2 = "";
        $name1 = "";
        $name2 = "";
        $link1 = "";
        $link2 = "";
        $score1 = "";
        $score2 = "";

        if ($tournament->teams_allowed == true)
        {
            $link1 = "/teams";
            $link2 = "/teams";
            $team1 = Team::join('contestants', 'contestants.team_id', '=', 'teams.id')
                ->where('contestants.tournament_id', $tournament->id)
                ->join('contests', 'contestants.id', '=', 'contests.contestant1_id')
                ->where('contestants.id', $contest->contestant1_id)
                ->select('teams.id', 'teams.name',)
                ->first();
            if(!is_null($team1)){
                $data1_is_null = 0;
                $id1 = $team1->id;
                $name1 = $team1->name;
                $link1 .= $id1;
                $score1 = $contest->score1;
            }
            $team2 = Team::join('contestants', 'contestants.team_id', '=', 'teams.id')
                ->where('contestants.tournament_id', $tournament->id)
                ->join('contests', 'contestants.id', '=', 'contests.contestant2_id')
                ->where('contestants.id', $contest->contestant2_id)
                ->select('teams.id', 'teams.name',)
                ->first();
            if(!is_null($team2)){
                $data2_is_null = 0;
                $id2 = $team2->id;
                $name2 = $team2->name;
                $link2 .= $id2;
                $score2 = $contest->score2;
            }
        }
        else
        {
            $link1 = "/users";
            $link2 = "/users";
            $user1 = User::join('contestants', 'contestants.user_id', '=', 'users.id')
                ->where('contestants.tournament_id', $tournament->id)
                ->join('contests', 'contestants.id', '=', 'contests.contestant1_id')
                ->where('contestants.id', $contest->contestant1_id)
                ->select('users.id', 'users.name',)
                ->first();
            if(!is_null($user1)){
                $data1_is_null = 0;
                $id1 = $user1->id;
                $name1 = $user1->name;
                $link1 .= $id1;
                $score1 = $contest->score1;
            }
            $user2 = User::join('contestants', 'contestants.user_id', '=', 'users.id')
                ->where('contestants.tournament_id', $tournament->id)
                ->join('contests', 'contestants.id', '=', 'contests.contestant2_id')
                ->where('contestants.id', $contest->contestant2_id)
                ->select('users.id', 'users.name',)
                ->first();
            if(!is_null($user2)){
                $data2_is_null = 0;
                $id2 = $user2->id;
                $name2 = $user2->name;
                $link2 .= $id2;
                $score2 = $contest->score2;
            }
        }

        return response()->json([
            'data1_is_null' => $data1_is_null,
            'data2_is_null' => $data2_is_null,
            'id1' => $id1,
            'id2' => $id2,
            'name1' => $name1,
            'name2' => $name2,
            'score1' => $score1,
            'score2' => $score2,
            'date' => $contest->date
        ]);

    

    }
}

?>
