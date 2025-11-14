<div class="w3-container w3-card w3-white w3-round-xlarge w3-margin"><br>
    <img src="../Images/Placeholder_ProfilePictures/Placeholder_ProfilePic2.jpeg" alt="Avatar"
        class="w3-left w3-circle w3-margin-right" style="width:60px">
    <span class="w3-right w3-opacity">- {{ $post->created_at->diffForHumans() }}</span>
    <h4 class="w3-left ">Username</h4><br><br>
    <hr class="w3-clear">
    <h4 class="w3-left w3-bold w3-margin-bottom">{{ $post->title }}</h2><br><br>
        <p class="w3-left-align">{{  $post->body }}</p>
        <div class="w3-container w3-right">
            <button class="w3-button w3-xlarge w3-margin-bottom w3-circle"
                onclick="window.location='{{ route('posts.edit', $post->id) }}'">
                <i class="fa fa-edit"></i>
            </button>


            <form action="{{ route('posts.destroy', $post->id) }}" method="post" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="w3-button w3-xlarge w3-margin-bottom w3-circle"
                    onclick="return confirm('Are you sure you want to delete this post?');">
                    <i class="fa fa-trash"></i>
                </button>
            </form>

        </div>
</div>