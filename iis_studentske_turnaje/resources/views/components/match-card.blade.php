@props(['contest', 'tournament'])

<x-card>
    @if ($tournament->$teams_allowed == true)
        {{
            $team1 = Team::join('contestants', 'contestants.team_id', '=', 'teams.id')
                ->where('tournament_id', $tournament->id)
                ->join('contests', 'contestants.id', '=', 'contests.contestant1_id')
                ->where('contestants.id', $contest->contestant1_id)
                ->get();
            $team2 = Team::join('contestants', 'contestants.team_id', '=', 'teams.id')
                ->where('tournament_id', $tournament->id)
                ->join('contests', 'contestants.id', '=', 'contests.contestant2_id')
                ->where('contestants.id', $contest->contestant2_id)
                ->get();
        }}
        <div style="margin: 15px 0; overflow: hidden; border-radius: 5px;">
            <div style="color: #fff; padding: 10px 8px; background-color: #74b9ff;border-bottom: 1px solid #8fc7ff;">
                <a href="{{url('/teams', $team1->id)}}">{{$team1->name}}</a><p style="text-align: right;">{{$contest->score1}}</p>
            </div>
            <div style="color: #fff; padding: 10px 8px; background-color: #74b9ff;border-bottom: 1px solid #8fc7ff;">
                <a href="{{url('/teams', $team2->id)}}">{{$team2->name}}</a><p style="text-align: right;">{{$contest->score2}}</p>
            </div>
        </div>
    @else
        {{
            $user1 = User::join('contestants', 'contestants.user_id', '=', 'users.id')
                ->where('tournament_id', $tournament->id)
                ->join('contests', 'contestants.id', '=', 'contests.contestant1_id')
                ->where('contestants.id', $contest->contestant1_id)
                ->get();
            $user2 = User::join('contestants', 'contestants.user_id', '=', 'users.id')
                ->where('tournament_id', $tournament->id)
                ->join('contests', 'contestants.id', '=', 'contests.contestant2_id')
                ->where('contestants.id', $contest->contestant2_id)
                ->get();
        }}
        <div style="margin: 15px 0; overflow: hidden; border-radius: 5px;">
            <div style="color: #fff; padding: 10px 8px; background-color: #74b9ff;border-bottom: 1px solid #8fc7ff;">
                <a href="{{url('/teams', $user1->id)}}">{{$user1->name}}</a><p style="text-align: right;">{{$contest->score1}}</p>
            </div>
            <div style="color: #fff; padding: 10px 8px; background-color: #74b9ff;border-bottom: 1px solid #8fc7ff;">
                <a href="{{url('/teams', $user2->id)}}">{{$user2->name}}</a><p style="text-align: right;">{{$contest->score2}}</p>
            </div>
        </div>
    @endif
</x-card>