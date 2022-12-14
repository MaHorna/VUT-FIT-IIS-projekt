<x-layout>
    <h3 class="text-2xl relative left-5 text-white font-bold">Players</h3>
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
                url: "{{url('/users')}}",
                method: 'GET',
                data: {
                    search: jQuery('#search').val(),
                },
                success: function(data){
                    $('#ajax-users').html('');

                    $.each(data.users, function(index, value){
                        $('#ajax-users').append(value);
                    });
                }});
        });
    </script>
    <div id="ajax-users" class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">
        @unless (count($users) == 0)
            @foreach ($users as $user)
                <x-card>
                    <div class="flex text-white">
                        <img
                            class="hidden w-48 mr-6 md:block"
                            src="{{$user->logo ? asset('images/logos/' . $user->logo) : asset('/images/placeholder.png')}}"
                            alt=""
                        />
    
                        @php 
                            $total_games = $user->lost_games + $user->won_games;
                            $win_rate = 0;
                            if ($total_games !== 0) {
                                $win_rate = ($user->won_games * 100) / $total_games;
                                
                            }
                        @endphp
    
                        <div>
                            <h3 class="text-2xl font-bold text-yellowish">
                                <a href="{{url('/users', $user->id)}}">{{$user->name}}</a>
                            </h3>
                            <div class="text-xl mb-4">Total games: {{$total_games}}</div>
                            <div class="text-0.5xl mb-4">Won games: {{$user->won_games}}</div>
                            <div class="text-0.5xl mb-4">Lost games: {{$user->lost_games}}</div>
                            <div class="text-0.5xl mb-4">Win rate: {{round($win_rate, 2);}}%</div>
                        </div>
                    </div>
                </x-card>
            @endforeach
        @else
            <p>No Players found</p>
        @endunless
    </div>
</x-layout>