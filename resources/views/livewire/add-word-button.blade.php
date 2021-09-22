<div>
    @if($alreadyAdded)
        <x-jet-button class="bg-red-900"><a href="#" wire:click.prevent="removeWord">Remove from vocabulary</a></x-jet-button>
    @else
        <x-jet-button class="bg-lime-900"><a href="#" wire:click.prevent="addWord">Add to my vocabulary</a></x-jet-button>
    @endif
</div>

