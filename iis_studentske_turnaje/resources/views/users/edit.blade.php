<x-layout>
    <div id="dom-target" style="display: none;">{{asset('images/logos')}}</div>
    <x-card class="p-10 rounded max-w-lg mx-auto mt-24">
        <header class="text-center">
            <h2 class="text-2xl font-bold uppercase mb-1">
                Edit User
            </h2>
            <p class="mb-4">Edit {{$user->name}}</p>
        </header>

        <form method="POST" action="{{url('/users', $user->id)}}" id="userForm" enctype="multipart/form-data">
            @csrf

            @method('PUT')
            <div class="mb-6">
                <label
                    for="name"
                    class="inline-block text-lg mb-2"
                    >User Name</label
                >
                <input
                    type="text"
                    class="border border-gray-200 rounded p-2 w-full bg-grayish"
                    name="name"
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
                    >Tournament logo</label
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
            class="hidden w-48 mr-6 md:block mb-6"
            id="logoForm"
            src="{{$user->logo ? asset('images/logos/' . $user->logo) : asset('/images/placeholder.png')}}"
            alt=""
            />

            <div class="mb-6">
                <button
                    class="bg-yellowish text-white rounded py-2 px-4 hover:bg-black bg-grayish"
                >
                    Edit user
                </button>

                <a href="{{url('/')}}" class="ml-4"> Back </a>
            </div>
        </form>
    </x-card>
</x-layout>