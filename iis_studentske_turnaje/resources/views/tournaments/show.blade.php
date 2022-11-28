<x-layout>
    <a href="{{url('/tournaments')}}" class="inline-block ml-4 mb-4"><i class="fa-solid fa-arrow-left"></i> Back</a>
    <div class="mx-4">
        <x-card class="p-10">
            <div class="flex flex-col items-center justify-center text-center">
                <img
                    class="w-48 mr-6 mb-6"
                    src="{{$tournament->logo ? asset('images/logos/' . $tournament->logo) : asset('/images/placeholder.png')}}"
                    alt=""
                />
                <h3 class="text-2xl mb-2 text-yellowish">{{$tournament->name}}</h3>
                <div class="text-xl font-bold mb-4">{{$tournament->game}}</div>
                <div class="text-xl font-bold mb-4">{{$tournament->status}}</div>
                @if ($tournament->teams_allowed)
                    <div class="text-0.5xl mb-4">Type: Team vs Team</div>
                @else
                    <div class="text-0.5xl mb-4">Type: Player vs Player</div>
                @endif
                <div class="text-lg my-4">
                    <i class="fa-solid fa-location-dot"></i> {{$tournament->start_date}}
                </div>
                <div class="border border-gray-200 w-full mb-6"></div>
                <div>
                    <div class="text-lg space-y-6 mb-4">
                        {{$tournament->description}}
                    </div>
                </div>
            </div>
            <div class="border border-gray-200 w-full mb-6"></div>
                @if ($contestants->count() > 0)
                    <h3 class="text-2xl relative left-5 text-white font-bold">Joined:</h3>
                    @foreach ($contestants as $contestant)
                        <div class="text-0.5xl mb-4">{{$contestant->name}}</div>
                    @endforeach
                @else
                    <h3 class="text-2xl relative left-5 text-white font-bold">Noone joined yet</h3>
                @endif
            </x-card>
            @if ($tournament->status != 'preparing')
                <x-card class="mt-4">
                    <div style='display: flex;overflow-x:auto'>
                        @for ($i = 1; $i <= $lastRound; $i++)
                            <div style='
                            flex: 1;
                            display: flex;
                            margin-right: 30px;
                            flex-direction: column;
                            justify-content: space-around;'>
                                @foreach ($contests as $contest)
                                    @if ($contest->round == $i)
                                        <x-match-card :contest="$contest" :tournament="$tournament"/>
                                    @endif
                                @endforeach
                            </div>
                        @endfor
                    </div>
                </x-card>
            @endif

            <x-card class="mt-4 p-2 flex space-x-6">
                @if ($tournament->status == 'preparing')
                    @if ($tournament->teams_allowed == 1)
                        @if ($is_registered_leader)
                            <form method="POST" action="{{url('/contestant/destroy_team/'.$tournament->id)}}">
                                @csrf
                                @method('DELETE')
                                <button class="" style="padding:5px;margin:5px;"><i class="fa-solid fa-door-open"></i> Leave game</button>
                            </form>
                        @else
                            @if ($is_team_leader)
                                @if ($my_non_registered_teams->count() > 0)
                                    <form action="{{url('/contestant')}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="tournament_id" value="{{$tournament->id}}">
                                        <label>Choose which team of your's should compete: </label>
                                        <select name="team_id" id="team_id" class="css_team_combobox bg-grayish rounded" style="padding:5px;margin:5px;">
                                            @foreach($my_non_registered_teams as $team)
                                            <option style="" value="{{ $team->id }}">{{ $team->name}}</option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" name="user_id" value="NULL">
                                        <input type="hidden" name="isteam" value="1">
                                        <button class="" style="padding:5px;margin:5px;"><i class="fa-solid fa-gamepad"></i> Join game</button>
                                    </form>
                                @else
                                        <p style="padding:5px;margin:5px;">You don't have any teams that can compete in this tournament.</p>
                                @endif
                            @else    
                                <p style="padding:5px;margin:5px;">You are not team leader, cant join</p>
                            @endif
                        @endif
                    @else
                        @if ($is_registered_user)
                            <form method="POST" action="{{url('/contestant/destroy_user/'.$tournament->id)}}">
                                @csrf
                                @method('DELETE')
                                <button class="" style="padding:5px;margin:5px;"><i class="fa-solid fa-door-open"></i> Leave game</button>
                            </form>
                        @else
                            <form action="{{url('/contestant')}}" method="POST">
                                @csrf
                                <input type="hidden" name="tournament_id" value="{{$tournament->id}}">
                                <input type="hidden" name="team_id" value="NULL">
                                <input type="hidden" name="user_id" value="{{auth()->id()}}">
                                <input type="hidden" name="isteam" value="0">
                                <button class="" style="padding:5px;margin:5px;"><i class="fa-solid fa-gamepad"></i> Join game</button>
                            </form>
                        @endif
                    @endif
                @endif
                @if (Auth::user() && Auth::user()->id == $tournament->user_id)
                    @if ($tournament->status == 'preparing')
                        <form action="{{url('/tournaments/' .$tournament->id .'/start')}}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="tournament_id" value="{{$tournament->id}}">
                            <input type="hidden" name="user_id" value="-1">
                            <input type="hidden" name="isteam" value="true">

                            <button class="" style="padding:5px;margin:5px;" ><i class="fa-solid fa-play"></i> Start tournament</button>

                        </form>

                    @elseif ($tournament->status == 'ongoing')
                        <form action="{{url('/tournaments/' .$tournament->id .'/end')}}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="tournament_id" value="{{$tournament->id}}">
                            <input type="hidden" name="user_id" value="-1">
                            <input type="hidden" name="isteam" value="true">
                            <button class="" style="padding:5px;margin:5px;"><i class="fa-solid fa-flag-checkered"></i> End tournament</button>
                        </form>

                @endif
                @if ($tournament->status != 'finished')
                    <a href="{{url('/tournaments/' .$tournament->id. '/edit')}}" style="padding:5px;margin:5px;"><i class="fa-solid fa-pencil"></i>Edit</a>
                    <form method="POST" action="{{url('/tournaments/' . $tournament->id)}}">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-500" style="padding:5px;margin:5px;"><i class="fa-solid fa-trash"></i> Delete</button>
                    </form>
                @endif
            @endif
        </x-card>
    </div>
</x-layout>