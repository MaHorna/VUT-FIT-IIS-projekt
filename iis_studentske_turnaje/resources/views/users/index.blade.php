<x-layout>
    <x-search :path="'/users'"/>
    <h1>Players</h1>
    <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">
        @unless (count($users) == 0)
            @foreach ($users as $user)
                <div class="flex">
                    <img
                        class="hidden w-48 mr-6 md:block"
                        src="{{$user->logo ? asset('storage/' . $user->logo) : asset('/images/placeholder.png')}}"
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
                        <h3 class="text-2xl font-bold">
                            <a href="{{url('/users', $user->id)}}">{{$user->name}}</a>
                        </h3>
                        <div class="text-xl mb-4">Total games played: {{$total_games}}</div>
                        <div class="text-0.5xl mb-4">Won games: {{$user->won_games}}</div>
                        <div class="text-0.5xl mb-4">Lost games: {{$user->lost_games}}</div>
                        <div class="text-0.5xl mb-4">Win rate: {{round($win_rate, 2);}}%</div>
                    </div>
                </div>
            @endforeach
        @else
            <p>No Players found</p>
        @endunless
    </div>
</x-layout>