<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Stack;

class UserController extends Controller {
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
        
        // dd($currentUser->id, $request->input('requested_user_id'));

        $request->validate([
            'requested_user_id' => 'required|integer|exists:users,id',
        ]);

        $requestedUserId = $request->input('requested_user_id');        
        $requestedUser =  User::find($requestedUserId);
        $currentFriends = $currentUser->current_friends ?? [];
        $requestedCurrentFriends = $requestedUser->current_friends ?? [];

        // dd($currentUser ,$requestedUser  );

        // add to current friends
        
        $alreadyFriends = in_array($requestedUserId, array_column($currentFriends, 'id'));

        if(!$alreadyFriends){
            $currentFriends[] = [
                'id' => $requestedUserId,
                'time' => now(),
            ];
            $requestedCurrentFriends[] = [
                'id' => $currentUser->id,
                'time' => now(),
            ];

            $currentUser->current_friends = $currentFriends;
            $currentUser->save(); 

            $requestedUser->current_friends = $requestedCurrentFriends;
            $requestedUser->save();

            // dd($requestedUser,$currentUser);
        }

        // remove from requests
        $pending = $currentUser->pending_friend_requests ?? [];

        $pending = array_filter($pending, function($request) use ($requestedUserId) {
            // return $request['requested_user_id'] !== $requestedUserId;
            return is_array($request) && isset($request['requested_user_id']) && $request['requested_user_id'] !== $requestedUserId;
        });


        $currentUser->pending_friend_requests = array_values($pending);
        $currentUser->save();        

        return redirect()->back();
    }

    // view list of friends

}
