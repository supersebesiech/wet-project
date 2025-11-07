<x-login-layout type="Log in to you profile">
    {{-- Form --}}
    <form method="POST" action="/login" class="pt-14  ">
        @csrf
        <div class="flex flex-col items-center gap-5">
            <div class="flex flex-col gap-5">
                <x-form-input  id="email" name="email" required type="email" placeholder="Email"></x-form-input>
                <x-form-error name="email"></x-form-error>
                <x-form-input  id="password" name="password" required type="password" placeholder="Password"></x-form-input>
                <x-form-error name="password"></x-form-error>
            </div>
            <div class="flex flex-col gap-0.5">
                <button class="bg-black text-white rounded-lg p-1" type="submit">Login</button>
                <a class="text-white" href="/reset" class="">Reset Password</a>
                <a class="text-white" href="/register" class="">Register</a>
            </div>
        </div>
    </form>
</x-login-layout>
