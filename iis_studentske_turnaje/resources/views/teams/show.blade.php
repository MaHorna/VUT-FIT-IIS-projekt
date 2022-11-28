<x-layout>
        <a href="{{url('/')}}" class="inline-block ml-4 mb-4"><i class="fa-solid fa-arrow-left"></i> Back</a>
        <div class="mx-4">
            <x-card class="p-10">
                <div class="flex flex-col items-center justify-center text-center">
                    <img
                        class="w-48 mr-6 mb-6"
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

                    <h3 class="text-2xl mb-2 text-yellowish">{{$team->name}}</h3>
                    <div class="text-xl mb-4">Total games: {{$total_games}}</div>
                    <div class="text-xl mb-4">Won games: {{$team->won_games}}</div>
                    <div class="text-xl mb-4">Lost games: {{$team->lost_games}}</div>
                    <div class="text-xl mb-4">Win rate: {{round($win_rate, 2);}}%</div>
                    <div class="border border-gray-200 w-full mb-6"></div>
                    <div class="mb-2">
                        <div class="text-lg space-y-6 mb-4">
                            {{$team->description}}
                        </div>
                    </div>
                    <div class="border border-gray-200 w-full mb-6"></div>
                    @if (Auth::user())
                        @foreach($team_users as $team_user)
                            <div class="flex">
                                <div class="mr-2">
                                    <span>{{$team_user->name}}</span>
                                </div>
                                <div>
                                    @if ((Auth::user() && Auth::user()->id == $team->user_id) or (Auth::user() && Auth::user()->id == $team_user->user_id))
                                        <form method="POST" action="{{url('/my_teams/destroy/'. $team_user->user_id . '/'. $team_user->team_id)}}">
                                            @csrf
                                            @method('DELETE')
                                            <button class="text-red-500"><i class="fa-solid fa-x"></i></button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </x-card>

            @if (Auth::user() && Auth::user()->id == $team->user_id)
                <x-card class="mt-4 p-2 flex space-x-6">
                    <a href="/teams/{{$team->id}}/edit">
                    <i class="fa-solid fa-pencil"></i> Edit
                    </a>

                    <form method="POST" action="/teams/{{$team->id}}">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-500"><i class="fa-solid fa-trash"></i> Delete</button>
                    </form>

                    <form action="{{url('/my_teams/add_user/' . $team->id)}}" method="POST">
                        @csrf
                        <input type="hidden" name="team_id" value="{{$team->id}}">
                                
                        <label>Choose player</label>
                            <select name="user_id" id="user_id" class="css_team_combobox bg-black border solid rounded pl-1" >
                                @foreach($users as $user)
                                    @php
                                        $is_not_team_user = true;
                                    @endphp
                                    @if (Auth::user())
                                        @foreach($team_users as $team_user)
                                            @if($user->id == $team_user->id)
                                                @php
                                                    $is_not_team_user = false;
                                                @endphp
                                            @endif
                                        @endforeach
                                    @endif

                                    @if ($is_not_team_user == true)
                                        <option value="{{ $user->id }}">{{ $user->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        <button><i class="fa-solid fa-plus"></i> Add player</button>
                    </form>
                </x-card>
            @endif
        </div>
    </x-layout>