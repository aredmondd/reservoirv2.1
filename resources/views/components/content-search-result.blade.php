@props(['id', 'content_type'])

<?php

use Carbon\Carbon;

$content = Http::asJson()->get(config('services.tmdb.endpoint'). $content_type . '/' . $id .'?append_to_response=release_dates&api_key='.config('services.tmdb.api')) ->json();
$posterPath = isset($content['poster_path']) ? $content['poster_path'] : null;


if ($content_type == 'movie') {
    $name = $content['title'];
    $runtime = floor($content['runtime'] / 60) . 'h ' . ($content['runtime'] % 60) . 'm';
    $releaseYear = Carbon::parse($content['release_date'])->year;
} elseif ($content_type == 'tv') {
    $name = $content['name'];
    $numOfSeasons = $content['number_of_seasons'];
    $runtime = null;
    $releaseYear = Carbon::parse($content['first_air_date'])->year;
}

?>

<div class="flex justify-between items-center text-white text-opacity-50 mx-64">
    <div class="flex">
        <img src="{{ $posterPath ? 'https://image.tmdb.org/t/p/w500' . $posterPath : asset('images/no-movie-poster.jpg') }}" alt="" class="rounded-lg w-28">
        <div class="flex flex-col justify-between mx-12">
            <div>
                <a href="{{ route('content', ['movie' => $content['id'], 'flag' => $content_type]) }}" class="font-serif text-title text-white hover:text-blue">{{ $name }}</a>
                <div class="flex space-x-2 text-body">
                    <p>{{ $releaseYear }}</p>
                    <p> | </p>
                    <p>{{ $runtime ? $runtime : $numOfSeasons . ' seasons' }}</p>
                </div>
            </div>
            <p class="text-sm">{{ Str::limit($content['overview'], 150, '...')}}</p>
        </div>

    </div>
    <div class="flex flex-col space-y-4 items-end">
        <x-add-to-watchlist-button :id='$id' :name='$name' :released='$releaseYear' :length="$content_type === 'tv' ? $content['number_of_seasons'] : $content['runtime']" :flag="isset($content['name']) ? 'tv' : 'movie'"/>
        <x-add-to-currently-watching-button :id='$id' :name='$name' :released='$releaseYear' :length="$content_type === 'tv' ? $content['number_of_seasons'] : $content['runtime']" :flag="isset($content['name']) ? 'tv' : 'movie'"/>
        <x-add-to-history-button :id='$id' :name='$name' :released='$releaseYear' :length="$content_type === 'tv' ? $content['number_of_seasons'] : $content['runtime']" :flag="isset($content['name']) ? 'tv' : 'movie'"/>
        <x-add-to-stack-button :id='$id' :name='$name' :flag="isset($content['name']) ? 'tv' : 'movie'"/>
        <x-add-to-profile-favorite :id='$id' :name='$name' :posterPath='$posterPath' />
        <x-send-to-friend :id='$id'/>  
    </div>
</div>

<hr class='border-white border-opacity-25 mx-64 my-6'>