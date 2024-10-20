<button class="text-white border border-blue rounded-full px-4 py-2 mt-2 mr-4 hover:bg-blue transition ease-in-out duration-300" x-data="" x-on:click.prevent="$dispatch('open-modal', 'add-content')">Fill your Reservoir</button>

<x-modal name="add-content" :show="$errors->isNotEmpty()" focusable>
    <form action="{{ route('search-results') }}" method="GET" class="bg-midnight p-8">
        @csrf

        <h2 class="text-title font-serif text-white text-center">
            Search
        </h2>
        
        <div class="mt-6">
            <x-text-input
                name="query"
                type="text"
                class="mt-1 block w-3/4 shadow-md"
                placeholder="Search Movies, TV Shows, & more..."
                required
            />
        </div>

        <div class="mt-6 flex justify-between items-center">
            <button type="button" x-on:click="$dispatch('close')" class="text-midnight bg-white rounded-full px-4 p-2 font-medium tracking-wide focus:outline-none focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue">Cancel</button>
            <button type="submit "class="text-white bg-blue rounded-full px-4 p-2 font-medium tracking-wide focus:outline-none focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue">Search</button>
        </div>
    </form>
</x-modal>