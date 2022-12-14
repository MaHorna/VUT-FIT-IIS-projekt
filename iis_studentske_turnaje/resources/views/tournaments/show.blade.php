<x-layout>
    @if (Auth::user() && Auth::user()->id == $tournament->user_id && $tournament->status != 'finished')
        <div onclick="closeForm()" class="modal_bgr" id="modal_bgr" style="display:none;"></div>
        <div class="modal" id="modal" style="display:none;">
            <x-card>
                <form id="popup_link1" method="POST" action="" class="form-container">
                    @csrf
                    @method("PUT")

                    <h1 id="popup_name1" class="text-2xl mb-2 text-yellowish"></h1>
                    <label id="popup_score1_label" for="score1" class="font-bold mb-2">Score</label>
                    <input id="popup_score1" type="number" value="" name="score1" class="border border-gray-200 rounded p-2 w-full bg-grayish"><br>

                    <hr id="popup_hr" class="mt-5">

                    <h1 id="popup_name2" class="text-2xl mb-2 text-yellowish"></h1>
                    <label id="popup_score2_label" for="score2">Score</label>
                    <input id="popup_score2" type="number" value="" name="score2" class="border border-gray-200 rounded p-2 w-full bg-grayish"><br>

                    <div class="mb-6">
                        <label for="date" class="inline-block text-lg mb-2">Start time</i></label>
                        <input id="popup_date" type="datetime-local" class="border border-gray-200 rounded p-2 w-full bg-grayish" name="date" min="{{now()}}" step="1" value=""/>
                        @error('date')
                            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                        @enderror
                    </div>

                    <button type="submit" id="popup_update_score_btn" match_id="" onclick="closeForm();update_score(event, this.match_id);" class="btn h-10 mt-2 w-36 text-white rounded-lg bg-yellowish hover:bg-grayish">Update score</button>
                </form>
            </x-card>
            <hr>
            <x-card class="mt-3">
                <form id="popup_link2" method="POST" action="" class="form-container">
                    @csrf
                    @method("PUT")
                    <input id="popup_winner1_radio" type="radio" name="winner" value="1">
                    <label for="popup_winner1_radio" id="popup_winner1"></label>
                    <br>
                    <hr id="popup_hr2">
                    <input id="popup_winner2_radio" type="radio" name="winner" value="2">
                    <label for="popup_winner2_radio" id="popup_winner2"></label>
                    <br>
                    <button type="submit" id="popup_update_winner_btn" match_id="" onclick="closeForm();update_winner(event, this.match_id);" class="btn mt-2 h-10 w-36 text-white rounded-lg bg-yellowish hover:bg-grayish">Confirm winner</button>
                    <button type="button" onclick="closeForm();" class="close btn mt-2 cancel" >Close</button>
                </form>
            </x-card>
        </div>
    @endif

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

