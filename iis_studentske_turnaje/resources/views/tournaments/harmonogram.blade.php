<x-layout>
    @if (count($my_hosted_tournaments) != 0)
        <h3 class="text-2xl relative left-9 text-white font-bold mb-2">My tournaments as host</h3>
        <div class="relative left-5" style="max-height:80vh;width:98%;overflow:auto;">
            <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 mt-2 mb-2 md:space-y-0 mx-4">
                @foreach ($my_hosted_tournaments as $my_hosted_tournament)
                    <x-tournament-card :tournament="$my_hosted_tournament" />
                @endforeach
            </div>
        </div>
    @endif
    @if (count($my_player_tournaments) != 0)
    <h3 class="text-2xl relative left-9 text-white font-bold mb-2">My tournaments as player</h3>
        <div class="relative left-5" style="max-height:80vh;width:98%;overflow:auto;">
            <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 mt-2 mb-2 md:space-y-0 mx-4">
                @foreach ($my_player_tournaments as $my_player_tournament)
                    <x-tournament-card :tournament="$my_player_tournament" />
                @endforeach
            </div>
        </div>
    @endif
    @if (count($my_team_tournaments) != 0)
    <h3 class="text-2xl relative left-9 text-white font-bold mb-2">My tournaments as team</h3>
        <div class="relative left-5" style="max-height:80vh;width:98%;overflow:auto;">
            <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 mt-2 mb-2 md:space-y-0 mx-4">
                @foreach ($my_team_tournaments as $my_team_tournament)
                    <x-tournament-card :tournament="$my_team_tournament" />
                @endforeach
            </div>
        </div>
    @endif
    @if (count($my_matches1) != 0 || count($my_matches2) != 0)
        <h3 class="text-2xl relative left-9 text-white font-bold mb-2">My matches as player</h3>
        <div class="relative left-5" style="max-height:80vh;width:98%;overflow:auto;">
            <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 mt-2 mb-2 md:space-y-0 mx-4">
                @foreach ($my_matches1 as $my_match1)
                    <x-contest-card :contest="$my_match1" />
                @endforeach
            </div>
            <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 mt-2 mb-2 md:space-y-0 mx-4">
                @foreach ($my_matches2 as $my_match2)
                    <x-contest-card :contest="$my_match2" />
                @endforeach
            </div>
        </div>
    @endif
    @if (count($my_matches) != 0)
        <h3 class="text-2xl relative left-9 text-white font-bold mb-2">My matches as player</h3>
        <div class="relative left-5" style="max-height:80vh;width:98%;overflow:auto;">
            <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 mt-2 mb-2 md:space-y-0 mx-4">
                @foreach ($my_matches as $my_match)
                    <x-contest-card :contest="$my_match" />
                @endforeach
            </div>
        </div>
    @endif
    @if (count($my_team_matches1) != 0 || count($my_team_matches2) != 0)
        <h3 class="text-2xl relative left-9 text-white font-bold mb-2">My matches as player</h3>
        <div class="relative left-5" style="max-height:80vh;width:98%;overflow:auto;">
            <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 mt-2 mb-2 md:space-y-0 mx-4">
                @foreach ($my_team_matches1 as $my_team_match1)
                    <x-contest-card :contest="$my_team_match1" />
                @endforeach
            </div>
            <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 mt-2 mb-2 md:space-y-0 mx-4">
                @foreach ($my_team_matches2 as $my_team_match2)
                    <x-contest-card :contest="$my_team_match2" />
                @endforeach
            </div>
        </div>
    @endif
</x-layout>