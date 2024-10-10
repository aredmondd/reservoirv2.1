<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class BacklogController extends Controller
{
    public function add(Request $request) {
        // Get user & movieId
        $user = Auth::user();
        $movieId = $request->input('id');
    
        $backlog = $user->backlog;
    
        $movies = $backlog->backlog ?? [];
    
        // Check if movie ID is already in the user's backlog
        if (!in_array($movieId, $movies)) {
            $movies[] = $movieId;
            $backlog->backlog = $movies;
            $backlog->save();
    
            dump($backlog->backlog);
        } else {
            dump("Movie ID {$movieId} is already in the backlog.");
        }
    }   
}
