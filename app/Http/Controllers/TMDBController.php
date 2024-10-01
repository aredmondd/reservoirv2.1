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


        // // get http request as a json but then needs to be inputted as a json again to get the results
        // $popularMovies = Http::asJson()
        // ->get(config('services.tmdb.endpoint').'movie/popular'.'?api_key='.config('services.tmdb.api'))
        // ->json()['results'];

        // // get http request as a json but then needs to be inputted as a json again to get the results
        // $inTheatersMovies = Http::asJson()
        //     ->get(config('services.tmdb.endpoint').'movie/now_playing'.'?api_key='.config('services.tmdb.api'))
        //     ->json()['results'];

        // // get http request as a json but then needs to be inputted as a json again to get the results
        // $topRatedMovies = Http::asJson()
        //     ->get(config('services.tmdb.endpoint').'movie/top_rated'.'?api_key='.config('services.tmdb.api'))
        //     ->json()['results'];

        // // passing all the api's calls into the view
        // return view('index', [
        //     'popularMovie' => $popularMovies,
        //     'inTheatersMovie' => $inTheatersMovies,
        //     'topRatedMovie' => $topRatedMovies,
        // ]);

    }

    // placeholder until can figure out how to do 
    // dont yell at me aiden ik this is very ugly 
    public function description($movieId){

        {
            // Fetch all categories of movies
            $popularMovies = $this->fetchMovies('popular');
            $inTheatersMovies = $this->fetchMovies('now_playing');
            $topRatedMovies = $this->fetchMovies('top_rated');
    
            // Consolidate all movies into one array
            $allMovies = array_merge($popularMovies, $inTheatersMovies, $topRatedMovies);
    
            // Search for the movie with the given ID
            foreach ($allMovies as $movie) {
                if ($movie['id'] == $movieId) {
                    return view('movie-description', ['movie' => $movie]);
                }
            }
        }
        // // get http request as a json but then needs to be inputted as a json again to get the results
        // $popularMovies = Http::asJson()
        // ->get(config('services.tmdb.endpoint').'movie/popular'.'?api_key='.config('services.tmdb.api'))
        // ->json()['results'];

        // // get http request as a json but then needs to be inputted as a json again to get the results
        // $inTheatersMovies = Http::asJson()
        //     ->get(config('services.tmdb.endpoint').'movie/now_playing'.'?api_key='.config('services.tmdb.api'))
        //     ->json()['results'];

        // // get http request as a json but then needs to be inputted as a json again to get the results
        // $topRatedMovies = Http::asJson()
        //     ->get(config('services.tmdb.endpoint').'movie/top_rated'.'?api_key='.config('services.tmdb.api'))
        //     ->json()['results'];

        //     // Consolidate all movies into one array
        //     $allMovies = array_merge($popularMovies, $inTheatersMovies, $topRatedMovies);

        //     // Search for the movie with the given ID
        //     foreach ($allMovies as $movie) {
        //         if ($movie['id'] == $movieId) {
        //             // Get the details of the found movie
        //             $movieDetails = $movie; // Use the found movie directly
        //             return view('movie-description', ['movie' => $movieDetails]);
        //         }
        //     }
            
        // // passing all the api's calls into the view
        // return view('movie-description', [
        //     'popularMovie' => $popularMovies,
        //     'inTheatersMovie' => $inTheatersMovies,
        //     'topRatedMovie' => $topRatedMovies,
        // ]);

    }

// testing purpouses will remove $movieID but it will normally take it 
    public function movieDetails(){
        // this is for now until we get something better 
        // Fetch all categories of movies
        $popularMovies = $this->fetchMovies('popular');
        $inTheatersMovies = $this->fetchMovies('now_playing');
        $topRatedMovies = $this->fetchMovies('top_rated');

        // Consolidate all movies into one array
        $allMovies = array_merge($popularMovies, $inTheatersMovies, $topRatedMovies);
        // randomize the movies
        $randomMovie = $allMovies[array_rand($allMovies)];
        $movieId = $randomMovie['id'];
        $movieDetails = Http::asJson()
        ->get(config('services.tmdb.endpoint').'movie/movie_id?' . $movieId .'?api_key='.config('services.tmdb.api'))
        ->json()['results'];
        // edit stack for now for testing
        return view('edit-stack', ['movie' => $movieDetails]);
    }

    // search for a movie by its name
    public function search($movieTitle){

        $movieDetails = Http::asJson()
        ->get(config('services.tmdb.endpoint').'movie/search/movie?query='. $movieTitle . '&include_adult=false&language=en-US&page=1' . '?api_key='.config('services.tmdb.api'))
        ->json()['results'];

        //  return to where the movie was being searched?


    }


    // full list of movies ??
}
