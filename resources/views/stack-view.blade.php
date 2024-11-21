<x-layout>

    <x-success-notification />
    <x-error-notification />

    @if (auth()->check() && auth()->user()->id === $stack['user_id'])
    <div class="flex justify-between items-end mx-40">
        <div class="flex flex-col items-start">
            <h1 class="text-blue text-mega font-serif mt-12 text-center max-w-5xl">{{ $stack->name }}</h1>
            <p class="text-white text-center text-body">{{ $stack->description }}</p>
        </div>
        <div class="flex flex-col space-y-6 mt-6 items-end">
            <span id="editButton" class="material-symbols-outlined text-white text-title cursor-pointer">edit</span>
            <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-stack-deletion')"><img src="images/delete.png" alt="Delete" class="w-8"></button>
        </div>
    </div>
    @else
    <div class="flex flex-col items-start mx-40">
        <h1 class="text-blue text-mega font-serif mt-12 text-center max-w-5xl">{{ $stack->name }}</h1>
        <p class="text-white text-center text-body">{{ $stack->description }}</p>
    </div>
    @endif

    <!-- Modal for Delete Confirmation -->
    <x-modal name="confirm-stack-deletion" focusable>
        <form action="/stack?id={{ request('id') }}" method="POST" class="bg-midnight text-white p-8">
            @csrf
            @method('DELETE')

            <h2 class="text-title font-medium">
                Are you sure?
            </h2>

            <p class="mt-1 text-sm text-opacity-50">
                Once you delete this stack, <span class="text-red-500 text-opacity-100">all of its content will be permanently lost.</span>
            </p>

            <div class="mt-6 flex justify-between">
                <x-secondary-button x-on:click="$dispatch('close')">
                    Cancel
                </x-secondary-button>

                <x-danger-button class="ms-3">
                    Delete Stack
                </x-danger-button>
            </div>
        </form>
    </x-modal>

    @if ($content == null)
        <div class="text-white text-center mt-24">Search for some movies to add to your stack in "Fill your Reservoir"</div>
    @else
        <div class="container mx-auto p-8 mt-12 mx-40">
            <div class="grid grid-cols-5 gap-6">
                @foreach($content as $item)
                    <x-stack-movie-poster :item="$item" :stackID="request('id')" />
                @endforeach
            </div>
        </div>
    @endif

    <div class="mb-40"></div>

    <script>
        document.getElementById('editButton').addEventListener('click', function() {
            const deleteButtons = document.querySelectorAll('.delete-button');
            deleteButtons.forEach(button => {
                button.classList.toggle('hidden');
            });
        });
    </script>

</x-layout>