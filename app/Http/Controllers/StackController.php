<?php 

namespace App\Http\Controllers;

use App\Models\Stack;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

class StackController extends Controller {
    
    public function display(Request $request) {
        $userId = Auth::id();
    
        $userStacks = Stack::where('user_id', $userId)->get();

        return view('my-stacks', ['stacks' => $userStacks]);
    }

    public function store(Request $request) {
        // dump($request->all());
        $attributes = request()->validate([
            'name' => 'required|max:50',
            'description' => 'required|max:90',
            'isPrivate' => 'required',
        ]);
        // dump($attributes);
        $attributes['user_id'] = Auth::id();
        $attributes['content'] = null;
        $attributes['isPrivate'] = ($attributes['isPrivate'] === 'private') ? true : false;
        
        // dd($attributes);
        $stack = Stack::create($attributes);
        $stackUrl = '/stack?fresh=true&id=' . $stack->id ;

        return redirect($stackUrl);
    }


    public function getStackContent(Request $request) {
        if ($request->input('id') != null) {
            $stack = Stack::find($request->input('id'));
            $content = Stack::find($request->input('id'))->content;

            // dd($stack, $content, $stack->name);

            return view('stack-view', ['stack' => $stack, 'content' => $content]);
        }

        return abort(404);
    }


    public function destroy() {
        $stackId = request('id');

        $stack = Stack::find($stackId);

        $stack->delete();

        return redirect('/stacks');
    }

    public function destoryContent(){

        $stackID= request('stackID');
        // get user
        $user = Auth::user();

        // stack
        $stack = Stack::find(request('stackID'));
        //  dd($stack);

        // Make sure the stack belongs to the authenticated user
        if (!$stack || $stack->user_id !== $user->id) {
            return redirect()->back();
        }

        $contentID = request('contentID');
        $content = $stack->content;

        // Loop through the content and remove the item with the matching ID
        $updatedContent = array_filter($content, function ($item) use ($contentID) {
            return $item['id'] !== $contentID;
        });

        $stack->content = array_values($updatedContent);

        $stack->save();

        return redirect()->back();
    }
}

?>
