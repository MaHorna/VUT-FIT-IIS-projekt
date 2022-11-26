<x-layout>
    <x-search :path="'/tournaments'"/>
        <a href="{{url('/')}}" class="inline-block ml-4 mb-4"><i class="fa-solid fa-arrow-left"></i> Back</a>
        <div class="mx-4">
            <x-card class="p-10">
                <div
                    class="flex flex-col items-center justify-center text-center"
                >
                    <img
                        class="w-48 mr-6 mb-6"
                        src="{{$tournament->logo ? asset('images/logos/' . $tournament->logo) : asset('/images/placeholder.png')}}"
                        alt=""
                    />
    
                    <h3 class="text-2xl mb-2">{{$tournament->name}}</h3>
                    <div class="text-xl font-bold mb-4">{{$tournament->game}}</div>
			<div class="text-xl font-bold mb-4">{{$tournament->status}}</div>
			<div class="text-xl font-bold mb-4">{{$tournament->teams_allowed}}</div>
                    <div class="text-lg my-4">
                        <i class="fa-solid fa-location-dot"></i> {{$tournament->start_date}}
                    </div>
                    <div class="border border-gray-200 w-full mb-6"></div>
                    <div>
                        <h3 class="text-3xl font-bold mb-4">
                            Job Description
                        </h3>
                        <div class="text-lg space-y-6">
                            {{$tournament->description}}
                        </div>
                    </div>
                </div>
            </x-card>

            <x-card class="mt-4 p-2 flex space-x-6">
            @if ($tournament->status = 'preparing')
                @if ($tournament->teams_allowed == 1)
                    @if ($is_registered_leader)
                        <form method="POST" action="{{url('/contestant/' . $contestant->id)}}">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-500"><i class="fa-solid fa-trash"></i>Leave game</button>
                        </form>
                    @else
                        @if ($is_team_leader)
                            <form action="{{url('/contestant')}}" method="POST">
                                @csrf
                                <input type="hidden" name="tournament_id" value="{{$tournament->id}}">
                                
                                <label>Choose which team of your's should compete ?</label>
                                <select name="team_id" id="team_id" class="css_team_combobox">
                                    @foreach($teams as $team)
                                    <option value="{{ $team->id }}">{{ $team->name}}</option>
                                    @endforeach
                                </select>
                                <input type="hidden" name="user_id" value="-1">
                                <input type="hidden" name="isteam" value="true">
                                <button class="text-red-500"><i class="fa-solid fa-trash"></i>Join game</button>
                            </form>
                        @else    
                            <p>You are not team leader, cant join</p>
                        @endif
                    @endif
                @else
                    @if ($is_registered_user)
                        <form method="POST" action="{{url('/contestant/' . $contestant->id)}}">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-500"><i class="fa-solid fa-trash"></i>Leave game</button>
                        </form>
                    @else
                        <form action="{{url('/contestant')}}" method="POST">
                            @csrf
                            <input type="hidden" name="tournament_id" value="{{$tournament->id}}">
                            <input type="hidden" name="team_id" value="-1">
                            <input type="hidden" name="user_id" value="{{auth()->id()}}">
                            <input type="hidden" name="isteam" value="0">
                            <button class="text-red-500"><i class="fa-solid fa-trash"></i>Join game</button>
                        </form>
                    @endif
		@endif
            @endif
            @if (Auth::user() && Auth::user()->id == $tournament->user_id)
                <a href="{{url('/tournaments/' .$tournament->id. '/edit')}}"><i class="fa-solid fa-pencil"></i>Edit</a>
                <form method="POST" action="{{url('/tournaments/' . $tournament->id)}}">
                    @csrf
                    @method('DELETE')
                    <button class="text-red-500"><i class="fa-solid fa-trash"></i>Delete</button>
                </form>  
            @endif
            </x-card>
        </div>
    </x-layout>