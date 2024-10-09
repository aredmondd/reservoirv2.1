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


        $leftMovieId = 496243;
        $middleMovieId = 27205;
        $rightMovieId = 254320;

        $leftMovie = $movieDetails = Http::asJson()
        ->get(config('services.tmdb.endpoint').'movie/' . $leftMovieId . '?append_to_response=release_dates&api_key='.config('services.tmdb.api'))
        ->json();

        $middleMovie = $movieDetails = Http::asJson()
        ->get(config('services.tmdb.endpoint').'movie/' . $middleMovieId . '?append_to_response=release_dates&api_key='.config('services.tmdb.api'))
        ->json();

        $rightMovie = $movieDetails = Http::asJson()
        ->get(config('services.tmdb.endpoint').'movie/' . $rightMovieId . '?append_to_response=release_dates&api_key='.config('services.tmdb.api'))
        ->json();

        // Pass all the API calls into the view
        return view('index', [
            'popularMovie' => $popularMovies,
            'inTheatersMovie' => $inTheatersMovies,
            'topRatedMovie' => $topRatedMovies,
            'leftMovie' => $leftMovie,
            'middleMovie' => $middleMovie,
            'rightMovie' => $rightMovie
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
    public function search($movieTitle){

        // can i do mini calls as each letter gets typed?

        // or can i search through our database?

        $movieDetails = Http::asJson()
        ->get(config('services.tmdb.endpoint').'movie/search/movie?query='. $movieTitle . '&include_adult=false&language=en-US&page=1' . '?api_key='.config('services.tmdb.api'))
        ->json()['results'];

        //  return to where the movie was being searched?


    }


    // full list of movies ??

}
