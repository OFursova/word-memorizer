<a href="#" wire:click="addWordInList">
    <x-jet-input type="checkbox" name="choose[]" :checked="request('choose')" value="{{$word->id}}"></x-jet-input>
</a>
