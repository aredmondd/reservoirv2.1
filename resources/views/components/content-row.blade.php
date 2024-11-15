@props(['content'])

<?php

use Carbon\Carbon;

if (request()->view == null || request()->view === 'watchlist') {
    $request = 'watchlist';
} elseif (request()->view === 'currently-watching') {
    $request = 'currently-watching';
} elseif (request()->view === 'history') {
    $request = 'history';
}

$id = $content['id'];
$contentType = $content['contentType'];

$details = Http::asJson()->get(config('services.tmdb.endpoint'). $contentType .'/' . $content['id'] .'?append_to_response=release_dates&api_key='.config('services.tmdb.api')) ->json();

$addedAt = Carbon::parse($content['time'])->toFormattedDateString();
$posterPath = isset($details['poster_path']) ? $details['poster_path'] : null;

if(isset($content['rating'])){
    $stars = $content['rating'];
} else {
    $stars = 0;
}
 
// movie
if ($contentType == 'movie') {
    $name = $details['title'];
    $runtime = floor($details['runtime'] / 60) . 'h ' . ($details['runtime'] % 60) . 'm';
    $releaseYear = Carbon::parse($details['release_date'])->year;
    $flag = 'movie';
}
// show
elseif ($contentType == 'tv') {
    $name = $details['name'];
    $numOfSeasons = $details['number_of_seasons'];
    $season_s = $numOfSeasons == 1 ? ' season' : ' seasons';
    $runtime = null;
    $releaseYear = Carbon::parse($details['first_air_date'])->year;
    $flag = 'tv';
}

?>

<div class="grid grid-cols-6 mx-40 text-white text-opacity-50">
    <div class="col-span-5 grid grid-cols-6 items-center">
        <p>{{ $addedAt }}</p>
        <div class="col-span-2 flex space-x-8 items-center">
            <img src="{{ $posterPath ? 'https://image.tmdb.org/t/p/w500' . $posterPath : asset('images/no-movie-poster.jpg') }}" alt="" class="rounded-sm w-12">
            <a href="{{ route('movie-description', ['movie' => $content['id'], 'flag' => $flag]) }}" class="font-serif text-body text-white">{{ Str::limit($name, 22, '...')  }}</a>
        </div>
        <p>{{ $releaseYear }}</p>
        <p>{{ $runtime ? $runtime : $numOfSeasons . $season_s }}</p>
        @if (request()->view == 'history')
            <x-add-stars :stars="$stars" />        
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
        <form method="POST" id="rating-form-dashboard-{{ $id }}" action="/move-content?id={{ $content['id'] }}&view={{ request()->input('view') }}"> 
            @csrf
            @if (request()->input('view') == 'watchlist' || request()->input('view') == null)
                <button type="submit" class="material-symbols-outlined hover:text-blue hover:cursor-pointer" title="Move content from watchlist to currently watching">visibility</button>
            @else
                <!-- add the modal link here -->
                <x-content-modal-rating :name='$name' :id='$id'/>
            @endif
        </form>
        @endif
        <form method="POST" action="/delete-content?id={{ $content['id'] }}&list={{ $request }}"> @csrf @method('DELETE')
            <button type="submit" class="material-symbols-outlined text-opacity-100 hover:text-red-600 hover:cursor-pointer" title="Delete content">delete</button>
        </form>
    </div>
</div>

<hr class='border-white border-opacity-25 mx-40 my-3'>