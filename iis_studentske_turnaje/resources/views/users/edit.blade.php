<x-layout>
    <x-card class="p-10 rounded max-w-lg mx-auto mt-24">
        <header class="text-center">
            <h2 class="text-2xl font-bold uppercase mb-1">
                Edit User
            </h2>
            <p class="mb-4">Edit {{$user->name}}</p>
        </header>

        <form method="POST" action="/users/{{$user->id}}" enctype="multipart/form-data">
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
                    class="border border-gray-200 rounded p-2 w-full"
                    name="name"
                    value="{{$user->name}}"
                />
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="logo" class="inline-block text-lg mb-2">
                    User Logo
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
            src="{{$user->logo ? asset('storage/' . $user->logo) : asset('/images/placeholder.png')}}"
            alt=""
            />

            <div class="mb-6">
                <button
                    class="bg-laravel text-white rounded py-2 px-4 hover:bg-black"
                >
                    Edit user
                </button>

                <a href="{{url('/')}}" class="text-black ml-4"> Back </a>
            </div>
        </form>
    </x-card>
</x-layout>