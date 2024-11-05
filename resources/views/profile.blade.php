<x-layout>



    <div class="flex justify-between mx-20 m-12">
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

    <div class="mx-20 mb-8 text-white rounded-lg max-w-md">
        <div class="flex justify-between mb-2">
            <h1 class="text-white text-sm">History</h1>
            <p class="text-white text-sm">Total Entries: {{ $totalContent }}</p>
        </div>
        <div class="flex w-full h-4 rounded relative">
            <div class="bg-white bg-opacity-50 h-full rounded-lg" style="width: 100%"></div>
            <div class="bg-blue h-full rounded-l" style="width: {{ $moviePercentage }}%;"></div>
            <div class="bg-aqua h-full rounded-r" style="width: {{ $showPercentage }}%;"></div>
        </div>
        <div class="flex justify-between mt-2 text-sm">
            <span>Movies: {{ $numMovies }}</span>
            <span>Shows: {{ $numShows }}</span>
        </div>
    </div>

    <div class="mx-20 text-white rounded-lg max-w-md">
        <div class="flex justify-between mb-2">
            <h1 class="text-white text-sm">History</h1>
            <p class="text-white text-sm">Total Entries: {{ $totalContentWatchlisted }}</p>
        </div>
        <div class="flex w-full h-4 rounded relative">
            <div class="bg-white bg-opacity-50 h-full rounded-lg" style="width: 100%"></div>
            <div class="bg-blue h-full rounded-l" style="width: {{ $moviePercentageWatchlisted }}%;"></div>
            <div class="bg-aqua h-full rounded-r" style="width: {{ $showPercentageWatchlisted }}%;"></div>
        </div>
        <div class="flex justify-between mt-2 text-sm">
            <span>Movies: {{ $numMoviesWatchlisted }}</span>
            <span>Shows: {{ $numShowsWatchlisted }}</span>
        </div>
    </div>

    <div class="mb-24"></div>


</x-layout>