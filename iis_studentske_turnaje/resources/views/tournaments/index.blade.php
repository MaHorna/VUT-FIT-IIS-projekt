{{-- * FILENAME : index.blade.php
*
* DESCRIPTION : Show all Tournaments
*
* AUTHOR : Dávid Kán - xkanda01--}}

<x-layout>
    <h3 class="text-2xl relative left-5 text-white font-bold">Tournaments</h3>
    
    {{-- Search bar --}}
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
    
    {{-- Ajax script for search bar --}}
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
                url: "{{url('/tournaments')}}",
                method: 'GET',
                data: {
                    search: jQuery('#search').val(),
                },
                success: function(data){
                    $('#ajax-tournaments').html('');

                    $.each(data.tournaments, function(index, value){
                        $('#ajax-tournaments').append(value);
                    });
                }});
        });
    </script>

    {{-- Tournaments cards --}}
    <div id="ajax-tournaments" class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">
        @unless (count($tournaments) == 0)
            @foreach ($tournaments as $tournament)
                <x-tournament-card :tournament="$tournament" />
            @endforeach
        @else
            <p>No Tournaments found</p>
        @endunless
    </div>
</x-layout>