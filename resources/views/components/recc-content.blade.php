@props(['content'])

<?php
    use App\Models\User;
    use Carbon\Carbon;

    dd($content);
                
    $posterPath = $content['posterPath'];
    $content_type = $content['content_type'];
    $content_message = $content['message'];
    $content_id = $content['content_id'];
    $content_recommender = $content['recommender'];
    $content_name = $content['content_name'];
    $addedAt = Carbon::parse($content['time'])->format('m/d');
    $content = Http::asJson()->get(config('services.tmdb.endpoint'). $content_type . '/' . $content_id .'?append_to_response=release_dates&api_key='.config('services.tmdb.api')) ->json();
    
    if ($content_type == 'movie') {
        $runtime = floor($content['runtime'] / 60) . 'h ' . ($content['runtime'] % 60) . 'm';
        $releaseYear = Carbon::parse($content['release_date'])->year;
    } elseif ($content_type == 'tv') {
        $numOfSeasons = $content['number_of_seasons'];
        $releaseYear = Carbon::parse($content['first_air_date'])->year;
    }
?>

<div class="flex justify-between mx-12">
    <div class="flex space-x-6">
        <p class="text-white text-opacity-50">{{ $addedAt }}</p>
        <img href="{{ route('content', ['movie' => $content['id'], 'flag' => $content_type]) }}" src="{{ $posterPath ? 'https://image.tmdb.org/t/p/w500' . $posterPath : asset('images/no-movie-poster.jpg') }}" alt="Poster" class="rounded-md w-24">
        <div class="flex flex-col justify-between">
            <div class="flex flex-col">
                <p class="text-body text-white text-opacity-50">{{ $content_recommender }} reccomended you watch:</p>
                <a class="inline text-white font-serif text-title hover:text-blue hover:text-opacity-100" href="{{ route('content', ['movie' => $content['id'], 'flag' => $content_type]) }}">{{ Str::limit($content_name, 22, '...') }}</a>
            </div>
            <p class="text-sm text-white text-opacity-50 mr-6">"{{ Str::limit($content_message, 115, '...') }}"</a></p>
        </div>
    </div>

    <!-- buttons -->
    <div class="flex flex-col justify-between">
        <x-add-to-watchlist-button :id='$content_id' :name='$content_name' :released='$releaseYear' :length="$content_type === 'tv' ? $content['number_of_seasons'] : $content['runtime']" :flag="$content_type"/>
        <x-add-to-currently-watching-button :id='$content_id' :name='$content_name' :released='$releaseYear' :length="$content_type === 'tv' ? $content['number_of_seasons'] : $content['runtime']" :flag="$content_type"/>
        <form action="{{ route('recc-content.delete') }}" method="POST">
            @csrf
            @method('DELETE')

            <!-- Hidden fields to pass the required data -->
            <input type="hidden" name="content_id" value="{{ $content_id }}">

            <button type="submit" class="text-sm text-white text-opacity-50 hover:text-red-600 hover:text-opacity-100 hover:cursor-pointer transition ease-in-out duration-500">
                <span class="material-symbols-outlined">delete</span>
            </button>
        </form>
    </div>
</div>

<hr class="border-white border-opacity-25 mx-12 my-6">