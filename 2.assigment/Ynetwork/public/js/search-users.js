document.getElementById('search').addEventListener('input', function () {
    let query = this.value;

    if (query.length > 1) {
        fetch(`/search-users?query=${encodeURIComponent(query)}`)
            .then(response => response.json())
            .then(data => {
                let results = document.getElementById('search-results');
                results.innerHTML = '';
                results.style.display = data.length ? 'block' : 'none';

                data.forEach(user => {
                    let item = document.createElement('a');
                    item.classList.add('search-item');
                    item.href = `/users/${user.id}`;

                    let img = document.createElement('img');
                    img.src = user.profile_picture || '/images/default-avatar.jpg'; //Currently gets profile_picture from non-existend location. Default image is used to replace it

                    let name = document.createElement('span');
                    name.textContent = `${user.first_name} ${user.last_name}`

                    item.appendChild(img);
                    item.appendChild(name);
                    results.appendChild(item);
                });
            });
    } else {
        document.getElementById('search-results').style.display = 'none';
    }
});
