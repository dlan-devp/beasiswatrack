<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-gradient-to-r from-indigo-600 via-purple-600 to-fuchsia-500 flex items-center justify-center p-6">

    <div class="w-full max-w-6xl bg-white rounded-2xl shadow-2xl overflow-hidden grid md:grid-cols-2">

        {{-- LEFT --}}
        <div class="relative bg-gradient-to-b from-sky-400 to-blue-500 text-white p-12 flex flex-col justify-between overflow-hidden">

            <div>
                <h2 class="text-2xl font-bold">
                    <i class="fas fa-graduation-cap"></i>
                    BeasiswaTrack
                </h2>
            </div>

            <div class="z-10">
                <h1 class="text-5xl font-bold mb-6">
                    Welcome to <br> BeasiswaTrack
                </h1>

                <p class="text-lg opacity-90">
                    Temukan berbagai informasi beasiswa terbaru,
                    simpan beasiswa favoritmu, dan raih impianmu bersama
                    BeasiswaTrack.
                </p>
            </div>

            <p class="z-10 text-sm opacity-80">
                © {{ date('Y') }} BeasiswaTrack
            </p>

            {{-- Wave --}}
            <div class="absolute bottom-0 left-0 w-full opacity-20">
                <svg viewBox="0 0 1440 320" class="w-full">
                    <path fill="#fff"
                        d="M0,192L48,197.3C96,203,192,213,288,197.3C384,181,480,139,576,149.3C672,160,768,224,864,234.7C960,245,1056,203,1152,170.7C1248,139,1344,117,1392,106.7L1440,96V320H0Z">
                    </path>
                </svg>
            </div>

        </div>

        {{-- RIGHT --}}
        <div class="p-10 md:p-14 flex items-center justify-center bg-white mt-10">

            <div class="w-full max-w-md">

                {{ $slot }}

            </div>

        </div>

    </div>

</body>
</html>