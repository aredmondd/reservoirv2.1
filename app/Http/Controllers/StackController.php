<?php 

namespace App\Http\Controllers;

use App\Models\Stack;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

class StackController extends Controller {
    
    public function display(Request $request) {
        $userId = Auth::id();
    
        $userStacks = Stack::where('user_id', $userId)
                      ->orderBy('created_at', 'desc')
                      ->paginate(9);

        return view('my-stacks', ['stacks' => $userStacks]);
    }

    public function store(Request $request) {
        $attributes = request()->validate([
            'name' => 'required|max:30',
            'description' => 'required|max:90',
            'isPrivate' => 'required',
        ]);
        $attributes['user_id'] = Auth::id();
        $attributes['content'] = null;
        $attributes['isPrivate'] = ($attributes['isPrivate'] === 'private') ? true : false;
        
        $stack = Stack::create($attributes);
        $stackUrl = '/stack?&id=' . $stack->id ;

        return redirect($stackUrl)->with('success', $stack['name'] . ' has been created!');
    }

    private function fetchMovies($category){
        // Make the API call for the provided category
        return Http::asJson()
        ->get(config('services.tmdb.endpoint').'movie/'.$category.'?api_key='.config('services.tmdb.api'))
        ->json()['results'];
    }

    // this was from use of chat gpt
    public function testGetStack(Request $request){
        $stackId = request('id');

        if ($stackId == null) {
            abort(404);
        }
    
        $stack = Stack::find($stackId);
    
        if (!$stack) {
            abort(404); // Handle the case where the stack is not found
        }
    
        if ($stack->user_id != Auth::id()) {
            abort(403);
        }
    
        // Access movies; this will return an empty collection if no movies are associated
        $movies = $stack->movies;
    
        // If movies are empty or null, fetch random movies
        if ($movies === null || $movies->isEmpty()) {
            // Fetch all categories of movies
            $popularMovies = $this->fetchMovies('popular');
            $inTheatersMovies = $this->fetchMovies('now_playing');
            $topRatedMovies = $this->fetchMovies('top_rated');
        
            // Consolidate all movies into one array
            $allMovies = array_merge($popularMovies, $inTheatersMovies, $topRatedMovies);
        
            // Initialize an array to store movie details
            $movieDetailsArray = [];
        
            // Create a set to track unique movie IDs that have already been added
            $existingMovieIds = $stack->movies->pluck('id')->toArray();
        
            // Loop until we have 10 unique movie details
            while (count($movieDetailsArray) < 10 && !empty($allMovies)) {
                // Randomize the movies
                $randomMovie = $allMovies[array_rand($allMovies)];
                $movieId = $randomMovie['id'];
        
                // Check if the movie is already in the stack
                if (!in_array($movieId, $existingMovieIds)) {
                    // Fetch the details of the random movie
                    $movieDetails = Http::asJson()
                        ->get(config('services.tmdb.endpoint').'movie/'.$movieId.'?api_key='.config('services.tmdb.api'))
                        ->json();
        
                    // Store the movie details in the array
                    $movieDetailsArray[] = $movieDetails; // Changed from [$i] to [] for sequential indexing
        
                    // Add the movie ID to the existing IDs to prevent future duplicates
                    $existingMovieIds[] = $movieId;
        
                    // Optionally remove the chosen movie from the allMovies array to prevent re-selection
                    $allMovies = array_filter($allMovies, fn($movie) => $movie['id'] !== $movieId);
                }
            }
        
            // Convert the array to a collection
            $moviesCollection = collect($movieDetailsArray);

            // Pass the collection to the view
            return view('stack-view', [
                'stackTitle' => $stack->name,
                'stackDescription' => $stack->description,
                'movies' => $moviesCollection,
                'stackId' => $stackId,
                'flag' => False, // there are no movies in the stack so add some
            ]);
        }
    
        // Return the stack view with the movies
        return view('stack-view', [
            'stackTitle' => $stack->name,
            'stackDescription' => $stack->description,
            'movies' => $movies, // Pass the movies to the view
            'stackId' => $stackId,
            'flag' => True, // there are movies already in the stack
        ]);
    }

    public function getStackContent(Request $request) {
        if ($request->input('id') != null) {
            $stack = Stack::find($request->input('id'));
            $content = Stack::find($request->input('id'))->content;

            return view('stack-view', ['stack' => $stack, 'content' => $content]);
        }

        return abort(404);
    }


    public function destroy() {
        $stackId = request('id');

        $stack = Stack::find($stackId);

        $stack->delete();

        return redirect('/stacks')->with('success', 'Stack was deleted.');
    }

    public function destoryContent(){

        $stackID = request('stackID');
        // get user
        $user = Auth::user();

        // stack
        $stack = Stack::find(request('stackID'));

        // Make sure the stack belongs to the authenticated user
        if (!$stack || $stack->user_id !== $user->id) {
            return redirect()->back();
        }

        $contentID = request('contentID');
        $content = $stack->content;

        // Loop through the content and remove the item with the matching ID
        $updatedContent = array_filter($content, function ($item) use ($contentID) {
            return $item['id'] !== $contentID;
        });


        $stack->content = array_values($updatedContent);

        $stack->save();

        return redirect()->back()->with('success', 'Content was deleted from stack');
    }
}

?>
