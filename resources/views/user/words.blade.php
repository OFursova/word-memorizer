<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Words') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <th></th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Word
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Translation
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Category
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Tries total
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Success rate
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Freshness
                        </th>
                        <th class="relative px-6 py-3" colspan="2"></th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($words as $word)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @livewire('pick-words-for-quiz', ['word' => $word])
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $word->name }}</td>
                            <td class="px-6 py-4">{{ $word->translation }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @foreach($word->categories as $category)
                                    {{ $category->name }}
                                @endforeach
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">{{$word->tries_count}}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{$word->successRate($word->id)}}%</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($word->created_at > now()->subDay()->startOfDay())
                                    &#127823;
                                @else
                                    &#127822;
                            @endif
                            <td class="px-6 py-4 whitespace-nowrap">
                                @livewire('edit-word-button', ['wordId' => $word->id])

                                @can('update', $word)
                                    <x-jet-button class="bg-houseColor"><a
                                            href="{{ route('words.edit', $word) }}">Edit</a>
                                    </x-jet-button>
                                @endcan
                            </td>
                            <td class="pr-4">
                                @can('delete', $word)
                                    <form action="{{ route('words.destroy', $word) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <x-jet-danger-button type="submit">
                                            Delete
                                        </x-jet-danger-button>
                                    </form>
                                @else
                                    <form action="{{ route('user.words.destroy', $word) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <x-jet-danger-button type="submit">
                                        Remove
                                    </x-jet-danger-button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                @livewire('start-custom-quiz')
                <div class="m-4 px-4 py-2">
                    {{ $words->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
