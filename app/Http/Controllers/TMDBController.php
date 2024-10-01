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
    // I am adding this here so we can make all the calls to the api in one function
    // and not seperate them for if we want to show all the shit yk dog
    public function mainMovieFunc(){
        // get http request as a json but then needs to be inputted as a json again to get the results
        $popularMovies = Http::asJson()
        ->get(config('services.tmdb.endpoint').'movie/popular'.'?api_key='.config('services.tmdb.api'))
        ->json()['results'];

        // get http request as a json but then needs to be inputted as a json again to get the results
        $inTheatersMovies = Http::asJson()
            ->get(config('services.tmdb.endpoint').'movie/now_playing'.'?api_key='.config('services.tmdb.api'))
            ->json()['results'];

        // get http request as a json but then needs to be inputted as a json again to get the results
        $topRatedMovies = Http::asJson()
            ->get(config('services.tmdb.endpoint').'movie/top_rated'.'?api_key='.config('services.tmdb.api'))
            ->json()['results'];

        // passing all the api's calls into the view
        return view('index', [
            'popularMovie' => $popularMovies,
            'inTheatersMovie' => $inTheatersMovies,
            'topRatedMovie' => $topRatedMovies,
        ]);

    }

    // placeholder until can figure out how to do 
    // dont yell at me aiden ik this is very ugly 
    public function description($movieId){
        // get http request as a json but then needs to be inputted as a json again to get the results
        $popularMovies = Http::asJson()
        ->get(config('services.tmdb.endpoint').'movie/popular'.'?api_key='.config('services.tmdb.api'))
        ->json()['results'];

        // get http request as a json but then needs to be inputted as a json again to get the results
        $inTheatersMovies = Http::asJson()
            ->get(config('services.tmdb.endpoint').'movie/now_playing'.'?api_key='.config('services.tmdb.api'))
            ->json()['results'];

        // get http request as a json but then needs to be inputted as a json again to get the results
        $topRatedMovies = Http::asJson()
            ->get(config('services.tmdb.endpoint').'movie/top_rated'.'?api_key='.config('services.tmdb.api'))
            ->json()['results'];

            // Consolidate all movies into one array
            $allMovies = array_merge($popularMovies, $inTheatersMovies, $topRatedMovies);

            // Search for the movie with the given ID
            foreach ($allMovies as $movie) {
                if ($movie['id'] == $movieId) {
                    // Get the details of the found movie
                    $movieDetails = $movie; // Use the found movie directly
                    return view('movie-description', ['movie' => $movieDetails]);
                }
            }
            
        // // passing all the api's calls into the view
        // return view('movie-description', [
        //     'popularMovie' => $popularMovies,
        //     'inTheatersMovie' => $inTheatersMovies,
        //     'topRatedMovie' => $topRatedMovies,
        // ]);

    }

    // search functions ?? 
    // public function search(){
    //     $search = Http::asJson()
    //         ->get(config('services.tmdb.endpoint').)


    // }


    // full list of movies ??
}
