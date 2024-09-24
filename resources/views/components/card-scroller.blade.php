<!-- scroll animation idea and partial code from https://cruip.com/create-an-infinite-horizontal-scroll-animation-with-tailwind-css/ -->

<!--  props added to include popular movies from tmdb api -->
@props(['movieData'])

<!-- loop over all the movies per category -->
<div class="w-full inline-flex flex-nowrap [mask-image:_linear-gradient(to_right,transparent_0,white,blue,transparent_100%)] group">
    <ul class="flex animate-loop-scroll group-hover:paused">
        @foreach ($movieData as $movieData) <!-- still need to make this rotate twice -->
            <!-- <img src="https://image.tmdb.org/t/p/w500{{ $movieData['poster_path'] }}" alt="{{ $movieData['title'] }} Poster"> -->
            <x-movie-card img="https://image.tmdb.org/t/p/w500{{ $movieData['poster_path'] }}"></x-movie-card>
        @endforeach
   </ul>
</div>



<!-- <div class="w-full inline-flex flex-nowrap [mask-image:_linear-gradient(to_right,transparent_0,white,blue,transparent_100%)] group">
    <ul class="flex animate-loop-scroll group-hover:paused">
            <x-movie-card img="images/movie_posters/Lobster.jpg"></x-movie-card>
            <x-movie-card img="images/movie_posters/IW.jpg"></x-movie-card>
            <x-movie-card img="images/movie_posters/batman.png"></x-movie-card>
            <x-movie-card img="images/movie_posters/jaws.jpg"></x-movie-card>
            <x-movie-card img="images/movie_posters/joker.avif"></x-movie-card>
            <x-movie-card img="images/movie_posters/opp.avif"></x-movie-card>
            <x-movie-card img="images/movie_posters/polt.jpg"></x-movie-card>
            <x-movie-card img="images/movie_posters/SOTL.jpg"></x-movie-card>
            <x-movie-card img="images/movie_posters/swtfa.jpeg"></x-movie-card>
            <x-movie-card img="images/movie_posters/TNBC.webp"></x-movie-card>
    </ul>
    <ul class="flex animate-loop-scroll group-hover:paused" aria-hidden="true">
            <x-movie-card img="images/movie_posters/Lobster.jpg"></x-movie-card>
            <x-movie-card img="images/movie_posters/IW.jpg"></x-movie-card>
            <x-movie-card img="images/movie_posters/batman.png"></x-movie-card>
            <x-movie-card img="images/movie_posters/jaws.jpg"></x-movie-card>
            <x-movie-card img="images/movie_posters/joker.avif"></x-movie-card>
            <x-movie-card img="images/movie_posters/opp.avif"></x-movie-card>
            <x-movie-card img="images/movie_posters/polt.jpg"></x-movie-card>
            <x-movie-card img="images/movie_posters/SOTL.jpg"></x-movie-card>
            <x-movie-card img="images/movie_posters/swtfa.jpeg"></x-movie-card>
            <x-movie-card img="images/movie_posters/TNBC.webp"></x-movie-card>
    </ul>
</div> -->

<!-- animate-loop-scroll -->