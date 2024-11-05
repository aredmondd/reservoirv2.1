<x-layout>



    <div class="flex justify-between mx-20 mt-12 mb-12">
        <div class="flex flex-col items-center">
            <img src="storage/{{ $user['profile_picture'] }}" alt="" class="w-64 rounded-full">
            <p class="mt-4 text-white text-title">{{ $user->username }} \ {{ $user->name }}</p>
        </div>
        <div class="flex space-x-4">
            <div class="bg-white bg-opacity-50 p-24 py-32 rounded-lg hover:cursor-pointer hover:bg-opacity-25 transition duration-300 ease-in-out"></div>
            <div class="bg-white bg-opacity-50 p-24 py-32 rounded-lg hover:cursor-pointer hover:bg-opacity-25 transition duration-300 ease-in-out"></div>
            <div class="bg-white bg-opacity-50 p-24 py-32 rounded-lg hover:cursor-pointer hover:bg-opacity-25 transition duration-300 ease-in-out"></div>
            <div class="bg-white bg-opacity-50 p-24 py-32 rounded-lg hover:cursor-pointer hover:bg-opacity-25 transition duration-300 ease-in-out"></div>
            <div class="bg-white bg-opacity-50 p-24 py-32 rounded-lg hover:cursor-pointer hover:bg-opacity-25 transition duration-300 ease-in-out"></div>
        </div>
    </div>

    <hr class='border-white border-opacity-25 mx-20'>

    <div class="mx-20">
        <div class="mt-12 mb-8 text-white rounded-lg max-w-md">
            <div class="flex justify-between mb-2">
                <h1 class="text-white text-sm">History</h1>
            </div>
            <div class="flex w-full h-4 rounded relative">
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
                <div class="bg-blue h-full rounded-l {{ $showPercentageWatchlisted == 0 ? 'rounded-r' : '' }}" style="width: {{ $moviePercentageWatchlisted }}%;"></div>
                <div class="bg-aqua h-full rounded-r {{ $moviePercentageWatchlisted == 0 ? 'rounded-l' : '' }}" style="width: {{ $showPercentageWatchlisted }}%;"></div>
            </div>
            <div class="flex justify-between mt-2 text-sm">
                <span>Movies: {{ $numMoviesWatchlisted }}</span>
                <span>Shows: {{ $numShowsWatchlisted }}</span>
            </div>
        </div>
    </div>

    <div class="mb-24"></div>




</x-layout>