<x-layout>
    <x-search :path="'/tournaments'"/>
        <a href="{{url('/')}}" class="inline-block ml-4 mb-4"><i class="fa-solid fa-arrow-left"></i> Back</a>
        <div class="mx-4">
            <x-card class="p-10">
                <div
                    class="flex flex-col items-center justify-center text-center"
                >
                    <img
                        class="w-48 mr-6 mb-6"
                        src="{{$tournament->logo ? asset('images/logos/' . $tournament->logo) : asset('/images/placeholder.png')}}"
                        alt=""
                    />
    
                    <h3 class="text-2xl mb-2">{{$tournament->name}}</h3>
                    <div class="text-xl font-bold mb-4">{{$tournament->game}}</div>
                    <div class="text-lg my-4">
                        <i class="fa-solid fa-location-dot"></i> {{$tournament->start_date}}
                    </div>
                    <div class="border border-gray-200 w-full mb-6"></div>
                    <div>

                        <div class="text-lg space-y-6">
                            {{$tournament->description}}
    
                            {{-- <a
                                href="mailto:{{$listing->email}}"
                                class="block bg-laravel text-white mt-6 py-2 rounded-xl hover:opacity-80"
                                ><i class="fa-solid fa-envelope"></i>
                                Contact Employer</a
                            >
    
                            <a
                                href="{{$listing->website}}"
                                target="_blank"
                                class="block bg-black text-white py-2 rounded-xl hover:opacity-80"
                                ><i class="fa-solid fa-globe"></i> Visit
                                Website</a
                            > --}}
                        </div>
                    </div>
                </div>
            </x-card>

            @if (Auth::user() && Auth::user()->id == $tournament->user_id)
            
                <x-card class="mt-4 p-2 flex space-x-6">
                    <a href="{{url('/tournaments/' .$tournament->id. '/edit')}}">
                    <i class="fa-solid fa-pencil"></i>Edit
                    </a>

                    <form method="POST" action="{{url('/tournaments/' . $tournament->id)}}">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-500"><i class="fa-solid fa-trash"></i>Delete</button>
                    </form>
                </x-card>
            @endif
            
        </div>
    </x-layout>