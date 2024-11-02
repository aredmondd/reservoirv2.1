<?php

use Illuminate\Support\Facades\Auth;

$numWatchlisted = count(Auth::user()->watchlist->watchlist);
$numWatched = count(Auth::user()->history->history);

?>

<x-layout>

    <h1 class="text-white text-center text-mega font-serif">My profile</h1>

    <h1 class="text-white"># of items watchlisted: {{ $numWatchlisted }}</h1>
    <h1 class="text-white"># of items watched: {{ $numWatched }}</h1>

</x-layout>