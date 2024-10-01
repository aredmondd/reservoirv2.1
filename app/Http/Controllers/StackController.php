<?php 

namespace App\Http\Controllers;

use App\Models\Stack;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StackController extends Controller {
    
    public function display(Request $request) {
        $userId = Auth::id();
    
        $userStacks = Stack::where('user_id', $userId)->get();

        return view('my-stacks', ['stacks' => $userStacks]);
    }

    public function store() {
        $attributes = request()->validate([
            'name' => 'required|max:50',
            'description' => 'required|max:90',
        ]);

        $attributes['user_id'] = Auth::id();

        $stack = Stack::create($attributes);
        $stackUrl = '/stack?fresh=true&id=' . $stack->id ;

        return redirect($stackUrl);
    }

    public function getStack(Request $request) {
        $stackId = request('id');

        if ($stackId == null) {
            abort(404);
        }

        $stack = Stack::find($stackId);

        if ($stack->user_id != Auth::id()) {
            abort(403);
        }

        return view('stack-view', ['stackTitle' => $stack->name, 'stackDescription' => $stack->description, 'fresh' => request('fresh') !== null ? true : false ]);
    }

    public function destroy() {
        $stackId = request('id');

        $stack = Stack::find($stackId);

        $stack->delete();

        return redirect('/stacks');
    }
}

?>
