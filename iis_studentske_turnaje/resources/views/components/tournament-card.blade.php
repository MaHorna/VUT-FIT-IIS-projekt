@props(['tournament'])

<x-card>
    <div class="flex">
        <img
            class="hidden w-48 mr-6 md:block"
            src="{{asset('images/placeholder.png')}}"
            alt=""
        />
        <div>
            <h3 class="text-2xl">
                <a href="/listings/{{$tournament->id}}">{{$tournament->name}}</a>
            </h3>
            <div class="text-xl font-bold mb-4">{{$tournament->game}}</div>
            <div class="text-lg mt-4">
                <i class="fa-solid fa-location-dot"></i> {{$listing->start_date}}
            </div>
        </div>
    </div>
</x-card>