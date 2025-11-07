<x-login-layout type="Reset password">
    <form method="POST" action="/login" class="pt-14  ">
        @csrf
        <div class="flex flex-col items-center gap-5">
            <div class="flex flex-col gap-5">
                <x-form-input  id="email" name="email" required type="email" placeholder="Email"></x-form-input>
                <x-form-error name="email"></x-form-error>
            </div>
            <div class="flex flex-col gap-0.5">
                <button class="bg-black text-white rounded-full py-2 px-8" type="submit">Send</button>
            </div>
        </div>
    </form>
</x-login-layout>
