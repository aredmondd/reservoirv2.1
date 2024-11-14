<x-layout>

    <x-error-notification />
    <x-success-notification />

    <h2 class="text-mega text-center text-white font-serif mt-12">Search Content</h2>

    <div class="mx-20 mt-6">
        <form action="/search/results" method="GET" x-data class="bg-midnight mx-80 flex items-center space-x-4">
            <div class="flex-1">
                <x-text-input
                    name="query"
                    type="text"
                    placeholder="Search Movies, TV Shows, & more..."
                    value="{{ request('query') }}"
                    required
                    class="w-full"
                />
            </div>

            <div class="relative">
                <select name="type" onchange="this.form.submit()" class="appearance-none bg-blue text-white rounded-full p-3 pr-10 w-full focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue">
                    <option value="">All</option>
                    <option value="movie" {{ request('type') === 'movie' ? 'selected' : '' }}>Movies</option>
                    <option value="tv" {{ request('type') === 'tv' ? 'selected' : '' }}>TV</option>
                </select>
                <!-- Custom Dropdown Icon -->
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-4 text-midnight">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
            </div>
        </form>



        <div class="mt-12"></div>

        @empty($filteredMovies)
            <div class="py-32 text-center text-white text-opacity-50 text-body">so empty...</div>
        @endempty

        <hr class='border-white border-opacity-25 mx-64 my-6'>
        
        @foreach ($filteredMovies as $movie)
            <x-content-search-result :id='$movie["id"]' :content_type="isset($movie['name']) ? 'tv' : 'movie'"/>
        @endforeach

        <div class="mt-8">
            {{ $filteredMovies->appends(request()->query())->links('vendor.pagination.tailwind') }}
        </div>
    </div>

    <div class="mb-32"></div>
</x-layout>