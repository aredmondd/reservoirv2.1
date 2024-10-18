<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function display(Request $request) {
        $view = $request->input('view');

        if ($view == 'watchlist') {
            return view('dashboard', ['list' => Auth::user()->watchlist->watchlist]);
        }
        elseif ($view == 'history') {
            return view('dashboard', ['list' => Auth::user()->history->history]);
        }
        elseif ($view == null) {
            return view('dashboard', ['list' => Auth::user()->watchlist->watchlist]);
        }
        else {
            abort(404);
        }
    }

    public function add(Request $request) {
        dd("made it!");
    }

    public function fav(Request $request) {
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
    
        $movieFound = false;
    
        for($i = 0; $i < count($movies); $i++) {
            if ($movies[$i]['id'] == $movieId) {
                $movies[$i]['liked'] = ($movies[$i]['liked'] == false) ? true : false;
                $movieFound = true;
                break;
            }
        }
    
        if ($movieFound) {
            if ($listType === 'watchlist') {
                $watchlist->watchlist = $movies;
                $watchlist->save();
            } elseif ($listType === 'history') {
                $history->history = $movies;
                $history->save();
            }
        }
        else {
            return abort(404);
        }

        return redirect()->back();
    }

    public function delete(Request $request) {
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
