<x-layout>
    <div class="flex justify-between mx-40 mt-20">
        <div class="flex items-center">
            <img src="{{ $user->profile_picture != null ? asset('storage/' . $user->profile_picture) : asset('images/default.png') }}" class="rounded-full mr-12" width='150' height='150'>
            <div class="flex flex-col">
                <h1 class="text-blue text-mega font-serif">{{ $user->username }}</h1>
                <p class="text-white text-opacity-50 font-sans text-body">{{ $user->bio }}</p>
            </div>
        </div>
        <div class="flex flex-col justify-around text-right">
            <a href="{{ route('user-profile', ['username' => $user->username]) }}" class="text-white text-right text-opacity-50 hover:text-opacity-100">Profile</a>
            <a href="{{ route('user-stacks', ['username' => $user->username]) }}" class="text-white text-right text-opacity-50 hover:text-opacity-100">Stacks</a>
            <a href="{{ route('user-watchlist', ['username' => $user->username]) }}" class="text-white text-right text-opacity-50 hover:text-opacity-100">Watchlist</a>
            <a href="{{ route('user-history', ['username' => $user->username]) }}" class="text-white text-right text-opacity-50 hover:text-opacity-100">History</a>
        </div>
    </div>

    {{ $slot }}
</x-layout>