<x-login-layout type="{{ __('Reset password') }}">
    <form method="POST" action="/reset" class="pt-14">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <input type="hidden" name="email" value="{{ $email }}">
        <div class="flex flex-col items-center gap-5">
            <div class="flex flex-col gap-5">
                <x-form-input id="password" name="password" required type="password" placeholder="{{ __('Password') }}"></x-form-input>
                <x-form-input id="password_confirmation" name="password_confirmation" required type="password" placeholder="{{ __('Confirm password') }}"></x-form-input>
                <x-form-error name="password"></x-form-error>
            </div>
            <div class="w3-padding-large">
                <button class="w3-button w3-black w3-round-xxlarge w3-padding-large w3-block w3-margin-bottom" type="submit">{{ __('Send') }}</button>
            </div>
        </div>
    </form>

    <!-- Finding locale based on browser locale-->
    <script>
        document.documentElement.setAttribute('data-locale', '{{ session("locale") }}');
    </script>
    <script src="{{ asset('js/browser-locale-detection.js') }}"></script>
</x-login-layout>
