<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Show the user's watchlist or history with partial word prefix matching
     * 
     * @access public
     * @author Aiden Redmond
     * @author ChatGPT
     * @param Request $request
     * @return view
     */
    public function display_list(Request $request) {
        $user = Auth::user();
        $view = $request->input('view');
        $search = $request->input('search');
        $type = $request->input('type');
    
        // Decide whether to show watchlist or history
        if ($view == 'history') {
            $list = $user->history->history ?? [];
        } 
        elseif ($view == 'watchlist') {
            $list = $user->watchlist->watchlist ?? [];
        }
        elseif ($view == 'currently-watching') {
            $list = $user->currentlyWatching->currently_watching ?? [];
        }
        else {
            $list = $user->watchlist->watchlist ?? [];
        }
    
        // Apply filters if provided
        $filtered = collect($list);
    
        // Filter by content type if a type is selected
        if ($type) {
            $filtered = $filtered->filter(function ($content) use ($type) {
                return $content['contentType'] === $type;
            });
        }
    
        // Apply search filter for title word prefix matching
        if ($search) {
            $search = strtolower($search);
            $filtered = $filtered->filter(function ($content) use ($search) {
                $titleWords = explode(' ', strtolower($content['name']));
                foreach ($titleWords as $word) {
                    if (strpos($word, $search) === 0) {
                        return true;
                    }
                }
                return false;
            });
        }
    
        // Paginate the filtered list (10 items per page)
        $perPage = 10;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = $filtered->slice(($currentPage - 1) * $perPage, $perPage)->values();
        $paginatedList = new LengthAwarePaginator($currentItems, $filtered->count(), $perPage);
        $paginatedList->withPath('/dashboard');
    
        return view('dashboard', ['list' => $paginatedList]);
    }


    /**
     * favorite a piece of content on watchlist or history
     * 
     * @access public
     * @author Aiden Redmond
     * @param Request $request
     * @return view
     */
    public function fav_content(Request $request) {
        $user = Auth::user();
        
        $movie_id = $request->input('id');
        $list_type = $request->input('list');
    
        /**
         * if we are favoriting content on watchlist, get the user's watchlist
         * if we are favoriting content on history, get the user's history
         */
        if ($list_type === 'watchlist') {
            $watchlist = $user->watchlist;
            $content = $watchlist->watchlist ?? [];
        } elseif ($list_type === 'history') {
            $history = $user->history;
            $content = $history->history ?? [];
        } else {
            return abort(404);
        }
    
        $movieFound = false;
    
        // find the content that is being requested as liked
        for($i = 0; $i < count($content); $i++) {
            // if the content is found - like it & update the list.
            if ($content[$i]['id'] == $movie_id) {

                $content[$i]['liked'] = ($content[$i]['liked'] == false) ? true : false;

                if ($list_type === 'watchlist') {
                    $watchlist->watchlist = $content;
                    $watchlist->save();
                } elseif ($list_type === 'history') {
                    $history->history = $content;
                    $history->save();
                }

                return redirect()->back();
            }
        }

        return abort(404);
    }


    /**
     * delete content from a list (watchlist or history)
     * 
     * @access public
     * @author Aiden Redmond
     * @param Request $request
     * @return view
     */
    public function delete_content_from_list(Request $request) {
        $user = Auth::user();

        $movieId = $request->input('id');
        $listType = $request->input('list');

        if ($listType === 'watchlist') {
            $watchlist = $user->watchlist;
            $movies = $watchlist->watchlist ?? [];
        } elseif ($listType === 'history') {
            $history = $user->history;
            $movies = $history->history ?? [];
        } else {
            return abort(404);
        }

        // Keep only movies that don't match the id we want to delete
        $movies = array_filter($movies, function ($movie) use ($movieId) {
            return $movie['id'] != $movieId; 
        });

        // Save the updated list 
        if ($listType === 'watchlist') {
            $watchlist->watchlist = array_values($movies);
            $watchlist->save();

            return redirect()->back()->with('success', 'Deleted item from watchlist.');
        } elseif ($listType === 'history') {
            $history->history = array_values($movies);
            $history->save();

            return redirect()->back()->with('success', 'Deleted item from history.');
        }
    }


    /**
     * move content from watchlist to history
     * 
     * @access public
     * @author Aiden Redmond
     * @param Request $request
     * @return view
     */
    public function move(Request $request) {
        $user = Auth::user();
        $movieId = $request->input('id');
        $view = $request->input('view') ?? 'watchlist';
        $contentToMove = null;

        $watchlist = $user->watchlist;
        $history = $user->history;
        $currently_watching = $user->currentlyWatching;

        $historyContent = $history->history ?? [];
        $watchlistContent = $watchlist->watchlist ?? [];
        $currentlyWatchingContent = $currently_watching->currently_watching ?? [];


        // move content from watchlist to currently watching
        if ($view == 'watchlist') {
            $contentToMove = collect($watchlistContent)->firstWhere('id', $movieId);

            // if the movie wasn't found
            if ($contentToMove == null) {
                return abort(404);
            }

            $contentToMove['time'] = now();

            // add the content to currently watching
            if (!in_array($movieId, array_column($currentlyWatchingContent, 'id'))) {
                $currentlyWatchingContent[] = $contentToMove;
                $currently_watching->currently_watching = $currentlyWatchingContent;
                $currently_watching->save();
            } else {
                return redirect()->route('dashboard')->with('error', 'You are already watching ' . $contentToMove['name']);
            }

            // delete the content from watchlist
            $watchlistContent = array_filter($watchlistContent, function ($movie) use ($movieId) {
                return $movie['id'] != $movieId; 
            });

            $watchlist->watchlist = array_values($watchlistContent);
            $watchlist->save();

            return redirect()->back()->with('success', $contentToMove['name'] . ' was moved to currently watching');
        }

        // move content from currently watching to history
        elseif ($view == 'currently-watching') {

            if($request->input('stars') == '1'){
                $content_rating = $request->input('stars');
            }else {
                $content_rating = $request->input('rating');
            }


            $contentToMove = collect($currentlyWatchingContent)->firstWhere('id', $movieId);

            // if the movie wasn't found
            if ($contentToMove == null) {
                return abort(404);
            }

            $contentToMove['rating'] = $content_rating;
            $contentToMove['time'] = now();

            // add the content to history
            if (!in_array($movieId, array_column($historyContent, 'id'))) {
                $historyContent[] = $contentToMove;
                $history->history = $historyContent;
                $history->save();
            } else {
                return redirect()->route('dashboard')->with('error', $contentToMove['name'] . ' is already in your history');
            }

            // delete the content from currently watching
            $currentlyWatchingContent = array_filter($currentlyWatchingContent, function ($movie) use ($movieId) {
                return $movie['id'] != $movieId; 
            });

            $currently_watching->currently_watching = array_values($currentlyWatchingContent);
            $currently_watching->save();

            return redirect()->back()->with('success', $contentToMove['name'] . ' was moved to history');
        }

    }
    
}

// EOF