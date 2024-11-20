@props(['name', 'id'])

<button type="submit" class="material-symbols-outlined text-white text-opacity-50 hover:text-opacity-100 transition ease-in-out duration-500" title="Move content from currently watching to history" x-on:click.prevent="$dispatch('open-modal', 'add-history-rating-dashboard-{{ $id }}')" x-data="{ stars: null }">check_circle</button>

<x-modal name="add-history-rating-dashboard-{{ $id }}" :show="$errors->isNotEmpty()" focusable>
    <div class="bg-midnight p-8 rounded-md shadow-lg mx-auto" x-data="{ stars: null, hovered: 0 }">
        <h2 class="text-title font-serif text-center text-blue mb-4">Rate {{ $name }}</h2>

        <div class="flex justify-center mb-6">
            <div class="flex">
                <!-- Stars for Rating -->
                <button type="submit" x-on:click="document.getElementById('rating-form-dashboard-{{ $id }}').action += '&rating=' + 1" x-on:mouseover="hovered = 1" x-bind:class="hovered >= 1 || stars >= 1 ? 'text-amber-400' : 'text-white text-opacity-25'" class="text-mega material-symbols-outlined cursor-pointer">star</button>
                <button type="submit" x-on:click="document.getElementById('rating-form-dashboard-{{ $id }}').action += '&rating=' + 2" x-on:mouseover="hovered = 2" x-bind:class="hovered >= 2 || stars >= 2 ? 'text-amber-400' : 'text-white text-opacity-25'" class="text-mega material-symbols-outlined cursor-pointer">star</span>
                <button type="submit" x-on:click="document.getElementById('rating-form-dashboard-{{ $id }}').action += '&rating=' + 3" x-on:mouseover="hovered = 3" x-bind:class="hovered >= 3 || stars >= 3 ? 'text-amber-400' : 'text-white text-opacity-25'" class="text-mega material-symbols-outlined cursor-pointer">star</span>
                <button type="submit" x-on:click="document.getElementById('rating-form-dashboard-{{ $id }}').action += '&rating=' + 4" x-on:mouseover="hovered = 4" x-bind:class="hovered >= 4 || stars >= 4 ? 'text-amber-400' : 'text-white text-opacity-25'" class="text-mega material-symbols-outlined cursor-pointer">star</span>
                <button type="submit" x-on:click="document.getElementById('rating-form-dashboard-{{ $id }}').action += '&rating=' + 5" x-on:mouseover="hovered = 5" x-bind:class="hovered >= 5 || stars >= 5 ? 'text-amber-400' : 'text-white text-opacity-25'" class="text-mega material-symbols-outlined cursor-pointer">star</span>
            </div>
        </div>
    </div>
</x-modal>

