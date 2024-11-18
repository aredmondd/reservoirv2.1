<?php
$ratings = $user->history->history ?? [];
$avg = 0;
$count = 0;
foreach ($ratings as $star){
    if(isset($star['rating'])){
        $avg += (int) $star['rating'];
        $count ++;
    }
}

if ($count > 0) {
    $avg = round($avg / $count);
}
else {
    $avg = 0;
}
// dd($user->profile_content_favorites);
?>
<x-layout>
    <div class="flex justify-between mx-40 my-12">
        <div class="flex">
            <img src="{{ $user->profile_picture != null ? asset('storage/' . $user->profile_picture) : asset('images/default.png') }}" class="rounded-full mr-12" width='175' height='175'>
            <div class="flex flex-col justify-between">
                <h1 class="text-blue text-mega font-serif">{{ $user->username }}</h1>
                <div class="flex flex-col space-y-2">
                    <p class="text-white font-sans text-body">{{ $user->bio }}</p>
                    <p class="text-white text-opacity-50 font-sans text-sm">Joined {{ Carbon\Carbon::parse($user->created_at)->toFormattedDateString() }}</p>
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
             <div class="w-56 border border-2 border-white bg-white bg-opacity-0 border-opacity-50 text-center rounded-lg hover:cursor-pointer hover:bg-opacity-25 transition duration-300 ease-in-out"><img src="https://image.tmdb.org/t/p/w500{{$favorite['posterPath']}}"  alt="" class="rounded-md"></div>
        @endforeach 
        @for ($i = 0; $i < $remainingSlots; $i++)
            <div class="text-white w-56 border border-2 border-white bg-white bg-opacity-0 border-opacity-50 text-center rounded-lg hover:cursor-pointer hover:bg-opacity-25 transition duration-300 ease-in-out">add your <br> fav content <br>here</div>
        @endfor
    </div>

    <div class="mb-24"></div>

    <div class="mx-40 mb-24 grid grid-cols-3">
        <div>
            <x-history-graph :numMovies='$numMovies' :numShows='$numShows' :moviePercentage='$moviePercentage' :showPercentage='$showPercentage'/>
            <x-watchlist-graph :numMoviesWatchlisted='$numMoviesWatchlisted' :numShowsWatchlisted='$numShowsWatchlisted' :moviePercentageWatchlisted='$moviePercentageWatchlisted' :showPercentageWatchlisted='$showPercentageWatchlisted'/>
        </div>
        <div class="flex flex-col items-center">
            <p class="text-center text-white">Average Rating</p>
            <div class="flex">
                <x-add-stars :stars="$avg" />
            </div>
        </div>
        <div>
            <p class="text-white text-center">Friends</p>
            <p class="text-white text-center text-opacity-50">{{ count($user->current_friends) }}</p>
        </div>
    </div>
</x-layout>