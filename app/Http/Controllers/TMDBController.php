<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class TMDBController extends Controller
{
    public function demo(){

        $tmdb_id = 436270;

        $data = Http::asJson()
            ->get(config('services.tmdb.endpoint').'movie/'.$tmdb_id. '?api_key='.config('services.tmdb.api'));
        return view('demo',compact('data'));
    }
}
