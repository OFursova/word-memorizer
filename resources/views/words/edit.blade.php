<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit word') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <x-jet-validation-errors class="mb-4"/>
            <form method="POST" action="{{ route('words.update', $word) }}">
                @csrf
                @method('PUT')
                <div>
                    <x-jet-label for="word" value="{{ __('Word') }}"/>
                    <x-jet-input id="word" class="block mt-1 w-full" type="text" name="name" :value="$word->name"
                                 required autofocus autocomplete="word"/>
                </div>

                <div class="mt-4">
                    <x-jet-label for="translation" value="{{ __('Translation') }}"/>
                    <x-jet-input id="translation" class="block mt-1 w-full" type="text" name="translation"
                                 :value="$word->translation"
                                 required autofocus autocomplete="translation"/>
                </div>

                @livewire('alternative-meanings', ['currentWord' => $word])

                <div class="mt-4">
                    <x-jet-label for="grammar_class_id" value="{{ __('Grammar Class') }}"/>
                    <x-select name="grammar_class_id" id="grammar_class_id" class="w-full">
                        <option value=""></option>
                        @foreach($grammarClasses as $class)
                            <option value="{{ $class->id }}"
                                    @if(request('grammar_class_id') == $class->id
                                        || $word->grammar_class_id == $class->id ) selected @endif>
                                {{ $class->name }} ({{$class->description}})
                            </option>
                        @endforeach
                    </x-select>
                </div>

                <div class="mt-4">
                    <x-jet-label for="categories" value="{{ __('Categories') }}"/>
                    <div class="max-w-xl flex flex-row flex-wrap justify-between pl-6">
                        @foreach($categories as $category)
                            <span class="mr-4">
                            <x-jet-input type="checkbox" name="categories[]" value="{{ $category->id }}"
                                         :checked="in_array($category->id, $wordCategories)"></x-jet-input>
                            <span class="font-medium text-md text-gray-700">{{ $category->name }}</span>
                            </span>
                        @endforeach
                    </div>
                </div>

                <div class="flex items-center mt-6">
                    <x-jet-button class="bg-houseColor">
                        {{ __('Save') }}
                    </x-jet-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
