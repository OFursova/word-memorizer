<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Statistics') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
               <p>Your success rate is: {{$successRate}}%</p>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-row justify-around">
                <x-jet-button class="bg-houseColor">
                    <a href="#">{{ __('Show random quiz results') }}</a>
                </x-jet-button>

                <x-jet-button class="bg-houseColor">
                    <a href="#">{{ __('Show custom quiz results') }}</a>
                </x-jet-button>

                <x-jet-button class="bg-houseColor">
                    <a href="#">{{ __('Show test results') }}</a>
                </x-jet-button>
            </div>
        </div>
    </div>


</x-app-layout>
