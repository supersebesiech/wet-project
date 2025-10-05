document.addEventListener('DOMContentLoaded', function () {

    console.log("script running");

    const MAX_TITLE_LEN = 100;
    const MAX_POST_CHARS = 1000;
    const MAX_POST_WORDS = 200;

    const titleInput = document.querySelector('.newpost-header');
    const bodyInput = document.querySelector('.newpost-textarea');
    const form = document.querySelector('.newpost-content form');
    const errorContainer = document.querySelector('.error-messages');
    const postsContainer = document.getElementById('postsContainer');

    function getWordCount(str) {
        if (!str) return 0;
        return str.trim().split(/\s+/).filter(Boolean).length;
    }

    function setError(message) {
        errorContainer.innerHTML = `<p>${message}</p>`;
    }

    function clearError() {
        errorContainer.innerHTML = '';
    }


    titleInput.addEventListener('input', function () {
        if (this.value.length > MAX_TITLE_LEN) {
            this.value = this.value.slice(0, MAX_TITLE_LEN);
            setError(`Title cannot exceed ${MAX_TITLE_LEN} characters.`);
        } else {
            clearError();
        }
    });


    form.addEventListener('submit', function (e) {
        e.preventDefault();

        const title = titleInput.value.trim();
        const text = bodyInput.value.trim();
        const words = getWordCount(text);

        if (!title) {
            setError('Please add a title.');
            return;
        }

        if (text.length > MAX_POST_CHARS) {
            setError('Post is too long (too many characters).');
            return;
        }

        if (words > MAX_POST_WORDS) {
            setError('Post is too long (too many words).');
            return;
        }

        clearError();


        const newPost = document.createElement('div');
        newPost.classList.add('post');
        newPost.innerHTML = `
            <div class="post-profile">
                <img src="../Images/Placeholder_ProfilePictures/Placeholder_ProfilePic1.jpeg" alt="Profile picture of User">
                <div class="poster-username">My Name</div>
            </div>
            <div class="post-content">
                <div class="post-header">
                    ${title}<span class="post-time"> - just now</span>
                </div>
                <div>${text}</div>
            </div>
        `;


        const firstPost = postsContainer.querySelector('.post');
        if (firstPost) {
            postsContainer.insertBefore(newPost, firstPost);
        } else {
            postsContainer.append(newPost);
        }

        titleInput.value = '';
        bodyInput.value = '';
    });
});