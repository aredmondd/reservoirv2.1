@props(['movieData'])

<?php

$content_type = isset($movieData['title']) ? 'movie' : 'tv';
$name = isset($movieData['title']) ? $movieData['title'] : $movieData['name'];
$release = isset($movieData['release_date']) ? $movieData['release_date'] : $movieData['first_air_date'];
$length = isset($movieData['runtime']) ? $movieData['runtime'] : $movieData['number_of_seasons'];

?>
<div class="flex flex-col mb-8">
    <div class="text-center justify-center">
            <a href="{{ route('movie-description', ['movie' => $movieData['id'], 'flag' => '$content_type']) }}">
                <img src="https://image.tmdb.org/t/p/w500{{ $movieData['poster_path'] }}" class="rounded-md w-72 mx-auto mb-6 transform transition-transform duration-300 hover:scale-105" alt="movie poster">
            </a>
            <div class="flex flex-col">
                <a href="{{ route('movie-description', ['movie' => $movieData['id'], 'flag' => '$content_type']) }}" class="text-white text-title font-sans mb-2 font-bold">{{ $name }}</a>
                <p class="text-white text-sm text-opacity-50 mx-14">{{ Str::limit($movieData['overview'], 100, '...') }}</p>
            </div>
    </div>
    <div class="flex mx-auto mt-6 space-x-6" >
        <x-add-to-watchlist-button           :id='$movieData["id"]' flag='$content_type' :name='$name' :released='$release' :length='$length'/>
        <x-add-to-currently-watching-button  :id='$movieData["id"]' flag='$content_type' :name='$name' :released='$release' :length='$length'/>
        <x-add-to-history-button             :id='$movieData["id"]' flag='$content_type' :name='$name' :released='$release' :length='$length'/>
    </div>
</div>