@props(['movieData'])
<div class="flex flex-col mb-8">
    <div class="text-center justify-center">
            <a href="{{ route('movie-description', ['movie' => $movieData['id'], 'flag' => 'movie']) }}">
                <img src="https://image.tmdb.org/t/p/w500{{ $movieData['poster_path'] }}" class="rounded-md w-72 mx-auto mb-6 transform transition-transform duration-300 hover:scale-105" alt="{{ $movieData['title'] }} movie poster">
            </a>
            <div class="flex flex-col">
                <h3 class="text-white text-title font-sans mb-2 font-bold">{{ $movieData['title'] }}</h3>
                <p class="text-white text-sm text-opacity-50 mx-14">{{ Str::limit($movieData['overview'], 100, '...') }}</p>
            </div>
    </div>
    <div class="flex mx-auto mt-6">
        <x-add-to-watchlist-button :id='$movieData["id"]' flag='movie' :name='$movieData["title"]'/>
        <div class="mr-6"></div>
        <x-add-to-history-button :id='$movieData["id"]' flag='movie' :name='$movieData["title"]' />
    </div>
</div>