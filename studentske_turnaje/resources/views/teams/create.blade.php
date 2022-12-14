{{-- * FILENAME : create.blade.php
*
* DESCRIPTION : Create team
*
* AUTHOR : Dávid Kán - xkanda01 --}}

<x-layout>

    {{-- utility --}}
    <div id="dom-target" style="display: none;">{{asset('images/logos')}}</div>
    <x-card class="p-10 rounded max-w-lg mx-auto mt-24">
        <header class="text-center">
            <h2 class="text-2xl font-bold uppercase mb-1">
                Create Team
            </h2>
            <p class="mb-4">Make your own Team now</p>
        </header>

        <form method="POST" action="{{url('/teams')}}" enctype="multipart/form-data" id="teamForm">
            @csrf

            {{-- Name --}}
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
                    value="{{old('name')}}"
                />
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            {{-- logo --}}
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
                class="hidden w-48 mr-6 md:block mb-6"
                id="logoForm"
                src="{{asset('images/logos/assassin.jpg')}}"
                alt=""
            />

            {{-- Description --}}
            <div class="mb-6">
                <label
                    for="description"
                    class="inline-block text-lg mb-2"
                >
                    Team Description
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

            {{-- Create and back button --}}
            <div class="mb-6">
                <button
                    class="bg-yellowish text-white rounded py-2 px-4 hover:bg-grayish"
                >
                    Create Team
                </button>

                <a href="{{url('/')}}" class="ml-4"> Back </a>
            </div>
        </form>
    </x-card>
</x-layout>