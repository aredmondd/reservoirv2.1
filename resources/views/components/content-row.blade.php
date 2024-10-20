@props(['content'])

<?php

use Carbon\Carbon;

$details = Http::asJson()->get(config('services.tmdb.endpoint').'movie/' . $content['id'] .'?append_to_response=release_dates&api_key='.config('services.tmdb.api')) ->json();

$runtime = floor($details['runtime'] / 60) . 'h ' . ($details['runtime'] % 60) . 'm';
$addedAt = Carbon::parse($content['time'])->toFormattedDateString();
$releaseYear = Carbon::parse($details['release_date'])->year;
$flag = isset($content['name']) ? 'tvshow' : 'movie';

?>

<div class="grid grid-cols-6 mx-40 text-white text-opacity-50">
    <div class="col-span-5 grid grid-cols-6 items-center">
        <p>{{ $addedAt }}</p>
        <div class="col-span-2 flex space-x-8 items-center">
            <img src="https://image.tmdb.org/t/p/w500{{ $details['poster_path'] }}" alt="" class="rounded-sm w-12">
            <a href="{{ route('movie-description', ['movie' => $content['id'], 'flag' => $flag]) }}" class="font-serif text-body text-white">{{ $details['title'] }}</a>
        </div>
        <p>{{ $releaseYear }}</p>
        <p>{{ $runtime }}</p>
        @if (request()->view == 'history')
        <p>☆☆☆☆☆</p>
        @endif
    </div>
    <div class="flex justify-end space-x-6 items-center">
        <form method="POST" action="/favorite?id={{ $content['id'] }}&list={{ request()->input('view') == 'watchlist' || !request()->input('view') ? 'watchlist' : 'history' }}"> @csrf
            <button type="submit" class="material-symbols-outlined hover:text-red-400 hover:cursor-pointer {{ $content['liked'] == true ? 'text-red-400' : '' }}" title="Like content">
                @if ($content['liked'] == true)
                    <img src="images/liked-content.png" alt="" class="w-6">
                @else
                    favorite
                @endif
            </button>
        </form>
        @if (request()->input('view') != 'history')
        <form method="POST" action="/move-content?id={{ $content['id'] }}"> @csrf
            <button type="submit" class="material-symbols-outlined hover:text-blue hover:cursor-pointer" title="Move content from watchlist to history">check_circle</button>
        </form>
        @endif
        <form method="POST" action="/delete-content?id={{ $content['id'] }}&list={{ request()->input('view') == 'watchlist' || !request()->input('view') ? 'watchlist' : 'history' }}"> @csrf @method('DELETE')
            <button type="submit" class="material-symbols-outlined text-opacity-100 hover:text-red-600 hover:cursor-pointer" title="Delete content">delete</button>
        </form>
    </div>
</div>

<hr class='border-white border-opacity-25 mx-40 my-3'>