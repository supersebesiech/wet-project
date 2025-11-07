<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Post</title>
    <link rel="icon" type="image/x-icon" href="../../Images/Logo2.png">
    <link rel="stylesheet" href="{{ asset('css/GlobalStyle.css') }}">
    <link rel="stylesheet" href="{{ asset('css/PostStyle.css') }}">
    <link rel="stylesheet" href="{{ asset('css/LogoutPopupStyle.css') }}">
</head>

<header class="topbar">
    <img class="logo" src="../../Images/Logo2.png" alt="Logo">
    <form class="search-bar" role="search">
        <input type="text" placeholder="Search Profile">
        <button aria-label="Search"></button>
    </form>

    <nav>
        <a href="{{ route('user.profile') }}">My Profile</a>
        <img src="../../Images/Placeholder_ProfilePictures/Placeholder_ProfilePic1.jpeg" alt="User profile">
    </nav>
</header>



<h2 class="myposts">Edit my post</h2>
    <div class="posts-container" id="postsContainer">

        <div class="newpost">
           
            <div class="newpost-content">
                <form action="{{ route('posts.update', $post->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <label for="title">Title</label>
                    <input class="newpost-header" type="text" id="title" name="title" value="{{ $post->title }}" required><br>
                    <label for="body">Body</label>
                    <textarea class="newpost-textarea" name="body" id="body" rows="3" required>{{ $post->body }}</textarea><br>
                    <button type="submit" class="btn mt-3 btn-primary">Update Post</button>
                </form>
            </div>
        </div>
    </div>