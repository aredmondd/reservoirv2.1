@props(['content'])

<?php

use Carbon\Carbon;

$contentType = $content['contentType'];

$details = Http::asJson()->get(config('services.tmdb.endpoint'). $contentType .'/' . $content['id'] .'?append_to_response=release_dates&api_key='.config('services.tmdb.api')) ->json();

$addedAt = Carbon::parse($content['time'])->toFormattedDateString();
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

<div class="grid grid-cols-6 mx-40 text-white text-opacity-50">
    <div class="col-span-5 grid grid-cols-6 items-center">
        <p>{{ $addedAt }}</p>
        <div class="col-span-2 flex space-x-8 items-center">
            <img src="https://image.tmdb.org/t/p/w500{{ $details['poster_path'] }}" alt="" class="rounded-sm w-12">
            <a href="{{ route('movie-description', ['movie' => $content['id'], 'flag' => $content['contentType']]) }}" class="font-serif text-body text-white">{{ $name }}</a>
        </div>
        <p>{{ $releaseYear }}</p>
        <p>{{ $runtime ? $runtime : $numOfSeasons . ' szns' }}</p>
    </div>
</div>

<hr class='border-white border-opacity-25 mx-40 my-3'>
