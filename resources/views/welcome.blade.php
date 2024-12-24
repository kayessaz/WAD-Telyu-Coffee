<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Tel-U Coffee</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite('resources/css/app.css')

    <style>
        /* Freeze the header and set the background to transparent */
        .header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 50;
            background-color: rgba(255, 255, 255, 0.6); /* Semi-transparent white */
            backdrop-filter: blur(10px); /* Optional: adds a blur effect to the background */
            transition: background-color 0.3s ease; /* Smooth transition for background change */
        }

        /* Add padding to the body to prevent content from hiding behind the fixed header */
        body {
            padding-top: 80px; /* Adjust based on header height */
        }
    </style>
</head>

<body class="antialiased">
    <div class="bg-white">
        <header class="header">
            <nav class="flex items-center justify-between p-6 lg:px-8 text-black" aria-label="Global">
                <div class="flex lg:flex-1">
                </div>
                <div class="hidden lg:flex lg:gap-x-12">
                    <a href="https://www.instagram.com/telu.coffee/" class="text-sm font-semibold leading-6 text-black">Instagram</a>
                    <a href="https://maps.app.goo.gl/vaQnA2jHRaGjMYZ18" class="text-sm font-semibold leading-6 text-black">Location</a>
                    <a href="https://youtu.be/YdKf5KSqQX8?si=mjq5lUidjRpsqPX4" class="text-sm font-semibold leading-6 text-black">About</a>
                    @auth
                    <a href="{{ route('reviews.index') }}" class="text-sm font-semibold leading-6 text-black">Add Review</a>
                    @else
                    <a href="{{ route('login', ['redirect' => 'add-review']) }}" class="text-sm font-semibold leading-6 text-black">Add Review</a>
                    @endauth

                </div>
                <div class="hidden lg:flex lg:flex-1 lg:justify-end">
                    <a href="{{ route('login') }}" class="text-sm font-semibold leading-6 text-black">Log in <span aria-hidden="true">&rarr;</span></a>
                </div>
            </nav>
        </header>

        <div class="hero min-h-screen relative" style="background-image: url('{{ asset('photos/telyucoffee-1.jpg') }}'); background-size: cover; background-position: center;">
            <!-- Overlay with reduced opacity for the background image -->
            <div class="hero-overlay bg-black bg-opacity-60 absolute inset-0"></div>

            <div class="text-center text-white absolute inset-0 flex items-center justify-center">
                <div class="max-w-screen-xl mx-auto">
                    <h1 class="mb-5 text-5xl font-bold">Welcome to Tel-U Coffee!</h1>
                    <p class="mb-5">Jl. Telekomunikasi No.1, Sukapura, Kec. Dayeuhkolot, Kabupaten Bandung</p>
                    <div class="mt-5">
                        <a href="{{ route('login') }}" class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow">Order Now</a>
                        <a href="{{ route('register') }}" class="ml-3">Register Now</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>

</html>
