<x-layout>
    <div class="flex justify-between items-center mx-20 mt-12">
        <div class="flex">
            <img src="{{ $user->profile_picture != null ? asset('storage/' . $user->profile_picture) : asset('images/default.png') }}" class="w-32 rounded-full mr-12">
            <div class="flex flex-col">
                <h1 class="text-blue text-mega font-serif">{{ $user->name }}</h1>
                <p class="text-white text-opacity-50 font-sans text-body">{{ $user->username }}</p>
            </div>
        </div>

        <!-- if the current user is already friends with user they are viewing -->

        <!-- if the current user is not already friends with the user they are viewing -->
        <button class="text-white border border-blue rounded-full px-6 p-2 hover:bg-blue transition ease-in-out duration-300">{{ __('Add Friend') }}</button>
    </div>

    <div class="flex justify-around mx-20 mt-12">
        <div class="border border-white border-opacity-50 rounded-lg p-12">
            <h1 class="text-white font-sans text-title">Stacks:</h1>
            @if ($stacks == null)
            <p class="text-white text-center text-opacity-50">user has no stacks yet!</p>
            @else
            @foreach ($stacks as $stack)
                <p class="text-white text-center font-sans text-body">{{$stack->name}}</p>
            @endforeach
            @endif
    </div>
</x-layout>