<!-- scroll animation idea and partial code from https://cruip.com/create-an-infinite-horizontal-scroll-animation-with-tailwind-css/ -->

<!--  props added to include popular movies from tmdb api -->
@props(['movieData', 'flag'])


<!-- loop over all the movies per category -->
<div class="w-full inline-flex flex-nowrap overflow-x-hidden [mask-image:_linear-gradient(to_right,transparent_0,white,blue,transparent_100%)] group">
    <ul class="flex animate-loop-scroll group-hover:paused">
        @foreach ($movieData as $item) <!-- Using $item for clarity -->
            @if (!($flag === 'movie' && $item['original_title'] === 'Heavenly Touch') && !($flag === 'tv' && $item['original_name'] === 'Heavenly Touch'))
                <a href="{{ route('content', ['movie' => $item['id'], 'flag' => $flag]) }}">
                    <x-movie-card img="https://image.tmdb.org/t/p/w500{{ $item['poster_path'] }}"/>
                </a>
            @endif
        @endforeach
    </ul>

    <ul class="flex animate-loop-scroll group-hover:paused" aria-hidden="true">
        @foreach ($movieData as $item)
            @if (!($flag === 'movie' && $item['original_title'] === 'Heavenly Touch') && !($flag === 'tv' && $item['original_name'] === 'Heavenly Touch'))
                <a href="{{ route('content', ['movie' => $item['id'], 'flag' => $flag]) }}">
                    <x-movie-card img="https://image.tmdb.org/t/p/w500{{ $item['poster_path'] }}"/>
                </a>
            @endif
        @endforeach
    </ul>
</div>
