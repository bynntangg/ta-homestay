<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to WatHome - Tempat Menginap Terbaik</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css">
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        /* Global Styles */
        body {
            font-family: 'Poppins', sans-serif;
            line-height: 1.6;
            color: #333;
            scroll-behavior: smooth;
        }

        .section {
            padding: 4rem 0;
        }

        .section-title {
            position: relative;
            margin-bottom: 3rem;
            text-align: center;
        }

        .section-title:after {
            content: '';
            display: block;
            width: 80px;
            height: 4px;
            background: #3B82F6;
            margin: 1rem auto;
            border-radius: 2px;
        }

        /* Animated Elements */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate {
            animation: fadeInUp 0.8s ease-out forwards;
        }

        .delay-1 {
            animation-delay: 0.2s;
        }

        .delay-2 {
            animation-delay: 0.4s;
        }

        .delay-3 {
            animation-delay: 0.6s;
        }

        /* Header Styles - Classic Look */
        .header {
            background: linear-gradient(135deg, #1a3a8a 0%, #2563eb 100%);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
            transition: all 0.3s ease;
        }

        .header.scrolled {
            padding: 0.5rem 0;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, #1E3A8A 0%, #3B82F6 100%);
            color: white;
            padding-top: 4rem;
            position: relative;
            overflow: hidden;
        }

        .hero:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('/images/hero-pattern.png') center/cover no-repeat;
            opacity: 0.1;
        }

        /* Search Form */
        .search-card {
            background: white;
            border-radius: 0 0 12px 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            margin-bottom: 0;
        }

        /* Features */
        .feature-icon {
            width: 80px;
            height: 80px;
            background: #EFF6FF;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            font-size: 2rem;
            color: #3B82F6;
            transition: all 0.3s ease;
        }

        .feature-card:hover .feature-icon {
            background: #3B82F6;
            color: white;
            transform: translateY(-5px);
        }

        /* Homestay Cards */
        .homestay-card {
            transition: all 0.3s ease;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }

        .homestay-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.12);
        }

        .price-tag {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: rgba(255, 255, 255, 0.9);
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-weight: bold;
            color: #3B82F6;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        }

        /* Testimonials */
        .testimonial-card {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .testimonial-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #3B82F6;
        }

        /* Newsletter */
        .newsletter {
            background: linear-gradient(135deg, #3B82F6 0%, #1E40AF 100%);
            border-radius: 12px;
            overflow: hidden;
        }

        /* Floating Action Button */
        .fab {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            width: 60px;
            height: 60px;
            background: #3B82F6;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            box-shadow: 0 5px 20px rgba(59, 130, 246, 0.4);
            z-index: 100;
            transition: all 0.3s ease;
        }

        .fab:hover {
            transform: scale(1.1);
            box-shadow: 0 8px 25px rgba(59, 130, 246, 0.5);
        }

        .search-form-container {
            position: relative;
            /* Container relatif untuk positioning absolut dropdown */
        }

        #homestay-dropdown {
            position: absolute;
            top: 100%;
            /* Muncul tepat di bawah input */
            left: 0;
            right: 0;
            margin-top: -1px;
            /* Untuk menghilangkan gap kecil */
            border-radius: 0 0 1.5rem 1.5rem;
            /* Hanya bulatkan bagian bawah */
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-top: none;
            /* Hilangkan border atas agar nempel dengan input */
            max-height: 500px;
            overflow-y: auto;
            transform-origin: top center;
            transform: scaleY(0);
            opacity: 0;
            transition: all 0.2s ease;
        }

        #homestay-dropdown.show {
            transform: scaleY(1);
            opacity: 1;
        }

        .homestay-dropdown-container {
            border-radius: inherit;
            /* Mewarisi radius dari parent */
        }

        .homestay-dropdown-header {
            border-top-left-radius: inherit;
            border-top-right-radius: inherit;
        }

        .homestay-dropdown-footer {
            border-bottom-left-radius: inherit;
            border-bottom-right-radius: inherit;
        }

        .homestay-item {
            transition: all 0.2s ease;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .homestay-item:last-child {
            border-bottom: none;
        }

        .homestay-item:hover {
            background-color: #f8fafc;
        }

        /* Sesuaikan radius input */
        #location-input {
            border-radius: 1.5rem 1.5rem 0 0 !important;
            /* Bulatkan hanya bagian atas */
            position: relative;
            z-index: 10;
            /* Pastikan input di atas dropdown */
        }

        #location-input.dropdown-active {
            box-shadow: none;
            border-bottom-left-radius: 0 !important;
            border-bottom-right-radius: 0 !important;
        }


        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .section {
                padding: 3rem 0;
            }

            .hero {
                padding: 4rem 0;
                text-align: center;
            }

            .search-card {
                padding: 2rem 1.5rem;
                margin: 1rem auto;
            }

            /* Sesuaikan radius input */
            #location-input {
                border-radius: 1rem 1rem 0 0 !important;
            }

            #homestay-dropdown {
                width: 100%;
                left: 0;
                border-radius: 0 0 1rem 1rem;
            }
        }
    </style>
</head>

