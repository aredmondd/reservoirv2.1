@props(['numMovies', 'numShows', 'moviePercentage', 'showPercentage'])

<div class="mb-8 text-white rounded-lg max-w-md">
    <div class="flex justify-between mb-2">
        <h1 class="text-white text-sm">History</h1>
    </div>
    <div class="flex w-full h-4 rounded relative">
        @if($numMovies + $numShows == 0)
            <div class="bg-white bg-opacity-50 h-full rounded" style="width: 100%;"></div>
        @endif
        <div class="bg-blue h-full rounded-l {{ $showPercentage == 0 ? 'rounded-r' : '' }}" style="width: {{ $moviePercentage }}%;"></div>
        <div class="bg-aqua h-full rounded-r {{ $moviePercentage == 0 ? 'rounded-l' : '' }}" style="width: {{ $showPercentage }}%;"></div>
    </div>
    <div class="flex justify-between mt-2 text-sm">
        <span>Movies: {{ $numMovies }}</span>
        <span>Shows: {{ $numShows }}</span>
    </div>
</div>