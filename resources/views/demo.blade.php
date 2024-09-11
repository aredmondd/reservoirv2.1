<!DOCTYPE html>
<html>
<head>
    <title>TMDB API Demo</title>
</head>
<body>

    @if(!empty($popularMovie))
    <h1>This is the popular shit </h1>
    @foreach ($popularMovie as $popular)
        <div class="movie">
            <img src="https://image.tmdb.org/t/p/w500{{ $popular['poster_path'] }}" alt="{{ $popular['title'] }} Poster">
            <h2>{{ $popular['title'] }}</h2>
            <p>Overview: {{ $popular['overview'] }}</p>
            <p>Release Date: {{ $popular['release_date'] }}</p>
            <p>Rating: {{ $popular['vote_average'] }}/10</p>
        </div>
    @endforeach
    @else
        <p>No data available or there was an error retrieving the data.</p>
    @endif

    @if(!empty($topRatedMovie))
    <h1>This is the top rated shit</h1>
    @foreach ($topRatedMovie as $topRated)
        <div class="movie">
            <img src="https://image.tmdb.org/t/p/w500{{ $topRated['poster_path'] }}" alt="{{ $topRated['title'] }} Poster">
            <h2>{{ $topRated['title'] }}</h2>
            <p>Overview: {{ $topRated['overview'] }}</p>
            <p>Release Date: {{ $topRated['release_date'] }}</p>
            <p>Rating: {{ $topRated['vote_average'] }}/10</p>
        </div>
    @endforeach
    @else
        <p>No data available or there was an error retrieving the data.</p>popular
    @endif

    @if(!empty($inTheatersMovie))
    <h1>This is the inTheaters shit</h1>
    @foreach ($inTheatersMovie as $inTheaters)
        <div class="movie">
            <img src="https://image.tmdb.org/t/p/w500{{ $inTheaters['poster_path'] }}" alt="{{ $inTheaters['title'] }} Poster">
            <h2>{{ $inTheaters['title'] }}</h2>
            <p>Overview: {{ $inTheaters['overview'] }}</p>
            <p>Release Date: {{ $inTheaters['release_date'] }}</p>
            <p>Rating: {{ $inTheaters['vote_average'] }}/10</p>
        </div>
    @endforeach
    @else
        <p>No data available or there was an error retrieving the data.</p>popular
    @endif
    

</body>
</html>