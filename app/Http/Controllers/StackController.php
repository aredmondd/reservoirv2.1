<?php 

namespace App\Http\Controllers;

use App\Models\Stack;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StackController extends Controller {
    
    public function display(Request $request) {
        dd(Stack::all());
    }

    public function store() {
        $attributes = request()->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:255',
        ]);

        dd($attributes);

        $attributes['user_id'] = Auth::id();

        Stack::create($attributes);

        return redirect('/stack-test');
    }
}

?>
