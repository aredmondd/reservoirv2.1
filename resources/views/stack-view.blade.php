<x-layout>
    <div class="flex justify-between items-end mx-40">
        <div class="flex flex-col items-start">
            <h1 class="text-blue text-mega font-serif mt-12 text-center max-w-5xl">{{ $stack->name }}</h1>
            <p class="text-white text-center text-body">{{ $stack->description }}</p>
        </div>

        <div class="flex flex-col space-y-6 mt-6 items-end">
            <button><img src="images/edit.png" alt="" class="w-8"></button>
            <form action="/stack?id={{ request('id') }}" method="POST" class="h-8">
                @csrf
                @method('DELETE')
                <button type="submit"><img src="images/delete.png" alt="Delete" class="w-8"></button>
            </form>
        </div>

    </div>

    @if ($content == null)
        <div class="text-white text-center mt-24">Search for some movies to add to your stack in "Fill your Reservoir"</div>
    @else
        <div class="flex justify-around my-24">
            @foreach($content as $item)
                <x-stack-movie-poster :item='$item' />
            @endforeach
        </div>
    @endif
</x-layout>