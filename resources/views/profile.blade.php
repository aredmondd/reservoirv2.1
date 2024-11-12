<x-layout>
    <div class="grid grid-cols-3 gap-12 mx-20 mt-12 mb-12">
        <div class="flex flex-col items-center">
            <img src="storage/{{ $user['profile_picture'] }}" alt="" class="w-56 rounded-full">
            <p class="mt-8 text-white text-title">{{ $user->username }} \ {{ $user->name }}</p>
        </div>
        <div>
            <div class="mt-12 mb-8 text-white rounded-lg max-w-md">
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
            <div class="text-white rounded-lg max-w-md">
                <div class="flex justify-between mb-2">
                    <h1 class="text-white text-sm">Watchlist</h1>
                </div>
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
        </div>
        <div class="mt-12 flex flex-col flex-auto items-center">
            <p class="text-white">Average Rating</p>
            <div class="flex">
                <span class="text-title text-white text-opacity-25 material-symbols-outlined">star</span>
                <span class="text-title text-white text-opacity-25 material-symbols-outlined">star</span>
                <span class="text-title text-white text-opacity-25 material-symbols-outlined">star</span>
                <span class="text-title text-white text-opacity-25 material-symbols-outlined">star</span>
                <span class="text-title text-white text-opacity-25 material-symbols-outlined">star</span>
            </div>
        </div>
    </div>

    <hr class='border-white border-opacity-25 mx-20'>

    <div class="flex justify-between mx-20 mt-12">
        <div class="w-64 border border-2 border-white bg-white bg-opacity-0 border-opacity-50 text-center rounded-lg hover:cursor-pointer hover:bg-opacity-25 transition duration-300 ease-in-out"><img src="https://image.tmdb.org/t/p/w500/cMD9Ygz11zjJzAovURpO75Qg7rT.jpg" alt="" class="rounded-md"></div>
        <div class="w-64 border border-2 border-white bg-white bg-opacity-0 border-opacity-50 text-center rounded-lg hover:cursor-pointer hover:bg-opacity-25 transition duration-300 ease-in-out">add your <br> fav content <br>here</div>
        <div class="w-64 border border-2 border-white bg-white bg-opacity-0 border-opacity-50 text-center rounded-lg hover:cursor-pointer hover:bg-opacity-25 transition duration-300 ease-in-out">add your <br> fav content <br>here</div>
        <div class="w-64 border border-2 border-white bg-white bg-opacity-0 border-opacity-50 text-center rounded-lg hover:cursor-pointer hover:bg-opacity-25 transition duration-300 ease-in-out"><img src="https://image.tmdb.org/t/p/w500/cMD9Ygz11zjJzAovURpO75Qg7rT.jpg" alt="" class="rounded-md"></div>
        <div class="w-64 border border-2 border-white bg-white bg-opacity-0 border-opacity-50 text-center rounded-lg hover:cursor-pointer hover:bg-opacity-25 transition duration-300 ease-in-out"><img src="https://image.tmdb.org/t/p/w500/cMD9Ygz11zjJzAovURpO75Qg7rT.jpg" alt="" class="rounded-md"></div>
    </div>

    <div class="mb-24"></div>




</x-layout>