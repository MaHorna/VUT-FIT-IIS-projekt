@props(['contest'])

<x-card>
    <div class="flex text-white">
        <div>
            <h3 class="text-2xl text-yellowish font-bold">
                <a href="{{url('/tournaments/' . $contest->tournament_id)}}">{{$contest->name}}</a>
            </h3>
            <div class="text-0.5lg mb-4">
                <i class="fa-solid fa-clock-four"></i> {{$contest->date}}
            </div> 
            <div class="text-0.5lg mb-4">
                <b>Round:</b> {{$contest->round}}
            </div>
            <div class="text-0.5lg mb-4">
                <b>Score1:</b> {{$contest->score1}}
            </div>
             
            <div class="text-0.5lg mb-4">
                <b>Score2:</b> {{$contest->score2}}
            </div>      
        </div>
    </div>
</x-card>