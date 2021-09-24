<div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
    <div class="flex flex-col items-center mt-6 mb-6 w-full">
        @foreach($words as $word)
            <p>{{$word->name}}</p>
            @if($word->result)
                &#9989;
            @else
                &#9989;
            @endif
        @endforeach
    </div>
</div>
