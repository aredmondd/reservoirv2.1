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
        
        // Decide whether to show watchlist or history
        if ($view == 'history') {
            $list = $user->history->history ?? [];
        } else {
            $list = $user->watchlist->watchlist ?? [];
        }
    
        // If there is a search query, filter the list by partial word prefix matching
        if ($search != null) {
            $search = strtolower($search);
    
            $list = array_filter($list, function($content) use ($search) {
                $titleWords = explode(' ', strtolower($content['name']));
                foreach ($titleWords as $word) {
                    if (strpos($word, $search) === 0) {
                        return true;
                    }
                }
                return false;
            });
        }
    
        // Paginate the list (15 items per page)
        $perPage = 10;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = array_slice($list, ($currentPage - 1) * $perPage, $perPage);
        $paginatedList = new LengthAwarePaginator($currentItems, count($list), $perPage);
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
        } elseif ($listType === 'history') {
            $history->history = array_values($movies);
            $history->save();
        }

        return redirect()->back();
    }


    public function move(Request $request) {
        $user = Auth::user();
        $movieId = $request->input('id');
        $contentToMove = null;

        $watchlist = $user->watchlist;
        $history = $user->history;

        $historyContent = $history->history ?? [];
        $watchlistContent = $watchlist->watchlist ?? [];

        // find the piece of content from the watchlist
        foreach ($watchlistContent as $content) {
            if ($content['id'] == $movieId) {
                $contentToMove = $content;
            }
        }

        // if the movie wasn't found
        if ($contentToMove == null) {
            return abort(404);
        }

        // edit the content to have the time be the date it was 'watched' or added to history
        $contentToMove['time'] = now();

        // add the content to history
        if (!in_array($movieId, array_column($historyContent, 'id'))) {
            $historyContent[] = $contentToMove;
            $history->history = $historyContent;
            $history->save();
        } else {
            dd('Movie is already in history!');
        }

        // delete the content from watchlist
        $watchlistContent = array_filter($watchlistContent, function ($movie) use ($movieId) {
            return $movie['id'] != $movieId; 
        });

        $watchlist->watchlist = array_values($watchlistContent);
        $watchlist->save();

        return redirect()->back();
    }
    
}

// EOF