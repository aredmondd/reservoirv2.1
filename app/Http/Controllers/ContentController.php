<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Stack;
use Illuminate\Http\Client\Pool;

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
        $content_name = $request->input('name');
        $content_type = $request->input('content_type');
    
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

            return redirect()->back()->with('success', $content_name . ' added to watchlist');
        } else {
            return redirect()->back()->with('error', $content_name . ' is already in your watchlist');
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
        $content_name = $request->input('name');
        $content_type = $request->input('content_type');
    
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

            return redirect()->back()->with('success', $content_name . ' added to history');
        } else {
            return redirect()->back()->with('error', $content_name . ' is already in your history');
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

            return redirect()->back()->with('success', 'Content added to ' . $stack['name']);
        } else {
            return redirect()->back()->with('error', 'you do not have permission to add content to' . $stack['name'] . '... how did you get here?');
        }
    }
}

// EOF