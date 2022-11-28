@props(['contest', 'tournament'])

<div style="width:300px;">
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
            <div style="color: #fff; padding: 10px 8px; background-color: #c69749;border-bottom: 1px solid #282a3a;">
                @if (!is_null($user1))

                    <a href="{{url('/teams', $team1->id)}}">{{$team1->name}}</a><button class="open-button" data-modal="modal{{$contest->id}}" style="text-align: right;">{{$contest->score1}}</button>

                @else
                    <span>-</span>
                @endif
            </div>
            <div style="color: #fff; padding: 10px 8px; background-color: #c69749;">
                @if (!is_null($user2))

                    <a href="{{url('/teams', $team2->id)}}">{{$team2->name}}</a><button class="open-button" data-modal="modal{{$contest->id}}" style="text-align: right;">{{$contest->score2}}</button>

                @else
                    <span>-</span>
                @endif
            </div>
        </div>
        @if (Auth::user() && Auth::user()->id == $tournament->user_id && $tournament->status != 'finished')
        <div class="modal{{$contest->id}} " id="modal">
            @if (!is_null($team1) || !is_null($team2))
                <x-card>
                    <form method="POST" action="/tournaments/{{$contest->id}}/updatescore" class="form-container">
                        @csrf
                        @method("PUT")
                        @if (!is_null($team1))
                            <h1 class="text-2xl mb-2 text-yellowish">{{$team1->name}}</h1>
                            <label for="score1" class="font-bold mb-2">Score</label>
                            <input type="number" value="{{$contest->score1}}" name="score1" class="border border-gray-200 rounded p-2 w-full bg-grayish"><br>
                        @else
                            <p>-</p>
                            <input type="hidden" value="0" name="score1">
                        @endif
                        <hr class="mt-5">
                        @if (!is_null($team2))
                            <h1 class="text-2xl mb-2 text-yellowish">{{$team2->name}}</h1>
                            <label for="score2">Score</label>
                            <input type="number" value="{{$contest->score2}}" name="score2" class="border border-gray-200 rounded p-2 w-full bg-grayish"><br>
                        @else
                            <p>-</p>
                            <input type="hidden" value="0" name="score2">
                        @endif

                        <div class="mb-6">
                            <label
                                for="start_date"
                                class="inline-block text-lg mb-2"
                                >Start time</i></label
                            >
                            <input
                                type="datetime-local"
                                class="border border-gray-200 rounded p-2 w-full bg-grayish"
                                name="start_date"
                                min="{{now()}}"
                                step="1"
                                value="{{$contest->start_date}}"
                            />
                            @error('start_date')
                                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                            @enderror
                        </div>
                            
                    <button type="submit" class="btn h-10 mt-2 w-36 text-white rounded-lg bg-yellowish hover:bg-grayish">Update score</button>
                    <button type="button" class="close btn mt-2 cancel">Close</button>
                    </form>
                </x-card>
                <hr>
                <x-card class="mt-3">
                    <form method="POST" action="/tournaments/{{$contest->id}}/updatewinner" class="form-container">
                        @csrf
                        @method("PUT")
                        @if (!is_null($team1))
                            
                        <input type="radio" id="contestant1" name="winner" value="1" checked>
                        <label for="contestant1">{{$team1->name}}</label><br>
                        @else
                            <p>-</p>
                        @endif
                        <hr>
                        @if (!is_null($team2))
                            <input type="radio" id="contestant2" name="winner" value="2">
                            <label for="contestant2">{{$team2->name}}</label><br>
                        @else
                            <p>-</p>
                        @endif         
                    <button type="submit" class="btn mt-2 h-10 w-36 text-white rounded-lg bg-yellowish hover:bg-grayish">Confirm winner</button>
                    <button type="button" class="close btn mt-2 cancel" >Close</button>
                    </form>
                </x-card>
            @endif
          </div>
        @endif
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
            <div style="color: #fff; padding: 10px 8px; background-color: #c69749;border-bottom: 1px solid #282a3a;">
                @if (!is_null($user1))
                    <div class="flex">
                        <div class="flex-1 w-10">
                            <a href="{{url('/users', $user1->id)}}">{{$user1->name}}</a>
                        </div>

                        <div class="flex-none">
                            <button class="open-button" onclick="openForm()" style="text-align: right;"><span style="text-align: right;">{{$contest->score1}}</span></button>
                        </div>
                    </div>
                @else
                    <span>-</span>
                @endif
            </div>
            <div style="color: #fff; padding: 10px 8px; background-color: #c69749;">
                @if (!is_null($user2))

                    <div class="flex">
                        <div class="flex-1 w-10">
                            <a href="{{url('/users', $user2->id)}}">{{$user2->name}}</a>
                        </div>

                        <div class="flex-none">
                            <button class="open-button" onclick="openForm()"><span style="text-align: right;">{{$contest->score2}}</span></button>
                        </div>
                    </div>

                @else
                    <span>-</span>
                @endif
            </div>
        </div>

        @if (Auth::user() && Auth::user()->id == $tournament->user_id && $tournament->status != 'finished')
        <div class="modal{{$contest->id}} " id="modal">
            @if (!is_null($user1) || !is_null($user2))
                <x-card>
                    <form method="POST" action="/tournaments/{{$contest->id}}/updatescore" class="form-container">
                        @csrf
                        @method("PUT")
                        @if (!is_null($user1))
                            <h1 class="text-2xl mb-2 text-yellowish">{{$user1->name}}</h1>
                            <label for="score1" class="font-bold mb-2">Score</label>
                            <input type="number" value="{{$contest->score1}}" name="score1" class="border border-gray-200 rounded p-2 w-full bg-grayish"><br>
                        @else
                            <p>-</p>
                            <input type="hidden" value="0" name="score1">
                        @endif
                        <hr class="mt-5">
                        @if (!is_null($user2))
                            <h1 class="text-2xl mb-2 text-yellowish">{{$user2->name}}</h1>
                            <label for="score2">Score</label>
                            <input type="number" value="{{$contest->score2}}" name="score2" class="border border-gray-200 rounded p-2 w-full bg-grayish"><br>
                        @else
                            <p>-</p>
                            <input type="hidden" value="0" name="score2">
                        @endif

                        <div class="mb-6">
                            <label
                                for="start_date"
                                class="inline-block text-lg mb-2"
                                >Start time</i></label
                            >
                            <input
                                type="datetime-local"
                                class="border border-gray-200 rounded p-2 w-full bg-grayish"
                                name="start_date"
                                min="{{now()}}"
                                step="1"
                                value="{{$contest->start_date}}"
                            />
                            @error('start_date')
                                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                            @enderror
                        </div>
                            
                    <button type="submit" class="btn h-10 mt-2 w-36 text-white rounded-lg bg-yellowish hover:bg-grayish">Update score</button>
                    <button type="button" class="close btn mt-2 cancel">Close</button>
                    </form>
                </x-card>
                <hr>
                <x-card class="mt-3">
                    <form method="POST" action="/tournaments/{{$contest->id}}/updatewinner" class="form-container">
                        @csrf
                        @method("PUT")
                        @if (!is_null($user1))
                            
                        <input type="radio" id="contestant1" name="winner" value="1" checked>
                        <label for="contestant1">{{$user1->name}}</label><br>
                        @else
                            <p>-</p>
                        @endif
                        <hr>
                        @if (!is_null($user2))
                            <input type="radio" id="contestant2" name="winner" value="2">
                            <label for="contestant2">{{$user2->name}}</label><br>
                        @else
                            <p>-</p>
                        @endif         
                    <button type="submit" class="btn mt-2 h-10 w-36 text-white rounded-lg bg-yellowish hover:bg-grayish">Confirm winner</button>
                    <button type="button" class="close btn mt-2 cancel" >Close</button>
                    </form>
                </x-card>
            @endif
          </div>
        @endif
    @endif
</div>