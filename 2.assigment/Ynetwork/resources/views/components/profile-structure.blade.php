
                <aside class="w3-card w3-round-large w3-padding w3-light-grey w3-margin w3-center"
                    aria-labelledby="user-name" style="max-width:400px; margin:auto;">
                    <h3 class="w3-xxlarge w3-bold">My Profile</h3>
                    <!-- Profile Picture -->
                    <img class="w3-circle w3-border w3-margin-bottom "
                        src="../Images/Placeholder_ProfilePictures/Placeholder_ProfilePic1.jpeg"
                        alt="Profile picture of User" style="width:150px; height:150px; object-fit:cover;">

                    <!-- Profile Info -->
                    <section class="w3-container w3-padding-small">

                        <!-- User Name -->
                        <input id="user-name" class="w3-input w3-round-xxlarge w3-margin-bottom w3-center"
                            type="text" value="{{ $profiledata->first_name }} {{ $profiledata->last_name }}" disabled>

                        <!-- Bio -->
                        <div class="w3-border w3-round-large w3-padding-small w3-white w3-margin-bottom"
                            contenteditable="true" disabled style="min-height:60px;">
                            {{ $profiledata->bio }}
                        </div>

                        <!-- Stats -->
                        <dl class="w3-container w3-small w3-text-dark-grey w3-margin-bottom" style="text-align:left;">
                            <div class="w3-row-padding w3-margin-bottom">
                                <dt class="w3-col s5 w3-text-black">Birthday:</dt>
                                <dd class="w3-col s7">{{ $profiledata->birthdate->format('d. F Y') }}</dd>
                            </div>

                            <div class="w3-row-padding w3-margin-bottom">
                                <dt class="w3-col s5 w3-text-black">Email:</dt>
                                <dd class="w3-col s7">{{ $profiledata->email }}</dd>
                            </div>

                            <div class="w3-row-padding">
                                <dt class="w3-col s5 w3-text-black">Joined on:</dt>
                                <dd class="w3-col s7">{{ $profiledata->created_at->format('d. F Y') }}</dd>
                            </div>
                        </dl>

                        <!-- Save Button -->
                        <button type="button" class="w3-button w3-black w3-round-large w3-margin-top">
                            Edit Profile
                        </button>
                    </section>
                </aside>
           