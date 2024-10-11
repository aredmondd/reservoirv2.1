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

    // remove profane language from movie searches
    private function filter($unfilteredMovies){
        // list of profane words to block out of movie search
        $profanewords = [
            'sex', 'sexual', 'porn', 'pornography', 'nude', 'nudity', 
            'erotic', 'xxx', 'boobs', 'breasts', 'tits', 'penis', 
            'dick', 'vagina', 'pussy', 'anal', 'blowjob', 'masturbation', 
            'orgasm', 'intercourse', 'fetish', 'bdsm', 'explicit', 
            'slut', 'whore', 'stripper', 'escort', 'lust', 'genital', 
            'incest', 'orgy'
        ];
        $filteredMovies = [];
        //  dd($unfilteredMovies);
        // go through each movie
        foreach($unfilteredMovies as $movies){
            $isProfane = false;
            // go through each profane word
            foreach($profanewords as $word){
                if(str_contains(strtolower($movies['original_title']), strtolower($word)) || str_contains(strtolower($movies['title']), strtolower($word)) || str_contains(strtolower($movies['overview']), strtolower($word))){
                    $isProfane = true;
                    break;
                }
            }
            if(!$isProfane){
                $filteredMovies[] = $movies;
            }

        }
        return $filteredMovies;

    }

    // search for a movie by its name
    public function search(Request $request)
    {
        $movieTitle = $request->input('query');
    
        $movieDetails = Http::asJson()
            ->get(config('services.tmdb.endpoint') . 'search/movie?query=' . $movieTitle . '&include_adult=false&language=en-US&page=1&api_key=' . config('services.tmdb.api'))
            ->json()['results'];

        // need to filter these movies by profane language and words in movie titles
        $filteredMovies = $this->filter($movieDetails);
    
        return view('search-movies', compact('filteredMovies'));
    }


    // full list of movies ??

}
