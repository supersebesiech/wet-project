<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Friendship;

class FriendshipController extends Controller
{
    // Send friend request
    public function send($friendId)
    {
        $exists = Friendship::where('user_id', auth()->id())
            ->where('friend_id', $friendId)
            ->exists();

        if ($exists) {
            return back()->with('error', 'Already sent or friends');
        }

        Friendship::create([
            'user_id' => auth()->id(),
            'friend_id' => $friendId,
            'status' => 'pending'
        ]);

        return back()->with('success', 'Friend request sent');
    }


    // Accept friend request
    public function accept($relationId)
    {
        $relation = Friendship::findOrFail($relationId);

        if ($relation->friend_id !== auth()->id()) {
            abort(403);
        }

        $relation->update(['status' => 'accepted']);

        return back()->with('success', 'Friend request accepted');
    }


    // Remove or unfriend
    public function remove($relationId)
    {
        $relation = Friendship::findOrFail($relationId);

        if ($relation->user_id !== auth()->id() && $relation->friend_id !== auth()->id()) {
            abort(403);
        }

        $relation->delete();

        return back()->with('success', 'Friend removed');
    }
}
