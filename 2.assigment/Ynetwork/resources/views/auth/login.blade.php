<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="gap-3">
        {{-- Title --}}
        <div class="flex flex-col items-center">
            <h1>Ynetwork</h1>
            <h2>Log In to your account</h2>
        </div>

        {{-- Form --}}
        <form method="POST" action="/login">
            @csrf
            <div class="flex flex-col">
                <div class="">
                    <input id="email" name="email" required type="email" placeholder="Email">
                    <x-form-error name="email"></x-form-error>
                    <input id="password" name="password" required type="password" placeholder="Password">
                    <x-form-error name="password"></x-form-error>
                </div>
                <div class="">
                    <button type="submit">Login</button>
                    <a href="/reset" class="">Reset Password</a>
                    <a href="/register" class="">Register</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
