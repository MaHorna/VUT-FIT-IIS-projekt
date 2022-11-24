<x-layout>
    <x-card class="p-10 rounded max-w-lg mx-auto mt-24">
        <header class="text-center">
            <h2 class="text-2xl font-bold uppercase mb-1">
                Edit Tournament
            </h2>
            <p class="mb-4">Edit {{$tournament->name}}</p>
        </header>

        <form method="POST" action="{{url('/tournaments/' . $tournament->id)}}" enctype="multipart/form-data">
            @csrf

            @method('PUT')
            <div class="mb-6">
                <label
                    for="name"
                    class="inline-block text-lg mb-2"
                    >Tournament Name</label
                >
                <input
                    type="text"
                    class="border border-gray-200 rounded p-2 w-full"
                    name="name"
                    value="{{$tournament->name}}"
                />
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="game" class="inline-block text-lg mb-2"
                    >Game</label
                >
                <input
                    type="game"
                    class="border border-gray-200 rounded p-2 w-full"
                    name="game"
                    value="{{$tournament->game}}"
                />
                @error('game')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label
                    for="start_date"
                    class="inline-block text-lg mb-2"
                    >Start time</label
                >
                <input
                    type="datetime-local"
                    class="border border-gray-200 rounded p-2 w-full"
                    name="start_date"
                    value="{{$tournament->start_date}}"
                />
                @error('start_date')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="prize" class="inline-block text-lg mb-2"
                    >Prize</label
                >
                <input
                    type="text"
                    class="border border-gray-200 rounded p-2 w-full"
                    name="prize"
                    value="{{$tournament->prize}}"
                />
                @error('prize')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label
                    for="num_participants"
                    class="inline-block text-lg mb-2"
                >
                    Number of contestants
                </label>
                <input
                    type="number"
                    class="border border-gray-200 rounded p-2 w-full"
                    name="num_participants"
                    value="{{$tournament->num_participants}}"
                />
                @error('num_participants')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="teams_allowed" class="inline-block text-lg mb-2">
                    Teams
                </label>
                <input
                    type="radio"
                    id="Teams"
                    class="p-2"
                    name="teams_allowed"
                    value="1"
                    @if($tournament->teams_allowed) checked @endif
                />
                <label for="teams_allowed" class="inline-block text-lg mb-2">
                    Players
                </label>
                <input
                    type="radio"
                    id="Players"
                    class="p-2"
                    name="teams_allowed"
                    value="0"
                    @if(!$tournament->teams_allowed) checked @endif
                />
                @error('teams_allowed')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="logo" class="inline-block text-lg mb-2">
                    Tournament Logo
                </label>
                <input
                    type="file"
                    class="border border-gray-200 rounded p-2 w-full"
                    name="logo"
                />
                @error('logo')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <img
            class="hidden w-48 mr-6 md:block"
            src="{{$tournament->logo ? asset('storage/' . $tournament->logo) : asset('/images/placeholder.png')}}"
            alt=""
            />

            <div class="mb-6">
                <label
                    for="description"
                    class="inline-block text-lg mb-2"
                >
                    Tournament Description
                </label>
                <textarea
                    class="border border-gray-200 rounded p-2 w-full"
                    name="description"
                    rows="10"
                >{{$tournament->description}}</textarea>
                @error('description')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6">
                <button
                    class="bg-laravel text-white rounded py-2 px-4 hover:bg-black"
                >
                    Edit tournament
                </button>

                <a href="{{url('/')}}" class="text-black ml-4"> Back </a>
            </div>
        </form>
    </x-card>
</x-layout>