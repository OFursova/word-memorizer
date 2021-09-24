<div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
    @if($quizStarted)
        <div class="flex flex-col items-center mt-6 mb-6 w-full">
            <h2 class="font-semibold text-2xl text-gray-600 leading-tight">
                {{$set[$round]['word']}}
            </h2>
            <div class="mt-2 mb-2 flex flex-wrap flex-row justify-around w-3/4">
                @foreach($set[$round]['vars'] as $index => $variant)
                    <div @if($result ?? false) class="bg-green-700"
                         @endif class="my-2 mx-4 flex justify-center border-2 border-gray-300 hover:bg-indigo-400 hover:border-indigo-300 hover:ring hover:ring-indigo-200 hover:ring-opacity-50 rounded-md shadow-sm w-2/5">
                        <button class="mx-auto mb-2 mt-2" wire:click="chooseWord('{{$variant}}')">{{$variant}}</button>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <div class="flex flex-col items-center mt-6 mb-6 w-full">
            @if($lastResults==$maxRounds)
                <h3 class="text-green-700 text-4xl"> {{ __('Congratulations!') }}</h3>
            @else
                <h2 class="font-semibold text-2xl text-gray-600 leading-tight mb-4">
                    {{ __('Welcome to the Quiz!') }}
                </h2>
            @endif
            <div class="mt-2 mb-6 flex flex-col items-center">
                <h2 class="my-2 font-semibold text-2xl text-gray-600 leading-tight">{{ __('Your recent results:') }}</h2>
                <span @if($lastResults==$maxRounds) class="text-green-700 text-5xl" @endif class="text-5xl">
                    {{$lastResults}}/{{$maxRounds}}
                </span>
            </div>
{{--                <a href="#" wire:click="$toggle('showDetails')" class="ml-4 self-start underline text-gray-500">{{ __('Show details:') }}</a>--}}
{{--                @if($showDetails)--}}
{{--                    <div>--}}
{{--                        @foreach($details as $word)--}}
{{--                            <span>{{$word['word']}}</span>--}}
{{--                            @if($word['result'] == 1)--}}
{{--                                <span>&#9989;</span>--}}
{{--                            @else--}}
{{--                                <span>&#9989;</span>--}}
{{--                            @endif--}}
{{--                        @endforeach--}}
{{--                    </div>--}}
{{--                @endif--}}
            <x-jet-button class="bg-houseColor mx-auto">
                <a href="#" wire:click.prevent="startQuiz">{{ __('Start') }}</a>
            </x-jet-button>
        </div>
    @endif
</div>
