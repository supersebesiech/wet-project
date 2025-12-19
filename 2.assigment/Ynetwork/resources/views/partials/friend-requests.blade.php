<div id="friend-requests">
    @forelse($friendRequests as $request)
        <div class="w3-card w3-light-grey w3-round-xlarge w3-margin-bottom w3-padding-small"
             id="friend-request-{{ $request->id }}">

        <strong>{{ $request->sender->first_name }} {{ $request->sender->last_name }}</strong>
        
        <div>
            <img src="{{ asset($request->sender->profile_picture) }}"
                    class="w3-circle"
                    style="width:48px; height:48px; object-fit:cover;">

            <button
                class="w3-button w3-green w3-round-xxlarge"
                onclick="acceptFriend({{ $request->sender->id }})">
                Accept
            </button>

            <button
                class="w3-button w3-red w3-round-xxlarge"
                onclick="denyFriend({{ $request->sender->id }})">
                Deny
            </button>
        </div>
        </div>
    @empty
        <p class="w3-small w3-text-grey">No friend requests at the moment.</p>
    @endforelse
</div>
