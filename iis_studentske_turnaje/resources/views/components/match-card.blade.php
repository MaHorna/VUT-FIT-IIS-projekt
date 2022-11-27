@props(['contest', 'tournament'])

<x-card>
    @if ($tournament->teams_allowed == true)
        @php
            
        
            $team1 = App\Models\Team::join('contestants', 'contestants.team_id', '=', 'teams.id')
                ->where('tournament_id', $tournament->id)
                ->join('contests', 'contestants.id', '=', 'contests.contestant1_id')
                ->where('contestants.id', $contest->contestant1_id)
                ->first();
            $team2 = App\Models\Team::join('contestants', 'contestants.team_id', '=', 'teams.id')
                ->where('tournament_id', $tournament->id)
                ->join('contests', 'contestants.id', '=', 'contests.contestant2_id')
                ->where('contestants.id', $contest->contestant2_id)
                ->first();
        @endphp
        <div style="margin: 15px 0; overflow: hidden; border-radius: 5px;">
            <div style="color: #fff; padding: 10px 8px; background-color: #74b9ff;border-bottom: 1px solid #8fc7ff;">
                <a href="{{url('/teams', $team1->id)}}">{{$team1->name}}</a><p style="text-align: right;">{{$contest->score1}}</p>
            </div>
            <div style="color: #fff; padding: 10px 8px; background-color: #74b9ff;border-bottom: 1px solid #8fc7ff;">
                <a href="{{url('/teams', $team2->id)}}">{{$team2->name}}</a><p style="text-align: right;">{{$contest->score2}}</p>
            </div>
        </div>
    @else
        @php
            $user1 = App\Models\User::join('contestants', 'contestants.user_id', '=', 'users.id')
                ->where('contestants.tournament_id', $tournament->id)
                ->join('contests', 'contestants.id', '=', 'contests.contestant1_id')
                ->where('contestants.id', $contest->contestant1_id)
                ->first();
            $user2 = App\Models\User::join('contestants', 'contestants.user_id', '=', 'users.id')
                ->where('contestants.tournament_id', $tournament->id)
                ->join('contests', 'contestants.id', '=', 'contests.contestant2_id')
                ->where('contestants.id', $contest->contestant2_id)
                ->first();
        @endphp
        
        <div style="margin: 15px 0; overflow: hidden; border-radius: 5px;">
            @if (!is_null($user1))
                <div style="color: #fff; padding: 10px 8px; background-color: #74b9ff;border-bottom: 1px solid #8fc7ff;">
                    <a href="{{url('/users', $user1->id)}}">{{$user1->name}}</a><p style="text-align: right;">{{$contest->score1}}</p>
                </div>
            @endif
            
            @if (!is_null($user2))
                <div style="color: #fff; padding: 10px 8px; background-color: #74b9ff;border-bottom: 1px solid #8fc7ff;">
                    <a href="{{url('/users', $user2->id)}}">{{$user2->name}}</a><p style="text-align: right;">{{$contest->score2}}</p>
                </div>
            @endif
        </div>
    @endif
</x-card>