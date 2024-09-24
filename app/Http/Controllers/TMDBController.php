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
        return view('movie-api-demo', [
            'popularMovie' => $popularMovies,
            'inTheatersMovie' => $inTheatersMovies,
            'topRatedMovie' => $topRatedMovies,
        ]);

    }

    // search functions ?? 
    // public function search(){
    //     $search = Http::asJson()
    //         ->get(config('services.tmdb.endpoint').)


    // }


    // full list of movies ??

}



// // will save this here but can prob get rid of hahahahah

//     // just to show the current popular movies
//     public function popularMovies(){ // works
//         // get http request as a json but then needs to be inputted as a json again to get the results
//         $popularMovies = Http::asJson()
//             ->get(config('services.tmdb.endpoint').'movie/popular'.'?api_key='.config('services.tmdb.api'))
//             ->json()['results'];

//         dd($popularMovies);
//     }

//     // testing to see if i can do now showing 
//     public function inTheatersMovies(){ // works
//         // get http request as a json but then needs to be inputted as a json again to get the results
//         $inTheatersMovies = Http::asJson()
//             ->get(config('services.tmdb.endpoint').'movie/now_playing'.'?api_key='.config('services.tmdb.api'))
//             ->json()['results'];

//         dd($inTheatersMovies);
//     }

//     // testing to see if i can look at top rated movies
//     public function topRatedMovies(){ // works
//         // get http request as a json but then needs to be inputted as a json again to get the results
//         $topRatedMovies = Http::asJson()
//             ->get(config('services.tmdb.endpoint').'movie/top_rated'.'?api_key='.config('services.tmdb.api'))
//             ->json()['results'];

//          dump($topRatedMovies);

//         return view('demo', ['topRated' => $topRatedMovies]);
        
//     }


//     // // just to show trending movies
//     // public function trendingMovies(){ // doesnt work
//     //     // get http request as a json but then needs to be inputted as a json again to get the results
//     //     $trendingMovies = Http::asJson()
//     //         ->get(config('services.tmdb.endpoint').'movie/trending'.'?api_key='.config('services.tmdb.api'))
//     //         ->json();

//     //     dd($trendingMovies);
//     // }


//     // to show





//     // search for movies function

//     // recommended movies ??? axel ??? also recomendations just off the thingy
//     //  aslo can sign into website and it gives recommendation just from using their shit

//     public function demo(){

//         $tmdb_id = 436270;

//         $data = Http::asJson()
//             ->get(config('services.tmdb.endpoint').'movie/'.$tmdb_id. '?api_key='.config('services.tmdb.api'));
//         return view('demo',compact('data'));
//     }
// }
