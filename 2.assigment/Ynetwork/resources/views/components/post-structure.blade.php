@props(['showActions' => true])
<div class="w3-container w3-card w3-white w3-round-xlarge w3-margin"
     data-post-id="{{ $post->id }}"><br>
    <img src="{{ asset($post->user->profile_picture) }}" alt="Avatar" class="w3-left w3-circle w3-margin-right"
        style="width:60px">
    <span class="w3-right w3-opacity">- {{ $post->created_at->diffForHumans() }}</span>
    <a href="{{ route('users.show', $post->user->id) }}">
        <h4 class="w3-left w3-hover-text-grey">{{ $post->user->first_name}} {{  $post->user->last_name }}</h4><br><br>
    </a>
    <hr class="w3-clear">
    <h4 class="w3-left w3-bold w3-margin-bottom">{{ $post->title }}</h2><br><br>
        <p class="w3-left-align">{{  $post->body }}</p>


        <div class="w3-container w3-right">
            @if ($showActions)
                <button class="w3-button w3-xlarge w3-margin-bottom w3-circle"
                    onclick="window.location='{{ route('posts.edit', $post->id) }}'">
                    <i class="fa fa-edit"></i>
                </button>
            @endif

            @if ($showActions || auth()->user()->is_admin)
                <button class="w3-button w3-xlarge w3-margin-bottom w3-circle"
                        onclick="deletePost({{ $post->id }})">
                    <i class="fa fa-trash"></i>
                </button>
            @endif

        </div>

        <script>
            async function deletePost(postId) {
                if (!confirm('Are you sure you want to delete this post?')) return;

                const response = await fetch(`/posts/${postId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    }
                });

                if (!response.ok) return;

                document.querySelector(`[data-post-id="${postId}"]`)?.remove();
            }
        </script>

</div>
