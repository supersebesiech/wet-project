<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;


class ProfileController extends Controller
{
    /**
     * Display posts for "Profile" page.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        $profiledata = auth()->user();

        $posts = Post::with('user')
            ->where('user_id', $profiledata->id)
            ->latest()
            ->get();

        return view('user.profile', compact('posts', 'profiledata'));
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
