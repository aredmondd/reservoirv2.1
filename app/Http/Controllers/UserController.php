<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function updateVisibility(Request $request)
    {
        $request->validate([
            'visibility' => 'required|in:public,private',
        ]);

        $user = auth()->user();

        $user->is_private = $request->input('visibility') === 'private';
        $user->save();

        return back()->with('status', 'visibility-updated');
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('query');

        if (empty($searchTerm)) {
            return view('search');
        }

        $users = User::where('is_private', false)
                      ->where(function ($query) use ($searchTerm) {
                          $query->where('name', 'LIKE', '%' . $searchTerm . '%')->orWhere('username', 'LIKE', '%' . $searchTerm . '%');
                      })
                      ->get();

        return view('search', compact('users'));
    }

    public function display(Request $request, $username) {
        $user = User::where('username', $username)->first();

        if ($user == User::find(Auth::id())) {
            return redirect('/dashboard');
        }

        dd($user);
    }
}
