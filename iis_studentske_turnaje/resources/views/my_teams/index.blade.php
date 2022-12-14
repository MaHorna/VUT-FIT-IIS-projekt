{{-- * FILENAME : index.blade.php
*
* DESCRIPTION : Show all my teams
*
* AUTHOR : Dávid Kán - xkanda01 --}}

<x-layout>
    <h3 class="text-2xl relative left-5 text-white font-bold">Teams</h3>
    <x-search :path="'/my_teams'"/>

    {{-- Teams card --}}
    <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">
        @unless (count($teams) == 0)
                
            @foreach ($teams as $team)
                @php
                    $isInTeam = false;
                @endphp
                @foreach ($team->teamuser as $team_user)
                    @if (Auth::user() && $team_user->user_id == Auth::user()->id)
                        @php
                            $isInTeam = true;
                        @endphp
                    @endif
                @endforeach
                @if (Auth::user() && (Auth::user()->id == $team->user_id) or $isInTeam)
                    <x-card>
                        <div class="flex">
                            <img
                                class="hidden w-48 mr-6 md:block"
                                src="{{$team->logo ? asset('images/logos/' . $team->logo) : asset('/images/placeholder.png')}}"
                                alt=""
                            />

                            @php 
                                $total_games = $team->lost_games + $team->won_games;
                                $win_rate = 0;
                                if ($total_games !== 0) {
                                    $win_rate = ($team->won_games * 100) / $total_games;
                                    
                                }
                            @endphp
            
                            <div>
                                <h3 class="text-2xl font-bold text-yellowish">
                                    <a href="{{url('/teams', $team->id)}}">{{$team->name}}</a>

                                </h3>
                                <div class="text-xl mb-4">Total games: {{$total_games}}</div>
                                <div class="text-0.5xl mb-4">Won games: {{$team->won_games}}</div>
                                <div class="text-0.5xl mb-4">Lost games: {{$team->lost_games}}</div>
                                <div class="text-0.5xl mb-4">Win rate: {{round($win_rate, 2);}}%</div>
                            </div>
                        </div>
                    </x-card>
                @endif

            @endforeach

        @else

            <p>No teams found</p>
                
        @endunless

</x-layout>