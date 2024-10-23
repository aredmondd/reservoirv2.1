<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Stack;

class ContentController extends Controller
{
    public function addToWatchlist(Request $request) {
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

    public function addToStack(Request $request) {
        $user = Auth::user();
        $contentId = $request->input('id');
        $flag = $request->input('flag');
        $stackId = $request->input('stack_id');
    
        $stack = Stack::findOrFail($stackId);
    
        if ($stack->user_id === $user->id) {
            $stack->addToStack($contentId, $flag);
        } else {
            abort(403, "You don't have permission to modify this stack.");
        }
    
        return redirect()->back();
    }    
}
