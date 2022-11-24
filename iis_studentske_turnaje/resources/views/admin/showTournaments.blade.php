<x-layout>
    <x-card class="p-10">
        <header>
            <h1
                class="text-3xl text-center font-bold my-6 uppercase"
            >
                Manage tournaments
            </h1>
        </header>
        <x-search :path="'/admin/tournaments'"/>
        <table class="w-full table-auto rounded-sm">
            <tbody>
                @unless ($tournaments->isEmpty())
                    @foreach ($tournaments as $tournament)
                        <tr class="border-gray-300">
                            <td
                                class="px-4 py-8 border-t border-b border-gray-300 text-lg"
                            >
                                <a href="{{url('/tournaments/' . $tournament->id)}}">
                                    {{$tournament->name}}
                                </a>
                            </td>
                            <td
                                class="px-4 py-8 border-t border-b border-gray-300 text-lg"
                            >
                                @if ($tournament->approved == 0)
                                    <p
                                    class="text-red-400 px-6 py-2 rounded-xl"
                                    >Not approved</p
                                    >   
                                @else
                                    <p
                                    class="text-green-400 px-6 py-2 rounded-xl"
                                    >Approved</p
                                    >
                                @endif
                                
                            </td>
                            <td
                                class="px-4 py-8 border-t border-b border-gray-300 text-lg"
                            >
                                <a
                                    href="{{url('/tournaments/' . $tournament->id . '/edit')}}"
                                    class="text-blue-400 px-6 py-2 rounded-xl"
                                    ><i
                                        class="fa-solid fa-pen-to-square"
                                    ></i>
                                    Edit</a
                                >
                            </td>
                            <td
                                class="px-4 py-8 border-t border-b border-gray-300 text-lg"
                            >
                                <form method="POST" action="/tournaments/{{$tournament->id}}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-500"><i class="fa-solid fa-trash"></i>Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                    @else
                    <tr class="border-gray-300">
                        <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                            <p class="text-center">No tournaments found</p>
                        </td>
                    </tr>

                @endunless
                
            </tbody>
        </table>
    </x-card>
</x-layout>