<body class="antialiased">

    <!-- Floating Action Button -->
    <a href="#search" class="fab animate delay-3">
        <i class="fas fa-search"></i>
    </a>
    <!-- Header with Classic Blue Gradient -->
    <header class="header py-4 text-white">
        <div class="container mx-auto px-4 flex justify-between items-center">
            <a href="/"
                class="text-3xl font-bold text-white flex items-center transition duration-300 hover:text-blue-100">
                <i class="fas fa-home mr-3 text-blue-200"></i>
                <span>WatHome</span>
                <span class="text-xs ml-2 bg-white bg-opacity-20 text-white px-2 py-1 rounded-full">.com</span>
            </a>

            <div class="flex items-center space-x-6">
                @auth
                    <div class="relative group">
                        <button class="flex items-center space-x-3 focus:outline-none">
                            <div class="text-right hidden md:block">
                                <p class="text-sm font-medium text-white">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-blue-100">Akun Saya</p>
                            </div>
                            <div class="relative">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=ffffff&color=3B82F6"
                                    alt="Profile" class="w-10 h-10 rounded-full border-2 border-blue-200 shadow-sm">
                                <span
                                    class="absolute bottom-0 right-0 w-3 h-3 bg-green-400 rounded-full border-2 border-white"></span>
                            </div>
                        </button>
                        <div
                            class="absolute right-0 mt-3 w-56 bg-white rounded-xl shadow-md py-2 opacity-0 invisible transition-all duration-300 transform translate-y-2 group-hover:opacity-100 group-hover:visible group-hover:translate-y-0 z-50 divide-y divide-gray-100">
                            <div class="px-4 py-3">
                                <p class="text-sm font-medium text-gray-900">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                            </div>
                            <div class="py-1">
                                <a href="{{ route('profile') }}"
                                    class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-gray-900">
                                    <i class="fas fa-user-circle mr-3 text-gray-400 w-5 text-center"></i> Profil Saya
                                </a>
                                <a href="{{ route('pemilik.pemesanan.riwayat', optional($pemesanan)->id) }}"
                                    class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-gray-900">
                                    <i class="fas fa-home mr-3 text-gray-400 w-5 text-center"></i> Pesanan Saya
                                </a>
                            </div>
                            <div class="py-1">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="flex items-center w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-gray-900">
                                        <i class="fas fa-sign-out-alt mr-3 text-gray-400 w-5 text-center"></i> Keluar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('login') }}"
                            class="text-white hover:text-blue-100 font-medium px-3 py-1.5 rounded-lg transition duration-300 hover:bg-white hover:bg-opacity-10">
                            Masuk
                        </a>
                        <a href="{{ route('register') }}"
                            class="bg-white text-blue-600 px-5 py-2.5 rounded-lg hover:shadow-md transition duration-300 hover:bg-blue-50">
                            Daftar
                        </a>
                    </div>
                @endauth
            </div>
        </div>
    </header>

    <!-- Rest of your HTML content remains the same -->
    <div class="relative overflow-hidden">
        <video autoplay muted loop class="absolute inset-0 w-full h-full object-cover z-0">
            <source src="/videos/PantaiWatuKarung.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>

        <div class="absolute inset-0 bg-black bg-opacity-40 z-1"></div>
        <!-- Tambahan credit sumber video -->
        <div class="absolute bottom-4 right-4 z-10">
            <p class="text-xs text-white/70 bg-black/30 px-2 py-1 rounded">
                Video by: <span class="font-medium">duaistanto</span> |
                Sumber: <a href="https://contoh-sumber.com" target="_blank"
                    class="underline hover:text-blue-300 transition">youtube.com</a>
            </p>
        </div>

        <div class="relative z-10">
            <div class="container mx-auto px-4 py-24 md:py-32 lg:py-48">
                <div class="search-card bg-transparent rounded-xl shadow-none p-8 md:p-10 lg:p-12" id="search"
                    style="width: 90%; margin-left: auto; margin-right: auto;">
                    <h2 class="text-2xl md:text-3xl font-bold mb-8 text-center text-white">Temukan Homestay Impian Anda
                    </h2>
                    <form class="max-w-4xl mx-auto" method="GET" id="search-form">
                        <div class="flex flex-col md:flex-row gap-6">
                            <div class="search-form-container relative flex-grow">
                                <form class="w-full" method="GET" id="search-form">
                                    <div class="relative flex items-center">
                                        <input type="text" id="location-input"
                                            placeholder="Cari homestay di Watukarung..."
                                            class="w-full px-6 py-4 md:py-5 border-2 border-blue-200 rounded-full focus:ring-4 focus:ring-blue-300 focus:border-blue-500 text-white text-lg md:text-xl shadow-sm hover:shadow-md transition duration-300 bg-transparent"
                                            autocomplete="off">
                                        <button type="submit" id="search-button"
                                            class="absolute right-2 bg-blue-600 hover:bg-blue-700 text-white p-4 rounded-full transition duration-300 transform hover:scale-105 shadow-md z-20">
                                            <i class="fas fa-search text-lg md:text-xl"></i>
                                        </button>
                                    </div>

                                    <div id="homestay-dropdown" class="hidden">
                                        <div class="homestay-dropdown-container bg-white shadow-2xl">
                                            <div class="divide-y divide-gray-100">
                                                <div class="homestay-dropdown-header px-4 py-3 bg-blue-50">
                                                    <h3 class="text-sm font-semibold text-blue-800 flex items-center">
                                                        <i class="fas fa-map-marker-alt mr-2 text-blue-600"></i>
                                                        Rekomendasi Homestay di Watukarung
                                                    </h3>
                                                </div>
                                                <div class="p-3">
                                                    <div
                                                        class="grid grid-cols-1 md:grid-cols-2 gap-3 max-h-[60vh] overflow-y-auto">
                                                        @foreach ($homestays as $homestay)
                                                            <div class="homestay-item flex items-start p-3 hover:bg-blue-50 rounded-lg cursor-pointer transition-all duration-200 group"
                                                                data-id="{{ $homestay->id }}"
                                                                data-name="{{ $homestay->nama }}"
                                                                data-address="{{ $homestay->alamat }}"
                                                                data-rating="{{ $homestay->rating ?? 0 }}">
                                                                <div class="flex-shrink-0 mr-3 relative">
                                                                    @if ($homestay->foto)
                                                                        <img src="data:image/jpeg;base64,{{ base64_encode($homestay->foto) }}"
                                                                            alt="{{ $homestay->nama }}"
                                                                            class="w-14 h-14 object-cover rounded-lg shadow-sm group-hover:shadow-md transition">
                                                                    @else
                                                                        <div
                                                                            class="w-14 h-14 bg-gradient-to-br from-blue-100 to-blue-50 rounded-lg flex items-center justify-center shadow-sm">
                                                                            <i
                                                                                class="fas fa-home text-blue-400 text-xl"></i>
                                                                        </div>
                                                                    @endif
                                                                    <div
                                                                        class="absolute -bottom-1 -right-1 bg-white rounded-full p-1 shadow">
                                                                        <div
                                                                            class="flex items-center bg-blue-600 text-white text-xs px-2 py-0.5 rounded-full">
                                                                            <span
                                                                                class="text-yellow-300 mr-0.5">★</span>
                                                                            <span
                                                                                class="font-bold">{{ $homestay->rating ?? 'Baru' }}</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="flex-grow">
                                                                    <h4
                                                                        class="font-medium text-gray-800 group-hover:text-blue-600 transition text-base">
                                                                        {{ $homestay->nama }}</h4>
                                                                    <p
                                                                        class="text-xs text-gray-600 mt-1 flex items-center">
                                                                        <i
                                                                            class="fas fa-map-marker-alt text-blue-400 mr-1 text-xs"></i>
                                                                        <span
                                                                            class="truncate">{{ $homestay->alamat }}</span>
                                                                    </p>
                                                                    <div class="mt-1 flex items-center text-xs">
                                                                        @if ($homestay->tipe_kamars->isNotEmpty())
                                                                            <span class="text-gray-600 mr-2">
                                                                                <i
                                                                                    class="fas fa-door-open text-blue-400 mr-1"></i>
                                                                                {{ $homestay->tipe_kamars->count() }}
                                                                                tipe
                                                                                kamar
                                                                            </span>
                                                                            <span class="text-blue-600 font-medium">
                                                                                <i
                                                                                    class="fas fa-tag text-blue-400 mr-1"></i>
                                                                                Rp
                                                                                {{ number_format($homestay->tipe_kamars->min('harga'), 0, ',', '.') }}
                                                                            </span>
                                                                        @else
                                                                            <span
                                                                                class="text-gray-500 italic text-xs">Belum
                                                                                ada kamar tersedia</span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="flex-shrink-0 ml-2 flex items-center">
                                                                    <i
                                                                        class="fas fa-chevron-right text-gray-400 group-hover:text-blue-600 transition"></i>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <div
                                                    class="homestay-dropdown-footer px-4 py-2 bg-gray-50 border-t border-gray-100">
                                                    <p class="text-xs text-gray-500 text-center">
                                                        <i class="fas fa-info-circle text-blue-400 mr-1"></i>
                                                        Pilih homestay untuk melihat detail lengkap
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="date-range-container"
                                        class="hidden mt-6 bg-white bg-opacity-90 backdrop-blur-sm p-6 rounded-lg shadow-lg border border-gray-200">
                                        <div class="flex flex-col md:flex-row gap-6">
                                            <div class="relative flex-grow">
                                                <label for="checkin-date"
                                                    class="block text-sm font-medium mb-2">Check-in</label>
                                                <input type="date" id="checkin-date" name="checkin"
                                                    class="w-full px-4 py-3 md:py-4 border-2 border-blue-200 rounded-lg focus:ring-4 focus:ring-blue-300 focus:border-blue-500 text-gray-700 shadow-sm hover:shadow-md transition duration-300 bg-white"
                                                    min="{{ date('Y-m-d') }}">
                                            </div>

                                            <div class="relative flex-grow">
                                                <label for="checkout-date"
                                                    class="block text-sm font-medium mb-2">Check-out</label>
                                                <input type="date" id="checkout-date" name="checkout"
                                                    class="w-full px-4 py-3 md:py-4 border-2 border-blue-200 rounded-lg focus:ring-4 focus:ring-blue-300 focus:border-blue-500 text-gray-700 shadow-sm hover:shadow-md transition duration-300 bg-white"
                                                    min="{{ date('Y-m-d', strtotime('+1 day')) }}">
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <p class="text-center text-white mt-6 font-medium text-lg md:text-xl">Cari homestay terbaik
                            dengan fasilitas lengkap di
                            Watukarung
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <section class="section bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="section-title animate">Kenapa Memilih WatHome?</h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="feature-card text-center p-6 rounded-xl bg-white animate delay-1">
                    <div class="feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Aman dan Terpercaya</h3>
                    <p class="text-gray-600">Semua properti diverifikasi langsung oleh tim kami untuk memastikan
                        kualitas terbaik</p>
                </div>

                <div class="feature-card text-center p-6 rounded-xl bg-white animate delay-2">
                    <div class="feature-icon">
                        <i class="fas fa-wallet"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Harga Terbaik</h3>
                    <p class="text-gray-600">Garansi harga terbaik dengan penawaran eksklusif untuk member kami</p>
                </div>

                <div class="feature-card text-center p-6 rounded-xl bg-white animate delay-3">
                    <div class="feature-icon">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Dukungan 24/7</h3>
                    <p class="text-gray-600">Tim kami siap membantu Anda kapan saja selama masa menginap</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Popular Homestays -->
    <section class="section bg-gray-50 py-12">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center mb-10">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800 mb-2 animate">Homestay Populer di Watukarung</h2>
                    <p class="text-gray-600 animate delay-1">Temukan pengalaman menginap terbaik dengan berbagai
                        pilihan
                        kamar</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach ($homestays as $homestay)
                    <div
                        class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300 animate delay-{{ ($loop->index % 4) + 1 }}">
                        <div class="relative overflow-hidden h-48">
                            @if ($homestay->foto)
                                <img src="data:image/jpeg;base64,{{ base64_encode($homestay->foto) }}"
                                    alt="{{ $homestay->nama }}"
                                    class="w-full h-full object-cover transition duration-500 hover:scale-110">
                            @else
                                <div
                                    class="w-full h-full bg-gradient-to-r from-blue-50 to-gray-100 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg>
                                </div>
                            @endif
                            <div class="absolute top-4 right-4 bg-white rounded-full p-2 shadow-md">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                            </div>
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent flex flex-col justify-end p-4">
                                <h3 class="text-white font-bold text-xl">{{ $homestay->nama }}</h3>
                                <div class="flex items-center mt-1">
                                    @php $rating = (int)($homestay->rating ?? 0); @endphp
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $rating)
                                            <span class="text-yellow-400">★</span>
                                        @else
                                            <span class="text-gray-300">★</span>
                                        @endif
                                    @endfor
                                    <span
                                        class="text-white text-sm ml-1">{{ $rating > 0 ? $rating . '.0' : 'Baru' }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="p-5">
                            <div class="flex items-center text-gray-600 mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span class="text-sm truncate">{{ $homestay->alamat ?? 'Watukarung, Pacitan' }}</span>
                            </div>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                                {{ $homestay->deskripsi ?? 'Homestay nyaman dengan fasilitas lengkap' }}</p>

                            <!-- Daftar Tipe Kamar -->
                            <div class="mb-4">
                                <h4 class="text-sm font-medium text-gray-700 mb-2">Tipe Kamar Tersedia:</h4>
                                <div class="space-y-2">
                                    @forelse ($homestay->tipe_kamars->take(2) as $tipe)
                                        <div class="flex justify-between text-sm">
                                            <span class="text-gray-600">{{ $tipe->nama }}</span>
                                            <span class="font-medium text-blue-600">Rp
                                                {{ number_format($tipe->harga, 0, ',', '.') }}</span>
                                        </div>
                                    @empty
                                        <p class="text-gray-500 text-sm">Belum ada tipe kamar tersedia</p>
                                    @endforelse

                                    @if ($homestay->tipe_kamars->count() > 2)
                                        <div class="text-center">
                                            <button class="text-blue-600 text-xs font-medium hover:text-blue-800">
                                                +{{ $homestay->tipe_kamars->count() - 2 }} tipe lainnya
                                            </button>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="flex justify-between items-center pt-2 border-t border-gray-100">
                                <div>
                                    <span class="text-gray-500 text-sm">Harga mulai</span>
                                    <p class="text-blue-600 font-bold">
                                        @if ($homestay->tipe_kamars->isNotEmpty())
                                            Rp {{ number_format($homestay->tipe_kamars->min('harga'), 0, ',', '.') }}
                                        @else
                                            -
                                        @endif
                                    </p>
                                </div>
                                <a href="#"
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition duration-300 flex items-center detail-btn"
                                    data-id="{{ $homestay->id }}" data-name="{{ $homestay->nama }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    Detail
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Testimonials Section -->
    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-2">Apa Kata Mereka?</h2>
                <div class="w-20 h-1 bg-blue-500 mx-auto"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach ($reviews as $review)
                    <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                        <div class="flex items-start mb-4">
                            <div
                                class="w-12 h-12 flex items-center justify-center rounded-full bg-blue-100 text-blue-600 mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h4 class="font-semibold text-gray-800">{{ $review->user->name }}</h4>
                                        <p class="text-sm text-gray-500 mb-1">{{ $review->homestay->nama }}</p>
                                    </div>
                                    <div class="flex items-center text-yellow-400">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $review->rating)
                                                <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20">
                                                    <path
                                                        d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                                                </svg>
                                            @else
                                                <svg class="w-4 h-4 fill-current text-gray-300"
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                    <path
                                                        d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                                                </svg>
                                            @endif
                                        @endfor
                                    </div>
                                </div>
                                <p class="text-gray-600 mt-3 italic relative pl-4">
                                    <span
                                        class="absolute left-0 top-0 text-2xl text-gray-300 leading-none h-full">"</span>
                                    {{ $review->komentar }}
                                </p>
                                <p class="text-xs text-gray-400 mt-3">
                                    {{ \Carbon\Carbon::parse($review->tanggal_ulasan)->translatedFormat('j F Y') }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if ($reviews->isEmpty())
                <div class="text-center py-8">
                    <div class="inline-block p-4 bg-gray-100 rounded-full mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-400" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                        </svg>
                    </div>
                    <p class="text-gray-500">Belum ada ulasan untuk homestay</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Add this section right after the Popular Homestays section -->
    <section class="section bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="section-title animate">Destinasi Wisata Pacitan</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Goa Gong -->
                <div
                    class="relative group overflow-hidden rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 animate delay-1">
                    <a href="https://youtu.be/n3J4ZTFNFVQ?si=feMye-hi82bHzL94" target="_blank"
                        class="block h-64 w-full bg-gray-200 overflow-hidden">
                        <img src="/images/GONG.jpeg" alt="Goa Gong"
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                    </a>
                    <div class="absolute bottom-0 left-0 right-0 p-4 text-white">
                        <h3 class="text-xl font-bold mb-1">Goa Gong</h3>
                        <p class="text-sm text-blue-100">Stalaktit & stalagmit menakjubkan</p>
                        <div class="mt-2">
                            <span
                                class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-600/90 text-white">
                                <i class="fas fa-mountain mr-1"></i> Wisata Alam
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Pantai Kasap -->
                <div
                    class="relative group overflow-hidden rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 animate delay-2">
                    <a href="https://youtu.be/y-Eg5qywRpQ?si=MVmQohJ6QeqmNUd4" target="_blank"
                        class="block h-64 w-full bg-gray-200 overflow-hidden">
                        <img src="/images/kasap.jpg" alt="Pantai Kasap"
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                    </a>
                    <div class="absolute bottom-0 left-0 right-0 p-4 text-white">
                        <h3 class="text-xl font-bold mb-1">Pantai Kasap</h3>
                        <p class="text-sm text-blue-100">Pasir putih & ombak tenang</p>
                        <div class="mt-2">
                            <span
                                class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-600/90 text-white">
                                <i class="fas fa-umbrella-beach mr-1"></i> Wisata Pantai
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Pantai Klayar -->
                <div
                    class="relative group overflow-hidden rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 animate delay-3">
                    <a href="https://youtu.be/kD0Jjb1HRco?si=P7B7PBykCCgA5fAT" target="_blank"
                        class="block h-64 w-full bg-gray-200 overflow-hidden">
                        <img src="/images/klayar.jpg" alt="Pantai Klayar"
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                    </a>
                    <div class="absolute bottom-0 left-0 right-0 p-4 text-white">
                        <h3 class="text-xl font-bold mb-1">Pantai Klayar</h3>
                        <p class="text-sm text-blue-100">Semburan air laut unik</p>
                        <div class="mt-2">
                            <span
                                class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-600/90 text-white">
                                <i class="fas fa-water mr-1"></i> Fenomena Alam
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Pantai Watukarung -->
                <div
                    class="relative group overflow-hidden rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 animate delay-4">
                    <a href="https://youtu.be/Wl7h3s1jENk?si=B11eoDt4GlAMIK9-" target="_blank"
                        class="block h-64 w-full bg-gray-200 overflow-hidden">
                        <img src="/images/watukarung.JPEG.jpg" alt="Pantai Watukarung"
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                    </a>
                    <div class="absolute bottom-0 left-0 right-0 p-4 text-white">
                        <h3 class="text-xl font-bold mb-1">Pantai Watukarung</h3>
                        <p class="text-sm text-blue-100">Spot surfing terbaik</p>
                        <div class="mt-2">
                            <span
                                class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-600/90 text-white">
                                <i class="fas fa-surfing mr-1"></i> Wisata Pantai
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container mx-auto px-4">
            <div
                class="bg-white rounded-xl shadow-lg overflow-hidden animate border-2 border-blue-100 hover:border-blue-300 transition-all duration-300">
                <div class="md:flex">
                    <!-- Image Section with Border Effect -->
                    <div class="md:w-1/3 bg-cover bg-center relative group"
                        style="background-image: url('/images/travel.jpg'); min-height: 300px;">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-4 text-white">
                            <h3 class="font-bold text-lg group-hover:text-blue-300 transition">Pacitan Guide</h3>
                        </div>
                        <!-- Decorative Border Corner -->
                        <div
                            class="absolute top-0 right-0 w-16 h-16 border-t-4 border-r-4 border-blue-500 rounded-tr-xl">
                        </div>
                    </div>

                    <!-- Content Section -->
                    <div class="md:w-2/3 p-8 md:p-12">
                        <h2 class="text-2xl md:text-3xl font-bold mb-4 text-blue-800">💡 Tips Liburan Akhir Tahun di
                            Pacitan</h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Tip 1 with Hover Effect -->
                            <div
                                class="flex items-start p-3 rounded-lg border border-gray-100 hover:border-blue-200 hover:bg-blue-50 transition">
                                <div class="bg-blue-100 p-3 rounded-lg mr-4 border border-blue-200">
                                    <i class="fas fa-sun text-blue-600"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold mb-1 text-gray-800">Waktu Terbaik Berkunjung</h4>
                                    <p class="text-gray-600 text-sm">April-Oktober saat musim kemarau untuk pantai yang
                                        indah</p>
                                </div>
                            </div>

                            <!-- Tip 2 with Hover Effect -->
                            <div
                                class="flex items-start p-3 rounded-lg border border-gray-100 hover:border-blue-200 hover:bg-blue-50 transition">
                                <div class="bg-blue-100 p-3 rounded-lg mr-4 border border-blue-200">
                                    <i class="fas fa-umbrella-beach text-blue-600"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold mb-1 text-gray-800">Pantai Favorit</h4>
                                    <p class="text-gray-600 text-sm">Pantai Klayar dan Pantai Watukarung wajib
                                        dikunjungi</p>
                                </div>
                            </div>

                            <!-- Tip 3 with Hover Effect -->
                            <div
                                class="flex items-start p-3 rounded-lg border border-gray-100 hover:border-blue-200 hover:bg-blue-50 transition">
                                <div class="bg-blue-100 p-3 rounded-lg mr-4 border border-blue-200">
                                    <i class="fas fa-car text-blue-600"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold mb-1 text-gray-800">Transportasi</h4>
                                    <p class="text-gray-600 text-sm">Sewa motor lebih praktis untuk jelajahi spot
                                        wisata</p>
                                </div>
                            </div>

                            <!-- Tip 4 with Hover Effect -->
                            <div
                                class="flex items-start p-3 rounded-lg border border-gray-100 hover:border-blue-200 hover:bg-blue-50 transition">
                                <div class="bg-blue-100 p-3 rounded-lg mr-4 border border-blue-200">
                                    <i class="fas fa-utensils text-blue-600"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold mb-1 text-gray-800">Kuliner</h4>
                                    <p class="text-gray-600 text-sm">Coba Sate Kelinci dan Nasi Tiwul khas Pacitan</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="section bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="section-title animate">Pertanyaan Umum</h2>

            <div class="max-w-3xl mx-auto">
                <div class="bg-white rounded-xl shadow-sm overflow-hidden animate delay-1">
                    <div
                        class="faq-question p-4 border-b border-gray-100 flex justify-between items-center cursor-pointer">
                        <h3 class="font-medium">Bagaimana cara memesan homestay di WatHome?</h3>
                        <span class="text-blue-600">+</span>
                    </div>
                    <div class="faq-answer p-4 hidden">
                        <p class="text-gray-600">Anda bisa mencari homestay melalui kolom pencarian di atas, pilih
                            tanggal menginap, lalu klik tombol "Pesan Sekarang". Ikuti langkah-langkah selanjutnya untuk
                            menyelesaikan pemesanan.</p>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm overflow-hidden animate delay-2">
                    <div
                        class="faq-question p-4 border-b border-gray-100 flex justify-between items-center cursor-pointer">
                        <h3 class="font-medium">Apa saja metode pembayaran yang tersedia?</h3>
                        <span class="text-blue-600">+</span>
                    </div>
                    <div class="faq-answer p-4 hidden">
                        <p class="text-gray-600">Kami menerima berbagai metode pembayaran termasuk transfer bank (BCA,
                            Mandiri, BRI, BNI), e-wallet (OVO, Gopay, Dana), dan kartu kredit (Visa, Mastercard).</p>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm overflow-hidden animate delay-3">
                    <div
                        class="faq-question p-4 border-b border-gray-100 flex justify-between items-center cursor-pointer">
                        <h3 class="font-medium">Bagaimana jika ingin membatalkan pemesanan?</h3>
                        <span class="text-blue-600">+</span>
                    </div>
                    <div class="faq-answer p-4 hidden">
                        <p class="text-gray-600">Kebijakan pembatalan berbeda-beda tergantung homestay. Anda bisa
                            melihat kebijakan pembatalan pada detail homestay. Untuk pembatalan, silakan hubungi
                            customer service kami.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white pt-12 pb-6">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <div>
                    <h3 class="text-xl font-bold mb-4 flex items-center">
                        <i class="fas fa-hotel mr-2 text-blue-400"></i> WatHome.com
                    </h3>
                    <p class="text-gray-400">Platform pemesanan penginapan terbaik di Pacitan dengan berbagai pilihan
                        homestay berkualitas.</p>
                </div>

                <div>
                    <h4 class="text-lg font-semibold mb-4">Tautan Cepat</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ route('about') }}" class="text-gray-400 hover:text-white transition">Tentang
                                Kami</a></li>
                        <li><a href="{{ route('contact') }}"
                                class="text-gray-400 hover:text-white transition">Kontak</a></li>
                        <li><a href="{{ route('faq') }}" class="text-gray-400 hover:text-white transition">FAQ</a>
                        </li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-lg font-semibold mb-4">Dukungan</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ route('privacy') }}"
                                class="text-gray-400 hover:text-white transition">Kebijakan Privasi</a></li>
                        <li><a href="{{ route('terms') }}" class="text-gray-400 hover:text-white transition">Syarat &
                                Ketentuan</a></li>
                        <li><a href="{{ route('help') }}"
                                class="text-gray-400 hover:text-white transition">Bantuan</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-lg font-semibold mb-4">Hubungi Kami</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li class="flex items-center">
                            <i class="fas fa-map-marker-alt mr-3 text-blue-400"></i> Dsn. Ketro Watukarung No. 17,
                            Pacitan
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-phone-alt mr-3 text-blue-400"></i> +62 882 9478 1090
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-envelope mr-3 text-blue-400"></i> info@wathome.com
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-800 pt-6 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-400 text-sm mb-4 md:mb-0">&copy; 2023 WatHome.com. All rights reserved.</p>
                <div class="flex space-x-4">
                    <a href="https://www.facebook.com/share/167HurYZ9F/" target="_blank" rel="noopener noreferrer"
                        class="text-gray-400 hover:text-white transition">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="https://twitter.com/blog_wathome" target="_blank" rel="noopener noreferrer"
                        class="text-gray-400 hover:text-white transition">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="https://www.instagram.com/wathome.official" target="_blank" rel="noopener noreferrer"
                        class="text-gray-400 hover:text-white transition">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>
            </div>
        </div>
    </footer>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // --- FAQ INTERAKTIF ---
            const faqItems = document.querySelectorAll('.faq-question');
            faqItems.forEach((item) => {
                item.addEventListener('click', () => {
                    const answer = item.nextElementSibling;
                    const icon = item.querySelector('span');

                    const isOpen = !answer.classList.contains('hidden');

                    // Tutup semua dulu
                    document.querySelectorAll('.faq-answer').forEach(a => a.classList.add(
                        'hidden'));
                    document.querySelectorAll('.faq-question span').forEach(i => i.textContent =
                        '+');

                    // Jika tadi belum terbuka, buka item ini
                    if (!isOpen) {
                        answer.classList.remove('hidden');
                        icon.textContent = '−';
                    }
                });
            });

            // --- HOMESTAY LOCATION & RATING DROPDOWN ---
            const locationInput = document.getElementById('location-input');
            const homestayIdInput = document.getElementById('homestay-id');
            const homestayDropdown = document.getElementById('homestay-dropdown');
            const dateRangeContainer = document.getElementById('date-range-container');
            const selectedRating = document.getElementById('selected-rating');
            const searchForm = document.getElementById('search-form');
            const searchButton = document.getElementById('search-button');



            locationInput.addEventListener('click', function() {
                if (!this.getAttribute('data-selected-id')) {
                    homestayDropdown.classList.remove('hidden');
                    if (dateRangeContainer) dateRangeContainer.classList.add('hidden');
                }
            });

            // Di bagian event listener input
            locationInput.addEventListener('focus', function() {
                if (!this.getAttribute('data-selected-id')) {
                    this.classList.add('dropdown-active');
                    homestayDropdown.classList.add('show');
                    homestayDropdown.classList.remove('hidden');
                }
            });

            // Di bagian akhir script, tambahkan kode berikut:
            document.querySelectorAll('.detail-btn').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();

                    const homestayId = this.getAttribute('data-id');
                    const homestayName = this.getAttribute('data-name');

                    // Scroll ke search form
                    document.getElementById('search').scrollIntoView({
                        behavior: 'smooth'
                    });

                    // Isi input lokasi
                    const locationInput = document.getElementById('location-input');
                    locationInput.value = homestayName;
                    locationInput.setAttribute('data-selected-id', homestayId);

                    // Tampilkan date picker
                    const dateRangeContainer = document.getElementById('date-range-container');
                    if (dateRangeContainer) {
                        dateRangeContainer.classList.remove('hidden');
                    }

                    // Fokus ke input tanggal check-in
                    document.getElementById('checkin-date').focus();
                });
            });

            // Handle homestay selection
            // Di bagian click homestay item
            document.querySelectorAll('.homestay-item').forEach(item => {
                item.addEventListener('click', function(e) {
                    e.preventDefault();
                    const id = this.getAttribute('data-id');
                    const name = this.getAttribute('data-name');

                    locationInput.value = name;
                    locationInput.setAttribute('data-selected-id', id);
                    locationInput.classList.remove('dropdown-active');
                    homestayDropdown.classList.remove('show');

                    // Tambahkan timeout untuk animasi
                    setTimeout(() => {
                        homestayDropdown.classList.add('hidden');
                    }, 200);

                    if (dateRangeContainer) dateRangeContainer.classList.remove('hidden');
                    document.getElementById('checkin-date').focus();
                });
            });

            document.addEventListener('click', function(e) {
                if (!locationInput.contains(e.target) && !homestayDropdown.contains(e.target)) {
                    locationInput.classList.remove('dropdown-active');
                    homestayDropdown.classList.remove('show');

                    // Tambahkan timeout untuk animasi
                    setTimeout(() => {
                        homestayDropdown.classList.add('hidden');
                    }, 200);
                }
            });

            // Filter homestay list
            locationInput.addEventListener('input', function() {
                if (this.getAttribute('data-selected-id')) {
                    this.removeAttribute('data-selected-id');
                    if (dateRangeContainer) dateRangeContainer.classList.add('hidden');
                }

                const searchTerm = this.value.toLowerCase();
                const items = document.querySelectorAll('.homestay-item');

                items.forEach(item => {
                    const name = item.getAttribute('data-name').toLowerCase();
                    const address = item.getAttribute('data-address').toLowerCase();

                    item.style.display = (name.includes(searchTerm) || address.includes(
                        searchTerm)) ? 'flex' : 'none';
                });

                if (searchTerm.length > 0) {
                    homestayDropdown.classList.remove('hidden');
                }
            });

            // --- DATE HANDLING ---
            const checkinInput = document.getElementById('checkin-date');
            const checkoutInput = document.getElementById('checkout-date');

            const today = new Date().toISOString().split('T')[0];
            const tomorrow = new Date();
            tomorrow.setDate(tomorrow.getDate() + 1);
            const tomorrowStr = tomorrow.toISOString().split('T')[0];

            if (!checkinInput.value) checkinInput.value = today;
            if (!checkoutInput.value) checkoutInput.value = tomorrowStr;
            checkoutInput.min = tomorrowStr;

            checkinInput.addEventListener('change', function() {
                if (this.value) {
                    const checkinDate = new Date(this.value);
                    checkinDate.setDate(checkinDate.getDate() + 1);
                    const nextDay = checkinDate.toISOString().split('T')[0];
                    checkoutInput.min = nextDay;

                    if (checkoutInput.value < nextDay) {
                        checkoutInput.value = nextDay;
                    }
                }
            });

            // --- GUEST DROPDOWN ---
            const guestToggle = document.getElementById('guest-toggle');
            const guestDropdown = document.getElementById('guest-dropdown');
            const guestSummary = document.getElementById('guest-summary');

            if (guestToggle && guestDropdown) {
                const roomCount = document.getElementById('room-count');
                const adultCount = document.getElementById('adult-count');
                const childCount = document.getElementById('child-count');

                const roomInput = document.getElementById('rooms-input');
                const adultInput = document.getElementById('adults-input');
                const childInput = document.getElementById('children-input');

                function updateGuestSummary() {
                    let summary = `${adultCount.textContent} Dewasa, ${roomCount.textContent} Kamar`;
                    if (parseInt(childCount.textContent) > 0) {
                        summary += `, ${childCount.textContent} Anak`;
                    }
                    guestSummary.textContent = summary;
                }

                function increment(element, input, max = 10) {
                    let count = parseInt(element.textContent);
                    if (count < max) {
                        element.textContent = count + 1;
                        input.value = count + 1;
                        updateGuestSummary();
                    }
                }

                // Saat memilih tanggal baru
                localStorage.setItem('temp_checkin', newCheckinDate);
                localStorage.setItem('temp_checkout', newCheckoutDate);

                function decrement(element, input, min = 1) {
                    let count = parseInt(element.textContent);
                    if (count > min) {
                        element.textContent = count - 1;
                        input.value = count - 1;
                        updateGuestSummary();
                    }
                }

                if (document.querySelector('.room-count-increment')) {
                    document.querySelector('.room-count-increment').addEventListener('click', () => increment(
                        roomCount, roomInput));
                    document.querySelector('.room-count-decrement').addEventListener('click', () => decrement(
                        roomCount, roomInput, 1));
                    document.querySelector('.adult-count-increment').addEventListener('click', () => increment(
                        adultCount, adultInput, 20));
                    document.querySelector('.adult-count-decrement').addEventListener('click', () => decrement(
                        adultCount, adultInput, 1));
                    document.querySelector('.child-count-increment').addEventListener('click', () => increment(
                        childCount, childInput, 20));
                    document.querySelector('.child-count-decrement').addEventListener('click', () => decrement(
                        childCount, childInput, 0));
                }

                guestToggle.addEventListener('click', function(e) {
                    e.stopPropagation();
                    guestDropdown.classList.toggle('hidden');
                });

                if (document.getElementById('guest-done')) {
                    document.getElementById('guest-done').addEventListener('click', function() {
                        guestDropdown.classList.add('hidden');
                    });
                }

                updateGuestSummary();
            }

            document.getElementById('search-form').addEventListener('submit', function(e) {
                e.preventDefault();

                const selectedHomestayId = document.getElementById('location-input').getAttribute(
                    'data-selected-id');
                const checkin = document.getElementById('checkin-date').value;
                const checkout = document.getElementById('checkout-date').value;

                if (!selectedHomestayId) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Pilih Homestay',
                        text: 'Silakan pilih homestay terlebih dahulu',
                    });
                    return;
                }

                if (!checkin || !checkout) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Pilih Tanggal',
                        text: 'Silakan pilih tanggal check-in dan check-out',
                    });
                    return;
                }

                // Redirect ke halaman detail dengan parameter
                window.location.href =
                    `/homestays/${selectedHomestayId}?checkin=${checkin}&checkout=${checkout}`;
            });
        });
    </script>
</body>

</html>
