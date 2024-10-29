@props(['item','stackID'])

<?php

use Carbon\Carbon;

$contentType = $item['contentType'];

$details = Http::asJson()->get(config('services.tmdb.endpoint'). $contentType .'/' . $item['id'] .'?append_to_response=release_dates&api_key='.config('services.tmdb.api')) ->json();
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

<div class="flex flex-col items-center">
    <img src="{{ $posterPath ? 'https://image.tmdb.org/t/p/w500' . $posterPath : asset('images/no-movie-poster.jpg') }}" class="rounded-md w-56 mb-2" alt="{{ $name }} movie poster">
    <div class="flex justify-between items-center w-full max-w-56">
        <p class="text-white text-body font-sans font-bold">{{ $name }}</p>
        <form action="/stack-content?stackID={{ $stackID }}&contentID={{ $item['id'] }}" method="POST" class="h-8">
            @csrf
            @method('DELETE')
            <button type="submit">
                <img src="images/delete.png" alt="Delete" class="w-6">
            </button>
        </form>
    </div>
</div>