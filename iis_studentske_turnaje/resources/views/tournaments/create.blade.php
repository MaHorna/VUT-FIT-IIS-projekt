<x-layout>
    <x-card class="p-10 rounded max-w-lg mx-auto mt-24">
        <header class="text-center">
            <h2 class="text-2xl font-bold uppercase mb-1">
                Create Tournament
            </h2>
            <p class="mb-4">Make your own tournament now</p>
        </header>

        <form method="POST" action="{{url('/tournaments')}}" enctype="multipart/form-data" id="tournamentForm">

            @csrf
            <div class="mb-6">
                <label
                    for="name"
                    class="inline-block text-lg mb-2"
                    >Tournament Name<i class="text-yellowish">*</i></label
                >
                <input
                    type="text"
                    class="border border-gray-200 rounded p-2 w-full bg-grayish"
                    name="name"
                    value="{{old('name')}}"
                />
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="game" class="inline-block text-lg mb-2"
                    >Game<i class="text-yellowish">*</i></label
                >
                <input
                    type="game"
                    class="border border-gray-200 rounded p-2 w-full bg-grayish"
                    name="game"
                    value="{{old('game')}}"
                />
                @error('game')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label
                    for="start_date"
                    class="inline-block text-lg mb-2"
                    >Start time<i class="text-yellowish">*</i></label
                >
                <input
                    type="datetime-local"
                    class="border border-gray-200 rounded p-2 w-full bg-grayish"
                    name="start_date"
                    min="{{now()}}"
                    step="1"
                    value="{{old('start_date')}}"
                />
                @error('start_date')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="prize" class="inline-block text-lg mb-2"
                    >Prize<i class="text-yellowish">*</i></label
                >
                <input
                    type="text"
                    class="border border-gray-200 rounded p-2 w-full bg-grayish"
                    name="prize"
                    value="{{old('prize')}}"
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
                    Number of contestants<i class="text-yellowish">*</i>
                </label>
                <input
                    type="number"
                    class="border border-gray-200 rounded p-2 w-full bg-grayish"
                    name="num_participants"
                    value="{{old('num_participants')}}"
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
                    @if(!old('teams_allowed')) checked @endif
                />
                <label for="teams_allowed" class="inline-block text-lg mb-2">
                    Players
                </label>
                <input
                    type="radio"
                    id="Players"
                    class="p-2 bg-grayish"
                    name="teams_allowed"
                    value="0"
                    @if(old('teams_allowed')) checked @endif
                />
                @error('teams_allowed')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label
                    for="logo"
                    class="inline-block text-lg mb-2"
                    >Tournament logo<i class="text-yellowish">*</i></label
                >
                <select id="logo" name="logo" form="tournamentForm" class="border border-gray-200 bg-grayish rounded p-2 w-full">
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

            <div class="mb-6">
                <label
                    for="description"
                    class="inline-block text-lg mb-2"
                >
                    Tournament Description
                </label>
                <textarea
                    class="border border-gray-200 rounded p-2 w-full bg-grayish"
                    name="description"
                    rows="10"
                    placeholder="Description..."
                    {{old('description')}}
                ></textarea>
                @error('description')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6">
                <button
                    class="bg-yellowish text-white rounded py-2 px-4 hover:bg-grayish"
                >
                    Create tournament
                </button>

                <a href="{{url('/')}}" class="ml-4"> Back </a>
            </div>
        </form>
    </x-card>
</x-layout>