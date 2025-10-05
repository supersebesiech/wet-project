document.addEventListener('DOMContentLoaded', function() {
    const profilePicture = document.querySelector('.topbar nav img');
    const popup = document.getElementById('logout-popup');
    const closeButton = document.getElementById('close-popup-btn');
    const logoutButton = document.getElementById('logout-btn');

    if (profilePicture && popup && closeButton && logoutButton) {
        profilePicture.addEventListener('click', function() {
            popup.style.display = 'flex';
        });

        closeButton.addEventListener('click', function() {
            popup.style.display = 'none';
        });

        logoutButton.addEventListener('click', function() {
            window.location.href = '../Login/Login.html';
        });
    }
});