<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Stack;

class UserController extends Controller {
    public function show_my_profile(Request $request) {
        $user = Auth::user();
        $watchlist = $user->watchlist;
        $history = $user->history;
        $currently_watching = $user->currentlyWatching;

        $history_content = $history->history ?? [];
        $watchlist_content = $watchlist->watchlist ?? [];
        $currently_watching_content = $currently_watching->currently_watching ?? [];

        for ($i = 0; $i < count($history_content); $i++) {
            $history_content[$i]['action'] = 'history';
        }
        for ($i = 0; $i < count($watchlist_content); $i++) {
            $watchlist_content[$i]['action'] = 'watchlist';
        }
        for ($i = 0; $i < count($currently_watching_content); $i++) {
            $currently_watching_content[$i]['action'] = 'currently_watching';
        }

        $entries = array_merge($history_content, $watchlist_content, $currently_watching_content);

        // sort the entries array from oldest to newest
        usort($entries, fn($a, $b) => $b['time'] <=> $a['time']);

        if ($watchlist == null) {
            $numWatchlisted = 0;
        }
        else {
            $numWatchlisted = count($watchlist_content);
        }

        if ($history == null) {
            $numWatched = 0;
        }
        else {
            $numWatched = count($history_content);
        }

        $numMovies = 0;
        $numShows = 0;

        $numMoviesWatchlisted = 0;
        $numShowsWatchlisted = 0;

        $totalTimeWatched = 0;

        if ($numWatched != 0) {
            foreach($history_content as $content) {
                if ($content['contentType'] == 'movie') {
                    $numMovies += 1;
                }
                elseif ($content['contentType'] == 'tv') {
                    $numShows += 1;
                }
            }
        }
        
        if ($numWatchlisted != 0) {
            foreach($watchlist_content as $content) {
                if ($content['contentType'] == 'movie') {
                    $numMoviesWatchlisted += 1;
                }
                elseif ($content['contentType'] == 'tv') {
                    $numShowsWatchlisted += 1;
                }
            }
        }

        $totalContent = $numMovies + $numShows;
        $moviePercentage = $totalContent > 0 ? ($numMovies / $totalContent) * 100 : 0;
        $showPercentage = $totalContent > 0 ? ($numShows / $totalContent) * 100 : 0;

        $totalContentWatchlisted = $numMoviesWatchlisted + $numShowsWatchlisted;
        $moviePercentageWatchlisted = $totalContentWatchlisted > 0 ? ($numMoviesWatchlisted / $totalContentWatchlisted) * 100 : 0;
        $showPercentageWatchlisted = $totalContentWatchlisted > 0 ? ($numShowsWatchlisted / $totalContentWatchlisted) * 100 : 0;

        return view('profile', compact('user', 'numWatchlisted', 'numWatched', 'numMovies', 'numShows', 'numMoviesWatchlisted', 'numShowsWatchlisted', 'totalContent', 'moviePercentage', 'showPercentage', 'totalContentWatchlisted', 'moviePercentageWatchlisted', 'showPercentageWatchlisted', 'entries'));
    }

    public function updateVisibility(Request $request) {
        $request->validate([
            'visibility' => 'required|in:public,private',
        ]);

        $user = auth()->user();

        $user->is_private = $request->input('visibility') === 'private';
        $user->save();

        return back()->with('status', 'visibility-updated');
    }

    public function search(Request $request) {
        $searchTerm = $request->input('query');

        if (empty($searchTerm)) {
            return view('search');
        }

        $users = User::where('is_private', false)
                    ->where('id', '!=', auth()->id())
                    ->where(function ($query) use ($searchTerm) {
                        $query->where('name', 'LIKE', '%' . $searchTerm . '%')->orWhere('username', 'LIKE', '%' . $searchTerm . '%');
                    })
                    ->get();

        return view('search', compact('users'));
    }

    public function display(Request $request, $username) {
        $user = User::where('username', $username)->first();

        // if user wasn't found
        if ($user == null) {
            abort(404);
        }

        // if user is private
        if ($user->is_private == true) {
            abort(403);
        }

        // if user is trying to view themselves
        if ($user == User::find(Auth::id())) {
            return redirect('/dashboard');
        }

        $profilePage = request()->segment(3);

        if ($profilePage == null) {
            return view('user-profile/index', ['user' => $user]);
        }
        elseif ($profilePage == 'stacks') {
            return view('user-profile/stacks', ['user' => $user, 'stacks' => $user->stack->toArray()]);
        }
        elseif ($profilePage == 'watchlist') {

            return view('user-profile/watchlist', ['user' => $user, 'watchlist' => $user->watchlist->watchlist]);
        }
        elseif ($profilePage == 'currently-watching') {

            return view('user-profile/currently-watching', ['user' => $user, 'currently_watching' => $user->currentlyWatching->currently_watching]);
        }
        elseif ($profilePage == 'history') {

            return view('user-profile/history', ['user' => $user, 'history' => $user->history->history]);
        }
        elseif ($profilePage == 'journal') {

            return view('user-profile/journal', ['user' => $user]);
        }
    }

    public function watchlist(Request $request) {

    }

    public function history(Request $request) {
        
    }

    public function stacks(Request $request) {
        
    }

    public function diary(Request $request) {
        
    }

}
