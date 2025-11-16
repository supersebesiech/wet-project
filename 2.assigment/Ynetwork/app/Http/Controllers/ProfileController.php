<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Friendship;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class ProfileController extends Controller
{
    public function profile()
    {
        $profiledata = auth()->user();

        $incomingRequests = Friendship::where('friend_id', $profiledata->id)
            ->where('status', 'pending')
            ->get();

        $posts = Post::where('user_id', $profiledata->id)
            ->latest()
            ->get();

        return view('user.profile', compact('posts', 'profiledata', 'incomingRequests'));
    }
}
