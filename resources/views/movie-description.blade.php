<?php
use Carbon\Carbon;

// vote average
$percent = round($movie['vote_average'] * 10);

// runtime
if($flag == "movie"){
    $hours = floor($movie['runtime'] / 60);
    $minutes = $movie['runtime'] % 60;
    $runtime = "{$hours}h {$minutes}min";
    // bc of tv show 
    $title = $movie['title'];
    $releaseDate = $movie['release_date'];
    $rating = 'NR';
    // movie rating
    foreach ($movie['release_dates']['results'] as $result) {
        if ($result['iso_3166_1'] === 'US') {
            foreach ($result['release_dates'] as $release) {  
                if (!empty($release['certification'])) { 
                    $rating = $release['certification'];
                    break;
                }
            }
        }
    }
} else {
    $runtime = "{$movie['number_of_seasons']} Seasons";
    $title = $movie['name'];
    $releaseDate = $movie['first_air_date'];
    $rating = 'NR';
    // movie rating
    foreach ($movie['content_ratings']['results'] as $result) {
        if ($result['iso_3166_1'] === 'US') {
            $rating = $result['rating'];
            break; 
        }
    }
}

?>


<x-layout>
    <div class="mx-24 mt-14 flex">
        <img src="https://image.tmdb.org/t/p/w500{{ $movie['poster_path'] }}" alt="" class="rounded-lg w-96 mr-12">

        <div class="flex flex-col justify-between">
            <div class="space-y-2">
                <div class="flex flex-row justify-between">
                    <div>
                        <h1 class="text-mega text-white font-serif"> {{ $title }}</h1>
                        <!-- movie data - movie rating (pg/r) - how long movie is-->
                        <h3 class="text-body text-white text-opacity-50 font-sans">{{ Carbon::parse($releaseDate)->year }} | {{ $rating }} | {{ $runtime }} </h3>
                    </div>
                    <x-user-rating-circle :percent="$percent"/>
                </div>
                <p class="text-white text-sm text-opacity-25"> {{ $movie['overview'] }}</p>
            </div>
            <div class="flex gap-2 overflow-x-auto max-w-4xl">
                @foreach($cast_crew_details['cast'] as $actor)
                    <x-cast-card :actor='$actor'/>
                @endforeach
            </div>
        </div>
    </div>
    <div class="mb-32"></div>
</x-layout>