<script>
    var opened = 0;
    var elem1 = document.getElementById('modal');
    var elem2 = document.getElementById('modal_bgr');
    function openForm(e, match_id) 
    {
        e.preventDefault();
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        jQuery.ajax({
            url: "{{ url('/tournaments/get_popup_data')}}"+"/"+match_id,
            method: 'POST',
            data: {match_id: match_id},
            success: function (ret_data) {
                if(ret_data.data1_is_null == 0 || ret_data.data2_is_null == 0) {
                    elem1.style.display = 'inline';
                    elem2.style.display = 'inline';
                }
                if(ret_data.data1_is_null == 1) {
                    //remove elements if no contestant
                    document.getElementById("popup_name1").style.display = "none";
                    document.getElementById("popup_score1_label").style.display = "none";
                    document.getElementById("popup_score1").style.display = "none";
                    document.getElementById("popup_hr").style.display = "none";
                    document.getElementById("popup_winner1").style.display = "none";
                    document.getElementById("popup_hr2").style.display = "none";
                    document.getElementById("popup_winner1").style.display = "none";
                    document.getElementById("popup_winner2_radio").checked = true;
                }
                else {
                    document.getElementById("popup_winner1_radio").checked = true;
                }
                if(ret_data.data2_is_null == 1) {
                    //remove elements if no contestant
                    document.getElementById("popup_name2").style.display = "none";
                    document.getElementById("popup_score2_label").style.display = "none";
                    document.getElementById("popup_score2").style.display = "none";
                    document.getElementById("popup_hr").style.display = "none";
                    document.getElementById("popup_winner2").style.display = "none";
                    document.getElementById("popup_hr2").style.display = "none";
                    document.getElementById("popup_winner2").style.display = "none";
                    document.getElementById("popup_winner2_radio").style.display = "none";
                    document.getElementById("popup_winner1_radio").checked = true;
                }
                //set values
                document.getElementById("popup_name1").innerHTML = ret_data.name1;
                document.getElementById("popup_score1").value = ret_data.score1;
                document.getElementById("popup_name2").innerHTML = ret_data.name2;
                document.getElementById("popup_score2").value = ret_data.score2;
                document.getElementById("popup_winner1").innerHTML = ret_data.name1;
                document.getElementById("popup_winner2").innerHTML = ret_data.name2;
                document.getElementById("popup_link1").action = "{{url('/tournaments/updatescore')}}"+"/"+match_id;
                document.getElementById("popup_link2").action = "{{url('/tournaments/updatewinner')}}"+"/"+match_id;
                document.getElementById("popup_date").value = ret_data.date;
                document.getElementById("popup_update_score_btn").match_id = match_id;
                document.getElementById("popup_update_winner_btn").match_id = match_id;
                
                
            } 
        });
    }
    function closeForm()
    {
        elem1.style.display = 'none';
        elem2.style.display = 'none';
        //display elements once again
        document.getElementById("popup_name1").style.display = "inline";
        document.getElementById("popup_score1_label").style.display = "inline";
        document.getElementById("popup_score1").style.display = "inline";
        document.getElementById("popup_hr").style.display = "inline";
        document.getElementById("popup_name2").style.display = "inline";
        document.getElementById("popup_score2_label").style.display = "inline";
        document.getElementById("popup_score2").style.display = "inline";
        document.getElementById("popup_winner1").style.display = "inline";
        document.getElementById("popup_winner2").style.display = "inline";
        document.getElementById("popup_hr2").style.display = "inline";
        document.getElementById("popup_winner1").style.display = "inline";
        document.getElementById("popup_winner1_radio").style.display = "inline";
        document.getElementById("popup_winner2").style.display = "inline";
        document.getElementById("popup_winner2_radio").style.display = "inline";
    }
    function update_score(e, match_id)
    {
        e.preventDefault();
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        jQuery.ajax({
            url: "{{ url('/tournaments/updatescore')}}"+"/"+match_id,
            method: 'PUT',
            data: {
                score1: document.getElementById("popup_score1").value,
                score2: document.getElementById("popup_score2").value,
                date: document.getElementById("popup_date").value,
            },
            success: function(data){
                document.getElementById("match_card_score1_"+match_id).innerHTML = data.score1;
                document.getElementById("match_card_score2_"+match_id).innerHTML = data.score2;
            }
        });
    }
    function update_winner(e, match_id) 
    {          
        e.preventDefault();
        $.ajaxSetup({headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        jQuery.ajax({
            url: "{{ url('/tournaments/updatewinner')}}"+"/"+match_id,
            method: 'PUT',
            data: {winner: document.querySelector('input[name="winner"]:checked').value},
            success: function(data){
                if (data.next_pos == 1) {
                    if (data.winner == 1) {
                        document.getElementById("match_card_name1_" + data.next_id).innerHTML = data.user1_name;
                        document.getElementById("match_card_name1_" + data.next_id).setAttribute("href", data.url+"/"+data.user1_id);
                        document.getElementById("match_card_score1_" + data.next_id).innerHTML = 0;
                    }
                    else
                    {
                        document.getElementById("match_card_name1_" + data.next_id).innerHTML = data.user2_name;
                        document.getElementById("match_card_name1_" + data.next_id).setAttribute("href", data.url+"/"+data.user2_id);
                        document.getElementById("match_card_score1_" + data.next_id).innerHTML = 0;
                    }
                }
                else if (data.next_pos == 2) {
                    if (data.winner == 1) {
                        document.getElementById("match_card_name2_" + data.next_id).innerHTML = data.user1_name;
                        document.getElementById("match_card_name2_" + data.next_id).setAttribute("href", data.url+"/"+data.user1_id);
                        document.getElementById("match_card_score2_" + data.next_id).innerHTML = 0;
                    }
                    else
                    {
                        document.getElementById("match_card_name2_" + data.next_id).innerHTML = data.user2_name;
                        document.getElementById("match_card_name2_" + data.next_id).setAttribute("href", data.url+"/"+data.user2_id);
                        document.getElementById("match_card_score2_" + data.next_id).innerHTML = 0;
                    }
                }
                else
                {
                    alert("Winner is:" + data.success);
                }
            }
        });                     
    }
</script>
