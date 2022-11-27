<x-layout>
    <x-search :path="'/teams'"/>
        <a href="/" class="inline-block ml-4 mb-4"><i class="fa-solid fa-arrow-left"></i> Back</a>
        <div class="mx-4">
            <x-card class="p-10">
                <div class="flex flex-col items-center justify-center text-center">
                    <img
                        class="w-48 mr-6 mb-6"
                        src="{{$team->logo ? asset('images/logos/' . $team->logo) : asset('/images/placeholder.png')}}"
                        alt=""
                    />
    
                    <h3 class="text-2xl mb-2">{{$team->name}}</h3>
                    <div class="text-lg my-4"></div>
                    <div class="border border-gray-200 w-full mb-6"></div>
                    <div>
                        <div class="text-lg space-y-6">
                            {{$team->description}}
                        </div>
                    </div>
                    <div class="border border-gray-200 w-full mb-6"></div>
                    @foreach($team_users as $team_user)
                        <option value="{{ $team_user->id }}">{{ $team_user->name}}</option>
                    @endforeach
                </div>
            </x-card>

            @if (Auth::user() && Auth::user()->id == $team->user_id)
                <x-card class="mt-4 p-2 flex space-x-6">
                    <a href="/teams/{{$team->id}}/edit">
                    <i class="fa-solid fa-pencil"></i>Edit
                    </a>

                    <form method="POST" action="/teams/{{$team->id}}">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-500"><i class="fa-solid fa-trash"></i>Delete</button>
                    </form>

                    <form action="{{url('/my_teams/' . $team->id . '/add_user')}}" method="POST">
                        @csrf
                        <input type="hidden" name="team_id" value="{{$team->id}}">
                                
                        <label>Choose which user you want to add to team ?</label>
                            <select name="user_id" id="user_id" class="css_team_combobox bg-black" >
                                @foreach($users as $user)
                                    @php
                                        $is_not_team_user = true;
                                    @endphp

                                    @foreach($team_users as $team_user)
                                        @if($user->id == $team_user->id)
                                            @php
                                                $is_not_team_user = false;
                                            @endphp
                                        @endif
                                    @endforeach

                                    @if ($is_not_team_user == true)
                                        <option value="{{ $user->id }}">{{ $user->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        <button><i class="fa-solid"></i>Add player</button>
                    </form>
                </x-card>
            @endif
        </div>
    </x-layout>