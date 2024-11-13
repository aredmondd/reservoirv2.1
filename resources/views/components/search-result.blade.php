<?php

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

$auth_user = Auth::user();

// check if the user we are viewing is already friends with the user logged in
$is_viewed_user_in_auth_user_current = collect($user->current_friends)->contains('id', $auth_user->id);

$date_became_friends = null;

if ($is_viewed_user_in_auth_user_current) {
    $idToFind = $auth_user->id;
    $date_became_friends = Arr::first($user->current_friends, function ($item) use ($idToFind) {
        return $item['id'] == $idToFind;
    })['time'];

    $date_became_friends = Carbon::parse($date_became_friends)->toFormattedDateString();
}



// check if the user we are viewing has yet to accept a pending friend request to the user logged in
$is_viewed_user_in_auth_user_pending = collect($user->pending_friend_requests)->contains('id', $auth_user->id);

$date_sent_request = null;

if ($is_viewed_user_in_auth_user_pending) {
    $idToFind = $auth_user->id;
    $date_sent_request = Arr::first($user->current_friends, function ($item) use ($idToFind) {
        return $item['id'] == $idToFind;
    });

    $date_sent_request = Carbon::parse($date_sent_request)->toFormattedDateString();
}

?>

<div class="flex justify-between items-center mx-20 my-6">
    <a class="flex" href="/user/{{ $user->username }}">
        <img src="{{ $user->profile_picture != null ? asset('storage/' . $user->profile_picture) : asset('images/default.png') }}" class="w-16 h-16 rounded-full mr-6">
        <div class="flex flex-col">
            <h1 class="text-white text-title font-serif hover:text-blue transition-all ease-in-out duration-500">{{ $user->name }}</h1>
            <p class="text-white text-opacity-50 font-sans text-sm">{{ $user->username }}</p>
        </div>
    </a>
    @if ($is_viewed_user_in_auth_user_pending)
        <p class="text-white text-opacity-50">Sent request <br> {{ $date_sent_request }}</p>
    @elseif (!$is_viewed_user_in_auth_user_current && !$is_viewed_user_in_auth_user_pending)
    <form action="{{ route('friend.add') }}" method="POST">
        @csrf
        <input type="hidden" name="requested_user_id" value="{{ $user->id }}">
        <button class="text-white text-title hover:text-blue transition-all duration-300 ease-in-out material-symbols-outlined">group_add</button>
    </form>
    @else
    <p class="text-white text-opacity-50">Friends since <br> {{ $date_became_friends }}</p>
    @endif

</div>

<hr class='border-white border-opacity-25 mx-12 my-6'>
