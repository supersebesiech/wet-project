function sendFriend(id) {
    request(`/friend/send/${id}`, 'POST', id);
}

function acceptFriend(id) {
    request(`/friend/accept/${id}`, 'POST', id);
}

function removeFriend(id) {
    request(`/friend/remove/${id}`, 'DELETE', id);
}

function denyFriend(id) {
    request(`/friend/deny/${id}`, 'POST', id);
}

function request(url, method, userId) {
    fetch(url, {
        method: method,
        headers: {
            'X-CSRF-TOKEN': document
                .querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
        }
    })
    .then(res => res.json())
    .then(() => {
        loadFriends();
        reloadFriendButton(userId);
        reloadFriendRequests()
    })
    .catch(err => console.error(err));
}

function loadFriends() {
    fetch('/friend/list', {
        headers: { 'Accept': 'text/html' }
    })
    .then(res => res.text())
    .then(html => {
        document.getElementById('friends-list').innerHTML = html;
    });
}

function reloadFriendButton(userId) {
    fetch(`/friend/button/${userId}`, {
        headers: { 'Accept': 'text/html' }
    })
    .then(res => res.text())
    .then(html => {
        document.getElementById('friend-button').innerHTML = html;
    });
}

function reloadFriendRequests() {
    fetch('/friend/requests', {
        headers: { 'Accept': 'text/html' }
    })
    .then(res => res.text())
    .then(html => {
        document.getElementById('friend-requests').innerHTML = html;
    });
}
