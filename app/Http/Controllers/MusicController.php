<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Pool;

class MusicController extends Controller
{
    public function main (){
        
        $responses = Http::pool(fn (Pool $pool) => [
            $pool->get(config('services.lastfm.endpoint').'/2.0/?method=chart.gettoptracks&api_key='.config('services.lastfm.api') . '&limit=5&format=json'),
            $pool->get(config('services.lastfm.endpoint').'/2.0/?method=chart.gettopartists&api_key='.config('services.lastfm.api') . '&limit=5&format=json'),
            $pool->get(config('services.lastfm.endpoint').'/2.0/?method=album.getinfo&api_key='.config('services.lastfm.api') . '&artist=Kendrick Lamar&album=Damn&format=json'),
        ]);

        $topTracks = $responses[0]->json()['tracks']['track'] ?? [];
        $topArtists = $responses[1]->json()['artists']['artist'] ?? [];
        $artistAlbum = $responses[2]->json()['album'] ?? [];

        return view('movie-api-demo',[
            'topTracks' => $topTracks,
            'topArtists' => $topArtists,
            'artistAlbum' => $artistAlbum,
        ]);
    }
}
