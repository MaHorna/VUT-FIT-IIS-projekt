<x-layout>
    <p>login, register and skip login page</p>
	<p>login - username text field, password textfield, button to submit</p>
	<p>register - username text field, password textfield, repeat password textfield, email textfield button to submit</p>
	<p>skip login - guest user , button linking nonuser view</p>

    @include('partials._search')
    <h1>Tournaments</h1>
    <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">

        
        @unless (count($tournaments) == 0)
            
            @foreach ($tournaments as $tournament)
                <x-tournament-card :tournament="$tournament" />
            @endforeach

        @else
            <p>No Tournaments found</p>
            
        @endunless
    </div>
    
        <div class="mt-6 p-4">
            {{$users->links()}}
        </div>
    </div>

</x-layout>