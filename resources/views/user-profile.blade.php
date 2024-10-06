<x-layout>
    <div class="flex justify-between items-end mx-20 mt-12">
        <div>
            <h1 class="text-blue text-mega font-serif">{{ $user->username }}</h1>
            <p class="text-white text-opacity-50 font-sans text-body">{{ $user->username }}</p>
        </div>

        <!-- if the current user is already friends with user they are viewing -->

        <!-- if the current user is not already friends with the user they are viewing -->
        <button class="text-white border border-blue rounded-full px-6 p-2 hover:bg-blue transition ease-in-out duration-300">{{ __('Add Friend') }}</button>
    </div>

    <div class="flex justify-around mx-20 mt-12">
        <div class="border border-white border-opacity-50 rounded-lg p-12">
            <h1 class="text-white font-sans text-title">Stacks:</h1>
            @if ($stacks != null)
            @foreach ($stacks as $stack)
                <p class="text-white text-center font-sans text-body">{{$stack->name}}</p>
            @endforeach
            @else
                <p class="text-white text-center">user has no stacks yet!</p>
            @endif
        </div>
        <div class="border border-white border-opacity-50 rounded-lg p-12">
            <h1 class="text-white font-sans text-title">Recently Watched:</h1>
        </div>
        <div class="border border-white border-opacity-50 rounded-lg p-12">
            <h1 class="text-white font-sans text-title">Friends:</h1>
        </div>
    </div>
</x-layout>