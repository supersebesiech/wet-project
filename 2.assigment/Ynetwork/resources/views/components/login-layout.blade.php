@props(['type'])


<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/5/w3.css">
    <link rel="preload" as="image" href="{{ asset('images/milkyway.jpg') }}">
    <style>
        .bg-cover-section {
            background-image: url('{{ asset('images/milkyway.jpg') }}');
            background-color: #0a0a1a;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            width: 100vw;
            height: 100vh;
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-cover-section w3-display-container w3-center">

    <div class="w3-overlay w3-display-container w3-show" style="pointer-events:none; background-color: transparent !important;">
        <div class="w3-display-middle">
            <svg width="200" height="200" viewBox="0 0 200 200">
                <g stroke-width="2" stroke="white" stroke-linejoin="round" fill="black" fill-rule="evenodd">
                    <polygon style="opacity: 0" id="path-1"
                        points="42,47 76,47 99,100 101,108 103,100 126,47 158,47 114,134 114,181 84,181 84,135">
                    </polygon>
                    <polygon style="opacity: 0" id="path-2"
                        points="100,56 118,90 152,108 118,126 100,160 82,126 48,108 82,90">
                    </polygon>

                </g>
            </svg>
        </div>
    </div>

   
    <div class="w3-container w3-display-middle w3-animate-opacity " style="opacity: 1" >
        <div class="w3-col w3-center animation-container">
            <h1 class="title-target w3-xxxlarge w3-row w3-bold"
                style="-webkit-text-stroke: 0.5px white;">Ynetwork</h1>
            <div class="formular-container">
            <h2 class="w3-row w3-xlarge w3-bold ">{{ $type }}</h2>

            {{ $slot }}
            </div>
        </div>
    </div>

    <footer class="w3-display-bottomleft w3-text-white w3-small">
        <p>&copy;2025 Ynetwork | Contact: y@network.com</p>
    </footer>

   

</body>



</html>