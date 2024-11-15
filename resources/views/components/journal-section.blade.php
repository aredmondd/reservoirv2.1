@props(['content'])

<?php 

use Carbon\Carbon;

$details = Http::asJson()->get(config('services.tmdb.endpoint'). $content['contentType'] .'/' . $content['id'] .'?append_to_response=release_dates&api_key='.config('services.tmdb.api')) ->json();
$posterPath = isset($details['poster_path']) ? $details['poster_path'] : null;

// movie
if ($content['contentType'] == 'movie') {
    $runtime = floor($details['runtime'] / 60) . 'h ' . ($details['runtime'] % 60) . 'm';
    $releaseYear = Carbon::parse($details['release_date'])->year;
    $flag = 'movie';
}
// show
elseif ($content['contentType'] == 'tv') {
    $numOfSeasons = $details['number_of_seasons'];
    $runtime = null;
    $releaseYear = Carbon::parse($details['first_air_date'])->year;
    $flag = 'tv';
}

if(isset($content['rating'])){
    $stars = $content['rating'];
} else {
    $stars = 0;
}

?>

<hr class='border-white border-opacity-25 mx-40 my-3'>
<div class="text-white text-opacity-50 grid grid-cols-7 mx-40 items-center">

    @if ($content['action'] == 'watchlist')
        <p class="material-symbols-outlined">collections_bookmark</p>
    @elseif ($content['action'] == 'currently_watching')
        <p class="material-symbols-outlined">visibility</p>
    @else
        <p class="material-symbols-outlined">history</p>
    @endif

    <p>{{ Carbon::parse($content['time'])->toFormattedDateString(); }}</p>
    <div class="flex col-span-2 space-x-8 items-center">
        <img src="{{ $posterPath ? 'https://image.tmdb.org/t/p/w500' . $posterPath : asset('images/no-movie-poster.jpg') }}" alt="" class="rounded-sm w-12">
        <a href="{{ route('movie-description', ['movie' => $content['id'], 'flag' => $content['contentType']]) }}" class="text-white font-serif text-body">{{ Str::limit($content['name'], 22, '...')  }}</a>
    </div>
    <p>{{ $releaseYear }}</p>
    <p>{{ $runtime ? $runtime : $numOfSeasons . ' seasons' }}</p>
    @if (isset($content['rating']))
        <x-add-stars :stars="$stars" />
    @else
        <p class="text-white text-opacity-50">not rated yet...</p>  
    @endif     
</div>