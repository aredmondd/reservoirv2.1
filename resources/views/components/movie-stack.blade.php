@props(['stack', 'author'])

<?php 
$poster_url = 'https://image.tmdb.org/t/p/w500';

$item_1 = Http::asJson()->get(config('services.tmdb.endpoint') . $stack->content[0]['contentType'] . '/' . $stack->content[0]['id'] . '?append_to_response=release_dates&api_key='.config('services.tmdb.api'))->json();
$item_2 = Http::asJson()->get(config('services.tmdb.endpoint') . $stack->content[1]['contentType'] . '/' . $stack->content[1]['id'] . '?append_to_response=release_dates&api_key='.config('services.tmdb.api'))->json();
$item_3 = Http::asJson()->get(config('services.tmdb.endpoint') . $stack->content[2]['contentType'] . '/' . $stack->content[2]['id'] . '?append_to_response=release_dates&api_key='.config('services.tmdb.api'))->json();
$item_4 = Http::asJson()->get(config('services.tmdb.endpoint') . $stack->content[3]['contentType'] . '/' . $stack->content[3]['id'] . '?append_to_response=release_dates&api_key='.config('services.tmdb.api'))->json();
$item_5 = Http::asJson()->get(config('services.tmdb.endpoint') . $stack->content[4]['contentType'] . '/' . $stack->content[4]['id'] . '?append_to_response=release_dates&api_key='.config('services.tmdb.api'))->json();

?>

<div class="flex flex-col">
    <div class="rounded-md flex">
        <img src="{{ $poster_url . $item_1['poster_path'] }}" class="rounded-md h-48 shadow-md z-50 mr-[-75px]">
        <img src="{{ $poster_url . $item_2['poster_path'] }}" class="rounded-md h-48 shadow-md z-40 mr-[-75px]">
        <img src="{{ $poster_url . $item_3['poster_path'] }}" class="rounded-md h-48 shadow-md z-30 mr-[-75px]">
        <img src="{{ $poster_url . $item_4['poster_path'] }}" class="rounded-md h-48 shadow-md z-20 mr-[-75px]">
        <img src="{{ $poster_url . $item_5['poster_path'] }}" class="rounded-md h-48 shadow-md z-10 mr-[-75px]">
    </div>
    <p class="text-title text-blue font-medium mt-2">{{ $stack->name }}</p>
    <p class="text-sm text-white text-opacity-50">By {{ $author }}</p>
</div>