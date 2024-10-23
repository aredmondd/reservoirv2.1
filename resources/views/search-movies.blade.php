<x-layout>
    <div class="mx-20 mt-12">
        <h1 class="text-white text-title mb-4 text-center">Search results for '{{ request()->query('query'); }}'</h1>

        <div class="mt-12"></div>

        @empty($filteredMovies)
        <div class="py-32 text-center text-white text-opacity-50 text-body">so empty...</div>
        @endempty

        <hr class='border-white border-opacity-25 mx-64 my-6'>
        
        @foreach ($filteredMovies as $movie)
            <x-content-search-result :id='$movie["id"]' :content_type="isset($movie['name']) ? 'tv' : 'movie'"/>
        @endforeach
    </div>
</x-layout>