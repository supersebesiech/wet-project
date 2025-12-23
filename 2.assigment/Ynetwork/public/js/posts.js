function createPost(form) {
    const formData = new FormData(form);

    fetch('/posts', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document
                .querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
        },
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        document
            .getElementById('posts-container')
            .insertAdjacentHTML('afterbegin', data.html);

        form.reset();
    })
    .catch(err => console.error(err));
}

function deletePost(postId) {
    if (!confirm('Are you sure you want to delete this post?')) return;

    fetch(`/posts/${postId}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document
                .querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
        }
    })
    .then(() => {
        document
            .querySelector(`[data-post-id="${postId}"]`)
            ?.remove();
    })
    .catch(err => console.error(err));
}

