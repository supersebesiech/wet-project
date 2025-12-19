
@php
    $friendship = \App\Models\Friendship::where(function($q) use ($profiledata) {
        $q->where('user_id', auth()->user()->id)
        ->where('friend_id', $profiledata->id);
    })->orWhere(function($q) use ($profiledata) {
        $q->where('user_id', $profiledata->id)
        ->where('friend_id', auth()->user()->id);
    })->first();
@endphp

{{-- ACCEPT --}}
@if($friendship && $friendship->status === 'pending' && $friendship->friend_id === auth()->id())
    <button
        id="friend-btn"
        class="w3-button w3-green w3-round-xxlarge w3-margin-bottom"
        onclick="acceptFriend({{ $profiledata->id }})">
        Accept Friend
    </button>

{{-- UNFRIEND --}}
@elseif($friendship && $friendship->status === 'accepted')
    <button
        id="friend-btn"
        class="w3-button w3-red w3-round-xxlarge w3-margin-bottom"
        onclick="removeFriend({{ $profiledata->id }})">
        Unfriend
    </button>

{{-- REQUEST SENT --}}
@elseif($friendship && $friendship->status === 'pending')
    <button
        class="w3-button w3-grey w3-round-xxlarge w3-margin-bottom"
        disabled>
        Request Sent
    </button>

{{-- ADD FRIEND --}}
@else
    <button
        id="friend-btn"
        class="w3-button w3-black w3-round-xxlarge w3-margin-bottom"
        onclick="sendFriend({{ $profiledata->id }})">
        Add Friend
    </button>
@endif