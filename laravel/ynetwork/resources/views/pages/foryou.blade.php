<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>For you page</title>
    <link rel="icon" type="image/x-icon" href="../Images/Logo2.png">
    <link rel="stylesheet" href="{{ asset('css/GlobalStyle.css') }}">
    <link rel="stylesheet" href="{{ asset('css/PostStyle.css') }}">
    <link rel="stylesheet" href="{{ asset('css/LogoutPopupStyle.css') }}">
</head>

<header class="topbar">
    <img class="logo" src="../Images/Logo2.png" alt="Logo">
    <form class="search-bar" role="search">
        <input type="text" placeholder="Search Profile">
        <button aria-label="Search"></button>
    </form>

    <nav>
        <a href="{{ route('profile') }}">My Profile</a>
        <img src="../Images/Placeholder_ProfilePictures/Placeholder_ProfilePic1.jpeg" alt="User profile">
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
                        {{ $post->content }}
                    </div>
                    
                </div>
            </div>


        @endforeach
    </div>
</body>
<footer>
    <p>&copy;2025 Ynetwork | Contact: y@network.com</p>
</footer>

</html>