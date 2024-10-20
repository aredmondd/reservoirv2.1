@props(['content'])

<?php 

$movie = Http::asJson()->get(config('services.tmdb.endpoint'). $content['contentType'] . '/' . $content['id'] .'?append_to_response=release_dates&api_key='.config('services.tmdb.api')) ->json();

?>


<img src="https://image.tmdb.org/t/p/w500{{ $movie['poster_path'] }}" class="rounded-lg" width=150>
