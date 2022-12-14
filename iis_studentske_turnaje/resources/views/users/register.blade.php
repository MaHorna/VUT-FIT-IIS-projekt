{{-- * FILENAME : register.blade.php
*
* DESCRIPTION : Register user
*
* AUTHOR: Dávid Kán - xkanda01  --}}

<x-layout>
    <x-card class="p-10 rounded max-w-lg mx-auto mt-24">
        <h2 class="text-2xl font-bold uppercase mb-1">
            Register
        </h2>
        <p class="mb-4">Create an account to post gigs</p>
        </header>

        <form method="POST" action="{{url('/register')}}">
            @csrf

            {{-- Name --}}
            <div class="mb-6">
                <label for="name" class="inline-block text-lg mb-2">
                    Name
                </label>
                <input
                    type="text"
                    class="border border-gray-200 rounded p-2 w-full bg-grayish"
                    name="name"
                    value="{{old('name')}}"/>

                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            {{-- Email --}}
            <div class="mb-6">
                <label for="email" class="inline-block text-lg mb-2">Email</label>
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

            {{-- Confirm Password --}}
            <div class="mb-6">
                <label
                    for="password2"
                    class="inline-block text-lg mb-2">
                    Confirm Password
                </label>
                <input
                    type="password"
                    class="border border-gray-200 rounded p-2 w-full bg-grayish"
                    name="password_confirmation"
                    value="{{old('password_confirmation')}}"/>
                
                @error('password_confirmation')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            {{-- Submit --}}
            <div class="mb-6">
                <button type="submit" class="bg-yellowish rounded py-2 px-4 hover:bg-grayish">Sign Up</button>
            </div>

            <div class="mt-8">
                <p>
                    Already have an account?
                    <a href="{{url('/login')}}" class="text-yellowish">Login</a>
                </p>
            </div>
        </form>
    </x-card>
</x-layout>