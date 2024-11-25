<?php

$user_favorites = $user->profile_content_favorites ?? [];

?>

<x-profile-wrapper :user='$user'>
    <h1 class="my-6 text-white text-center text-title font-sans font-semibold">{{ ucfirst($user->name) }}'s Favorite Content</h1>
    <div class="flex justify-between mx-40 mb-12">
        @foreach ($user_favorites as $content)
            <div class="w-56 border border-2 border-white bg-black bg-opacity-0 border-opacity-50 text-center rounded-lg hover:cursor-pointer transition duration-500 ease-in-out relative group">
                <a href="{{ route('content', ['movie' => $content['id'], 'flag' => $content['content_type']]) }}"><img src="https://image.tmdb.org/t/p/w500{{ $content['posterPath'] }}" alt="" class="rounded-md h-full w-full object-cover"></a>
            </div>
        @endforeach
        @for ($i = 0; $i < 5 - count($user_favorites); $i++)
        <div class="w-56 bg-black bg-opacity-0 border-opacity-50 text-center rounded-md relative group">
            <img class="opacity-50  rounded-md" src="{{ asset('images/no-movie-poster.jpg') }}"></img>
        </div>
        @endfor
    </div>
</x-profile-wrapper>