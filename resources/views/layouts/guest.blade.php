<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'WatHome') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        .btn-back,
        .btn-dashboard {
            @apply bg-gradient-to-r text-white shadow-md hover:shadow-lg px-5 py-2.5 rounded-full text-sm font-semibold flex items-center gap-2 transition-all duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105;
        }

        .btn-back {
            @apply from-indigo-500 via-blue-500 to-sky-400;
        }

        .btn-dashboard {
            @apply from-green-400 via-emerald-500 to-teal-500;
        }

        .btn-back i,
        .btn-dashboard i {
            animation: bounceX 1.5s infinite;
        }

        @keyframes bounceX {

            0%,
            100% {
                transform: translateX(0);
            }

            50% {
                transform: translateX(-4px);
            }
        }

        .btn-back:hover i,
        .btn-dashboard:hover i {
            animation-play-state: paused;
        }
      /* Base Button Styles */
      .btn-nav {
        @apply w-12 h-12 rounded-full shadow-lg flex items-center justify-center 
               transition-all duration-300 ease-in-out transform hover:scale-110;
    }
    
    /* Back Button */
    .btn-back {
        @apply bg-gradient-to-br from-indigo-500 to-blue-400 text-white;
        box-shadow: 0 4px 15px rgba(59, 130, 246, 0.4);
    }
    
    /* Dashboard Button */
    .btn-dashboard {
        @apply bg-gradient-to-br from-emerald-400 to-teal-500 text-white;
        box-shadow: 0 4px 15px rgba(16, 185, 129, 0.4);
    }
    
    /* Icon Animation */
    .btn-nav i {
        transition: all 0.3s ease;
    }
    
    /* Dashboard Button Hover Effects */
    .btn-dashboard:hover {
        @apply shadow-xl;
        animation: pulse-green 1.5s infinite;
    }
    
    .btn-dashboard:hover i {
        transform: translateY(-3px);
    }
    .bg-decor {
        background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
        background-size: 400% 400%;
        animation: gradient 15s ease infinite;
        position: relative;
        overflow: hidden;
    }

    .bg-decor::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-image: 
            radial-gradient(circle at 10% 20%, rgba(255,255,255,0.1) 0%, transparent 20%),
            radial-gradient(circle at 90% 80%, rgba(255,255,255,0.1) 0%, transparent 20%);
        background-size: 300px 300px;
    }

    @keyframes gradient {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }
</style>

</head>

<body class="antialiased flex flex-col min-h-screen items-center justify-start px-4 py-12 sm:py-20 bg-decor overflow-y-auto">

    <!-- Navigation Buttons -->
    <div class="absolute top-6 left-6 flex gap-3">
        <!-- Back Button -->
        <a href="{{ url()->previous() }}" class="btn-nav btn-back" title="Kembali">
            <i class="fas fa-arrow-left text-lg"></i>
        </a>

        <!-- Dashboard Button -->
        <a href="{{ route('dashboard.pengguna') }}" class="btn-nav btn-dashboard" title="Dashboard">
            <i class="fas fa-home text-lg"></i>
        </a>
    </div>



    <!-- Slot Container -->
    <main class="relative z-10">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <div class="mt-8 text-center text-sm text-gray-400">
        &copy; {{ date('Y') }} WatHome. All rights reserved.
    </div>


</body>

</html>
