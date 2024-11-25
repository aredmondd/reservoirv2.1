<?php

use Carbon\Carbon;

$history = $user->history->history ?? [];
$avg = 0;
$count = 0;

foreach ($history as $star){
    if(isset($star['rating'])){
        $avg += (int) $star['rating'];
        $count ++;
    }
}

$avg = $count > 0 ? round($avg / $count) : 0;

?>
<x-layout>
    <x-error-notification />
    <x-success-notification />
    
    <div class="flex justify-between mx-40 my-12">
        <div class="flex">
            <img src="{{ $user->profile_picture != null ? asset('storage/' . $user->profile_picture) : asset('images/default.png') }}" class="rounded-full mr-12" width='175' height='175'>
            <div class="flex flex-col justify-between">
                <h1 class="text-blue text-mega font-serif">{{ $user->username }}</h1>
                <div class="flex flex-col space-y-2">
                    <p class="text-white font-sans text-body">{{ $user->bio }}</p>
                    <p class="text-white text-opacity-50 font-sans text-sm">Joined {{ Carbon::parse($user->created_at)->toFormattedDateString() }}</p>
                </div>
            </div>
        </div>
        <a href="/profile" class="material-symbols-outlined text-white text-opacity-50 text-title text-right mt-6">settings</a>
    </div>

    <hr class='border-white border-opacity-25 mx-40'>

    <div class="flex justify-between mx-40 mt-12">
        @php
            $favorites = $user->profile_content_favorites ?? [];
            $remainingSlots = 5 - count($favorites);
        @endphp
        @foreach ( $favorites as $favorite)
            <div class="w-56 border border-2 border-white bg-black bg-opacity-0 border-opacity-50 text-center rounded-lg hover:cursor-pointer transition duration-500 ease-in-out relative group">
                <!-- Black background that appears on hover -->
                <div class="rounded-md w-full h-full bg-black bg-opacity-0 group-hover:bg-opacity-50 absolute top-0 left-0 z-0 transition-opacity duration-500 ease-in-out">
                    <!-- Heart Minus Icon (on top of the background) -->
                    <form action="{{ route('profile.deleteFav') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="id" value="{{ $favorite['id'] }}">
                        <input type="hidden" name="name" value="{{ $favorite['name'] }}">
                        <button type="submit" class="material-symbols-outlined absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-mega text-red-500 px-2 py-1 opacity-0 group-hover:opacity-100 transition-opacity duration-500 ease-in-out z-10">
                            heart_minus
                        </button>
                    </form>
                </div>

                <!-- Image -->
                <img src="https://image.tmdb.org/t/p/w500{{ $favorite['posterPath'] }}" alt="" class="rounded-md h-full w-full object-cover">
            </div>
        @endforeach
        @for ($i = 0; $i < $remainingSlots; $i++)
        <a href="/search/results" class="text-white py-[140px] w-56 border border-2 border-white bg-white bg-opacity-0 border-opacity-50 text-center rounded-lg hover:cursor-pointer hover:bg-opacity-25 transition duration-300 ease-in-out">
            use '<span class="material-symbols-outlined inline align-middle">heart_plus</span>' to display your favorite content
        </a>
        @endfor
    </div>

    <div class="mb-20"></div>

    <div class="grid grid-cols-3 mx-40 gap-24 place-items-center mb-32">
        <x-history-graph :numMovies='$numMovies' :numShows='$numShows' :moviePercentage='$moviePercentage' :showPercentage='$showPercentage'/>
        <x-cw-graph :numMovies='$numMoviesWatching' :numShows='$numShowsWatching' :moviePercentage='$moviePercentageWatching' :showPercentage='$showPercentageWatching'/>
        <x-watchlist-graph :numMoviesWatchlisted='$numMoviesWatchlisted' :numShowsWatchlisted='$numShowsWatchlisted' :moviePercentageWatchlisted='$moviePercentageWatchlisted' :showPercentageWatchlisted='$showPercentageWatchlisted'/>
    </div>
</x-layout>