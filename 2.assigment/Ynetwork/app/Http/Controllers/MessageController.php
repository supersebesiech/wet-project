<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{

    public function sendMessage(Request $request)
    {
        $request->validate([
            'user_to' => 'required|exists:users,id',
            'message' => 'required|string|max:1000',
        ]);

        $message = Message::create([
            'user_from' => Auth::id(),
            'user_to' => $request->user_to,
            'message' => $request->message,
        ]);

        return response()->json($message, 201);
    }

    public function getChatHistory(Request $request)
    {
        $request->validate([
            'user' => 'required|integer|exists:users,id',
        ]);

        $authId = Auth::id();
        $userId = $request->query('user');

        $messages = Message::where(function ($query) use ($authId, $userId) {
            $query->where('user_from', $authId)->where('user_to', $userId);
        })->orWhere(function ($query) use ($authId, $userId) {
            $query->where('user_from', $userId)->where('user_to', $authId);
        })->orderBy('created_at', 'asc')->get();

        return response()->json([
            'status' => 'success',
            'data' => $messages
        ]);
    }

    public function getFriends()
    {
        $authId = Auth::id();

        $friends = \DB::table('friendships as f')   // ← FIXED HERE
        ->join('users as u', function ($join) use ($authId) {
            $join->on(function ($q) use ($authId) {
                $q->where('f.user_id', $authId)
                    ->whereColumn('f.friend_id', 'u.id');
            })
                ->orOn(function ($q) use ($authId) {
                    $q->where('f.friend_id', $authId)
                        ->whereColumn('f.user_id', 'u.id');
                });
        })
            ->where('f.status', 'accepted')
            ->select('u.id', \DB::raw("u.first_name || ' ' || u.last_name AS full_name"))
            ->get();

        return response()->json($friends);
    }



}
