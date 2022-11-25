<x-layout>
    <x-card class="p-10 rounded max-w-lg mx-auto mt-24">
        <header class="text-center">
            <h2 class="text-2xl font-bold uppercase mb-1">
                Edit Team
            </h2>
            <p class="mb-4">Edit {{$team->name}}</p>
        </header>

        <form method="POST" action="{{url('/teams/' . $team->id)}}" id="teamForm" enctype="multipart/form-data">
            @csrf

            @method('PUT')
            <div class="mb-6">
                <label
                    for="name"
                    class="inline-block text-lg mb-2"
                    >Team Name</label
                >
                <input
                    type="text"
                    class="border border-gray-200 rounded p-2 w-full bg-grayish"
                    name="name"
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
                    >Tournament logo</label
                >
                <select id="logo" name="logo" form="teamForm" class="border bg-grayish border-gray-200 rounded p-2 w-full">
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
            src="{{$team->logo ? asset('images/logos/' . $team->logo) : asset('/images/placeholder.png')}}"
            alt=""
            />

            <div class="mb-6">
                <label
                    for="description"
                    class="inline-block text-lg mb-2"
                >
                    team Description
                </label>
                <textarea
                    class="border border-gray-200 rounded p-2 w-full bg-grayish"
                    name="description"
                    rows="10"
                >{{$team->description}}</textarea>
                @error('description')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6">
                <button
                    class="bg-yellowish text-white rounded py-2 px-4 hover:bg-grayish"
                >
                    Edit Team
                </button>

                <a href="/" class="ml-4"> Back </a>
            </div>
        </form>
    </x-card>
</x-layout>