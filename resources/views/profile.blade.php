<x-layout>

    <div class="flex flex-col items-center justify-center">
        <h1 class="text-white"># of items watchlisted: {{ $numWatchlisted }}</h1>
        <h1 class="text-white"># of items watched: {{ $numWatched }}</h1>
        <h1 class="text-white"># of movies watched: {{ $numMovies }}</h1>
        <h1 class="text-white"># of tv watched: {{ $numShows }}</h1>
        <h1 class="text-white"># of movies watchlisted: {{ $numShowsWatchlisted }}</h1>
        <h1 class="text-white"># of tv watchlisted: {{ $numMoviesWatchlisted }}</h1>
    </div>

    <div class="text-white p-4 rounded-lg max-w-md mx-auto">
        <div class="flex justify-between mb-2">
            <h1 class="text-white text-sm">History</h1>
            <p class="text-white text-sm">Total Entries: {{ $totalContent }}</p>
        </div>
        <div class="flex w-full h-4 rounded relative">
            <div class="bg-blue h-full rounded-l" style="width: {{ $moviePercentage }}%;"></div>
            <div class="bg-aqua h-full rounded-r" style="width: {{ $showPercentage }}%;"></div>
        </div>
        <div class="flex justify-between mt-2 text-sm">
            <span>Movies: {{ $numMovies }}</span>
            <span>Shows: {{ $numShows }}</span>
        </div>
    </div>

    <div class="text-white p-4 rounded-lg max-w-md mx-auto">
    <h1 class="text-white mb-2">Watchlist</h1>
        <div class="flex w-full h-4 rounded relative">
            <div class="bg-blue h-full rounded-l" style="width: {{ $moviePercentageWatchlisted }}%;"></div>
            <div class="bg-aqua h-full rounded-r" style="width: {{ $showPercentageWatchlisted }}%;"></div>
        </div>
        <div class="flex justify-between mt-2 text-sm">
            <span>Movies: {{ $numMoviesWatchlisted }}</span>
            <span>Shows: {{ $numShowsWatchlisted }}</span>
        </div>
        <div class="flex justify-between mt-4">
            <span>Total Entries: {{ $totalContentWatchlisted }}</span>
        </div>
    </div>




</x-layout>