@props(['name', 'id'])

<button type="submit" class="material-symbols-outlined hover:text-blue hover:cursor-pointer" title="Move content from currently watching to history" x-on:click.prevent="$dispatch('open-modal', 'add-history-rating-dashboard-{{ $id }}')" x-data="{ stars: null }" >check_circle</button>

<x-modal name="add-history-rating-dashboard-{{ $id }}" :show="$errors->isNotEmpty()" focusable>
            <div class="bg-midnight p-8 rounded-md shadow-lg max-w-md mx-auto text-white" x-data="{ stars: null }">
                <h2 class="text-xl font-semibold text-center mb-4">Rate {{ $name }} </h2>

                <div class="flex justify-center mb-6">
                    <label class="mr-4 text-lg">Rating:</label>
                    <select name="stars" x-model="stars" id="stars" class="px-4 py-2 rounded bg-white text-midnight text-lg shadow" required>
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
                            x-on:click="$dispatch('close-modal', 'add-history-rating-dashboard-{{ $id }}')" 
                            class="text-midnight bg-white rounded-full px-4 py-2 font-medium tracking-wide hover:bg-gray-200 transition">
                        Cancel
                    </button>
                    <!-- Submit Rating Button -->
                    <button type="submit" 
                            x-on:click="document.getElementById('rating-form-dashboard-{{ $id }}').action += '&rating=' + stars"
                            class="text-white bg-blue rounded-full px-4 py-2 font-medium tracking-wide hover:bg-blue-600 transition">
                        Submit
                    </button>
                </div>
            </div>
        </x-modal>