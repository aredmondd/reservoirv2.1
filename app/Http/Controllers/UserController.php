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

    public function showProfileFavorites(Request $request){
        $user = Auth::user();

        $profile_fav = $user->profile_content_favorites;

        $profile_fav_content = $profile_fav ?? []; 

        $content_id = $request->input('id');
        $content_name = $request->input('name');
        $content_poster = $request->input('posterPath');

        $content_in_profile_fav = collect($profile_fav_content)->contains('id', $content_id);

        if(!$content_in_profile_fav && count($profile_fav_content) < 5){
            $profile_fav_content[] = [
                'id' => $content_id,
                'name' => $content_name,
                'posterPath' => $content_poster,
                'time' => now(),
            ];
        }else{
            return redirect()->back()->with('error', 'You can only have up to 5 items in your favorites.');
        }

        $user->profile_content_favorites = $profile_fav_content;
        $user->save();

        return redirect()->back()->with('success', 'You added ' . $content_name . ' to your profile. You have ' . 5 - count($profile_fav_content) . ' slots left');
        


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
            return view('friends');
        }

        $users = User::where('is_private', false)
                    ->where('id', '!=', auth()->id())
                    ->where(function ($query) use ($searchTerm) {
                        $query->where('name', 'LIKE', '%' . $searchTerm . '%')->orWhere('username', 'LIKE', '%' . $searchTerm . '%');
                    })
                    ->get();

        return view('friends', compact('users'));
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

            return view('user-profile/watchlist', ['user' => $user, 'watchlist' => $user->watchlist->watchlist ?? []]);
        }
        elseif ($profilePage == 'currently-watching') {

            return view('user-profile/currently-watching', ['user' => $user, 'currently_watching' => $user->currentlyWatching->currently_watching ?? []]);
        }
        elseif ($profilePage == 'history') {

            return view('user-profile/history', ['user' => $user, 'history' => $user->history->history ?? []]);
        }
    }

    public function sendFriendRequest(Request $request){
        $request->validate([
            'requested_user_id' => 'required|integer|exists:users,id',
        ]);

        $requestedUserId = $request->input('requested_user_id');
        $requestedUser =  User::find($requestedUserId);
        $currentUserID = auth()->user()['id'];

        if ($requestedUser->addFriendRequest($currentUserID)) {

            return redirect()->back(); 

        }

        return redirect()->back();


    }

    // view friend requests

    public function displayFriends (){
        $searchTerm = request()->input('query');

        if ($searchTerm != null) {
            if (empty($searchTerm)) {
                return view('friends');
            }
    
            $users = User::where('is_private', false)
                        ->where('id', '!=', auth()->id())
                        ->where(function ($query) use ($searchTerm) {
                            $query->where('name', 'LIKE', '%' . $searchTerm . '%')->orWhere('username', 'LIKE', '%' . $searchTerm . '%');
                        })
                        ->get();
    
            return view('friends', compact('users'));
        }

        $currentUser = Auth::user();

        $friendRequests = $currentUser->pending_friend_requests;
        $currentFriends = $currentUser->current_friends;

        return view ('friends',[
            'friendRequests' => $friendRequests,
            'currentFriends' => $currentFriends,
        ]);
    }

    public function acceptFriendRequest(Request $request){
        $currentUser = Auth::user();

        $request->validate([
            'requested_user_id' => 'required|integer|exists:users,id',
        ]);

        $requestedUserId = $request->input('requested_user_id');        
        $requestedUser =  User::find($requestedUserId);
        $currentFriends = $currentUser->current_friends ?? [];
        $requestedCurrentFriends = $requestedUser->current_friends ?? [];

        // add to current friends
        $alreadyFriends = in_array($requestedUserId, array_column($currentFriends, 'id'));

        if(!$alreadyFriends){
            $currentFriends[] = [
                'id' => (int) $requestedUserId,
                'time' => now(),
            ];
            $requestedCurrentFriends[] = [
                'id' => (int) $currentUser->id,
                'time' => now(),
            ];

            $currentUser->current_friends = $currentFriends;
            $currentUser->save(); 

            $requestedUser->current_friends = $requestedCurrentFriends;
            $requestedUser->save();

        }

        // remove from requests
        $pending = $currentUser->pending_friend_requests ?? [];

        $pending = array_filter($pending, function($request) use ($requestedUserId) {
            return isset($request['id']) && (int) $request['id'] !== (int) $requestedUserId;
        });
        
        $currentUser->pending_friend_requests = array_values($pending);
        $currentUser->save();        

        return redirect()->back();
    }

    public function declineFriendRequest(Request $request){
        $currentUser = Auth::user();

        $request->validate([
            'requested_user_id' => 'required|integer|exists:users,id',
        ]);

        $requestedUserId = $request->input('requested_user_id'); 
        $deleteRequests = $currentUser->pending_friend_requests ?? [];

        $deleteRequests = array_filter($deleteRequests, function($request) use ($requestedUserId) {
            return isset($request['id']) && (int) $request['id'] !== (int) $requestedUserId;
        });

        $currentUser->pending_friend_requests = array_values($deleteRequests);
        $currentUser->save();        

        return redirect()->back();

    }

    public function deleteFriend(Request $request) {
        $currentUser = Auth::user();
    
        $request->validate([
            'requested_user_id' => 'required|integer|exists:users,id',
        ]);
    
        $requestedUserId = $request->input('requested_user_id'); 
        $deleteRequests = $currentUser->current_friends ?? [];
        
        $deleteRequests = array_filter($deleteRequests, function($friend) use ($requestedUserId) {
            return isset($friend['id']) && (int) $friend['id'] !== (int) $requestedUserId;
        });
    
        $currentUser->current_friends = array_values($deleteRequests);
        $currentUser->save();
    
        $requestedUser = User::find($requestedUserId);
        $requestedFriends = $requestedUser->current_friends ?? [];
        
        $requestedFriends = array_filter($requestedFriends, function($friend) use ($currentUser) {
            return isset($friend['id']) && (int) $friend['id'] !== (int) $currentUser->id;
        });
    
        $requestedUser->current_friends = array_values($requestedFriends);
        $requestedUser->save();
    
        return redirect()->back();
    }
    

}
