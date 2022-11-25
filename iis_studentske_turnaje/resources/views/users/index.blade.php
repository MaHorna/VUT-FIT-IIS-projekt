<x-layout>
    <h3 class="text-2xl relative left-5 text-white font-bold">Players</h3>
    <x-search :path="'/users'"/>
    <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">
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
            <p>No Players found</p>
        @endunless
    </div>
</x-layout>