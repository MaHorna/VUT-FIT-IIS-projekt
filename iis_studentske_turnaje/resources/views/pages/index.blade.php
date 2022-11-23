<x-layout>
    @include('partials._search')
    <h1>Tournaments</h1>
    <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">
        @unless (count($tournaments) == 0)
            @foreach ($tournaments as $tournament)
                <x-tournament-card :tournament="$tournament" />
            @endforeach
        @else
            <p>No Tournaments found</p>
        @endunless
    </div>
    <h1>Players</h1>
    <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">
        @unless (count($users) == 0)
            @foreach ($users as $user)
            <x-card>
                <div class="flex">
                    <img
                        class="hidden w-48 mr-6 md:block"
                        src="{{asset('images/placeholder.png')}}"
                        alt=""
                    />
                    <div>
                        <h3 class="text-2xl">
                            <a href="{{url('/users', $user->id)}}">{{$user->name}}</a>
                        </h3>
                    </div>
                </div>
            </x-card>
            @endforeach
        @else
            <p>No Tournaments found</p>
        @endunless
    </div>
        <p>Teams</p>
        <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">
        @unless (count($teams) == 0)
            @foreach ($teams as $team)
            <x-card>
                <div class="flex">
                    <img
                        class="hidden w-48 mr-6 md:block"
                        src="{{asset('images/placeholder.png')}}"
                        alt=""
                    />
                    <div>
                        <h3 class="text-2xl">
                            <a href="{{url('/teams', $team->id)}}">{{$team->name}}</a>
                        </h3>
                        <div class="text-xl font-bold mb-4">{{$team->won_games}}</div>
                        <div class="text-lg mt-4">
                            <i class="fa-solid fa-clock-four"></i> {{$team->lost_games}}
                        </div>
                    </div>
                </div>
            </x-card>
            @endforeach
        @else
            <p>No Tournaments found</p>
        @endunless

        <div class="mt-6 p-4">
            {{$users->links()}}
        </div>
    </div>
</x-layout>