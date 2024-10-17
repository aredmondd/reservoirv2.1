<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class BacklogController extends Controller
{
    public function add(Request $request) {
        $user = Auth::user();
        $movieId = $request->input('id');
    
        $backlog = $user->backlog;
    
        $movies = $backlog->backlog ?? [];
    
        if (!in_array($movieId, array_column($movies, 'id'))) {
            $movies[] = [
                'id' => $movieId,
                'time' => now(),
                'liked' => false
            ];
            $backlog->backlog = $movies;
            $backlog->save();
        } else {
            dd('Movie is already in backlog!');
        }

        return redirect()->back();
    }   
}
