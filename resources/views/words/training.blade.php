<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Word training') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-row justify-around">
                <x-jet-button class="bg-green-700"><a href="{{ route('training.index') }}">Random quiz</a>
                </x-jet-button>

                <x-jet-button class="bg-indigo-700"><a href="{{ route('training.index', ['custom' => true, 'quiz' => 3]) }}">Custom
                        quiz</a></x-jet-button>

                <x-jet-button class="bg-houseColor"><a href="{{ route('seed-variants') }}">Seed variants</a>
                </x-jet-button>
            </div>
        </div>
    </div>

    {{--    <x-slot name="header">--}}
    {{--        <h2 class="font-semibold text-xl text-gray-800 leading-tight">--}}
    {{--            {{ __('Welcome to the Quiz!') }}--}}
    {{--        </h2>--}}
    {{--    </x-slot>--}}


    @if(request('custom') == 1)
        <div class="py-12">
            <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
                @livewire('custom-quiz', ['quizId' => request('quiz')])
            </div>
        </div>
    @else
        <div class="py-12">
            <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
                @livewire('random-quiz')
            </div>
        </div>
    @endif
</x-app-layout>
