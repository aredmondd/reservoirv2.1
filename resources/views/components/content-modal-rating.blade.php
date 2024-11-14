@props(['name', 'id'])

<button type="submit" class="material-symbols-outlined hover:text-blue hover:cursor-pointer" title="Move content from currently watching to history" x-on:click.prevent="$dispatch('open-modal', 'add-history-rating-dashboard-{{ $id }}')" x-data="{ stars: null }">check_circle</button>

<x-modal name="add-history-rating-dashboard-{{ $id }}" :show="$errors->isNotEmpty()" focusable>
    <div class="bg-midnight p-8 rounded-md shadow-lg max-w-md mx-auto" x-data="{ stars: null, hovered: 0 }">
        <h2 class="text-title font-serif text-center text-blue mb-4">What did you think of {{ $name }}? </h2>

        <div class="flex justify-center mb-6">
            <label class="mr-4 text-lg">Rating:</label>
            <div class="flex">
                <!-- Stars for Rating -->
                <span x-on:mouseover="hovered = 1" x-on:click="stars = 1" x-bind:class="hovered >= 1 || stars >= 1 ? 'text-amber-400' : 'text-white text-opacity-25'" class="text-title material-symbols-outlined cursor-pointer">star</span>
                <span x-on:mouseover="hovered = 2" x-on:click="stars = 2" x-bind:class="hovered >= 2 || stars >= 2 ? 'text-amber-400' : 'text-white text-opacity-25'" class="text-title material-symbols-outlined cursor-pointer">star</span>
                <span x-on:mouseover="hovered = 3" x-on:click="stars = 3" x-bind:class="hovered >= 3 || stars >= 3 ? 'text-amber-400' : 'text-white text-opacity-25'" class="text-title material-symbols-outlined cursor-pointer">star</span>
                <span x-on:mouseover="hovered = 4" x-on:click="stars = 4" x-bind:class="hovered >= 4 || stars >= 4 ? 'text-amber-400' : 'text-white text-opacity-25'" class="text-title material-symbols-outlined cursor-pointer">star</span>
                <span x-on:mouseover="hovered = 5" x-on:click="stars = 5" x-bind:class="hovered >= 5 || stars >= 5 ? 'text-amber-400' : 'text-white text-opacity-25'" class="text-title material-symbols-outlined cursor-pointer">star</span>
            </div>
        </div>

        <!-- Submit Rating Button -->
        <button type="submit" 
                x-on:click="document.getElementById('rating-form-dashboard-{{ $id }}').action += '&rating=' + stars"
                class="text-white bg-blue rounded-full px-4 py-2 font-medium tracking-wide hover:bg-blue-600 transition">
            Submit
        </button>
    </div>
</x-modal>

