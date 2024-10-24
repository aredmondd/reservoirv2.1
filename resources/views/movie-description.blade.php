<?php
// dd($movie);
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
    <div class="mt-14"></div>
    <div class="mx-24 flex">
        <img src="https://image.tmdb.org/t/p/w500{{ $movie['poster_path'] }}" alt="" class="rounded-lg w-96">
        
        <div class="pl-12"></div>
        <div>
            <div class="flex flex-row justify-between">
                <div>
                    <h1 class="text-mega text-white font-serif"> {{ $title }}</h1>
                    <!-- movie data - movie rating (pg/r) - how long movie is-->
                    <h3 class="text-body text-white text-opacity-50 font-sans">{{ $releaseDate }} | {{ $rating }} | {{ $runtime }} </h3>
                </div>
                <div class="flex">
                    <div class="border border-white border-opacity-25 text-white p-12 rounded-md"> {{ $percent }}</div>
                    <div class="mr-6"></div>
                    <div class="border border-white border-opacity-25 text-white p-12 rounded-md"># of watchlists</div>
                </div>
            </div>
            <div class="mt-6"></div>
            <p class="text-white text-sm text-opacity-50"> {{ $movie['overview'] }}</p>
            <div class="flex flex-row mt-6">
                @foreach ($movie['genres'] as $genre)
                    <x-genre-tag title="{{ $genre['name'] }}"></x-genre-tag>
                @endforeach
            </div>
            <div class="flex flex-row mt-6"></div>
        </div>
    </div>
    <div class="mb-32"></div>
</x-layout>