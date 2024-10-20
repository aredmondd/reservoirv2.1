<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function addToWatchlist(Request $request) {
        // dd($request->all());
        $user = Auth::user();
        $movieId = $request->input('id');
    
        $watchlist = $user->watchlist;
    
        $movies = $watchlist->watchlist ?? [];
    
        if (!in_array($movieId, array_column($movies, 'id'))) {
            $movies[] = [
                'id' => $movieId,
                'time' => now(),
                'liked' => false
            ];
            $watchlist->watchlist = $movies;
            $watchlist->save();
        } else {
            dump("Movie ID {$movieId} is already in the history.");
        }

        return redirect()->back();
    }  

    public function addToHistory(Request $request) {
        $user = Auth::user();
        $movieId = $request->input('id');
    
        $history = $user->history;
    
        $movies = $history->history ?? [];
    
        if (!in_array($movieId, array_column($movies, 'id'))) {
            $movies[] = [
                'id' => $movieId,
                'time' => now(),
                'liked' => false
            ];
            $history->history = $movies;
            $history->save();
        } else {
            dump("Movie ID {$movieId} is already in the history.");
        }

        return redirect()->back();
    }  
}
