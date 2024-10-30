<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Stack;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use App\Models\User;

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


    private function fetchTV($category){
        // Make the API call for the provided category
        return Http::asJson()
        ->get(config('services.tmdb.endpoint').'tv/'.$category.'?api_key='.config('services.tmdb.api'))
        ->json()['results'];
    }


    // I am adding this here so we can make all the calls to the api in one function
    // and not seperate them for if we want to show all the shit yk dog
    public function mainMovieFunc(){

        // Fetch movies using the helper function
        $popularMovies = $this->fetchMovies('popular');
        $inTheatersMovies = $this->fetchMovies('now_playing');
        $topRatedMovies = $this->fetchMovies('top_rated');

        //tvshows  which is actually going to be top rated lol
        $topRatedTVShows = $this->fetchTV('top_rated');

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

        $aiden_stack = User::find(1)->stack[0];
        $brandon_stack = User::find(2)->stack[0];
        $axel_stack = User::find(3)->stack[0];

        // Pass all the API calls into the view
        return view('index', [
            'popularMovie' => $popularMovies,
            'inTheatersMovie' => $inTheatersMovies,
            'topRatedMovie' => $topRatedMovies,
            'leftMovie' => $leftMovie,
            'middleMovie' => $middleMovie,
            'rightMovie' => $rightMovie,
            'topRatedTVShows' => $topRatedTVShows,
            'aiden_stack' => $aiden_stack,
            'brandon_stack' => $brandon_stack,
            'axel_stack' => $axel_stack
        ]);

    }

// get full list of movie details
    public function movieDetails($movieId, $flag){
        // to determine if movie or tv details need to be shown
        $descriptor = $flag === 'movie' ? 'movie/' : 'tv/';
        $append = $flag === 'movie' ? 'release_dates' : 'content_ratings';

        $movieDetails = Http::asJson()
        ->get(config('services.tmdb.endpoint'). $descriptor . $movieId .'?append_to_response=' . $append . '&api_key='.config('services.tmdb.api'))
        ->json();

        $castCrewDetails = Http::asJson()
        ->get(config('services.tmdb.endpoint'). $descriptor . $movieId . '/credits' . '?append_to_response=' . $append . '&api_key='.config('services.tmdb.api'))
        ->json();

        // edit stack for now for testing
        return view('movie-description', ['movie' => $movieDetails, 'cast_crew_details' => $castCrewDetails, 'flag' => $flag]);
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
            'incest', 'orgy' , 'Big Tit Monastery'
        ];
        $filteredMovies = [];
        // go through each movie
        foreach($unfilteredMovies as $movies){
            // Check if vote_count exists
            if (!isset($movies['vote_count'])) continue;

            $isProfane = false;
            // go through each profane word
            foreach($profanewords as $word){
                if( str_contains(strtolower($movies['original_title'] ?? $movies['original_name']), strtolower($word)) ||
                    str_contains(strtolower($movies['title'] ?? $movies['name']), strtolower($word)) ||
                    str_contains(strtolower($movies['overview']), strtolower($word))
                    ){
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
    
    public function search(Request $request) {
        $movieTitle = $request->input('query');
        $type = $request->input('type'); // Retrieve the selected type (movie or tv)
    
        $movieDetails = [];
        $tvDetails = [];
    
        if ($type === 'movie' || !$type) {
            $movieDetails = Http::asJson()
                ->get(config('services.tmdb.endpoint') . 'search/movie', [
                    'query' => $movieTitle,
                    'include_adult' => false,
                    'language' => 'en-US',
                    'page' => 1,
                    'api_key' => config('services.tmdb.api'),
                ])->json()['results'];
        }
    
        if ($type === 'tv' || !$type) {
            $tvDetails = Http::asJson()
                ->get(config('services.tmdb.endpoint') . 'search/tv', [
                    'query' => $movieTitle,
                    'include_adult' => false,
                    'language' => 'en-US',
                    'page' => 1,
                    'api_key' => config('services.tmdb.api'),
                ])->json()['results'];
        }
    
        $allResults = array_merge($movieDetails, $tvDetails);
    
        $filteredMovies = $this->filter($allResults);
    
        // Sort by vote count in descending order
        usort($filteredMovies, function ($a, $b) {
            return ($b['vote_count'] ?? 0) <=> ($a['vote_count'] ?? 0);
        });
    
        // Pagination logic
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 10;
        $currentResults = Collection::make($filteredMovies)->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $paginatedResults = new LengthAwarePaginator(
            $currentResults,
            count($filteredMovies),
            $perPage,
            $currentPage,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );
    
        $user = Auth::user();
        $userStacks = Stack::where('user_id', $user->id)->get();
    
        return view('search-movies', [
            'filteredMovies' => $paginatedResults,
            'userStacks' => $userStacks,
            'query' => $movieTitle
        ]);
    }    
}
