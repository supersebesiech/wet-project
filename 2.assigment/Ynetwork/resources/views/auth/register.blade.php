<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div>
        {{-- Title --}}
        <div class="flex flex-col items-center">
            <h1>Ynetwork</h1>
            <h2>Log In to your account</h2>
        </div>

        {{-- Form --}}
        <form method="POST" action="/register">
            @csrf
            <div class="">
                <div class="">
                    <input id="email" name="email" required type="email" placeholder="Email">
                    <input id="email_confirmation" name="email_confirmation" required type="email" placeholder="Confirm email">
                    <x-form-error name="email"></x-form-error>
                    <input id="password" name="password" required type="password" placeholder="Create password">
                    <input id="password_confirmation" name="password_confirmation" required type="password" placeholder="Confirm password">
                    <x-form-error name="password"></x-form-error>
                </div>
                <div class="">
                    <button type="submit">Register</button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
