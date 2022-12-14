<x-layout>
    <h3 class="text-2xl relative left-5 text-white font-bold">Teams</h3>
    <form>
        <div class="relative border-2 border-gray-100 m-4 rounded-lg">
            <div class="absolute top-4 left-3">
                <i
                    class="fa fa-search text-gray-400 z-20 hover:text-gray-500"
                ></i>
            </div>
            <input
                type="text"
                name="search"
                id="search"
                class="h-14 w-full pl-10 pr-20 rounded-lg z-0 bg-black focus:shadow focus:outline-none"
                placeholder="Search..."
            />
            <div class="absolute top-2 right-2">
                <button
                    id="searchbtn"
                    class="h-10 w-20 text-white rounded-lg bg-yellowish hover:bg-grayish"
                >
                    Search
                </button>
            </div>
        </div>
    </form>
    
    <script>
        $("#searchbtn").click(function(e)
        {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            jQuery.ajax({
                url: "{{url('/teams')}}",
                method: 'GET',
                data: {
                    search: jQuery('#search').val(),
                },
                success: function(data){
                    $('#ajax-teams').html('');

                    $.each(data.teams, function(index, value){
                        $('#ajax-teams').append(value);
                    });
                }});
        });
    </script>
    <div id="ajax-teams" class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">        
        @unless (count($teams) == 0)
            
            @foreach ($teams as $team)
            <x-card>
                <div class="flex">
                    <img
                        class="hidden w-48 mr-6 md:block"
                        src="{{$team->logo ? asset('images/logos/' . $team->logo) : asset('/images/placeholder.png')}}"
                        alt=""
                    />

                    @php 
                        $total_games = $team->lost_games + $team->won_games;
                        $win_rate = 0;
                        if ($total_games !== 0) {
                            $win_rate = ($team->won_games * 100) / $total_games;
                            
                        }
                    @endphp
    
                    <div>
                        <h3 class="text-2xl font-bold text-yellowish">
                            <a href="{{url('/teams', $team->id)}}">{{$team->name}}</a>

                        </h3>
                        <div class="text-xl mb-4">Total games: {{$total_games}}</div>
                        <div class="text-0.5xl mb-4">Won games: {{$team->won_games}}</div>
                        <div class="text-0.5xl mb-4">Lost games: {{$team->lost_games}}</div>
                        <div class="text-0.5xl mb-4">Win rate: {{round($win_rate, 2);}}%</div>
                    </div>
                </div>
            </x-card>
            @endforeach

        @else
            <p>No teams found</p>
            
        @endunless
</x-layout>