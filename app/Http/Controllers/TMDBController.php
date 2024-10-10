<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

use GuzzleHttp\Client;

// to rememeber what is being called
// TMDB_ENDPOINT=https://api.themoviedb.org/3/
// TMDB_APP_KEY=ad75d64a140f409aac6dbdc4a867b626

class TMDBController extends Controller
{

    private function fetchMovies($category){
        // Make the API call for the provided category
        return Http::asJson()
        ->get(config('services.tmdb.endpoint').'movie/'.$category.'?api_key='.config('services.tmdb.api'))
        ->json()['results'];
    }
    // I am adding this here so we can make all the calls to the api in one function
    // and not seperate them for if we want to show all the shit yk dog
    public function mainMovieFunc(){

        // Fetch movies using the helper function
        $popularMovies = $this->fetchMovies('popular');
        $inTheatersMovies = $this->fetchMovies('now_playing');
        $topRatedMovies = $this->fetchMovies('top_rated');

        // Pass all the API calls into the view
        return view('index', [
            'popularMovie' => $popularMovies,
            'inTheatersMovie' => $inTheatersMovies,
            'topRatedMovie' => $topRatedMovies,
        ]);

    }

// get full list of movie details
    public function movieDetails($movieId){
        $movieDetails = Http::asJson()
        ->get(config('services.tmdb.endpoint').'movie/' . $movieId .'?append_to_response=release_dates&api_key='.config('services.tmdb.api'))
        ->json();
        // edit stack for now for testing
        return view('movie-description', ['movie' => $movieDetails]);
    }

    // search for a movie by its name
    public function search(Request $request)
    {
        $movieTitle = $request->input('query');
    
        $movieDetails = Http::asJson()
            ->get(config('services.tmdb.endpoint') . 'search/movie?query=' . $movieTitle . '&include_adult=false&language=en-US&page=1&api_key=' . config('services.tmdb.api'))
            ->json()['results'];

        // need to filter these movies by profane language and words in movie titles
    
        return view('search', compact('movieDetails'));
    }


    // full list of movies ??

}
