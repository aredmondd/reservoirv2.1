@props(['stack'])

<?php 

use App\Models\User;
use Illuminate\Support\Facades\Http;

$poster_url = 'https://image.tmdb.org/t/p/w500';
$default_poster = asset('images/no-movie-poster.jpg');

$items = [];
for ($i = 0; $i < 5; $i++) {
    if (isset($stack->content[$i])) {
        $contentType = $stack->content[$i]['contentType'];
        $contentId = $stack->content[$i]['id'];
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
    <a href="/stack?id={{ $stack->id }}">
        <p class="text-title text-white font-medium mt-2">{{ \Illuminate\Support\Str::limit($stack->name, 21, '...') }}</p>
    </a>
</div>
