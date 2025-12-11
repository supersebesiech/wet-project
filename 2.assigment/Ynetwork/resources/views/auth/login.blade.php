<x-login-layout type="Log in to you profile">
    {{-- Form --}}
    <form method="POST" action="/" class="pt-14" id="login-form">
        @csrf
        <div class="w3-container w3-center" style="max-width:400px; margin:auto;">
            <div class="w3-padding-large">
                <x-form-input class="w3-input w3-border w3-round-xxlarge w3-margin-bottom" id="email" name="email"
                    required type="email" placeholder="Email"></x-form-input>

                <x-form-error name="email" class="w3-margin-bottom"></x-form-error>

                <x-form-input class="w3-input w3-border w3-round-xxlarge w3-margin-bottom" id="password" name="password"
                    required type="password" placeholder="Password"></x-form-input>

                <x-form-error name="password" class="w3-margin-bottom"></x-form-error>

                <div id="error-message" class="w3-text-red w3-margin-bottom" style="display: none;"></div>

                <button type="submit" class="w3-button w3-black w3-round-xxlarge w3-padding-large w3-block w3-margin-bottom">
                    Login
                </button>
                <hr class="w3-border-black w3-margin" style="border-width:2px;">
                <a class="w3-button w3-black w3-round-xxlarge w3-padding-large w3-block w3-margin-bottom"
                    href="/reset-request">
                    Reset Password
                </a>

                <a class="w3-button w3-black w3-round-xxlarge w3-padding-large w3-block" href="/register">
                    Register
                </a>
            </div>
        </div>
    </form>

    <script>
        document.getElementById('login-form').addEventListener('submit', function(e) {
            e.preventDefault(); 
            
            const formData = new FormData(this);
            
            fetch('/', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(data => {
                        throw data;
                    });
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    console.log("Login successful, starting animation");
                    startAnimation();
                    
                    const animationDuration = 5000;
                    let animationDone = false;
                    let dataReady = false;

                    setTimeout(() => {
                        console.log("Animation done timer finish...");
                        animationDone = true;
                        tryRedirect();
                    }, animationDuration);

                    fetch('/prepare-foryou')
                        .then(res => res.json())
                        .then(() => {
                            console.log("Backend data preparation done...");
                            dataReady = true;
                            tryRedirect();
                        });

                    function tryRedirect() {
                        console.log("Trying to redirect...");
                        if (animationDone && dataReady) {
                            console.log("Redirecting to /for-you");
                            window.location.href = '/for-you';
                        }
                    }
                }
            })
            .catch(error => {
                console.error('Login error:', error);
                const errorDiv = document.getElementById('error-message');
                if (error.errors && error.errors.password) {
                    errorDiv.textContent = error.errors.password[0];
                } else if (error.message) {
                    errorDiv.textContent = error.message;
                } else {
                    errorDiv.textContent = 'An error occurred during login.';
                }
                errorDiv.style.display = 'block';
            });
        });
    </script>
</x-login-layout>