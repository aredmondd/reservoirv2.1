<x-layout>
    <div class="container mx-auto p-8">
        <h1 class="text-white text-2xl mb-4">Search Results for "{{ request()->query('query'); }}"</h1>
        
        <div class="grid grid-cols-4 gap-6">
            @forelse($filteredMovies as $movie)
                <div class="bg-gray-800 p-4 rounded-lg">
                    <img src="https://image.tmdb.org/t/p/w500{{ $movie['poster_path'] }}" alt="{{ $movie['title'] }}" class="rounded-lg mb-2">
                    <h2 class="text-white text-lg">{{ $movie['title'] }}</h2>
                    <p class="text-white text-opacity-50">{{ $movie['release_date'] }}</p>
                    <div class="flex items-center">
                        <x-add-to-watchlist-button :id='$movie["id"]'/>
                        <x-add-to-history-button :id='$movie["id"]'/>
                    </div>
                </div>
            @empty
                <p class="text-white">No movies found.</p>
            @endforelse
        </div>
    </div>
</x-layout>