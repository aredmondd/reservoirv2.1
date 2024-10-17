<x-layout>
    <div class="flex justify-between mx-40 mt-12">
        <div class="flex items-center">
            <img src="{{ $user->profile_picture != null ? asset('storage/' . $user->profile_picture) : asset('images/default.png') }}" class="w-24 rounded-full mr-12">
            <div class="flex flex-col">
                <h1 class="text-blue text-title font-serif">{{ $user->name }}</h1>
                <p class="text-white text-opacity-50 font-sans text-body">{{ $user->username }}</p>
            </div>
        </div>

        <!-- if the current user is already friends with user they are viewing -->

        <!-- if the current user is not already friends with the user they are viewing -->
        <button class="text-white border border-blue rounded-full px-6 p-2 hover:bg-blue transition ease-in-out duration-300">{{ __('Add Friend') }}</button>
    </div>

    <div class="flex justify-around mx-96 mt-12 py-5 border border-blue rounded-lg">
        <x-nav-link :href="route('user-profile', ['username' => Auth::user()->username])" :active="request()->is('user/*')">
            {{ __('Profile') }}
        </x-nav-link>

        <x-nav-link :href="route('dashboard')" :active="request()->is('dashboard')">
            {{ __('Watchlist') }}
        </x-nav-link>

        <x-nav-link :href="route('dashboard')" :active="request()->is('dashboard')">
            {{ __('History') }}
        </x-nav-link>

        <x-nav-link :href="route('dashboard')" :active="request()->is('dashboard')">
            {{ __('Stacks') }}
        </x-nav-link>

        <x-nav-link :href="route('dashboard')" :active="request()->is('dashboard')">
            {{ __('Reviews') }}
        </x-nav-link>
    </div>
</x-layout>