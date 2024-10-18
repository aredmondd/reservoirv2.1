@props(['content'])

<?php

use Carbon\Carbon;

$details = Http::asJson()->get(config('services.tmdb.endpoint').'movie/' . $content['id'] .'?append_to_response=release_dates&api_key='.config('services.tmdb.api')) ->json();

$runtime = floor($details['runtime'] / 60) . 'h ' . ($details['runtime'] % 60) . 'm';
$addedAt = Carbon::parse($content['time'])->toFormattedDateString();
$releaseYear = Carbon::parse($details['release_date'])->year 
?>

<div class="grid grid-cols-6 mx-40 text-white text-opacity-50">
    <div class="col-span-5 grid grid-cols-6 items-center">
        <p>{{ $addedAt }}</p>
        <div class="col-span-2 flex space-x-8 items-center">
            <img src="https://image.tmdb.org/t/p/w500{{ $details['poster_path'] }}" alt="" class="rounded-sm w-12">
            <a href="{{ route('movie-description', ['movie' => $content['id']]) }}" class="font-serif text-body text-white">{{ $details['title'] }}</a>
        </div>
        <p>{{ $releaseYear }}</p>
        <p>{{ $runtime }}</p>
    </div>
</div>

<hr class='border-white border-opacity-25 mx-40 my-3'>
