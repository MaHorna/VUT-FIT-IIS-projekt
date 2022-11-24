@props(['tournament'])

<x-card>
    <div class="flex">
        <img
            class="hidden w-48 mr-6 md:block"
            src="{{$tournament->logo ? asset('storage/' . $tournament->logo) : asset('/images/placeholder.png')}}"
            alt=""
        />
        <div>
            <h3 class="text-2xl">
                <a href="{{url('/tournaments', $tournament->id)}}">{{$tournament->name}}</a>
            </h3>
            <div class="text-xl font-bold mb-4">{{$tournament->game}}</div>
            <div class="text-lg mt-4">
                <i class="fa-solid fa-clock-four"></i> {{$tournament->start_date}}
            </div>
        </div>
    </div>
</x-card>