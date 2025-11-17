<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Friendship;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class ProfileController extends Controller
{
    /**
     * Display posts for "Profile" page.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function profile()
    {
        $profiledata = auth()->user();
        $friends = $profiledata->friends()->get();

        $incomingRequests = Friendship::where('friend_id', $profiledata->id)
            ->where('status', 'pending')
            ->get();

        $posts = Post::with('user')
            ->where('user_id', $profiledata->id)
            ->latest()
            ->get();

        return view('user.profile', compact('posts', 'profiledata', 'incomingRequests', 'friends'));
    }

    public function editUser(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'bio' => ['nullable', 'string'],
        ]);

        $user->email = $validated['email'];
        $user->bio   = $validated['bio'];

        $user->save();

        return redirect('/profile');
    }
}
