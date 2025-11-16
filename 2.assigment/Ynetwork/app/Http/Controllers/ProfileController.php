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

        if (!auth()->check()) {
        return redirect('/'); // redirect guests to homepage
    }

        $profiledata = auth()->user();
        // SORT POSTS DESCENDING BY CREATED_AT
        //$posts = Post::all()->sortByDesc('created_at');

        $posts = Post::with('user')
                 ->where('user_id', $profiledata->id)
                 ->latest()
                 ->get();

        return view('user.profile', compact('posts', 'profiledata'));

    }
}
