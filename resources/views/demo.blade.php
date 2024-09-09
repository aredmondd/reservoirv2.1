<!DOCTYPE html>
<html>
<head>
    <title>TMDB API Demo</title>
</head>
<body>
    <h1>Movie Data from TMDB</h1>

    @if(!empty($data))
        $data['poster_path']
        <h2>{{ $data['title'] }}</h2>
        <p>Overview: {{ $data['overview'] }}</p>
        <p>Release Date: {{ $data['release_date'] }}</p>
        <p>Rating: {{ $data['vote_average'] }}/10</p>
    @else
        <p>No data available or there was an error retrieving the data.</p>
    @endif

</body>
</html>