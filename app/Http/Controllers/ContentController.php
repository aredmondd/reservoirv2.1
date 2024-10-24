<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Stack;

class ContentController extends Controller
{

    /**
     * add content to the user's watchlist
     * 
     * @access public
     * @author Aiden Redmond
     * @param Request $request
     * @return redirect
     */
    public function add_to_watchlist(Request $request) {
        $user = Auth::user();
        $watchlist = $user->watchlist;
    
        // if there is no content inside watchlist, make an empty array
        $watchlist_content = $watchlist->watchlist ?? [];

        // get information about content
        $content_id = $request->input('id');
        $content_type = $request->input('content_type');
        $content_details = $details = Http::asJson()->get(
            config('services.tmdb.endpoint') . $content_type . '/' . $content_id . 
            '?append_to_response=release_dates&api_key=' . config('services.tmdb.api')
        )->json();
        $content_name = ($content_type == 'movie') ? $content_details['title'] : $content_details['name'];
    
        // check if the content is inside the watchlist
        $content_in_watchlist = in_array($content_id, array_column($watchlist_content, 'id'));

        /**
         * if the content is not inside the watchlist, add it & save the watchlist.
         * if the content is inside the watchlist, throw an error.
         */
        if (!$content_in_watchlist) {
            $watchlist_content[] = [
                'id'          => $content_id,
                'time'        => now(),
                'name'        => $content_name,
                'contentType' => $content_type,
                'liked'       => false
            ];
            $watchlist->watchlist = $watchlist_content;
            $watchlist->save();

            return redirect()->back();
        } else {
            dump("Movie ID {$content_id} is already in watchlist.");

            return redirect()->back();
        }
    }  

    /**
     * add content to the user's history
     * 
     * @access public
     * @author Aiden Redmond
     * @param Request $request
     * @return redirect
     */
    public function add_to_history(Request $request) {
        $user = Auth::user();
        $history = $user->history;
    
        // if there is no content inside history, make an empty array
        $history_content = $history->history ?? [];

        // get information about content
        $content_id = $request->input('id');
        $content_type = $request->input('content_type');
        $content_details = $details = Http::asJson()->get(
            config('services.tmdb.endpoint') . $content_type . '/' . $content_id . 
            '?append_to_response=release_dates&api_key=' . config('services.tmdb.api')
        )->json();
        $content_name = ($content_type == 'movie') ? $content_details['title'] : $content_details['name'];
    
        // check if the content is inside the watchlist
        $content_in_history = in_array($content_id, array_column($history_content, 'id'));

        /**
         * if the content is not inside the history, add it & save the history.
         * if the content is inside the history, throw an error.
         */
        if (!$content_in_history) {
            $history_content[] = [
                'id'          => $content_id,
                'time'        => now(),
                'name'        => $content_name,
                'contentType' => $content_type,
                'liked'       => false
            ];
            $history->history = $history_content;
            $history->save();

            return redirect()->back();
        } else {
            dump("Movie ID {$content_id} is already in history.");

            return redirect()->back();
        }
    }  

    /**
     * add content to a user's stack
     * 
     * @access public
     * @author Aiden Redmond
     * @param Request $request
     * @return redirect
     */
    public function add_to_stack(Request $request) {
        dd($request->all());
        // get the user's stack
        $user = Auth::user();
        $stackId = $request->input('stack_id');
        $stack = Stack::findOrFail($stackId);

        // get the content id and type of content from the URL
        $content_id = $request->input('id');
        $content_type = $request->input('content_type');
    
        // check if the user sending the request is the owner of the stack
        $stack_owner_is_active_user = $stack->user_id === $user->id;

        /**
         * if the user is the stack's owner, add it to the stack requested
         * if the user is NOT the stack's owner, throw an error
         */
        if ($stack_owner_is_active_user) {
            $stack->add_to_stack($content_id, $content_type);

            return redirect()->back();
        } else {
            abort(403, "You don't have permission to modify this stack.");

            return redirect()->back();
        }
    }
}

// EOF