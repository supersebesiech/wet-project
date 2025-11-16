<aside class="w3-card w3-round-large w3-padding w3-light-grey w3-margin w3-center" aria-labelledby="user-name"
    style="max-width:400px; margin:auto;">
    <h3 class="w3-xxlarge w3-bold">My Profile</h3>
    <!-- Profile Picture -->
    <img class="w3-circle w3-border w3-margin-bottom " src="{{ $profiledata->profile_picture }}"
        alt="Profile picture of User" style="width:150px; height:150px; object-fit:cover;">

    <!-- Profile Info -->
    <section class="w3-container w3-padding-small">
        <form method="POST" action="/edit">
            @csrf
            <!-- User Name -->
            <input id="user-name" class="w3-input w3-round-xxlarge w3-margin-bottom w3-center" type="text"
                value="{{ $profiledata->first_name }} {{ $profiledata->last_name }}" disabled>

            <!-- Bio -->
            @can('update', $profiledata)
                <textarea id="bio" name="bio" class="w3-border w3-round-large w3-padding-small w3-white w3-margin-bottom">
                                        {{ $profiledata->bio }}
                                    </textarea>
            @else
                <textarea disabled id="bio" name="bio"
                    class="w3-border w3-round-large w3-padding-small w3-white w3-margin-bottom">
                                    {{ $profiledata->bio }}
                                    </textarea>
            @endcan

            <!-- Stats -->
            <dl class="w3-container w3-small w3-text-dark-grey w3-margin-bottom" style="text-align:left;">
                @can('update', $profiledata)
                    <div class="w3-row-padding w3-margin-bottom">
                        <dt class="w3-col s5 w3-text-black">Email:</dt>
                        <input id="email" name="email" class="w3-col s7" value="{{ $profiledata->email }}">
                    </div>
                @endcan

                @can('update', $profiledata)
                    <div class="w3-row-padding w3-margin-bottom">
                        <dt class="w3-col s5 w3-text-black">Birthday:</dt>
                        <dd class="w3-col s7">{{ $profiledata->birthdate->format('d. F Y') }}</dd>
                    </div>
                @endcan

                <div class="w3-row-padding">
                    <dt class="w3-col s5 w3-text-black">Joined on:</dt>
                    <dd class="w3-col s7">{{ $profiledata->created_at->format('d. F Y') }}</dd>
                </div>
            </dl>

            <!-- Save Button -->
            @can('update', $profiledata)
                <button type="submit" class="w3-button w3-black w3-round-xxlarge w3-margin-top">
                    Save
                </button>
            @endcan
        </form>
        @if (auth()->user()->is_admin)
            <form action="{{ route('users.destroy', $profiledata) }}" method="post" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w3-button w3-black w3-round-xxlarge w3-margin-top"
                        onclick="return confirm('Are you sure you want to delete this profile?');">
                        Delete this profile <i class="fa fa-trash"></i>
                    </button>
                </form>
        </button>
        @endif
    </section>
</aside>