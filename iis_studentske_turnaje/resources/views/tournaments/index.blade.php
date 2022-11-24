<x-layout>
    <x-search :path="'/tournaments'"/>
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
</x-layout>