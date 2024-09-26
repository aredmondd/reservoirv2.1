<?php
//   dd($movie)
    // movie genres from tmdb 
 $genres = [
    28 => 'Action',
    12 => 'Adventure',
    16 => 'Animation',
    35 => 'Comedy',
    80 => 'Crime',
    99 => 'Documentary',
    18 => 'Drama',
    10751 => 'Family',
    14 => 'Fantasy',
    36 => 'History',
    27 => 'Horror',
    10402 => 'Music',
    9648 => 'Mystery',
    10749 => 'Romance',
    878 => 'Science Fiction',
    10770 => 'TV Movie',
    53 => 'Thriller',
    10752 => 'War',
    37 => 'Western',
];
?>

<x-layout>
    <div class="mt-14"></div>
    <div class="mx-24 flex">
        <div class="border border-white border-opacity-25 rounded-md py-60 px-40">
            <img src="https://image.tmdb.org/t/p/w500{{ $movie['poster_path'] }}" alt="">
        </div>
        
        <div class="pl-12"></div>
        <div>
            <div class="flex flex-row justify-between">
                <div>
                    <h1 class="text-mega text-white font-serif"> {{ $movie['title'] }}</h1>
                    <!-- movie data - movie rating (pg/r) - how long movie is-->
                    <h3 class="text-body text-white text-opacity-50 font-sans">{{ $movie['release_date'] }} | {{ $movie['popularity'] }} | Time</h3>
                </div>
                <div class="flex">
                    @php
                        $percent = round($movie['vote_average'] * 10)
                    @endphp
                    <div class="border border-white border-opacity-25 text-white p-12 rounded-md"> {{ $percent }}</div>
                    <div class="mr-6"></div>
                    <div class="border border-white border-opacity-25 text-white p-12 rounded-md"># of watchlists</div>
                </div>
            </div>
            <div class="mt-6"></div>
            <p class="text-white text-sm text-opacity-50"> {{ $movie['overview'] }}</p>
            <div class="flex flex-row mt-6">
                @foreach ($movie['genre_ids'] as $genre_id)
                    @if (isset($genres[$genre_id]))
                        <x-genre-tag title="{{ $genres[$genre_id] }}"></x-genre-tag>
                    @endif
                @endforeach
            </div>
            <div class="flex flex-row mt-6"></div>
        </div>
    </div>
</x-layout>