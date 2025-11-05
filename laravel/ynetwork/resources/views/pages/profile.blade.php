<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>My Profile</title>
    <link rel="icon" type="image/x-icon" href="../Images/Logo2.png">
    <link rel="stylesheet" href="{{ asset('css/GlobalStyle.css') }}">
    <link rel="stylesheet" href="{{ asset('css/PostStyle.css') }}">
    <link rel="stylesheet" href="{{ asset('css/NewPostStyle.css') }}">
    <link rel="stylesheet" href="{{ asset('css/LogoutPopupStyle.css') }}">

    <link rel="stylesheet" href="{{ asset('css/ProfileStyle.css') }}">

</head>

<header class="topbar">
    <img class="logo" src="../Images/Logo2.png" alt="Logo">

    <form class="search-bar" role="search">
        <input type="text" placeholder="Search Profile">
        <button aria-label="Search"></button>
    </form>

    <nav>
        <a href="{{ route('foryou') }}">Home</a>
        <img src="../Images/Placeholder_ProfilePictures/Placeholder_ProfilePic1.jpeg" alt="User profile">
    </nav>

</header>
<script src="../Scripts/LogoutPopup.js"></script>

<body>
    <h1>My Profile</h1>

    <aside class="userprofile" aria-labelledby="user-name">

        <img class="avatar" src="../Images/Placeholder_ProfilePictures/Placeholder_ProfilePic1.jpeg"
            alt="Profile picture of User">


        <section class="profile-info">

            <input id="user-name" type="text" value="Max Mustermann"><br>

            <div class="bio" contenteditable="true">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed laoreet
                justo et vestibulum pharetra. Morbi semper tincidunt risus nec scelerisque. Cras mattis lobortis
                pharetra. Mauris faucibus libero velit, eu gravida nunc pellentesque nec. Phasellus mollis enim vitae
                ultrices mattis. Quisque lacinia nibh ac laoreet egestas. Vestibulum ante ipsum primis in.</div>

            <dl class="stats">
                <div>
                    <dt>Birthday</dt>
                    <dd>January 1, 1990</dd>
                </div>
                <div>
                    <dt>Email:</dt>
                    <dd>maxmuster@gmail.com</dd>
                </div>
                <div>
                    <dt>Joined on:</dt>
                    <dd>May 6, 1984</dd>
                </div>
            </dl>

            <button type="button">Save Profile</button>
        </section>
    </aside>
    <div id="logout-popup" class="logout-popup" style="display:none;">
        <div class="logout-popup-content">
            <button id="logout-btn" onclick="window.location.href='../Login/Login.html'; return false;">Logout</button>
            <button id="close-popup-btn">Cancel</button>
        </div>
    </div>
    <h2 class="myposts">My Posts</h2>
    <div class="posts-container" id="postsContainer">

        <div class="newpost">
            <div class="newpost-profile">
                <img src="../Images/Placeholder_ProfilePictures/Placeholder_ProfilePic1.jpeg"
                    alt="Profile picture of User">
                <div class="newposter-username">My Name</div>
            </div>
            <div class="newpost-content">
                <form action = "{{ route('posts.store') }}" method="post">
                    @csrf

                    <input class="newpost-header" type="text" placeholder="Post Title" id="title" name="title" required><br>
                    <textarea class="newpost-textarea" name="content" id="content" rows="3" required
                        placeholder="What do you wanna post about?"></textarea><br>
                    <input class="newpost-submit" type="submit" value="Post">
                </form>
            </div>

            <script src="../Scripts/PostScript.js"></script>
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
                            {{ $post->title }}<span class="post-time"> - {{ $post->created_at->diffForHumans() }}</span>

                        </div>
                        <div>
                            {{ $post->content }}
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-sm">
                                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                </div>
                                <div class="col-sm">
                                    <form action="{{ route('posts.destroy', $post->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            @endforeach
        </div>
    </div>


    </div>

</body>

</html>