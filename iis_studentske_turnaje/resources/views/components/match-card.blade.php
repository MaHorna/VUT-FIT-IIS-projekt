@props(['contest', 'tournament'])
<script>
    var opened = 0;
    var id_name = 'modal';
    function openForm(match_id) {
        if (opened == 0) {
            var elem1 = document.getElementById(id_name.concat(match_id));
            elem1.style.display = 'inline';
            var elem2 = document.getElementById(id_name.concat(match_id).concat('_bgr'));
            elem2.style.display = 'inline';
            opened = 1;
        }
        else {
            var elem1 = document.getElementById(id_name.concat(match_id));
            elem1.style.display = 'none';
            var elem2 = document.getElementById(id_name.concat(match_id).concat('_bgr'));
            elem2.style.display = 'none';
            opened = 0;
        }
    }
</script>
<div style="width:300px;">
    @if ($tournament->teams_allowed == true)
        @php
            $team1 = App\Models\Team::join('contestants', 'contestants.team_id', '=', 'teams.id')
                ->where('contestants.tournament_id', $tournament->id)
                ->join('contests', 'contestants.id', '=', 'contests.contestant1_id')
                ->where('contestants.id', $contest->contestant1_id)
                ->select('teams.id', 'teams.name',)
                ->first();
            $team2 = App\Models\Team::join('contestants', 'contestants.team_id', '=', 'teams.id')
                ->where('contestants.tournament_id', $tournament->id)
                ->join('contests', 'contestants.id', '=', 'contests.contestant2_id')
                ->where('contestants.id', $contest->contestant2_id)
                ->select('teams.id', 'teams.name',)
                ->first();
        @endphp

        <div onclick="openForm({{$contest->id}})" style="margin: 15px 0; overflow: hidden; border-radius: 5px;">
            <div style="color: #fff; padding: 10px 8px; background-color: #c69749;border-bottom: 1px solid #282a3a;">
                @if (!is_null($team1))
                    <div class="flex">
                        <div class="flex-1 w-10">
                            <a onclick='event.stopPropagation();' href="{{url('/teams', $team1->id)}}">{{$team1->name}}</a>
                        </div>

                        <div class="flex-none">
                            <button class="open-button"  onclick="openForm({{$contest->id}})"><span style="text-align: right;">{{$contest->score1}}</span></button>
                        </div>
                    </div>
                @else
                    <span>-</span>
                @endif
            </div>
            <div style="color: #fff; padding: 10px 8px; background-color: #c69749;">
                @if (!is_null($team2))

                    <div class="flex">
                        <div class="flex-1 w-10">
                            <a onclick='event.stopPropagation();' href="{{url('/teams', $team2->id)}}">{{$team2->name}}</a>
                        </div>

                        <div class="flex-none">
                            <button class="open-button"><span style="text-align: right;">{{$contest->score2}}</span></button>
                        </div>
                    </div>

                @else
                    <span>-</span>
                @endif
            </div>
        </div>

        @if (Auth::user() && Auth::user()->id == $tournament->user_id && $tournament->status != 'finished')
        <div onclick="openForm({{$contest->id}})" class="modal_bgr" id="modal{{$contest->id}}_bgr" style="display:none;">
        </div>
        <div class="modal" id="modal{{$contest->id}}" style="display:none;">
            @if (!is_null($team1) || !is_null($team2))
                <x-card>
                    <form method="POST" action="{{url('/tournaments/'.$contest->id.'/updatescore')}}" class="form-container">
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
                                for="date"
                                class="inline-block text-lg mb-2"
                                >Start time</i></label
                            >
                            <input
                                type="datetime-local"
                                class="border border-gray-200 rounded p-2 w-full bg-grayish"
                                name="date"
                                min="{{now()}}"
                                step="1"
                                value="{{$contest->date}}"
                            />
                            @error('date')
                                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                            @enderror
                        </div>

                    <button type="submit" onclick="openForm({{$contest->id}})" class="btn h-10 mt-2 w-36 text-white rounded-lg bg-yellowish hover:bg-grayish">Update score</button>
                    </form>
                </x-card>
                <hr>
                <x-card class="mt-3">
                    <form method="POST" action="{{url('/tournaments/' . $contest->id . '/updatewinner')}}" class="form-container">
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
                    <button type="submit" onclick="openForm({{$contest->id}})" class="btn mt-2 h-10 w-36 text-white rounded-lg bg-yellowish hover:bg-grayish">Confirm winner</button>
                    <button type="button" onclick="openForm({{$contest->id}})" class="close btn mt-2 cancel" >Close</button>
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
                ->select('users.id', 'users.name',)
                ->first();
            $user2 = App\Models\User::join('contestants', 'contestants.user_id', '=', 'users.id')
                ->where('contestants.tournament_id', $tournament->id)
                ->join('contests', 'contestants.id', '=', 'contests.contestant2_id')
                ->where('contestants.id', $contest->contestant2_id)
                ->select('users.id', 'users.name',)
                ->first();
        @endphp

        <div onclick="openForm({{$contest->id}})" style="margin: 15px 0; overflow: hidden; border-radius: 5px;">
            <div style="color: #fff; padding: 10px 8px; background-color: #c69749;border-bottom: 1px solid #282a3a;">
                @if (!is_null($user1))
                    <div class="flex">
                        <div class="flex-1 w-10">
                            <a onclick='event.stopPropagation();' id="user1name{{$contest->id}}" href="{{url('/users', $user1->id)}}">{{$user1->name}}</a>
                        </div>

                        <div class="flex-none">
                            <button class="open-button"><span id="score1Value{{$contest->id}}" style="text-align: right;">{{$contest->score1}}</span></button>
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
                            <a onclick='event.stopPropagation();' id="user2name{{$contest->id}}"  href="{{url('/users', $user2->id)}}">{{$user2->name}}</a>
                        </div>

                        <div class="flex-none">
                            <button class="open-button"><span id="score2Value{{$contest->id}}" style="text-align: right;">{{$contest->score2}}</span></button>
                        </div>
                    </div>

                @else
                    <span>-</span>
                @endif
            </div>
        </div>

        @if (Auth::user() && Auth::user()->id == $tournament->user_id && $tournament->status != 'finished')
        <div onclick="openForm({{$contest->id}})" class="modal_bgr" id="modal{{$contest->id}}_bgr" style="display:none;">
        </div>
        <div class="modal" id="modal{{$contest->id}}" style="display:none;">
            @if (!is_null($user1) || !is_null($user2))
                <x-card>
                    <form class="form-container" id="myForm" name="myForm"  >

                        @if (!is_null($user1))
                            <h1 class="text-2xl mb-2 text-yellowish">{{$user1->name}}</h1>
                            <label for="score1" class="font-bold mb-2">Score</label>
                            <input type="number" value="{{$contest->score1}}" id="score1{{$contest->id}}" name="score1" class="border border-gray-200 rounded p-2 w-full bg-grayish"><br>
                        @else
                            <p>-</p>
                            <input type="hidden" value="0" name="score1">
                        @endif
                        <hr class="mt-5">
                        @if (!is_null($user2))
                            <h1 class="text-2xl mb-2 text-yellowish">{{$user2->name}}</h1>
                            <label for="score2">Score</label>
                            <input type="number" value="{{$contest->score2}}" id="score2{{$contest->id}}" name="score2" class="border border-gray-200 rounded p-2 w-full bg-grayish"><br>
                        @else
                            <p>-</p>
                            <input type="hidden" value="0" name="score2">
                        @endif

                        <div class="mb-6">
                            <label
                                for="date"
                                class="inline-block text-lg mb-2"
                                >Start time</i></label
                            >
                            <input
                                type="datetime-local"
                                class="border border-gray-200 rounded p-2 w-full bg-grayish"
                                name="date"
                                id="date{{$contest->id}}"
                                min="{{now()}}"
                                step="1"
                                value="{{$contest->date}}"
                            />
                            @error('date')
                                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                            @enderror
                        </div>
                        <button id="update{{$contest->id}}" class="update{{$contest->id}} btn h-10 mt-2 w-36 text-white rounded-lg bg-yellowish hover:bg-grayish">Update score</button>
                    </form>
                
                    <script>
                        $("#update{{$contest->id}}").click(function(e)
                        {
                            e.preventDefault();
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });
                            jQuery.ajax({
                                url: "{{ url('/tournaments/'.$contest->id.'/updatescore') }}",
                                method: 'PUT',
                                data: {
                                    score1: jQuery('#score1{{$contest->id}}').val(),
                                    score2: jQuery('#score2{{$contest->id}}').val(),
                                    date: jQuery('#date{{$contest->id}}').val()
                                },
                                success: function(data){
                                    document.getElementById("score1Value{{$contest->id}}").innerHTML = data.score1;
                                    document.getElementById("score2Value{{$contest->id}}").innerHTML = data.score2;
                                }});
                        });
                    </script>
                
                <hr class="mt-5">
                
                    <form class="form-container">
                        @if (!is_null($user1))

                        <input type="radio" id="contestant{{$contest->id}}" name="winner{{$contest->id}}" value="1" checked>
                        <label for="contestant{{$contest->id}}" id="user1nameRadio{{$contest->id}}">{{$user1->name}}</label><br>
                        @else
                            <p>-</p>
                        @endif
                        <hr>
                        @if (!is_null($user2))
                            <input type="radio" id="contestant{{$contest->id}}" name="winner{{$contest->id}}" value="2">
                            <label for="contestant{{$contest->id}}" id="user2nameRadio{{$contest->id}}">{{$user2->name}}</label><br>
                        @else
                            <p>-</p>
                        @endif
                    <button id="updateWinner{{$contest->id}}" class="btn mt-2 h-10 w-36 text-white rounded-lg bg-yellowish hover:bg-grayish">Confirm winner</button>
                    <button type="button" onclick="openForm({{$contest->id}})" class="close btn mt-2 cancel" >Close</button>
                    </form>

                    <script>
                        $("#updateWinner{{$contest->id}}").click(function(e)
                        {
                            e.preventDefault();
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });
                            jQuery.ajax({
                                url: "{{ url('/tournaments/'.$contest->id.'/updatewinner') }}",
                                method: 'PUT',
                                data: {
                                    winner: document.querySelector('input[name="winner{{$contest->id}}"]:checked').value
                                },
                                success: function(data){
                                    if (data.next_pos == 1) {
                                        if (data.winner == 1) {
                                            document.getElementById("user1name" + data.next_id).innerHTML = data.user1_name;
                                            document.getElementById("user1nameRadio" + data.next_id).innerHTML = data.user1_name;
                                        }
                                        else
                                        {
                                            document.getElementById("user1name" + data.next_id).innerHTML = data.user2_name;
                                            document.getElementById("user1nameRadio" + data.next_id).innerHTML = data.user2_name;
                                        }
                                    }
                                    else if (data.next_pos == 2) {
                                        if (data.winner == 1) {
                                            document.getElementById("user2name" + data.next_id).innerHTML = data.user1_name;
                                            document.getElementById("user2nameRadio" + data.next_id).innerHTML = data.user1_name;
                                        }
                                        else
                                        {
                                            document.getElementById("user2name" + data.next_id).innerHTML = data.user2_name;
                                            document.getElementById("user2nameRadio" + data.next_id).innerHTML = data.user2_name;
                                        }
                                    }
                                }});
                        });
                    </script>
                </x-card>
            @endif
          </div>
        @endif
    @endif
</div>