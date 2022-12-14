    <x-layout>
        <script>
            var opened = 0;
            var id_name = 'modal';
            function openEditTeamForm(team_id) {
                if (opened == 0) {
                    var elem1 = document.getElementById(id_name.concat(team_id));
                    elem1.style.display = 'inline';
                    var elem2 = document.getElementById(id_name.concat(team_id).concat('_bgr'));
                    elem2.style.display = 'inline';
                    opened = 1;
                }
                else {
                    var elem1 = document.getElementById(id_name.concat(team_id));
                    elem1.style.display = 'none';
                    var elem2 = document.getElementById(id_name.concat(team_id).concat('_bgr'));
                    elem2.style.display = 'none';
                    opened = 0;
                }
            }
        </script>
        <script>
            var opened = 0;
            var id_delete = 'delete';
            function openDELETETeamForm(delete_id) {
                if (opened == 0) {
                    var elem11 = document.getElementById(id_delete.concat(delete_id));
                    elem11.style.display = 'inline';
                    var elem22 = document.getElementById(id_delete.concat(delete_id).concat('_bgr'));
                    elem22.style.display = 'inline';
                    opened = 1;
                }
                else {
                    var elem11 = document.getElementById(id_delete.concat(delete_id));
                    elem11.style.display = 'none';
                    var elem22 = document.getElementById(id_delete.concat(delete_id).concat('_bgr'));
                    elem22.style.display = 'none';
                    opened = 0;
                }
            }
        </script>
        <script>
            var opened = 0;
            var id_name = 'modal';
            function openAddPlayer(team_id) {
                if (opened == 0) {
                    var elem1 = document.getElementById(id_name.concat(team_id));
                    elem1.style.display = 'inline';
                    var elem2 = document.getElementById(id_name.concat(team_id).concat('_bgr'));
                    elem2.style.display = 'inline';
                    opened = 1;
                }
                else {
                    var elem1 = document.getElementById(id_name.concat(team_id));
                    elem1.style.display = 'none';
                    var elem2 = document.getElementById(id_name.concat(team_id).concat('_bgr'));
                    elem2.style.display = 'none';
                    opened = 0;
                }
            }
        </script>
    
        <div id="dom-target" style="display: none;">{{asset('images/logos')}}</div>
            <a href="{{url('/')}}" class="inline-block ml-4 mb-4"><i class="fa-solid fa-arrow-left"></i> Back</a>
            <div class="mx-4">
                <x-card class="p-0">
                    <div>
                        <div class="flex items-center justify-center text-center">
                            <img
                                id="logoProfile"
                                class="w-48 mr-6 mb-6 absolute top-40 rounded-full"
                                src="{{$team->logo ? asset('images/logos/' . $team->logo) : asset('/images/placeholder.png')}}"
                                alt=""
                            />
                        </div>
                        <div style="background-image: url('{{asset('images/logos/bg2.png')}}');
                        background-size: cover;
                        background-repeat: no-repeat;
                        height: 14rem;
                        ">
                            <div class="flex items-end justify-end text-center p-10">
                                @if (Auth::user() && Auth::user()->id == $team->user_id)
                                        <button onclick="openEditTeamForm({{$team->id}})" class="mx-2 border px-2 py-1 rounded border-transparent bg-grayish hover:bg-yellowish hover:text-black">
                                        <i class="fa-solid fa-pencil" ></i>
                                        </button>
                                        <button onclick="openDELETETeamForm({{$team->id}})" class="text-red-500 mx-2 border px-2 py-1 rounded border-transparent bg-grayish hover:bg-red-500 hover:text-black">
                                            <i class="fa-solid fa-trash"></i></button>
                                            </a>
                                @endif
                            </div>
                        </div>
                        <div class="flex flex-col items-center justify-center text-center p-10 pt-20">
                            
        
                            @php 
                                $total_games = $team->lost_games + $team->won_games;
                                $win_rate = 0;
                                if ($total_games !== 0) {
                                    $win_rate = ($team->won_games * 100) / $total_games;
                                    
                                }
                            @endphp
        
                            <h3 id="nameProfile" class="text-4xl mb-2 text-yellowish">{{$team->name}}</h3>
    
                            
                            <div class="mb-2 w-full rounded px-5 py-2  text-start">
                                <div>
                                    Description
                                </div>
                                <div id="descriptionProfile" class="text-lg space-y-6 mb-4" style="opacity: 0.4" >
                                    {{$team->description}}
                                </div>
                            </div>
                            
                            <div class="flex flex space-x-6" style="">
                                <div class="flex space-x-6">
                                    <div style="" class=" ">
                                        <div class="text-xl mb-4 px-3 py-1 rounded border-transparent bg-grayish hover:bg-yellowish hover:text-black">
                                            <div style="opacity: 0.4;" class="">Total games</div>
                                            <div style="" class="">{{$total_games}}</div>
                                        </div>
                                    </div>
                                    <div style="" class=" ">
                                        <div class="text-xl mb-4 px-3 py-1 rounded border-transparent bg-grayish hover:bg-yellowish hover:text-black">
                                            <div style="opacity: 0.4;" class="">Won games</div>
                                            <div style="" class="">{{$team->won_games}}</div>
                                        </div>
        
                                    </div>
                                    <div style="" class="">
                                        <div class="text-xl mb-4 px-3 py-1 rounded border-transparent bg-grayish hover:bg-yellowish hover:text-black">
                                            <div style="opacity: 0.4;" class="">Lost games</div>
                                            <div style="" class="">{{$team->lost_games}}</div>
                                        </div>
    
                                    </div>
                                    <div style="" class=" ">
                                        <div class="text-xl mb-4 px-3 py-1 rounded border-transparent bg-grayish hover:bg-yellowish hover:text-black">
                                            <div style="opacity: 0.4;" class="">Win rate</div>
                                            <div style="" class="">{{round($win_rate, 2);}}%</div>
                                        </div>
    
                                    </div>
                                <div>
                                </div class="flex space-x-6">
                                    
                                </div>
                            </div>
    
                            <div class="flex space-x-2">
                                @if (Auth::user())
                                    <div id="forEachPlayers" class="rounded bg-grayish p-2">
                                        @foreach($team_users as $team_user)
                                            <div id="div{{$team->id .'a'. $team_user->id}}" style="display: visible;">
                                                <div class="flex">
                                                    <div class="mr-2">
                                                        <span>{{$team_user->name}}</span>
                                                    </div>
                                                    <div>
                                                        @if ((Auth::user() && Auth::user()->id == $team->user_id) or (Auth::user() && Auth::user()->id == $team_user->user_id))
                                                            <form>
                                                                <button id="remove{{$team->id .'a'. $team_user->id}}" class="removePlayer text-red-500"><i class="fa-solid fa-x"></i></button>
                                                            </form>
                                                        @endif
                                                    </div>
                                                </div>
                                                <script>
                                                    $("#remove{{$team->id .'a' . $team_user->id}}").click(function(e)
                                                    {
                                                        e.preventDefault();
                                                        $.ajaxSetup({
                                                            headers: {
                                                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                            }
                                                        });
                                                        jQuery.ajax({
                                                            url: "{{url('/my_teams/destroy/'. $team_user->user_id . '/'. $team_user->team_id)}}",
                                                            method: 'DELETE',
                                                            data: {
                                                            },
                                                            success: function(data){
                                                                const tmp = document.getElementById(data.delete);
                                                                tmp.remove();
                                                            }});
                                                    });
                                                </script>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                                @if (Auth::user() && Auth::user()->id == $team->user_id)
                                    <button onclick="openAddPlayer('AddPlayer')" style="align-self: flex-end;" class="px-2 py-1 bg-grayish rounded hover:bg-yellowish hover:text-black">
                                    <i class="fa-solid fa-plus" ></i>
                                    </button>
                                    
                                @endif
                            </div>
                            
                        </div>
                    </div>
                </x-card>
    
                
    
                <div onclick="openEditTeamForm({{$team->id}})" class="modal_bgr" id="modal{{$team->id}}_bgr" style="display:none;">
                </div>
                <div class="modal" id="modal{{$team->id}}" style="display:none;">
                    <x-card class="p-10 rounded max-w-lg mx-auto">
                        <header class="text-center">
                            <h2 class="text-2xl font-bold uppercase mb-1">
                                Edit Team
                            </h2>
                            <p class="mb-4" id="nameForm">{{$team->name}}</p>
                        </header>
                        <form id="teamForm">
                            <div class="mb-6">
                                <label
                                    for="name"
                                    class="inline-block text-lg mb-2"
                                    >Team Name<i class="text-yellowish">*</i></label
                                >
                                <input
                                    type="text"
                                    class="border border-gray-200 rounded p-2 w-full bg-grayish"
                                    name="name"
                                    id="name"
                                    value="{{$team->name}}"
                                />
                                @error('name')
                                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                                @enderror
                            </div>
                
                            <div class="mb-6">
                                <label
                                    for="logo"
                                    class="inline-block text-lg mb-2"
                                    >Tournament logo<i class="text-yellowish">*</i></label
                                >
                                
                                <select id="logo" name="logo" form="teamForm" class="border bg-grayish border-gray-200 rounded p-2 w-full" onchange="document.getElementById('logoForm').src = document.getElementById('dom-target').textContent+'/'+this.value">
                                    <option value="assassin.jpg">Assassin</option>
                                    <option value="bull.jpg">Bull</option>
                                    <option value="cobra.jpg">Cobra</option>
                                    <option value="dragon.jpg">Dragon</option>
                                    <option value="saber.png">Saber</option>
                                    <option value="unicorn.png">Unicorn</option>
                                    <option value="wolf.jpg">Wolf</option>
                                </select>
                                @error('logo')
                                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                                @enderror
                            </div>
                
                            <img
                                class="hidden w-48 mr-6 md:block"
                                id="logoForm"
                                src="{{$team->logo ? asset('images/logos/' . $team->logo) : asset('/images/placeholder.png')}}"
                                alt=""
                            />
                
                            <div class="mb-6">
                                <label
                                    for="description"
                                    class="inline-block text-lg mb-2 mt-2"
                                >
                                    Team Description
                                </label>
                                <textarea
                                    class="border border-gray-200 rounded p-2 w-full bg-grayish"
                                    name="description"
                                    id="description"
                                    rows="10"
                                >{{$team->description}}</textarea>
                                @error('description')
                                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                                @enderror
                            </div>
                
                            <div class="mb-6">
                                <button
                                    class="bg-yellowish text-white rounded py-2 px-4 hover:bg-grayish"
                                    id="update"
                                >
                                    Edit Team
                                </button>
                
                                <a onclick="openEditTeamForm({{$team->id}})" class="ml-4"> Back </a>
                            </div>
                        </form>
                        
                    </x-card>
    
                    <script>
                        $("#update").click(function(e)
                        {
                            e.preventDefault();
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });
                            jQuery.ajax({
                                url: "{{ url('/teams/' . $team->id )}}",
                                method: 'PUT',
                                data: {
                                    name: jQuery('#name').val(),
                                    logo: $('#logo').find(":selected").val(),
                                    description: jQuery('#description').val()
                                },
                                success: function(data){
                                    document.getElementById("nameProfile").innerHTML = data.name;
                                    document.getElementById("nameForm").innerHTML = data.name;
                                    document.getElementById("descriptionProfile").innerHTML = data.description;
                                    document.getElementById("logoProfile").setAttribute("src", data.logo);
                                }});
                        });
                    </script>
                </div>
    
                <div onclick="openAddPlayer('AddPlayer')" class="modal_bgr" id="modalAddPlayer_bgr" style="display:none;">
                </div>
                <div class="modal" id="modalAddPlayer" style="display:none;">
                    <x-card class="p-10 rounded max-w-lg mx-auto">
                        <header class="text-center">
                            <h2 class="text-2xl font-bold uppercase mb-1 text-yellowish">
                                Add player
                            </h2>
                            <p class="mb-4">Choose player</p>
                        </header>
                        <form>
                            <input type="hidden" id="team_id" name="team_id" value="{{$team->id}}">
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
                                        <option id="option{{$team->id .'a'. $user->id}}" value="{{ $user->id }}">{{ $user->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                            <div class="mb-6 mt-6">
                                <button
                                    class="bg-yellowish text-white rounded py-2 px-4 hover:bg-grayish"
                                    id="addPlayer"
                                >
                                    Add player
                                </button>
                
                                <a onclick="openAddPlayer('AddPlayer')" class="ml-4"> Back </a>
                            </div>
                        </form>
    
                        <script>
                            $("#addPlayer").click(function(e)
                            {
                                e.preventDefault();
                                $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                });
                                jQuery.ajax({
                                    url: "{{url('/my_teams/add_user/' . $team->id)}}",
                                    method: 'POST',
                                    data: {
                                        team_id: jQuery('#team_id').val(),
                                        user_id: $('#user_id').find(":selected").val()
                                    },
                                    success: function(data){
                                        var div = document.createElement('div');
                                        div.innerHTML = data.addPlayer;
                                        document.getElementById("forEachPlayers").appendChild(div);
                                        document.getElementById(data.delete).remove();
                                    }});
                            });
                        </script>                    
                    </x-card>
    
                    <script>
                        $("#addPlayer").click(function(e)
                        {
                            e.preventDefault();
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });
                            jQuery.ajax({
                                url: "{{ url('/teams/' . $team->id )}}",
                                method: 'PUT',
                                data: {
                                    name: jQuery('#name').val(),
                                    logo: $('#logo').find(":selected").val(),
                                    description: jQuery('#description').val()
                                },
                                success: function(data){
                                    document.getElementById("nameProfile").innerHTML = data.name;
                                    document.getElementById("nameForm").innerHTML = data.name;
                                    document.getElementById("descriptionProfile").innerHTML = data.description;
                                    document.getElementById("logoProfile").setAttribute("src", data.logo);
                                }});
                        });
                    </script>
                </div>
            </div>

            <div onclick="openDELETETeamForm({{$team->id}})" class="delete_bgr" id="delete{{$team->id}}_bgr" style="display:none;"></div>
            <div class="delete" id="delete{{$team->id}}" style="display:none;">
                <x-card class="p-10 rounded mx-auto">
                    <header class="text-center">
                        <h2 class="mb-4">
                            Are you sure you want delete this user ? 
                        </h2>
                        <p class="text-2xl font-bold  mb-1"  id="nameFormdel">{{$team->name}}</p>
                    </header>
                    <div class="bottom-three"> </div>
                    <form method="POST" action="{{url('/teams/'.$team->id)}}">
                        @csrf
                        @method('DELETE')
                        <div class="absolute bottom-4 right-12"> 
                            <button class="myButton">Delete</button>
                        </div>
                    </form>
                    <div class="absolute bottom-4 left-12"> 
                        <a onclick="openDELETETeamForm({{$team->id}})" class="green"> No </a>
                    </div>
                </x-card>
            </div>
        </div>
        </x-layout>