<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Words') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-jet-banner :message="session('message')"></x-jet-banner>

            <div class="mb-4 flex items-center justify-between">
                <x-jet-button class="my-4 mr-4 bg-houseColor"><a href="{{ route('words.create') }}">{{ __('Add new word') }}</a>
                </x-jet-button>
                <div class="inline-flex items-center">
                <form action="" method="GET">
                    <x-jet-input type="text" name="word" placeholder="Word"
                                 value="{{ request('word') }}"></x-jet-input>
                    <x-select name="category">
                        <option value="">Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                    @if(request('category') == $category->id) selected @endif>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </x-select>
                    <x-select name="grammarClass">
                        <option value="">Grammar Class</option>
                        @foreach($grammarClasses as $grammarClass)
                            <option value="{{ $grammarClass->id }}"
                                    @if(request('grammarClass') == $grammarClass->id) selected @endif>
                                {{ $grammarClass->name }}
                            </option>
                        @endforeach
                    </x-select>
                    <x-jet-button class="ml-4">{{ __('Search') }}</x-jet-button>
                </form>
                <x-jet-button class="my-4 ml-2 bg-gray-400"><a href="{{ route('words.index') }}">{{ __('Clear') }}</a>
                </x-jet-button>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
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
                        <th class="relative px-6 py-3" colspan="2">
                            @livewire('added-words-banner')
                        </th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($words as $word)
                        <tr>
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
                                @if($word->added_by != auth()->id())
                                    @livewire('add-word-button', ['wordId' => $word->id])
                                @endif
                            </td>
                            <td class="pr-4"></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="m-4 px-4 py-2">
                    {{ $words->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
