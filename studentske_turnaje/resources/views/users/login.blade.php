{{-- * FILENAME : login.blade.php
*
* DESCRIPTION : Login user
*
* AUTHOR : Dávid Kán - xkanda01 --}}

<x-layout>
    <x-card class="p-10 rounded max-w-lg mx-auto mt-24">
        <h2 class="text-2xl font-bold uppercase mb-1">
            Login
        </h2>
        <p class="mb-4">Log into your account</p>
        </header>

        <form method="POST" action="{{url('/users/authenticate')}}">
            @csrf

            {{-- Email --}}
            <div class="mb-6">
                <label for="email" class="inline-block text-lg mb-2"
                    >Email</label>
                <input
                    type="email"
                    class="border border-gray-200 rounded p-2 w-full bg-grayish"
                    name="email"
                    value="{{old('email')}}"/>
                    
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            {{-- Password --}}
            <div class="mb-6">
                <label
                    for="password"
                    class="inline-block text-lg mb-2">
                    Password
                </label>
                <input
                    type="password"
                    class="border border-gray-200 rounded p-2 w-full bg-grayish"
                    name="password"
                    value="{{old('password')}}"/>
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            {{-- Submit --}}
            <div class="mb-6">
                <button type="submit" class="bg-yellowish text-white rounded py-2 px-4 hover:bg-grayish">Sign in</button>
            </div>
            <div class="mt-8">
                <p>Don't have an account?<a href="{{url('/register')}}" class="text-yellowish">Register</a></p>
            </div>
        </form>
    </x-card>
</x-layout>