@props(['numMoviesWatchlisted', 'numShowsWatchlisted', 'moviePercentageWatchlisted', 'showPercentageWatchlisted'])

<div class="text-white rounded-lg w-full">
    <h1 class="text-white text-center text-sm my-2">Watchlist</h1>
    <div class="flex w-full h-4 rounded relative">
        @if($numMoviesWatchlisted + $numShowsWatchlisted == 0)
            <div class="bg-white bg-opacity-50 h-full rounded" style="width: 100%;"></div>
        @endif
        <div class="bg-blue h-full rounded-l {{ $showPercentageWatchlisted == 0 ? 'rounded-r' : '' }}" style="width: {{ $moviePercentageWatchlisted }}%;"></div>
        <div class="bg-aqua h-full rounded-r {{ $moviePercentageWatchlisted == 0 ? 'rounded-l' : '' }}" style="width: {{ $showPercentageWatchlisted }}%;"></div>
    </div>
    <div class="flex justify-between mt-2 text-sm">
        <span>Movies: {{ $numMoviesWatchlisted }}</span>
        <span>Shows: {{ $numShowsWatchlisted }}</span>
    </div>
</div>