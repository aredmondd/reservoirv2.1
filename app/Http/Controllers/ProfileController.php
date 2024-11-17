<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    /**
     * Show the form for editing the user's profile picture.
     */
    public function editProfilePicture()
    {
        $user = Auth::user();
        return view('profile.edit-picture', compact('user'));
    }

    /**
     * Update the user's profile picture.
     */
    public function updateProfilePicture(Request $request)
    {
        $request->validate([
            'profile_picture' => 'nullable|image|max:2048', // Max 2MB
        ]);

        $user = Auth::user();

        if ($request->hasFile('profile_picture')) {
            // Delete old profile picture if exists
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }

            // Store the new profile picture
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');

            // Update user's profile_picture path
            $user->update(['profile_picture' => $path]);
        }

        return redirect()->back()->with('success', 'Profile picture updated successfully.');
    }

    public function deleteProfilePicture(Request $request) {
        $user = Auth::user();

        if ($user->profile_picture) {
            // Delete the profile picture from storage
            Storage::disk('public')->delete($user->profile_picture);

            // Remove the profile picture path from the user record
            $user->update(['profile_picture' => null]);

            return redirect()->back()->with('success', 'Profile picture deleted successfully.');
        }

        return redirect()->back()->with('error', 'No profile picture to delete.');
    }

    // remove favorite content from profile
    public function deleteContent (Request $request){
        $user = Auth::user();

        $content_id = $request->input('id');
        $content_name = $request->input('name');
        $fav_content = $user->profile_content_favorites ?? [];

        $fav_content = array_filter($fav_content, function ($content) use ($content_id) {
            return $content['id'] != $content_id; 
        });

        $user->profile_content_favorites = array_values($fav_content);
        $user->save();

        return redirect()->back()->with('success', '' . $content_name . ' was deleted from profile favorites.');

    }
}
