<div class="mt-4 flex flex-col">
    <x-jet-label for="meanings" value="{{ __('Alternative meanings') }}"/>
    @if(old('meanings'))
        @foreach(old('meanings') as $index => $meaning)
            <x-jet-input id="meanings" class="block mt-1 w-full" type="text" name="meanings[{{$index}}]"
                         value="{{$meaning}}"
                         required autofocus autocomplete="meanings"/>
        @endforeach
    @else
        @foreach($meanings as $index => $meaning)
            <x-jet-input id="meanings" class="block mt-1 w-full" type="text" name="meanings[{{$index}}]"
                         :value="$meaning" required autofocus autocomplete="meanings"/>
        @endforeach
    @endif
    <x-jet-button class="mt-2 self-end" wire:click.prevent="addMeaning">+ Add another meaning</x-jet-button>
</div>
