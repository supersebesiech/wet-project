@if ($friends->count())
    @foreach ($friends as $friend)
        <div class="w3-card w3-round-xlarge w3-padding-small w3-border-bottom w3-margin-bottom"
             style="display:flex; align-items:center; gap:12px;">

            <img src="{{ asset($friend->profile_picture) }}"
                 class="w3-circle"
                 style="width:48px; height:48px; object-fit:cover;">

            <a href="{{ route('users.show', $friend->id) }}"
               class="w3-text-black"
               style="text-decoration:none; font-weight:600;">
                {{ $friend->first_name }} {{ $friend->last_name }}
            </a>
        </div>
    @endforeach
@else
    <p class="w3-small w3-text-grey">No friends yet.</p>
@endif
