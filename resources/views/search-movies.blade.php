<?php 
//  dd($filteredMovies)
?>

<x-layout>
    <div class="container mx-auto p-8">
        <h1 class="text-white text-2xl mb-4">Search Results for "{{ request()->query('query'); }}"</h1>
        
        <div class="grid grid-cols-4 gap-6">
            @forelse($filteredMovies as $movie)
            <?php 
                // it is a movie
                $flag = isset($movie['name']) ? 'tvshow' : 'movie';
                $title = $movie['title'] ?? $movie['name'];
                $releaseDate = $movie['release_date'] ?? $movie['first_air_date'];
            ?>
                <div class="bg-gray-800 p-4 rounded-lg">
                    <a href="{{ route('movie-description', ['movie' => $movie['id'], 'flag' => $flag]) }}">
                        <img src="https://image.tmdb.org/t/p/w500{{ $movie['poster_path'] }}" alt="{{ $title }}" class="rounded-lg mb-2">
                        <h2 class="text-white text-lg">{{ $title }}</h2>
                        <p class="text-white text-opacity-50">{{ $releaseDate }}</p>
                    </a>
                </div>
            @empty
                <p class="text-white">No movies found.</p>
            @endforelse
        </div>
    </div>
</x-layout>