<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function add(Request $request) {
        // Get user & movieId
        $user = Auth::user();
        $movieId = $request->input('id');
    
        $history = $user->history;
    
        $movies = $history->history ?? [];
    
        // Check if movie ID is already in the user's history
        if (!in_array($movieId, $movies)) {
            $movies[] = $movieId;
            $history->history = $movies;
            $history->save();
    
            dump($history->history);
        } else {
            dump("Movie ID {$movieId} is already in the history.");
        }
    }   
}
