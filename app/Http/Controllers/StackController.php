<?php 

namespace App\Http\Controllers;

use App\Models\Stack;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StackController extends Controller {
    
    public function display(Request $request) {
        $userId = Auth::id();
    
        $userStacks = Stack::where('user_id', $userId)->get();
    
        return response()->json($userStacks);
    }

    public function store() {
        $attributes = request()->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:255',
        ]);

        $attributes['user_id'] = Auth::id();

        Stack::create($attributes);

        return redirect('/stacks');
    }

    public function movie(){
        $attributes = request()->validate([
            'title' => 'requried|max:255',
            'poster_path' => 'requried|max:255',
            'description' => 'requried',
            'stack_id' => 'required|exists:stacks,id'
        ]);

        Movie::create($attributes);

        return redirect('/stack');
    }

}

?>
