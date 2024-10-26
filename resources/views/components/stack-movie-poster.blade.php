
@props(['item','stackID'])

<?php

use Carbon\Carbon;

// dd($item);
$contentType = $item['contentType'];

$details = Http::asJson()->get(config('services.tmdb.endpoint'). $contentType .'/' . $item['id'] .'?append_to_response=release_dates&api_key='.config('services.tmdb.api')) ->json();
// dd($details);
$posterPath = isset($details['poster_path']) ? $details['poster_path'] : null;

// movie
if ($contentType == 'movie') {
    $name = $details['title'];
    $runtime = floor($details['runtime'] / 60) . 'h ' . ($details['runtime'] % 60) . 'm';
    $releaseYear = Carbon::parse($details['release_date'])->year;
    $flag = 'movie';
}
// show
elseif ($contentType == 'tv') {
    $name = $details['name'];
    $numOfSeasons = $details['number_of_seasons'];
    $runtime = null;
    $releaseYear = Carbon::parse($details['first_air_date'])->year;
    $flag = 'tv';
}
?>

<div class="bg-gray-800 p-4 rounded-lg">
    <div class="flex flex-col mb-8">
        <div class="text-center justify-center">
            <img src="{{ $posterPath ? 'https://image.tmdb.org/t/p/w500' . $posterPath : asset('images/no-movie-poster.jpg') }}" class="rounded-md w-56 mx-auto mb-2 transform transition-transform duration-300 hover:scale-105" alt="{{ $name }} movie poster">
            <div class="flex justify-between items-center mb-2">
                <h3 class="text-white text-body font-sans font-bold">{{ $name }}</h3>
                <form action="/stack-content?stackID={{ $stackID }}&contentID={{ $item['id'] }}" method="POST" class="h-8 ml-4">
                    @csrf
                    @method('DELETE')
                    <button type="submit">
                        <img src="images/delete.png" alt="Delete" class="w-8">
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
