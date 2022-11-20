{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{config('app.name', 'IIS projekt studentske turnaje')}}</title>
    </head>
    <body>
	<!-- <p>login, register and skip login page</p>
	<p>login - username text field, password textfield, button to submit</p>
	<p>register - username text field, password textfield, repeat password textfield, email textfield button to submit</p>
	<p>skip login - guest user , button linking nonuser view</p> -->
    </body>
</html> --}}

<x-layout>
    <!--<p>login, register and skip login page</p> -->

    <!-- <p>login - username text field, password textfield, button to submit</p> -->
	<section>
        <main class="p-10 rounded max-w-lg mx-auto mt-24">
            <h1 class="text-2xl font-bold uppercase mb-1">Log In</h1>

            <form method="post" action="/login">
                @csrf

            <div class="mb-6">
                <label for="email" class="inline-block text-lg mb-2"
                    >Email</label>

                <input
                    type="email"
                    class="border border-gray-200 rounded p-2 w-full"
                    name="email"
                    value={{old('email')}}/>

                 @error('email')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label
                    for="password"
                    class="inline-block text-lg mb-2"
                >
                    Password
                </label>
                <input
                    type="password"
                    class="border border-gray-200 rounded p-2 w-full"
                    name="password"
                    value={{old('password')}}/>

                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>


                <div class="flex items-center justify-center mb-6">
                    <button type="submit"
                        class="px-4 py-2 mr-4 text-white bg-gray-700 rounded hover:bg-gray-800">
                        Log In
                    </button>
                </div>

            </form>

        </main>
    </section>

    
	<!--<p>register - username text field, password textfield, repeat password textfield, email textfield button to submit</p>
	<p>skip login - guest user , button linking nonuser view</p>-->

</x-layout>