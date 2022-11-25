<x-layout>
    <x-search :path="'/'"/>
    <h3 class="text-2xl relative left-9 text-white font-bold mb-2">Tournaments</h3>
    <div class="relative left-5" style="max-height:80vh;width:98%;overflow:auto;">
        
        
        <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 mt-2 mb-2 md:space-y-0 mx-4">
            @unless (count($tournaments) == 0)
                @foreach ($tournaments as $tournament)
                    <x-tournament-card :tournament="$tournament" />
                @endforeach
            @else
                <x-card><p class="text-2xl mb-2">No Tournaments found</p></x-card>
            @endunless
        </div>
    </div>
    <h3 class="text-2xl relative left-9 text-white font-bold mb-2 mt-2">Players</h3>
    <div class="relative left-5" style="max-height:80vh;width:98%;overflow:auto;">
        <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4 mt-2 mb-2">
            @unless (count($users) == 0)
                @foreach ($users as $user)
                <x-card>
                    <div class="flex text-white">
                        <img
                            class="hidden w-48 mr-6 md:block"
                            src="{{$user->logo ? asset('images/logos/' . $user->logo) : asset('/images/placeholder.png')}}"
                            alt=""
                        />

                        @php 
                            $total_games = $user->lost_games + $user->won_games;
                            $win_rate = 0;
                            if ($total_games !== 0) {
                                $win_rate = ($user->won_games * 100) / $total_games;
                                
                            }
                        @endphp

                        <div>
                            <h3 class="text-2xl font-bold text-yellowish">
                                <a href="{{url('/users', $user->id)}}">{{$user->name}}</a>
                            </h3>
                            
                            <div class="text-xl mb-4">Total games: {{$total_games}}</div>
                            <div class="text-0.5xl mb-4">Won games: {{$user->won_games}}</div>
                            <div class="text-0.5xl mb-4">Lost games: {{$user->lost_games}}</div>
                            <div class="text-0.5xl mb-4">Win rate: {{round($win_rate, 2);}}%</div>
                        </div>
                    </div>
                </x-card>
                @endforeach
            @else
                <x-card><p class="text-2xl mb-2">No Users found</p></x-card>
            @endunless
        </div>
    </div>
    <h3 class="text-2xl relative left-9 text-white font-bold mb-2 mt-2">Teams</h3>
    <div class="relative left-5" style="max-height:80vh;width:98%;overflow:auto;">
        <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">
            @unless (count($teams) == 0)
                @foreach ($teams as $team)
                <x-card>
                    <div class="flex text-white">
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
                @endforeach
            @else
                <x-card><p class="text-2xl mb-2">No Teams found</p></x-card>
            @endunless
        </div>
    </div>
</x-layout>