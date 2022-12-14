{{-- * FILENAME : match-card.blade.php
*
* DESCRIPTION : Match card
*
* AUTHOR : Matej Horňanský - xhorna17 --}}

@props(['contest', 'tournament'])
@php
    $data = App\Http\Controllers\MatchController::show_data($contest, $tournament);
@endphp

<div style="width:300px;">
    <div onclick="openForm(event, {{$contest->id}})" style="margin: 15px 0; overflow: hidden; border-radius: 5px;">
        <div style="color: #fff; padding: 10px 8px; background-color: #c69749;border-bottom: 1px solid #282a3a;">
            <div class="flex">
                <div class="flex-1 w-10">
                    <a id="match_card_name1_{{$contest->id}}" onclick="event.stopPropagation()" href="{{url($data['link1'])}}">{{$data['name1']}}</a>
                </div>
                <div class="flex-none">
                    <span id="match_card_score1_{{$contest->id}}" style="text-align: right;">{{$data['score1']}}</span>
                </div>
            </div>
        </div>
        <div style="color: #fff; padding: 10px 8px; background-color: #c69749;">
            <div class="flex">
                <div class="flex-1 w-10">
                    <a id="match_card_name2_{{$contest->id}}" onclick="event.stopPropagation()" href="{{url($data['link2'])}}">{{$data['name2']}}</a>
                </div>
                <div class="flex-none">
                    <span id="match_card_score2_{{$contest->id}}" style="text-align: right;">{{$data['score2']}}</span>
                </div>
            </div>
        </div>
    </div>
</div>
