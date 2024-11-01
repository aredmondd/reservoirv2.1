@props(['stack'])

<?php 

use App\Models\User;
use Illuminate\Support\Facades\Http;

// Fetch the author's username using the user_id from the stack array
$author = User::find($stack['user_id'])->username;
$poster_url = 'https://image.tmdb.org/t/p/w500';
$default_poster = asset('images/no-movie-poster.jpg');

$items = [];
// Loop through the content array in the stack to gather item posters
for ($i = 0; $i < 5; $i++) {
    if (isset($stack['content'][$i])) {
        $contentType = $stack['content'][$i]['contentType'];
        $contentId = $stack['content'][$i]['id'];
        $item = Http::asJson()->get(config('services.tmdb.endpoint') . "$contentType/$contentId?append_to_response=release_dates&api_key=" . config('services.tmdb.api'))->json();
        $items[] = $poster_url . ($item['poster_path'] ?? '');
    } else {
        $items[] = $default_poster;
    }
}

?>

<div class="flex flex-col">
    <div class="rounded-md flex">
        @foreach ($items as $index => $itemPoster)
            <img src="{{ $itemPoster }}" class="border border-[0.25px] border-midnight rounded-md h-48 z-{{ 40 - ($index * 10) }} mr-[-75px]">
        @endforeach
    </div>
    <a href="/stack?id={{ $stack['id'] }}">
        <p class="text-title text-white font-medium mt-2">{{ $stack['name'] }}</p>
    </a>
    @if (!Route::is('my-stacks'))
        <p class="text-sm text-white text-opacity-50">by {{ $author }}</p>
    @endif
</div>
