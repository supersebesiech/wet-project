<div class="container">
    <div class="profile-card">
        {{ $user->profile_picture ?? $user->first_name }}" style="width:150px; height:150px; border-radius:50%;">
        <h2>{{ $user->first_name }} {{ $user->last_name }}</h2>
        <p>Email: {{ $user->email }}</p>
        <!-- Add more user details here -->
    </div>
</div>