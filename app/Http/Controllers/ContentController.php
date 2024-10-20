<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function addToWatchlist(Request $request) {
        // dd($request->all());
        $user = Auth::user();
        $contentId = $request->input('id');
        $flag = $request->input('flag');
    
        $watchlist = $user->watchlist;
    
        $movies = $watchlist->watchlist ?? [];
    
        if (!in_array($contentId, array_column($movies, 'id'))) {
            $movies[] = [
                'id' => $contentId,
                'time' => now(),
                'contentType' => $flag,
                'liked' => false
            ];
            $watchlist->watchlist = $movies;
            $watchlist->save();
        } else {
            dump("Movie ID {$contentId} is already in the history.");
        }

        return redirect()->back();
    }  

    public function addToHistory(Request $request) {
        $user = Auth::user();
        $contentId = $request->input('id');
        $flag = $request->input('flag');
    
        $history = $user->history;
    
        $movies = $history->history ?? [];
    
        if (!in_array($contentId, array_column($movies, 'id'))) {
            $movies[] = [
                'id' => $contentId,
                'time' => now(),
                'contentType' => $flag,
                'liked' => false
            ];
            $history->history = $movies;
            $history->save();
        } else {
            dump("Movie ID {$contentId} is already in the history.");
        }

        return redirect()->back();
    }  
}
