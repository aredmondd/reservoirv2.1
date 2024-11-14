<x-layout>

    <x-success-notification />
    <x-error-notification />
    
    <div class="flex justify-between items-end mx-20 mt-12">
        <h1 class="text-mega text-white font-serif">My Stacks</h1>
        
        <button class="text-white border border-blue rounded-full px-4 p-2 mb-6 hover:bg-blue transition ease-in-out duration-300" x-data="" x-on:click.prevent="$dispatch('open-modal', 'new-stack')">New Stack</button>
    </div>


    <x-modal name="new-stack" :show="$errors->isNotEmpty()" focusable>
        <form method="POST" action="{{ route('new-stack') }}" class="p-6 bg-midnight z-[10000]">
            @csrf

            <h2 class="text-title font-medium text-white text-center">
                Create new Stack
            </h2>

            <div class="mt-6">
                <x-text-input
                    id="name"
                    name="name"
                    type="text"
                    class="mt-1 block w-3/4 shadow-md"
                    placeholder="Stack Name"
                />

                <x-text-input
                    id="description"
                    name="description"
                    type="text"
                    class="mt-3 block w-3/4 shadow-md"
                    placeholder="Description"
                />
                
                @if($errors->any())
                    <div class="text-red-600">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            <div class="mt-6 flex justify-between items-center">
                <button type="button" x-on:click="$dispatch('close')" class="text-midnight bg-white rounded-full px-4 p-2 font-medium tracking-wide focus:outline-none focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue">Cancel</button>

                <div class="flex items-center space-x-4">
                    <label class="text-white">
                        <input type="radio" name="isPrivate" value="public" checked class="mr-2">
                        Public
                    </label>
                    <label class="text-white">
                        <input type="radio" name="isPrivate" value="private" class="mr-2">
                        Private
                    </label>
                </div>

                <button type="submit "class="text-white bg-blue rounded-full px-4 p-2 font-medium tracking-wide focus:outline-none focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue">Create new Stack</button>
            </div>
        </form>
    </x-modal>

    <hr class='border-white border-opacity-25 mx-20 my-3'>

    @if($stacks->isEmpty())
    <div class="py-32 text-center text-white text-opacity-50 text-body">
        so empty...
    </div>
    @else
    <div class="mt-12 grid grid-cols-3 mx-20 mr-[-85px]">
        @foreach ($stacks as $stack)
            <div class="mb-12">
                <x-content-stack :stack='$stack'/>
            </div>
        @endforeach
    </div>

    <!-- Pagination Links -->
    <div class="mt-6 mb-12 flex">
        {{ $stacks->links() }}
    </div>
    @endif
</x-layout>