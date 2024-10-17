@props(['movieData'])
<div class="flex flex-col mb-8">
    <div class="text-center justify-center">
        <!--  aiden idk what this is for but i had to add my code here so my code could work -->
            <a href="{{ route('movie-description', ['movie' => $movieData['id'], 'flag' => 'movie']) }}">
                <img src="https://image.tmdb.org/t/p/w500{{ $movieData['poster_path'] }}" class="rounded-md w-72 mx-auto mb-6 transform transition-transform duration-300 hover:scale-105" alt="{{ $movieData['title'] }} movie poster">
            </a>
            <div class="flex flex-col">
                <h3 class="text-white text-title font-sans mb-2 font-bold">{{ $movieData['title'] }}</h3>
                <p class="text-white text-sm text-opacity-50 mx-14">{{ Str::limit($movieData['overview'], 100, '...') }}</p>
            </div>
    </div>
    <div class="flex mx-auto mt-6">
        <p class="border border-blue rounded-full text-sm text-blue p-2 px-3 hover:cursor-pointer">Add to Watchlist</p>
        <div class="mr-6"></div>
        <p class="border border-aqua rounded-full text-sm text-aqua p-2 px-3 hover:cursor-pointer">Add to History</p>
    </div>
</div>