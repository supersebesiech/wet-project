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
        // SORT POSTS DESCENDING BY CREATED_AT
        $posts = Post::all()->sortByDesc('created_at');
        return view('user.profile', compact('posts'), compact('profiledata'));
    }
}
