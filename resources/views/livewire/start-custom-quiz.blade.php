<div>
    @if(count($words) >= 5)
        <x-jet-button wire:click="sendWords" class="ml-6">Start a quiz</x-jet-button>
    @endif
</div>
