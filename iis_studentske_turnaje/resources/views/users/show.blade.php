<x-layout>
    <script>
        var opened = 0;
        var id_name = 'modal';
        function openEditUserForm(user_id) {
            if (opened == 0) {
                var elem1 = document.getElementById(id_name.concat(user_id));
                elem1.style.display = 'inline';
                var elem2 = document.getElementById(id_name.concat(user_id).concat('_bgr'));
                elem2.style.display = 'inline';
                opened = 1;
            }
            else {
                var elem1 = document.getElementById(id_name.concat(user_id));
                elem1.style.display = 'none';
                var elem2 = document.getElementById(id_name.concat(user_id).concat('_bgr'));
                elem2.style.display = 'none';
                opened = 0;
            }
        }
    </script>
    <script>
        var opened = 0;
        var id_delete = 'delete';
        function openDELETEUserForm(delete_id) {
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
    <div id="dom-target" style="display: none;">{{asset('images/logos')}}</div>
    <a href="{{url('/')}}" class="inline-block ml-4 mb-4"><i class="fa-solid fa-arrow-left"></i> Back</a>
    <div class="mx-4">
        <x-card class="p-0">
            <div class="flex items-center justify-center text-center">
                <img
                    id="logoProfile"
                    class="w-48 mr-6 mb-6 absolute top-40 rounded-full"
                    src="{{$user->logo ? asset('images/logos/' . $user->logo) : asset('/images/placeholder.png')}}"
                    alt=""
                />
            </div>
            <div style="background-image: url('{{asset('images/logos/bg2.png')}}');
            background-size: cover;
            background-repeat: no-repeat;
            height: 14rem;
            ">
                <div class="flex items-end justify-end text-center p-10">
                    @if (Auth::user() && Auth::user()->id == $user->id)
                        <button onclick="openEditUserForm({{$user->id}})" class="mx-2 border px-2 py-1 rounded border-transparent bg-grayish hover:bg-yellowish hover:text-black">
                        <i class="fa-solid fa-pencil" ></i>
                        </button>
                        <button onclick="openDELETEUserForm({{$user->id}})" class="text-red-500 mx-2 border px-2 py-1 rounded border-transparent bg-grayish hover:bg-red-500 hover:text-black">
                            <i class="fa-solid fa-trash"></i></button>
                            </a>
                    @endif
                </div>
            </div>
            
            <div
                class="flex flex-col items-center justify-center text-center p-10 pt-20"
            >
                
                @php 
                $total_games = $user->lost_games + $user->won_games;
                $win_rate = 0;
                if ($total_games !== 0) {
                    $win_rate = ($user->won_games * 100) / $total_games;
                    
                }
                @endphp

                <h3 id="nameProfile" class="text-4xl mb-2 text-yellowish">{{$user->name}}</h3>

                <div class="flex flex space-x-6 mt-6" style="">
                    <div class="flex space-x-6">
                        <div style="" class=" ">
                            <div class="text-xl mb-4 px-3 py-1 rounded border-transparent bg-grayish hover:bg-yellowish hover:text-black">
                                <div style="opacity: 0.4;" class="">Email</div>
                                <div style="" class="">{{$user->email}}</div>
                            </div>
                        </div>
                        <div style="" class=" ">
                            <div class="text-xl mb-4 px-3 py-1 rounded border-transparent bg-grayish hover:bg-yellowish hover:text-black">
                                <div style="opacity: 0.4;" class="">Total games</div>
                                <div style="" class="">{{$total_games}}</div>
                            </div>
                        </div>
                        <div style="" class=" ">
                            <div class="text-xl mb-4 px-3 py-1 rounded border-transparent bg-grayish hover:bg-yellowish hover:text-black">
                                <div style="opacity: 0.4;" class="">Won games</div>
                                <div style="" class="">{{$user->won_games}}</div>
                            </div>

                        </div>
                        <div style="" class="">
                            <div class="text-xl mb-4 px-3 py-1 rounded border-transparent bg-grayish hover:bg-yellowish hover:text-black">
                                <div style="opacity: 0.4;" class="">Lost games</div>
                                <div style="" class="">{{$user->lost_games}}</div>
                            </div>

                        </div>
                        <div style="" class=" ">
                            <div class="text-xl mb-4 px-3 py-1 rounded border-transparent bg-grayish hover:bg-yellowish hover:text-black">
                                <div style="opacity: 0.4;" class="">Win rate</div>
                                <div style="" class="">{{round($win_rate, 2);}}%</div>
                            </div>

                        </div>
                    <div>
                </div>
            </div>
        </x-card>

        <div onclick="openEditUserForm({{$user->id}})" class="modal_bgr" id="modal{{$user->id}}_bgr" style="display:none;"></div>
            <div class="modal" id="modal{{$user->id}}" style="display:none;">
                <x-card class="p-10 rounded max-w-lg mx-auto">
                    <header class="text-center">
                        <h2 class="text-2xl font-bold uppercase mb-1">
                            Edit User
                        </h2>
                        <p class="mb-4" id="nameForm">{{$user->name}}</p>
                    </header>
            
                    <form id="userForm">
                        <div class="mb-6">
                            <label
                                for="name"
                                class="inline-block text-lg mb-2"
                                >User Name<i class="text-yellowish">*</i></label
                            >
                            <input
                                type="text"
                                class="border border-gray-200 rounded p-2 w-full bg-grayish"
                                name="name"
                                id="name"
                                value="{{$user->name}}"
                            />
                            @error('name')
                                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                            @enderror
                        </div>
            
                        <div class="mb-6">
                            <label
                                for="logo"
                                class="inline-block text-lg mb-2"
                                >User logo<i class="text-yellowish">*</i></label
                            >
                           
                            <select id="logo" name="logo" form="userForm" class="border bg-grayish border-gray-200 rounded p-2 w-full" onchange="document.getElementById('logoForm').src = document.getElementById('dom-target').textContent+'/'+this.value">
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
                        src="{{$user->logo ? asset('images/logos/' . $user->logo) : asset('/images/placeholder.png')}}"
                        alt=""
                        />
            
                        <div class="mb-6">
                            <button
                                class="bg-yellowish text-white rounded py-2 px-4 hover:bg-grayish"
                                id="update_user"
                            >
                                Edit User
                            </button>
            
                            <a onclick="openEditUserForm({{$user->id}})" class="ml-4"> Back </a>
                        </div>
                    </form>
                </x-card>

                <script>
                    $("#update_user").click(function(e)
                    {
                        e.preventDefault();
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        jQuery.ajax({
                            url: "{{ url('/users/' . $user->id )}}",
                            method: 'PUT',
                            data: {
                                name: jQuery('#name').val(),
                                logo: $('#logo').find(":selected").val(),
                            },
                            success: function(data){
                                document.getElementById("nameProfile").innerHTML = data.user;
                                document.getElementById("nameForm").innerHTML = data.user;
                                document.getElementById("nameFormdel").innerHTML = data.user;
                                document.getElementById("logoProfile").setAttribute("src", data.logo);
                            }});
                    });
                </script>
            </div>

        <div onclick="openDELETEUserForm({{$user->id}})" class="delete_bgr" id="delete{{$user->id}}_bgr" style="display:none;"></div>
            <div class="delete" id="delete{{$user->id}}" style="display:none;">
                <x-card class="p-10 rounded mx-auto">
                    <header class="text-center">
                        <h2 class="mb-4">
                            Are you sure you want delete this user ? 
                        </h2>
                        <p class="text-2xl font-bold  mb-1"  id="nameFormdel">{{$user->name}}</p>
                    </header>
                    <div class="bottom-three"> </div>
                    <form method="POST" action="{{url('/users/'.$user->id)}}">
                        @csrf
                        @method('DELETE')
                        <div class="absolute bottom-4 right-12"> 
                            <button class="myButton">Delete</button>
                        </div>
                    </form>
                    <div class="absolute bottom-4 left-12"> 
                        <a onclick="openDELETEUserForm({{$user->id}})" class="green"> No </a>
                    </div>
                </x-card>
            </div>
        </div>
</x-layout>