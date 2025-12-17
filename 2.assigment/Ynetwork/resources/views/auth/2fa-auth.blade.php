<x-login-layout type="Enter your verification code">
    {{-- Form --}}
    <form method="POST" action="/login" class="pt-14  ">
        @csrf
        <div class="w3-container w3-center" style="max-width:400px; margin:auto;">
            <div class="w3-padding-large">
                <x-form-input class="w3-input w3-border w3-round-xxlarge w3-margin-bottom" id="code" name="code"
                              required type="text" placeholder="code"></x-form-input>

                <x-form-error name="code" class="w3-margin-bottom"></x-form-error>

                <button type="submit" class="w3-button w3-black w3-round-xxlarge w3-padding-large w3-block w3-margin-bottom">
                    Verify
                </button>
            </div>
        </div>

    </form>
</x-login-layout>
