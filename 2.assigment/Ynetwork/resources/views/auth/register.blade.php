<x-login-layout type="Create new profile">
    {{-- Form --}}
    <form method="POST" action="/login" class="pt-14  ">
        @csrf
        <div class="flex flex-col items-center gap-5">
            <div class="flex flex-col gap-5">
                <x-form-input id="first_name" name="first_name" type="text" required placeholder="First name"></x-form-input>
                <x-form-input id="last_name" name="last_name" type="text" required placeholder="Last name"></x-form-input>
                <x-form-input  id="email" name="email" required type="email" placeholder="Email"></x-form-input>
                <x-form-input id="email_confirmation" name="email_confirmation" required type="email" placeholder="Confirm email"></x-form-input>
                <x-form-error name="email"></x-form-error>
                <x-form-input  id="password" name="password" required type="password" placeholder="Password"></x-form-input>
                <x-form-input id="password_confirmation" name="password_confirmation" required type="password" placeholder="Confirm password"></x-form-input>
                <x-form-error name="password"></x-form-error>
                <x-form-input type="date"></x-form-input>
            </div>
            <div class="flex flex-col gap-0.5">
                <button class="bg-black text-white rounded-lg py-2 px-4" type="submit">Register</button>
            </div>
        </div>
    </form>
</x-login-layout>
