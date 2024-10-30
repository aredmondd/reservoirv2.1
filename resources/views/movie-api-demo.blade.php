<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top Tracks and Artists</title>
</head>
<body>
    <h1>Top Tracks</h1>

    @if(!empty($topTracks))
        @foreach ($topTracks as $track)
            <div class="track">
                <h2>{{ $track['name'] }} by {{ $track['artist']['name'] }}</h2>
                <p>Playcount: {{ $track['playcount'] }}</p>
                <p>Listeners: {{ $track['listeners'] }}</p>
                <a href="{{ $track['url'] }}" target="_blank">Listen on Last.fm</a>
                
                <div class="images">
                    @foreach ($track['image'] as $image)
                        <img src="{{ $image['#text'] }}" alt="{{ $track['name'] }} image" style="width: 50px;">
                    @endforeach
                </div>
            </div>
        @endforeach
    @else
        <p>No top tracks available at the moment.</p>
    @endif

    <h1>Top Artists</h1>

    @if(!empty($topArtists))
        @foreach ($topArtists as $artist)
            <div class="artist">
                <h2>{{ $artist['name'] }}</h2>
                <p>Playcount: {{ $artist['playcount'] }}</p>
                <p>Listeners: {{ $artist['listeners'] }}</p>
                <a href="{{ $artist['url'] }}" target="_blank">Visit on Last.fm</a>
                
                <div class="images">
                    @foreach ($artist['image'] as $image)
                        @if(!empty($image['#text']))
                            <img src="{{ $image['#text'] }}" alt="{{ $artist['name'] }} image" style="width: 50px;">
                        @endif
                    @endforeach
                </div>
            </div>
        @endforeach
    @else
        <p>No top artists available at the moment.</p>
    @endif

    <h1>Album info </h1>

    <h1>Album: {{ $artistAlbum['name'] ?? 'N/A' }}</h1>
    <h2>Artist: {{ $artistAlbum['artist'] ?? 'N/A' }}</h2>
    
    <h3>Tags:</h3>
    <ul>
        @foreach($artistAlbum['tags']['tag'] ?? [] as $tag)
            <li><a href="{{ $tag['url'] }}" target="_blank">{{ $tag['name'] }}</a></li>
        @endforeach
    </ul>
    
    <h3>Playcount: {{ $artistAlbum['playcount'] ?? 'N/A' }}</h3>
    <h3>Listeners: {{ $artistAlbum['listeners'] ?? 'N/A' }}</h3>

    <h3>Images:</h3>
    <div>
        @foreach($artistAlbum['image'] ?? [] as $image)
            <img src="{{ $image['#text'] }}" alt="{{ $artistAlbum['name'] ?? 'Album Image' }}" style="width: 100px;">
        @endforeach
    </div>

    <h3>Tracks:</h3>
    <ul>
        @foreach($artistAlbum['tracks']['track'] ?? [] as $track)
            <li>{{ $track['name'] }} - <a href="{{ $track['url'] }}" target="_blank">Listen</a> ({{ $track['duration'] }} seconds)</li>
        @endforeach
    </ul>

    <h3>Album URL:</h3>
    <a href="{{ $artistAlbum['url'] }}" target="_blank">{{ $artistAlbum['url'] }}</a>

    <h3>Summary:</h3>
    <p>{!! $artistAlbum['wiki']['summary'] ?? 'No summary available.' !!}</p>
</body>
</html>
