<x-layout>
    <x-search :path="'/teams'"/>
    <h1>Teams</h1>
    <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">

        
        @unless (count($teams) == 0)
            
            @foreach ($teams as $team)
            <div class="flex">
                <img
                    class="hidden w-48 mr-6 md:block"
                    src="{{$team->logo ? asset('storage/' . $team->logo) : asset('/images/placeholder.png')}}"
                    alt=""
                />

                <div>
                    <h3 class="text-2xl font-bold">
                        <a href="{{url('/users', $team->id)}}">{{$team->name}}</a>
                    </h3>
                </div>
            </div>
            @endforeach

        @else
            <p>No teams found</p>
            
        @endunless
</x-layout>