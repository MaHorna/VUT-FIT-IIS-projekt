@props(['tournament'])

<x-card>
    <div class="flex text-white">
        <img
            class="hidden w-48 mr-6 md:block"
            src="{{$tournament->logo ? asset('images/logos/' . $tournament->logo) : asset('/images/placeholder.png')}}"
            alt=""
        />
        <div>
            <h3 class="text-2xl text-yellowish font-bold">
                <a href="{{url('/tournaments', $tournament->id)}}">{{$tournament->name}}</a>
            </h3>
            <div class="text-xl font-bold mb-4">{{$tournament->game}}</div>
            <div class="text-0.5lg mb-4">
                <i class="fa-solid fa-clock-four"></i> {{$tournament->start_date}}
            </div>
            <div class="text-0.5xl mb-4">Status: {{$tournament->status}}</div>
            @if ($tournament->teams_allowed)
                <div class="text-0.5xl mb-4">Type: Team vs Team</div>
            @else
                <div class="text-0.5xl mb-4">Type: Player vs Player</div>
            @endif
            
        </div>
    </div>
</x-card>