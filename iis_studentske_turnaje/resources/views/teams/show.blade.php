<x-layout>
    <x-search :path="'/teams'"/>
        <a href="/" class="inline-block ml-4 mb-4"><i class="fa-solid fa-arrow-left"></i> Back</a>
        <div class="mx-4">
            <x-card class="p-10">
                <div
                    class="flex flex-col items-center justify-center text-center"
                >
                    <img
                        class="w-48 mr-6 mb-6"
                        src="{{$team->logo ? asset('images/logos/' . $team->logo) : asset('/images/placeholder.png')}}"
                        alt=""
                    />
    
                    <h3 class="text-2xl mb-2">{{$team->name}}</h3>
                    <div class="text-lg my-4">
                    </div>
                    <div class="border border-gray-200 w-full mb-6"></div>
                    <div>
                        <div class="text-lg space-y-6">
                            {{$team->description}}
                        </div>
                    </div>
                </div>
            </x-card>

            @if (Auth::user() && Auth::user()->id == $team->user_id)
                <x-card class="mt-4 p-2 flex space-x-6">
                    <a href="/teams/{{$team->id}}/edit">
                    <i class="fa-solid fa-pencil"></i>Edit
                    </a>

                    <form method="POST" action="/teams/{{$team->id}}">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-500"><i class="fa-solid fa-trash"></i>Delete</button>
                    </form>
                </x-card>
            @endif
        </div>
    </x-layout>