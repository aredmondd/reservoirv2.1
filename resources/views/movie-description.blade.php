<?php
// vote average
$percent = round($movie['vote_average'] * 10);

// runtime
$hours = floor($movie['runtime'] / 60);
$minutes = $movie['runtime'] % 60;
$runtime = "{$hours}h {$minutes}min";

//dd($movie);
$rating = 'NR';
// movie rating
foreach ($movie['release_dates']['results'] as $result) {
    if ($result['iso_3166_1'] === 'US') {
        foreach ($result['release_dates'] as $release) {  
            if (!empty($release['certification'])) { 
                $rating = $release['certification'];
                // if($rating == ''){
                //     $rating = 'nr';
                // };
                break;
            }
        }
    }
    else {
        $rating = 'NR';
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
                    <h1 class="text-mega text-white font-serif"> {{ $movie['title'] }}</h1>
                    <!-- movie data - movie rating (pg/r) - how long movie is-->
                    <h3 class="text-body text-white text-opacity-50 font-sans">{{ $movie['release_date'] }} | {{ $rating }} | {{ $runtime }} </h3>
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
</x-layout>