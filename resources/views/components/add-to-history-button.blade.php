@props(['id', 'name', 'flag', 'released', 'length'])

<div class="relative group">
    <form id="rating-form-{{ $id }}" action="/history?id={{ $id }}&name={{ $name }}&content_type={{ $flag }}&released={{$released}}&length={{$length}}" method="POST">
        @csrf

        <!-- Add to History Button -->
        <button 
            class="text-sm text-white text-opacity-50 hover:text-aqua hover:text-opacity-100 transition ease-in-out duration-500" 
            x-data="{ stars: null }" 
            x-on:click.prevent="$dispatch('open-modal', 'add-history-rating-{{ $id }}')">
            <span class="material-symbols-outlined">history</span>
        </button>

        <!-- Modal for Rating -->
        <x-modal name="add-history-rating-{{ $id }}" :show="$errors->isNotEmpty()" focusable>
            <div class="bg-midnight mb-12 p-8 rounded-md shadow-lg max-w-md mx-auto text-white" x-data="{ stars: null }">
                <h2 class="text-mega font-semibold text-center mb-4">Rate {{ $name }}? </h2>

                <div class="flex justify-center mb-6">
                    <label class="mr-4 text-lg">Rating:</label>
                    <select name="stars" x-model="stars" id="stars" class="px-4 py-2 rounded text-midnight text-lg shadow" required>
                        <option value="1">1 Star</option>
                        <option value="2">2 Stars</option>
                        <option value="3">3 Stars</option>
                        <option value="4">4 Stars</option>
                        <option value="5">5 Stars</option>
                    </select>
                </div>

                <div class="flex justify-between items-center">
                    <!-- Cancel Button -->
                    <button type="button"
                            x-on:click="$dispatch('close-modal', 'add-history-rating-{{ $id }}')" 
                            class="text-midnight bg-white rounded-full px-4 py-2 font-medium tracking-wide hover:bg-gray-200 transition">
                        Cancel
                    </button>
                    <!-- Submit Rating Button -->
                    <button type="submit" 
                            x-on:click="document.getElementById('rating-form-{{ $id }}').action += '&rating=' + stars"
                            class="text-white bg-blue rounded-full px-4 py-2 font-medium tracking-wide hover:bg-blue-600 transition">
                        Submit
                    </button>
                </div>
            </div>
        </x-modal>
    </form>

    <!-- Tooltip -->
    <x-hover-tooltip text="Add to History" />
</div>

