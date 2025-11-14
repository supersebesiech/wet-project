<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>For you page</title>
    <link rel="icon" type="image/x-icon" href="../Images/Logo2.png">
    <link rel="stylesheet" href="{{ asset('css/GlobalStyle.css') }}">
    <link rel="stylesheet" href="{{ asset('css/PostStyle.css') }}">
    <link rel="stylesheet" href="{{ asset('css/LogoutPopupStyle.css') }}">
    <link rel="stylesheet" href="{{ asset('css/SearchStyle.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<header class="topbar">
    <img class="logo" src="../Images/Logo2.png" alt="Logo">

    <!-- Search bar -->
    <div style="position: relative;">
        <input type="text" id="search" placeholder="Search users..." autocomplete="off" class="form-control">
        <div id="search-results" class="dropdown-menu show" style="width: 100%; display: none;"></div>
    </div>
    <script src="{{ asset('js/get-user-avatar.js') }}"></script>
    <script src="{{ asset('js/search-users.js') }}"></script>
    <!-- Search bar end -->

    <nav>
        <a href="{{ route('user.profile') }}">My Profile</a>
        <img class="avatar user-avatar" data-user-id="{{ auth()->user()->id }}" src="/profilePictures/{{ auth()->user()->id }}.png"
            alt="Profile picture of User"> <!-- Get user profile picture -->
    </nav>
</header>
<script src="../Scripts/LogoutPopup.js"></script>

<body>


    <h1>For you page</h1>

    <div id="logout-popup" class="logout-popup" style="display:none;">
        <div class="logout-popup-content">
            <button id="logout-btn" onclick="window.location.href='../Login/Login.html'; return false;">Logout</button>
            <button id="close-popup-btn">Cancel</button>
        </div>
    </div>


    <div class="posts-container" id="postsContainer">
        @foreach ($posts as $post)
            <div class="post">
                <div class="post-profile">
                    <img src="../Images/Placeholder_ProfilePictures/Placeholder_ProfilePic2.jpeg" alt="Poster profile">
                    <div class="poster-username">User</div>
                </div>
                <div class="post-content">
                    <div class="post-header">
                        {{ $post->title }}<span class="post-time"> - {{ $post->updated_at->diffForHumans() }}</span>
                    </div>
                    <div>
                        {{ $post->body }}
                    </div>

                </div>
            </div>


        @endforeach
    </div>
</body>

@include('components.chat-bar')

<footer>
    <p>&copy;2025 Ynetwork | Contact: y@network.com</p>
</footer>

</html>
