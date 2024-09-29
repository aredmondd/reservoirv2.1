<x-layout>
    <div class="flex justify-between items-end mx-20 mt-12">
        <h1 class="text-mega text-white font-serif">My Stacks</h1>
        
        <button class="text-white bg-blue rounded-full px-4 p-2 mb-6 font-medium tracking-wide hover:bg-aqua hover:text-midnight transition ease-in-out duration-300" x-data="" x-on:click.prevent="$dispatch('open-modal', 'new-stack')">{{ __('Create new Stack') }}</button>
    </div>


    <x-modal name="new-stack" focusable>
        <form method="POST" action="{{ route('new-stack') }}" class="p-6 bg-midnight">
            @csrf

            <h2 class="text-title font-medium text-white text-center">
                {{ __('Create a new Stack') }}
            </h2>

            <div class="mt-6">
                <x-text-input
                    id="name"
                    name="name"
                    type="text"
                    class="mt-1 block w-3/4 shadow-md mb-6"
                    placeholder="{{ __('Stack Name') }}"
                />

                <x-text-input
                    id="description"
                    name="description"
                    type="text"
                    class="mt-1 block w-3/4 shadow-md"
                    placeholder="{{ __('Description') }}"
                />
            </div>

            <div class="mt-6 flex justify-between items-center">
                <button x-on:click="$dispatch('close')" class="text-midnight bg-white rounded-full px-4 p-2 font-medium tracking-wide">Cancel</button>

                <button type="submit "class="text-white bg-blue rounded-full px-4 p-2 font-medium tracking-wide">{{ __('Create new Stack') }}</button>
            </div>
        </form>
    </x-modal>

    <!-- If the user has no stacks display: -->
    <div class="py-64 text-center text-white text-opacity-50 text-body">
        so empty... create a stack?
    </div>

    <!-- If the user has 1 or more stacks display:  -->

</x-layout>