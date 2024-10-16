<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function display(Request $request) {
        $view = $request->input('view');

        if ($view == 'watchlist') {
            return view('dashboard', ['list' => Auth::user()->backlog->backlog]);
        }
        elseif ($view == 'history') {
            return view('dashboard', ['list' => Auth::user()->history->history]);
        }
        elseif ($view == null) {
            return view('dashboard', ['list' => Auth::user()->backlog->backlog]);
        }
        else {
            abort(404);
        }
    }
}
