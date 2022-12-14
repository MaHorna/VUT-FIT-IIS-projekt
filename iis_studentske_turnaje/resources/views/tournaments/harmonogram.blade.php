{{-- * FILENAME : index.blade.php
*
* DESCRIPTION : Show all upcoming matches ordered ba tyme
*
* AUTHOR : Dávid Kán - xkanda01 --}}

<x-layout>

    {{-- Player matches --}}
    <h3 class="text-2xl relative left-9 text-white font-bold mb-2">My ongoing matches as player</h3>
    @if (count($my_matches) != 0)  
        <div class="relative left-5" style="max-height:80vh;width:98%;overflow:auto;">
            <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 mt-2 mb-2 md:space-y-0 mx-4">
                @foreach ($my_matches as $my_match)
                    @if ($my_match->status == 'ongoing')
                        <x-contest-card :contest="$my_match" />
                    @endif
                @endforeach
            </div>
        </div>
    @endif

    {{-- Team matches --}}
    <h3 class="text-2xl relative left-9 text-white font-bold mb-2">My ongoing matches as team</h3>
    @if (count($my_team_matches) != 0)    
        <div class="relative left-5" style="max-height:80vh;width:98%;overflow:auto;">
            <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 mt-2 mb-2 md:space-y-0 mx-4">
                @foreach ($my_team_matches as $my_team_match)
                    @if ($my_team_match->status == 'ongoing')
                        <x-contest-card :contest="$my_team_match" />
                    @endif
                @endforeach
            </div>
        </div>
    @endif
</x-layout>