<x-layout>
    <div class="flex justify-between mx-40 mt-12 items-center">
        <div class="flex items-center">
            <img src="{{ $user->profile_picture != null ? asset('storage/' . $user->profile_picture) : asset('images/default.png') }}" class="rounded-full mr-12" width='150' height='150'>
            <div class="flex flex-col">
                <h1 class="text-blue text-mega font-serif">{{ $user->username }}</h1>
                <p class="text-white text-opacity-50 font-sans text-body">{{ $user->bio }}</p>
            </div>
        </div>
    </div>

    <div class="flex justify-center items-end">
        <div class="flex justify-around space-x-24 mt-12 p-5 border border-blue rounded-lg">
            <x-nav-link :href="route('user-profile', ['username' => $user->username])" :active="request()->is('user/' . $user->username)">
                {{ __('Profile') }}
            </x-nav-link>
            <x-nav-link :href="route('user-stacks', ['username' => $user->username])" :active="request()->is('user/*/stacks')">
                {{ __('Stacks') }}
            </x-nav-link>
            <x-nav-link :href="route('user-watchlist', ['username' => $user->username])" :active="request()->is('user/*/watchlist')">
                {{ __('Watchlist') }}
            </x-nav-link>
            <x-nav-link :href="route('user-history', ['username' => $user->username])" :active="request()->is('user/*/history')">
                {{ __('History') }}
            </x-nav-link>
            <x-nav-link :href="route('user-diary', ['username' => $user->username])" :active="request()->is('user/*/journal')">
                {{ __('Journal') }}
            </x-nav-link>
        </div>
    </div>

    {{ $slot }}
</x-layout>