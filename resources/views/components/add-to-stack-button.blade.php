@props(['id', 'flag'])

<?php

use App\Models\Stack;

$user = Auth::user();
$userStacks = Stack::where('user_id', $user->id)->get();

?>


<div class="relative group">
    <button class="text-sm text-white text-opacity-50 hover:text-aqua hover:text-opacity-100 hover:cursor-pointer transition ease-in-out duration-500" x-data="" x-on:click.prevent="$dispatch('open-modal', 'add-content-modal-{{ $id }}')"><span class="material-symbols-outlined">layers</span></button>

    <x-hover-tooltip text='Add to Stack' />
</div>

<x-modal name="add-content-modal-{{ $id }}" :show="$errors->isNotEmpty()" focusable>

    <div x-data="{ selectedStackId: null }" class="bg-midnight p-8">
        <form :action="`/addToStack?id={{ $id }}&content_type={{ $flag }}&stack_id=${selectedStackId}&hardcode_id=1726`" 
              method="POST">
            @csrf

            <h2 class="text-title font-serif text-white text-center mb-4">
                Select a Stack to Add:
            </h2>

            <!-- Displaying User Stacks -->
            <div class="text-white mb-6">
                @foreach($userStacks as $stack)
                    <div class="py-2 cursor-pointer" 
                         @click="selectedStackId = '{{ $stack['id'] }}'">
                         
                        {{ $stack['name'] ?? 'Unnamed Stack' }} - {{ $stack['description'] }}
                    </div>
                @endforeach
            </div>
            <div class="mt-6 flex justify-between items-center">
            <button type="button" 
                        x-on:click="$dispatch('close-modal', 'add-content-modal-{{ $id }}')" 
                        class="text-midnight bg-white rounded-full px-4 p-2 font-medium tracking-wide "> 
                        <!-- focus:outline-none 
                               focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 
                               focus-visible:outline-blue -->
                    Cancel
                </button>
                <button type="submit" 
                        class="text-white bg-blue rounded-full px-4 p-2 font-medium tracking-wide" 
                        :disabled="!selectedStackId">
                        <!--  focus:outline-none 
                               focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 
                               focus-visible:outline-blue -->
                    Add to Stack
                </button>
            </div>
        </form>
    </div>
</x-modal>