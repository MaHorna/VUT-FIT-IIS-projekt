<x-layout>
    <x-search :path="'/my_teams'"/>
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
        </div>
    </x-layout>