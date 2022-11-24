<x-layout>
    <a href="{{url('/')}}" class="inline-block text-black ml-4 mb-4"><i class="fa-solid fa-arrow-left"></i> Back</a>
    <div class="mx-4">
        <x-card class="p-10">
            <div
                class="flex flex-col items-center justify-center text-center"
            >
                <img
                    class="w-48 mr-6 mb-6"
                    src="{{asset('images/placeholder.png')}}"
                    alt=""
                />

                @php 
                $total_games = $user->lost_games + $user->won_games;
                $win_rate = 0;
                if ($total_games !== 0) {
                    $win_rate = ($user->won_games * 100) / $total_games;
                    
                }
                @endphp

                <h3 class="text-2xl mb-2">{{$user->name}}</h3>
                <div class="text-xl font-bold mb-4">Email: {{$user->email}}</div>
                <div class="text-xl font-bold mb-4">Total games played: {{$total_games}}</div>
                <div class="text-xl font-bold mb-4">Won games: {{$user->won_games}}</div>
                <div class="text-xl font-bold mb-4">Lost games: {{$user->lost_games}}</div>
                <div class="text-xl font-bold mb-4">Win rate: {{round($win_rate, 2);}}%</div>
            </div>
        </x-card>

        <x-card class="mt-4 p-2 flex space-x-6">
            <a href="{{url('/users/' . $user->id . '/edit')}}">
            <i class="fa-solid fa-pencil"></i>Edit
            </a>

            <form method="POST" action="/users/{{$user->id}}">
                @csrf
                @method('DELETE')
                <button class="text-red-500"><i class="fa-solid fa-trash"></i>Delete</button>
            </form>
        </x-card>
    </div>
</x-layout>