        <!DOCTYPE html>
        <html lang="id">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>{{ $homestay->nama }} - Detail Homestay</title>
            <script src="https://cdn.tailwindcss.com"></script>
            <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
            <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
                rel="stylesheet">
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
            <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
            <style>
                body {
                    font-family: 'Poppins', sans-serif;
                    scroll-behavior: smooth;
                }

                .room-type-card:hover {
                    transform: translateY(-5px);
                    box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
                }

                .map-container {
                    width: 100%;
                    height: 400px;
                    background-color: #f5f5f5;
                    position: relative;
                    overflow: hidden;
                }

                .map-placeholder {
                    width: 100%;
                    height: 100%;
                    background-image: url('https://maps.googleapis.com/maps/api/staticmap?center={{ urlencode($homestay->alamat) }}&zoom=15&size=800x400&maptype=roadmap&markers=color:red%7C{{ urlencode($homestay->alamat) }}');
                    background-size: cover;
                    background-position: center;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    flex-direction: column;
                    color: #555;
                }

                .attraction-card:hover {
                    transform: translateY(-5px);
                    transition: transform 0.3s ease;
                }

                .facility-icon {
                    width: 40px;
                    height: 40px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    border-radius: 10px;
                    margin-right: 12px;
                }

                /* Search Form */
                .search-card {
                    background: white;
                    border-radius: 0 0 12px 12px;
                    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                    padding: 2rem;
                    margin-bottom: 0;
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
                        transform: none;
                        margin-bottom: 3rem;
                    }
                }

                button[type="submit"] {
                    transition: all 0.3s ease;
                    height: 48px;
                    box-shadow: 0 4px 6px rgba(66, 153, 225, 0.3);
                    position: relative;
                    overflow: hidden;
                }

                button[type="submit"]:hover {
                    transform: translateY(-2px);
                    box-shadow: 0 6px 12px rgba(66, 153, 225, 0.4);
                }

                button[type="submit"]::after {
                    content: '';
                    position: absolute;
                    top: -50%;
                    left: -60%;
                    width: 200%;
                    height: 200%;
                    background: rgba(255, 255, 255, 0.2);
                    transform: rotate(30deg);
                    transition: all 0.3s ease;
                }

                button[type="submit"]:hover::after {
                    left: 100%;
                }

                /* Animasi untuk counter buttons */
                .room-count-increment,
                .room-count-decrement,
                .adult-count-increment,
                .adult-count-decrement,
                .child-count-increment,
                .child-count-decrement {
                    transition: all 0.2s ease;
                }

                .room-count-increment:hover,
                .room-count-decrement:hover,
                .adult-count-increment:hover,
                .adult-count-decrement:hover,
                .child-count-increment:hover,
                .child-count-decrement:hover {
                    background: #ebf8ff !important;
                    border-color: #90cdf4 !important;
                }

                #guest-done {
                    transition: all 0.2s ease;
                }

                #guest-done:hover {
                    transform: translateY(-1px);
                    box-shadow: 0 2px 8px rgba(66, 153, 225, 0.4);
                }

                .sold-out-badge {
                    position: absolute;
                    top: 50%;
                    left: 50%;
                    transform: translate(-50%, -50%);
                    background-color: rgba(239, 68, 68, 0.9);
                    color: white;
                    padding: 8px 16px;
                    border-radius: 20px;
                    font-weight: bold;
                    z-index: 10;
                }

                .sold-out-overlay {
                    position: absolute;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    background-color: rgba(0, 0, 0, 0.5);
                    z-index: 5;
                }

                .sold-out-card {
                    opacity: 0.7;
                    position: relative;
                }

                .sold-out-card::after {
                    content: "";
                    position: absolute;
                    top: 0;
                    left: 0;
                    right: 0;
                    bottom: 0;
                    background: linear-gradient(135deg, rgba(255, 255, 255, 0.8) 0%, rgba(255, 255, 255, 0.9) 100%);
                    z-index: 1;
                }

                /* Multi Room Booking Panel */
                #multi-room-booking-panel {
                    transition: all 0.3s ease;
                    box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
                }

                #selected-rooms::-webkit-scrollbar {
                    width: 6px;
                }

                #selected-rooms::-webkit-scrollbar-track {
                    background: #f1f1f1;
                    border-radius: 10px;
                }

                #selected-rooms::-webkit-scrollbar-thumb {
                    background: #c1c1c1;
                    border-radius: 10px;
                }

                #selected-rooms::-webkit-scrollbar-thumb:hover {
                    background: #a1a1a1;
                }

                /* Tambahkan ke bagian style */
                .room-counter {
                    display: flex;
                    align-items: center;
                    border: 1px solid #e2e8f0;
                    border-radius: 0.5rem;
                    overflow: hidden;
                }

                .room-counter button {
                    padding: 0.25rem 0.75rem;
                    background-color: #f8fafc;
                    color: #4a5568;
                    border: none;
                    cursor: pointer;
                    transition: background-color 0.2s;
                }

                .room-counter button:hover {
                    background-color: #f1f5f9;
                }

                .room-counter span {
                    padding: 0.25rem 1rem;
                    min-width: 2.5rem;
                    text-align: center;
                    border-left: 1px solid #e2e8f0;
                    border-right: 1px solid #e2e8f0;
                }

                #main-image {
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                    object-position: center;
                    transition: opacity 0.3s ease;
                }

                .thumbnail-image {
                    border: 2px solid transparent;
                    transition: all 0.3s ease;
                    cursor: pointer;
                }

                .thumbnail-image:hover {
                    opacity: 0.9;
                }

                .active-thumbnail {
                    border-color: #3b82f6;
                    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.3);
                }

                /* Fullscreen Gallery Styles */
                /* Perbaikan untuk gallery modal */
                #gallery-modal {
                    z-index: 1001;
                    /* Lebih tinggi dari header (1000) */
                }

                /* Perbaikan untuk tombol close */
                #gallery-modal .close-button {
                    position: fixed;
                    top: 1.5rem;
                    right: 1.5rem;
                    z-index: 1002;
                    /* Lebih tinggi dari modal */
                }

                #modal-main-image {
                    max-width: 100%;
                    max-height: calc(100vh - 180px);
                    /* Account for header and thumbnails */
                    object-fit: contain;
                    cursor: grab;
                    transition: transform 0.2s ease;
                }

                #modal-main-image:active {
                    cursor: grabbing;
                }

                #modal-thumbnails {
                    scrollbar-width: none;
                    /* Hide scrollbar for Firefox */
                }

                #modal-thumbnails::-webkit-scrollbar {
                    display: none;
                    /* Hide scrollbar for Chrome/Safari */
                }

                #modal-thumbnails img {
                    width: 80px;
                    height: 60px;
                    object-fit: cover;
                    border-radius: 4px;
                    border: 2px solid transparent;
                    transition: all 0.2s ease;
                    flex-shrink: 0;
                }

                #modal-thumbnails img:hover {
                    border-color: rgba(255, 255, 255, 0.5);
                }

                #modal-thumbnails img.active-thumbnail {
                    border-color: #3b82f6;
                    box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.5);
                }

                .sold-out-card {
                    position: relative;
                    opacity: 0.7;
                }

                .sold-out-card::after {
                    content: "";
                    position: absolute;
                    top: 0;
                    left: 0;
                    right: 0;
                    bottom: 0;
                    background: linear-gradient(135deg, rgba(255, 255, 255, 0.8) 0%, rgba(255, 255, 255, 0.9) 100%);
                    z-index: 1;
                }

                .sold-out-badge {
                    position: absolute;
                    top: 50%;
                    left: 50%;
                    transform: translate(-50%, -50%);
                    background-color: rgba(239, 68, 68, 0.9);
                    color: white;
                    padding: 8px 16px;
                    border-radius: 20px;
                    font-weight: bold;
                    z-index: 10;
                }

                .sold-out-overlay {
                    position: absolute;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    background-color: rgba(0, 0, 0, 0.5);
                    z-index: 5;
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
            </style>
        </head>

        <body class="bg-gray-50">
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
                                            alt="Profile"
                                            class="w-10 h-10 rounded-full border-2 border-blue-200 shadow-sm">
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
                                            <i class="fas fa-user-circle mr-3 text-gray-400 w-5 text-center"></i> Profil
                                            Saya
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
                                                <i class="fas fa-sign-out-alt mr-3 text-gray-400 w-5 text-center"></i>
                                                Keluar
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

            <!-- Main Content -->
            <div class="container mx-auto px-4 py-8">
                <!-- Breadcrumb -->
                <div class="flex items-center text-sm text-gray-600 mb-6">
                    <a href="{{ route('dashboard.pengguna') }}" class="hover:text-blue-600 transition">
                        <i class="fas fa-home mr-1"></i> Beranda
                    </a>
                    <span class="mx-2">/</span>
                    <span class="text-gray-800 font-medium truncate max-w-xs">{{ $homestay->nama }}</span>
                </div>

                <!-- Homestay Header - Layout Grid dengan Foto Besar dan Thumbnail dari Carousel -->
                <div class="flex flex-col lg:flex-row gap-8 mb-12">
                    <!-- Foto Utama Besar (Kiri) -->
                    <div class="w-full lg:w-2/3">
                        <div
                            class="rounded-2xl overflow-hidden bg-gradient-to-r from-blue-50 to-gray-100 aspect-[4/3] shadow-xl relative">
                            @if ($homestay->foto)
                                <img src="data:image/jpeg;base64,{{ base64_encode($homestay->foto) }}"
                                    alt="{{ $homestay->nama }}"
                                    class="w-full h-full object-cover transition duration-500 hover:scale-105"
                                    id="main-image" loading="eager" <!-- Prioritaskan loading gambar utama -->
                                decoding="async" <!-- Optimasi decoding -->
                                fetchpriority="high"> <!-- Prioritaskan fetch -->
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-400">
                                    <i class="fas fa-home text-6xl"></i>
                                </div>
                            @endif
                            <div
                                class="absolute bottom-4 left-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-sm font-medium shadow-sm">
                                <i class="fas fa-camera mr-1 text-blue-500"></i>
                                <span id="image-counter">1</span>/{{ $homestay->carousels->count() + 1 }}
                            </div>
                        </div>
                    </div>

                    <!-- Grid Thumbnail (Kanan) - Hanya dari Carousel -->
                    <div class="w-full lg:w-1/3">
                        <div class="grid grid-cols-3 gap-2 h-full">
                            <!-- Thumbnail Utama (2 kolom pertama) -->
                            <div class="col-span-2 aspect-[2/1] rounded-xl overflow-hidden">
                                @if ($homestay->foto)
                                    <!-- Di bagian thumbnail, ganti onclick dengan: -->
                                    <img src="data:image/jpeg;base64,{{ base64_encode($homestay->foto) }}"
                                        alt="{{ $homestay->nama }} Thumbnail" loading="lazy"
                                        class="w-full h-full object-cover cursor-pointer hover:opacity-90 transition thumbnail-image active-thumbnail"
                                        data-index="0" onclick="openGallery(0)">
                                @else
                                    <div
                                        class="w-full h-full bg-gray-200 flex items-center justify-center cursor-pointer">
                                        <i class="fas fa-home text-2xl"></i>
                                    </div>
                                @endif
                            </div>
                            @if ($homestay->carousels && $homestay->carousels->count() > 0)
                                @foreach ($homestay->carousels as $index => $carousel)
                                    <div class="aspect-square rounded-xl overflow-hidden">
                                        <img src="data:image/jpeg;base64,{{ base64_encode($carousel->gambar) }}"
                                            alt="Gallery {{ $index + 1 }}"
                                            class="w-full h-full object-cover cursor-pointer hover:opacity-90 transition thumbnail-image {{ $index == 0 ? 'active-thumbnail' : '' }}"
                                            data-index="{{ $index + 1 }}"
                                            onclick="changeMainImage(this, 'data:image/jpeg;base64,{{ base64_encode($carousel->gambar) }}')">
                                    </div>
                                @endforeach
                            @else
                                <!-- Placeholder jika tidak ada gambar carousel -->
                                @for ($i = 0; $i < 6; $i++)
                                    <div
                                        class="aspect-square rounded-xl overflow-hidden bg-gray-200 flex items-center justify-center">
                                        <i class="fas fa-image text-gray-400"></i>
                                    </div>
                                @endfor
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Quick Info -->
                <div class="w-full bg-white rounded-2xl shadow-xl p-6 mb-12 border border-gray-100">
                    <!-- Konten quick info tetap sama seperti sebelumnya -->
                    <div class="flex justify-between items-start mb-4">
                        <h1 class="text-2xl font-bold text-gray-800">{{ $homestay->nama }}</h1>
                        <button class="text-gray-400 hover:text-red-500 transition">
                            <i class="far fa-heart text-xl"></i>
                        </button>
                    </div>

                    <div class="flex items-center text-gray-600 mb-4">
                        <i class="fas fa-map-marker-alt mr-2 text-blue-500"></i>
                        <span class="truncate">{{ $homestay->alamat }}</span>
                    </div>

                    @if ($homestay->rating > 0)
                        <div class="flex items-center mb-6">
                            <div class="flex mr-1">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $homestay->rating)
                                        <i class="fas fa-star text-yellow-400"></i>
                                    @else
                                        <i class="far fa-star text-gray-300"></i>
                                    @endif
                                @endfor
                            </div>
                            <span class="text-sm font-medium text-gray-700 ml-1">{{ $homestay->rating }}.0</span>
                        </div>
                    @endif

                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-3">Deskripsi</h3>
                        <p class="text-gray-600 leading-relaxed">{{ $homestay->deskripsi }}</p>
                    </div>

                    <div class="bg-blue-50/50 rounded-xl p-5 border border-blue-100">
                        <h4 class="font-medium text-blue-800 mb-2">Mulai dari</h4>
                        <div class="flex items-end mb-4">
                            <span
                                class="text-3xl font-bold text-blue-600">Rp{{ number_format($homestay->tipe_kamars->min('harga'), 0, ',', '.') }}</span>
                            <span class="text-gray-500 ml-1 text-sm">/malam</span>
                        </div>
                        <a href="#room-selection"
                            class="w-full bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 text-white py-3 rounded-xl font-medium transition-all flex items-center justify-center shadow-md hover:shadow-lg">
                            <i class="fas fa-calendar-check mr-2"></i> Pesan Sekarang
                        </a>

                    </div>
                </div>

                <!-- Fullscreen Gallery Modal -->
                <div id="gallery-modal" class="fixed inset-0 z-50 hidden bg-black overflow-y-auto">
                    <!-- Header Bar -->
                    <div class="fixed top-0 left-0 right-0 bg-black/70 z-50 flex justify-between items-center p-4">
                        <!-- Back Button -->
                        <button onclick="closeGallery()" class="text-white flex items-center">
                            <i class="fas fa-arrow-left text-xl mr-2"></i>
                            <span class="font-medium">Kembali</span>
                        </button>

                        <!-- Image Counter -->
                        <div class="text-white font-medium">
                            <span id="modal-image-counter">1</span>/<span id="modal-total-images">0</span>
                        </div>

                        <!-- Close Button -->
                        <button onclick="closeGallery()" class="text-white text-2xl">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>

                    <!-- Main Image Content -->
                    <div class="min-h-screen flex items-center justify-center p-4 pt-20 pb-32">
                        <div class="relative w-full h-full">
                            <!-- Navigation Arrows -->
                            <button onclick="navigateGallery(-1)"
                                class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-black/50 text-white rounded-full w-12 h-12 flex items-center justify-center z-10 hover:bg-black/70">
                                <i class="fas fa-chevron-left text-xl"></i>
                            </button>

                            <!-- Main Image -->
                            <img id="modal-main-image" src="" alt=""
                                class="w-full max-h-[calc(100vh-180px)] object-contain">

                            <button onclick="navigateGallery(1)"
                                class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-black/50 text-white rounded-full w-12 h-12 flex items-center justify-center z-10 hover:bg-black/70">
                                <i class="fas fa-chevron-right text-xl"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Thumbnail Strip -->
                    <div class="fixed bottom-0 left-0 right-0 bg-black/70 py-4 px-4 z-40">
                        <div class="flex overflow-x-auto space-x-3 px-2" id="modal-thumbnails">
                            <!-- Thumbnails will be inserted here by JavaScript -->
                        </div>
                    </div>
                </div>

                <!-- Facilities Section -->
                <div class="bg-white rounded-2xl shadow-xl p-8 mb-12 border border-gray-200">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Fasilitas Homestay</h2>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @php
                            $availableFacilities = [
                                'wifi' => [
                                    'label' => 'WiFi Gratis',
                                    'icon' => 'wifi',
                                    'color' => 'bg-purple-100 text-purple-600',
                                ],
                                'parkir' => [
                                    'label' => 'Parkir',
                                    'icon' => 'parking',
                                    'color' => 'bg-blue-100 text-blue-600',
                                ],
                                'ac' => [
                                    'label' => 'AC',
                                    'icon' => 'snowflake',
                                    'color' => 'bg-cyan-100 text-cyan-600',
                                ],
                                'kolam_renang' => [
                                    'label' => 'Kolam Renang',
                                    'icon' => 'swimming-pool',
                                    'color' => 'bg-teal-100 text-teal-600',
                                ],
                                'breakfast' => [
                                    'label' => 'Sarapan',
                                    'icon' => 'mug-saucer',
                                    'color' => 'bg-amber-100 text-amber-600',
                                ],
                                'tv' => ['label' => 'TV', 'icon' => 'tv', 'color' => 'bg-red-100 text-red-600'],
                                'shower' => [
                                    'label' => 'Shower',
                                    'icon' => 'shower',
                                    'color' => 'bg-sky-100 text-sky-600',
                                ],
                                'kitchen' => [
                                    'label' => 'Dapur',
                                    'icon' => 'utensils',
                                    'color' => 'bg-orange-100 text-orange-600',
                                ],
                            ];

                            $fasilitas = is_array($homestay->fasilitas) ? $homestay->fasilitas : [];
                        @endphp

                        @foreach ($availableFacilities as $key => $facility)
                            @if (isset($fasilitas[$key]) && $fasilitas[$key])
                                <div
                                    class="flex items-center p-4 border border-gray-100 rounded-xl hover:shadow-md transition">
                                    <div class="facility-icon {{ $facility['color'] }}">
                                        <i class="fas fa-{{ $facility['icon'] }}"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-gray-800">{{ $facility['label'] }}</h4>
                                        <p class="text-sm text-gray-500">Tersedia</p>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>

                @if ($checkin && $checkout)
                    <div class="bg-blue-50 rounded-xl p-4 mb-6 border border-blue-200">
                        <div class="flex flex-col md:flex-row justify-between items-center">
                            <div>
                                <h3 class="font-medium text-blue-800">Tanggal Dipilih</h3>
                                <p class="text-gray-700">
                                    {{ \Carbon\Carbon::parse($checkin)->translatedFormat('d F Y') }} -
                                    {{ \Carbon\Carbon::parse($checkout)->translatedFormat('d F Y') }}
                                    ({{ \Carbon\Carbon::parse($checkin)->diffInDays($checkout) }} malam)
                                </p>
                            </div>
                            <a href="{{ route('dashboard.pengguna') }}"
                                class="mt-2 md:mt-0 text-blue-600 hover:text-blue-800 text-sm font-medium">
                                <i class="fas fa-edit mr-1"></i> Ubah Tanggal
                            </a>
                        </div>
                    </div>
                @endif

                <!-- Di bagian Room Selection Section -->
                <div class="mb-16" id="room-selection">
                    @foreach ($homestay->tipe_kamars as $index => $tipe_kamar)
                        <div
                            class="room-type-card bg-white rounded-2xl shadow-lg p-6 mb-8 border border-gray-200 transition-all duration-300 
                            @if ($tipe_kamar->available_rooms_count == 0) sold-out-card @endif">

                            @if ($tipe_kamar->available_rooms_count == 0)
                                <div class="sold-out-overlay"></div>
                                <div class="sold-out-badge">
                                    <span class="text-white font-bold">Kamar Habis</span>
                                </div>
                            @endif
                            <div class="flex flex-col lg:flex-row gap-8">
                                <!-- Room Info -->
                                <div class="lg:w-2/5">
                                    <div
                                        class="aspect-[4/3] bg-gray-100 rounded-xl overflow-hidden mb-4 shadow-sm relative">
                                        @if ($tipe_kamar->foto)
                                            <img src="data:image/jpeg;base64,{{ base64_encode($tipe_kamar->foto) }}"
                                                alt="{{ $tipe_kamar->nama }}"
                                                class="w-full h-full object-cover hover:scale-105 transition duration-500">
                                        @else
                                            <div
                                                class="w-full h-full flex items-center justify-center bg-gradient-to-r from-blue-50 to-gray-100 text-gray-400">
                                                <i class="fas fa-bed text-4xl"></i>
                                            </div>
                                        @endif
                                        <div
                                            class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm px-2 py-1 rounded-full text-xs font-medium shadow-sm">
                                            <i class="fas fa-door-open text-blue-500 mr-1"></i>
                                            {{ $tipe_kamar->available_rooms_count }} Kamar Tersedia
                                        </div>
                                    </div>

                                    <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $tipe_kamar->nama }}</h3>
                                    <div class="text-2xl font-bold text-blue-600 mb-3">
                                        Rp{{ number_format($tipe_kamar->harga, 0, ',', '.') }} <span
                                            class="text-sm font-normal text-gray-500">/malam</span>
                                    </div>

                                    <p class="text-gray-600 mb-4">{{ $tipe_kamar->deskripsi }}</p>

                                    <div class="flex flex-wrap gap-2 mb-4">
                                        <span class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-xs">
                                            <i class="fas fa-user-friends mr-1"></i> Maks {{ $tipe_kamar->kapasitas }}
                                            orang
                                        </span>
                                        <span class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-xs">
                                            <i class="fas fa-ruler-combined mr-1"></i> {{ $tipe_kamar->ukuran }} m²
                                        </span>
                                        <span class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-xs">
                                            <i class="fas fa-bed mr-1"></i> {{ $tipe_kamar->tipe_bed }}
                                        </span>
                                    </div>

                                    <!-- Ganti bagian button "Tambah ke Pesanan" -->
                                    <div class="flex items-center justify-between mt-4">
                                        <div
                                            class="flex items-center border border-gray-300 rounded-lg overflow-hidden">
                                            <button onclick="decrementRoom('{{ $tipe_kamar->id }}')"
                                                class="px-3 py-1 bg-gray-100 hover:bg-gray-200 text-gray-700"
                                                @if ($tipe_kamar->available_rooms_count == 0) disabled @endif>
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <span id="room-count-{{ $tipe_kamar->id }}" class="px-4 py-1">0</span>
                                            <button
                                                onclick="incrementRoom('{{ $tipe_kamar->id }}', {{ $tipe_kamar->available_rooms_count }})"
                                                class="px-3 py-1 bg-gray-100 hover:bg-gray-200 text-gray-700"
                                                @if ($tipe_kamar->available_rooms_count == 0) disabled @endif>
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                        <button
                                            onclick="addToBooking('{{ $tipe_kamar->id }}', '{{ $tipe_kamar->nama }}', {{ $tipe_kamar->harga }}, {{ $tipe_kamar->available_rooms_count }})"
                                            class="bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 text-white px-4 py-2 rounded-lg font-medium transition-all flex items-center shadow-md hover:shadow-lg"
                                            @if ($tipe_kamar->available_rooms_count == 0) disabled @endif>
                                            <i class="fas fa-cart-plus mr-2"></i> Tambah
                                        </button>
                                    </div>
                                </div>

                                <!-- Room Availability -->
                                <div class="lg:w-3/5">
                                    <div class="bg-gray-50 rounded-xl p-6 border border-gray-200 h-full">
                                        <h4 class="text-lg font-semibold text-gray-800 mb-4">Ketersediaan Kamar</h4>

                                        <div
                                            class="room-type-card bg-white rounded-2xl shadow-lg p-6 mb-8 border border-gray-200 transition-all duration-300 
                                            @if ($tipe_kamar->available_rooms_count == 0) sold-out-card @endif">
                                            @if ($tipe_kamar->available_rooms_count == 0)
                                                <div class="sold-out-overlay"></div>
                                                <div class="sold-out-badge">
                                                    <span class="text-white font-bold">Kamar Habis</span>
                                                </div>
                                            @endif
                                            <div class="flex items-center justify-between mb-2">
                                                <div class="text-sm font-medium text-gray-700">Total Kamar</div>
                                                <div class="text-sm font-semibold text-blue-600">
                                                    {{ $tipe_kamar->kamars->count() }} kamar
                                                </div>
                                            </div>

                                            <div class="flex items-center justify-between mb-2">
                                                <div class="text-sm font-medium text-gray-700">Tersedia</div>
                                                <div
                                                    class="text-sm font-semibold @if ($tipe_kamar->available_rooms_count > 0) text-green-600 @else text-red-600 @endif">
                                                    {{ $tipe_kamar->available_rooms_count }} kamar
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <!-- Panel Pemesanan Multi Kamar -->
                    <div id="multi-room-booking-panel"
                        class="bg-white rounded-2xl shadow-xl p-6 mb-12 border border-gray-200 sticky bottom-4 z-10 hidden">
                        <div class="flex flex-col md:flex-row justify-between items-center">
                            <div class="mb-4 md:mb-0">
                                <h3 class="text-lg font-bold text-gray-800">Pesanan Kamar</h3>
                                <div id="selected-rooms" class="mt-2 max-h-40 overflow-y-auto"></div>
                            </div>

                            <div class="flex items-center">
                                <div class="mr-6 text-right">
                                    <p class="text-sm text-gray-600">Total Harga:</p>
                                    <p class="text-2xl font-bold text-blue-600">Rp<span id="total-price">0</span></p>
                                </div>

                                @auth
                                    <form id="multi-room-booking-form" action="{{ route('pemesanan.index') }}"
                                        method="GET" onsubmit="event.preventDefault(); submitMultiRoomBooking();">
                                        @csrf
                                        <input type="hidden" name="homestay_id" value="{{ $homestay->id }}">
                                        <input type="hidden" name="selected_room_ids" id="selected-room-ids">
                                        <input type="hidden" name="checkin" value="{{ $checkin }}">
                                        <input type="hidden" name="checkout" value="{{ $checkout }}">
                                        <button type="submit"
                                            class="bg-gradient-to-r from-green-600 to-green-500 hover:from-green-700 hover:to-green-600 text-white px-6 py-3 rounded-xl font-medium transition-all flex items-center shadow-md hover:shadow-lg">
                                            <i class="fas fa-shopping-cart mr-2"></i> Lanjutkan Pemesanan
                                        </button>
                                    </form>
                                @else
                                    <a href="{{ route('login', [
                                        'redirect' =>
                                            url()->current() .
                                            (request()->has('checkin') ? '?checkin=' . request('checkin') . '&checkout=' . request('checkout') : '') .
                                            '#room-selection',
                                    ]) }}"
                                        id="continue-booking-btn"
                                        class="bg-gradient-to-r from-green-600 to-green-500 hover:from-green-700 hover:to-green-600 text-white px-6 py-3 rounded-xl font-medium transition-all flex items-center shadow-md hover:shadow-lg">
                                        <i class="fas fa-shopping-cart mr-2"></i> Lanjutkan Pemesanan
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Location Map Section -->
                <div class="mb-16">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Lokasi Homestay</h2>
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                        <div class="map-container h-96">
                            <iframe width="100%" height="100%" frameborder="0" scrolling="no" marginheight="0"
                                marginwidth="0"
                                src="https://maps.google.com/maps?q={{ urlencode($homestay->alamat) }}&z=15&output=embed"
                                class="border-0" allowfullscreen>
                            </iframe>
                        </div>
                        <div class="p-6 border-t border-gray-200">
                            <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-800 mb-1">{{ $homestay->nama }}</h3>
                                    <p class="text-gray-600"><i class="fas fa-map-marker-alt text-blue-500 mr-2"></i>
                                        {{ $homestay->alamat }}</p>
                                </div>
                                <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($homestay->nama . ' ' . $homestay->alamat) }}"
                                    target="_blank"
                                    class="mt-4 md:mt-0 bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition flex items-center">
                                    <i class="fas fa-directions mr-2"></i> Buka di Google Maps
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Enhanced Contact Section -->
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden mb-16" id="contact">
                    <!-- Header with Gradient Background -->
                    <div class="bg-gradient-to-r from-blue-600 to-blue-500 p-6 text-white">
                        <h2 class="text-2xl font-bold flex items-center">
                            <i class="fas fa-address-card mr-3"></i>
                            Kontak Pemilik Homestay
                        </h2>
                        <p class="mt-2 opacity-90">Hubungi langsung pemilik untuk informasi lebih lanjut</p>
                    </div>

                    <!-- Reviews Section -->
                    <div class="mb-16">
                        <h2 class="text-2xl font-bold text-gray-800 mb-6">Ulasan Pengunjung</h2>

                        <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-200">
                            <!-- Rating Summary -->
                            <div class="flex flex-col md:flex-row items-start md:items-center justify-between mb-8">
                                <div class="mb-4 md:mb-0">
                                    <h3 class="text-xl font-bold text-gray-800 mb-2">Rating Keseluruhan</h3>
                                    <div class="flex items-center">
                                        <div class="flex mr-2">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= $averageRating)
                                                    <i class="fas fa-star text-yellow-400 text-2xl"></i>
                                                @else
                                                    <i class="far fa-star text-gray-300 text-2xl"></i>
                                                @endif
                                            @endfor
                                        </div>
                                        <span
                                            class="text-3xl font-bold text-gray-800 ml-2">{{ number_format($averageRating, 1) }}</span>
                                        <span class="text-gray-500 ml-1">/5.0</span>
                                    </div>
                                    <p class="text-gray-600 mt-1">{{ $totalReviews }} ulasan</p>
                                </div>

                                <!-- Rating Breakdown -->
                                <div class="w-full md:w-1/2">
                                    @for ($i = 5; $i >= 1; $i--)
                                        <div class="flex items-center mb-2">
                                            <span class="text-sm font-medium text-gray-600 w-8">{{ $i }} <i
                                                    class="fas fa-star text-yellow-400"></i></span>
                                            <div class="flex-1 mx-2 h-2 bg-gray-200 rounded-full overflow-hidden">
                                                <div class="h-full bg-yellow-400"
                                                    style="width: {{ $totalReviews > 0 ? ($ratingCounts[$i] / $totalReviews) * 100 : 0 }}%">
                                                </div>
                                            </div>
                                            <span
                                                class="text-sm text-gray-600 w-10 text-right">{{ $ratingCounts[$i] }}</span>
                                        </div>
                                    @endfor
                                </div>
                            </div>

                            @auth
                                @php
                                    $canReview = auth()
                                        ->user()
                                        ->pemesanans()
                                        ->where('homestay_id', $homestay->id)
                                        ->where('status_pemesanan', 'check_out')
                                        ->exists();

                                    $hasReviewed = auth()
                                        ->user()
                                        ->reviews()
                                        ->where('homestay_id', $homestay->id)
                                        ->exists();
                                @endphp

                                @if ($canReview && !$hasReviewed)
                                    <button onclick="openReviewModal()"
                                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition">
                                        <i class="fas fa-star mr-2"></i> Beri Rating
                                    </button>
                                @elseif($hasReviewed)
                                    <div class="bg-green-100 text-green-800 px-4 py-2 rounded-lg">
                                        <i class="fas fa-check-circle mr-2"></i> Anda sudah memberikan ulasan
                                    </div>
                                @else
                                    <div class="bg-gray-100 text-gray-600 px-4 py-2 rounded-lg text-sm">
                                        <i class="fas fa-info-circle mr-2"></i>
                                        Berikan ulasan setelah check-out dari homestay ini
                                    </div>
                                @endif
                            @else
                                <a href="{{ route('login') }}?redirect={{ url()->current() }}#reviews"
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition">
                                    <i class="fas fa-sign-in-alt mr-2"></i> Login untuk Beri Ulasan
                                </a>
                            @endauth

                            <!-- Reviews List -->
                            <div class="space-y-6">
                                @forelse ($reviews as $review)
                                    <div class="border-b border-gray-200 pb-6 last:border-0 last:pb-0">
                                        <div class="flex justify-between items-start mb-3">
                                            <div class="flex items-center">
                                                <div class="mr-4">
                                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($review->user->name) }}&background=random&color=fff"
                                                        alt="{{ $review->user->name }}"
                                                        class="w-12 h-12 rounded-full">
                                                </div>
                                                <div>
                                                    <h4 class="font-bold text-gray-800">{{ $review->user->name }}</h4>
                                                    <div class="flex items-center">
                                                        <div class="flex mr-1">
                                                            @for ($i = 1; $i <= 5; $i++)
                                                                @if ($i <= $review->rating)
                                                                    <i class="fas fa-star text-yellow-400 text-sm"></i>
                                                                @else
                                                                    <i class="far fa-star text-gray-300 text-sm"></i>
                                                                @endif
                                                            @endfor
                                                        </div>
                                                        <span class="text-xs text-gray-500 ml-1">
                                                            {{ \Carbon\Carbon::parse($review->tanggal_ulasan)->translatedFormat('d M Y') }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            @if (auth()->id() === $review->user_id)
                                                <button onclick="confirmDeleteReview({{ $review->id }})"
                                                    class="text-gray-400 hover:text-red-500 transition">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            @endif
                                        </div>
                                        <p class="text-gray-700 mt-2">{{ $review->komentar }}</p>
                                    </div>
                                @empty
                                    <div class="text-center py-8">
                                        <i class="fas fa-comment-slash text-4xl text-gray-300 mb-3"></i>
                                        <p class="text-gray-500">Belum ada ulasan untuk homestay ini</p>
                                    </div>
                                @endforelse

                                <!-- Pagination -->
                                @if ($reviews->hasPages())
                                    <div class="mt-8">
                                        {{ $reviews->links() }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Review Modal -->
                    <div id="review-modal"
                        class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex items-center justify-center p-4">
                        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md">
                            <div class="p-6">
                                <div class="flex justify-between items-center mb-4">
                                    <h3 class="text-xl font-bold text-gray-800">Tambah Ulasan</h3>
                                    <button onclick="closeReviewModal()" class="text-gray-400 hover:text-gray-600">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>

                                <form id="review-form" action="{{ route('reviews.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="homestay_id" value="{{ $homestay->id }}">

                                    <div class="mb-6">
                                        <label class="block text-gray-700 font-medium mb-2">Rating</label>
                                        <div class="flex items-center" id="rating-stars">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <i class="far fa-star text-2xl text-gray-300 cursor-pointer mr-1"
                                                    data-rating="{{ $i }}" onmouseover="hoverStar(this)"
                                                    onmouseout="resetStars()" onclick="setRating(this)"></i>
                                            @endfor
                                        </div>
                                        <input type="hidden" name="rating" id="selected-rating" value="0">
                                        <p id="rating-error" class="text-red-500 text-sm mt-1 hidden">Silakan beri
                                            rating</p>
                                    </div>

                                    <div class="mb-6">
                                        <label for="comment"
                                            class="block text-gray-700 font-medium mb-2">Komentar</label>
                                        <textarea name="komentar" id="comment" rows="4"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                            placeholder="Bagaimana pengalaman Anda menginap di homestay ini?"></textarea>
                                        <p id="comment-error" class="text-red-500 text-sm mt-1 hidden">Silakan isi
                                            komentar</p>
                                    </div>

                                    <button type="submit"
                                        class="w-full bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 text-white py-3 rounded-xl font-medium transition-all shadow-md hover:shadow-lg">
                                        Kirim Ulasan
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Content -->
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 p-8">
                        <!-- Owner Profile Card -->
                        <div class="bg-gray-50 rounded-xl p-6 border border-gray-200 lg:col-span-1">
                            <div class="flex flex-col items-center text-center mb-6">
                                <div
                                    class="w-24 h-24 rounded-full bg-blue-100 flex items-center justify-center mb-4 overflow-hidden">
                                    @if ($homestay->pemilik->profile_photo ?? false)
                                        <img src="{{ asset('storage/' . $homestay->pemilik->profile_photo) }}"
                                            alt="Foto Profil" class="w-full h-full object-cover">
                                    @else
                                        <i class="fas fa-user text-blue-600 text-4xl"></i>
                                    @endif
                                </div>
                                <h3 class="text-xl font-bold text-gray-800">
                                    {{ $homestay->pemilik->name ?? 'Nama Pemilik' }}
                                </h3>
                                <p class="text-blue-600 font-medium">Pemilik {{ $homestay->nama }}</p>
                            </div>

                            <!-- Contact Methods -->
                            <div class="space-y-4">
                                <!-- Phone -->
                                <div
                                    class="flex items-center p-4 bg-white rounded-lg border border-gray-200 hover:shadow-md transition">
                                    <div class="bg-green-100 p-3 rounded-full mr-4 text-green-600">
                                        <i class="fas fa-phone-alt"></i>
                                    </div>
                                    <div class="text-left">
                                        <h4 class="font-medium text-gray-700">Telepon/WhatsApp</h4>
                                        <p class="text-gray-600">
                                            @if ($homestay->pemilik->no_telepon ?? false)
                                                <a href="https://wa.me/{{ $homestay->pemilik->no_telepon }}"
                                                    class="hover:text-green-600 transition flex items-center"
                                                    target="_blank">
                                                    {{ $homestay->pemilik->no_telepon }}
                                                    <i class="fas fa-external-link-alt ml-2 text-xs"></i>
                                                </a>
                                            @else
                                                <span class="text-gray-400">Tidak tersedia</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>

                                <!-- Email -->
                                <div
                                    class="flex items-center p-4 bg-white rounded-lg border border-gray-200 hover:shadow-md transition">
                                    <div class="bg-blue-100 p-3 rounded-full mr-4 text-blue-600">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <div class="text-left">
                                        <h4 class="font-medium text-gray-700">Email</h4>
                                        <p class="text-gray-600">
                                            @if ($homestay->pemilik->email ?? false)
                                                <a href="mailto:{{ $homestay->pemilik->email }}"
                                                    class="hover:text-blue-600 transition">
                                                    {{ $homestay->pemilik->email }}
                                                </a>
                                            @else
                                                <span class="text-gray-400">Tidak tersedia</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>

                                <!-- Response Time -->
                                <div
                                    class="flex items-center p-4 bg-white rounded-lg border border-gray-200 hover:shadow-md transition">
                                    <div class="bg-purple-100 p-3 rounded-full mr-4 text-purple-600">
                                        <i class="fas fa-clock"></i>
                                    </div>
                                    <div class="text-left">
                                        <h4 class="font-medium text-gray-700">Waktu Respon</h4>
                                        <p class="text-gray-600">Rata-rata 1-2 jam</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Contact Action Section -->
                        <div class="lg:col-span-2">
                            <!-- WhatsApp Direct Button -->
                            @if ($homestay->pemilik->no_telepon ?? false)
                                <div class="bg-green-50 rounded-xl p-6 border border-green-100 mb-6">
                                    <div class="flex flex-col md:flex-row items-center">
                                        <div class="md:mr-6 mb-4 md:mb-0">
                                            <div class="bg-green-100 p-4 rounded-full text-green-600">
                                                <i class="fab fa-whatsapp text-3xl"></i>
                                            </div>
                                        </div>
                                        <div class="flex-1 text-center md:text-left">
                                            <h3 class="text-xl font-bold text-gray-800 mb-2">Hubungi via WhatsApp</h3>
                                            <p class="text-gray-600 mb-4">Dapatkan respon cepat dengan menghubungi
                                                langsung
                                                via WhatsApp</p>
                                            <a href="https://wa.me/{{ $homestay->pemilik->no_telepon }}?text=Halo%20{{ urlencode($homestay->pemilik->name) }},%20saya%20tertarik%20dengan%20homestay%20{{ urlencode($homestay->nama) }}"
                                                class="inline-block bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg font-medium transition shadow-md hover:shadow-lg"
                                                target="_blank">
                                                <i class="fab fa-whatsapp mr-2"></i> Kirim Pesan Sekarang
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- Email Direct Button -->
                            @if ($homestay->pemilik->email ?? false)
                                <div class="bg-blue-50 rounded-xl p-6 border border-blue-100">
                                    <div class="flex flex-col md:flex-row items-center">
                                        <div class="md:mr-6 mb-4 md:mb-0">
                                            <div class="bg-blue-100 p-4 rounded-full text-blue-600">
                                                <i class="fas fa-envelope text-3xl"></i>
                                            </div>
                                        </div>
                                        <div class="flex-1 text-center md:text-left">
                                            <h3 class="text-xl font-bold text-gray-800 mb-2">Kirim Email</h3>
                                            <p class="text-gray-600 mb-4">Untuk pertanyaan lebih detail atau reservasi
                                                khusus</p>
                                            <a href="mailto:{{ $homestay->pemilik->email }}?subject=Penanyaan%20tentang%20Homestay%20{{ urlencode($homestay->nama) }}"
                                                class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium transition shadow-md hover:shadow-lg">
                                                <i class="fas fa-envelope mr-2"></i> Kirim Email Sekarang
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- Additional Info -->
                            <div class="mt-6 bg-yellow-50 rounded-xl p-5 border border-yellow-100">
                                <div class="flex">
                                    <div class="mr-4 text-yellow-500">
                                        <i class="fas fa-info-circle text-xl"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-gray-800 mb-1">Tips Berkomunikasi</h4>
                                        <p class="text-gray-600 text-sm">Sebutkan nama homestay, tanggal penginapan,
                                            dan
                                            jumlah tamu untuk mendapatkan respon lebih cepat.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <footer class="bg-gray-900 text-white pt-12 pb-6">
                <div class="container mx-auto px-4">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                        <div>
                            <h3 class="text-xl font-bold mb-4 flex items-center">
                                <i class="fas fa-hotel mr-2 text-blue-400"></i> WatHome.com
                            </h3>
                            <p class="text-gray-400">Platform pemesanan penginapan terbaik di Pacitan dengan berbagai
                                pilihan homestay berkualitas.</p>
                        </div>

                        <div>
                            <h4 class="text-lg font-semibold mb-4">Tautan Cepat</h4>
                            <ul class="space-y-2">
                                <li><a href="{{ route('about') }}"
                                        class="text-gray-400 hover:text-white transition">Tentang
                                        Kami</a></li>
                                <li><a href="{{ route('contact') }}"
                                        class="text-gray-400 hover:text-white transition">Kontak</a></li>
                                <li><a href="{{ route('faq') }}"
                                        class="text-gray-400 hover:text-white transition">FAQ</a>
                                </li>
                            </ul>
                        </div>

                        <div>
                            <h4 class="text-lg font-semibold mb-4">Dukungan</h4>
                            <ul class="space-y-2">
                                <li><a href="{{ route('privacy') }}"
                                        class="text-gray-400 hover:text-white transition">Kebijakan Privasi</a></li>
                                <li><a href="{{ route('terms') }}"
                                        class="text-gray-400 hover:text-white transition">Syarat &
                                        Ketentuan</a></li>
                                <li><a href="{{ route('help') }}"
                                        class="text-gray-400 hover:text-white transition">Bantuan</a></li>
                            </ul>
                        </div>

                        <div>
                            <h4 class="text-lg font-semibold mb-4">Hubungi Kami</h4>
                            <ul class="space-y-2 text-gray-400">
                                <li class="flex items-center">
                                    <i class="fas fa-map-marker-alt mr-3 text-blue-400"></i> Dsn. Ketro Watukarung No.
                                    17,
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
                            <a href="https://www.facebook.com/share/167HurYZ9F/" target="_blank"
                                rel="noopener noreferrer" class="text-gray-400 hover:text-white transition">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="https://twitter.com/blog_wathome" target="_blank" rel="noopener noreferrer"
                                class="text-gray-400 hover:text-white transition">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="https://www.instagram.com/wathome.official" target="_blank"
                                rel="noopener noreferrer" class="text-gray-400 hover:text-white transition">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </footer>

            <script>
                // ===== ROOM QUANTITY HANDLING =====
                // Variabel untuk menyimpan jumlah kamar yang dipilih per tipe
                const roomCounts = {};

                // Fungsi untuk menambah jumlah kamar dengan validasi ketersediaan
                function incrementRoom(roomId, availableRooms) {
                    if (!roomCounts[roomId]) {
                        roomCounts[roomId] = 0;
                    }

                    // Cek apakah sudah mencapai batas kamar tersedia
                    if (roomCounts[roomId] >= availableRooms) {
                        Swal.fire({
                            title: 'Kamar Tidak Tersedia',
                            text: `Maaf, hanya tersedia ${availableRooms} kamar untuk tipe ini pada tanggal yang dipilih.`,
                            icon: 'warning',
                            confirmButtonText: 'Mengerti'
                        });
                        return;
                    }

                    roomCounts[roomId]++;
                    document.getElementById(`room-count-${roomId}`).textContent = roomCounts[roomId];
                }

                // Fungsi untuk mengurangi jumlah kamar
                function decrementRoom(roomId) {
                    if (!roomCounts[roomId] || roomCounts[roomId] <= 0) return;
                    roomCounts[roomId]--;
                    document.getElementById(`room-count-${roomId}`).textContent = roomCounts[roomId];
                }

                // Fungsi untuk menambahkan kamar ke pemesanan dengan validasi
                function addToBooking(roomId, roomName, price, availableRooms) {
                    const count = roomCounts[roomId] || 0;

                    if (count <= 0) {
                        Swal.fire('Peringatan', 'Silakan pilih jumlah kamar terlebih dahulu', 'warning');
                        return;
                    }

                    // Validasi jumlah kamar yang dipilih tidak melebihi yang tersedia
                    if (count > availableRooms) {
                        Swal.fire({
                            title: 'Kamar Tidak Cukup',
                            text: `Maaf, hanya tersedia ${availableRooms} kamar untuk tipe ini pada tanggal yang dipilih.`,
                            icon: 'error',
                            confirmButtonText: 'Mengerti'
                        });
                        return;
                    }

                    const selectedRoomsContainer = document.getElementById('selected-rooms');
                    const existingRoom = document.querySelector(`[data-room-id="${roomId}"]`);

                    if (existingRoom) {
                        // Update jumlah kamar yang sudah ada
                        const currentCount = parseInt(existingRoom.querySelector('.room-quantity').textContent);
                        const newCount = currentCount + count;

                        // Validasi total kamar yang dipesan tidak melebihi yang tersedia
                        if (newCount > availableRooms) {
                            Swal.fire({
                                title: 'Kamar Tidak Cukup',
                                text: `Total pemesanan (${newCount}) melebihi kamar tersedia (${availableRooms})`,
                                icon: 'error',
                                confirmButtonText: 'Mengerti'
                            });
                            return;
                        }

                        existingRoom.querySelector('.room-quantity').textContent = newCount;
                    } else {
                        // Tambahkan kamar baru ke daftar
                        const roomElement = document.createElement('div');
                        roomElement.className = 'flex justify-between items-center p-3 bg-gray-50 rounded-lg mb-2';
                        roomElement.dataset.roomId = roomId;
                        roomElement.innerHTML = `
                <div>
                    <h4 class="font-medium">${roomName}</h4>
                    <p class="text-sm text-gray-600">Rp${price.toLocaleString('id-ID')}/malam</p>
                </div>
                <div class="flex items-center">
                    <span class="mr-4 text-gray-700">Jumlah: <span class="font-medium room-quantity">${count}</span></span>
                    <button onclick="removeFromBooking('${roomId}')" class="text-red-500 hover:text-red-700">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            `;
                        selectedRoomsContainer.appendChild(roomElement);
                    }


                    updateTotalPrice();
                    // Reset counter setelah ditambahkan
                    roomCounts[roomId] = 0;
                    document.getElementById(`room-count-${roomId}`).textContent = '0';
                }

                // Fungsi untuk menghapus kamar dari pemesanan
                function removeFromBooking(roomId) {
                    const roomElement = document.querySelector(`[data-room-id="${roomId}"]`);
                    if (roomElement) {
                        roomElement.remove();
                        updateTotalPrice();
                    }
                }

                // ===== ORIGINAL FUNCTIONS =====
                // Function untuk update total harga
                function updateTotalPrice() {
                    const selectedRooms = document.querySelectorAll('#selected-rooms [data-room-id]');
                    let total = 0;

                    selectedRooms.forEach(room => {
                        const priceText = room.querySelector('p').textContent;
                        const price = parseInt(priceText.replace(/[^\d]/g, ''));
                        const quantity = parseInt(room.querySelector('.room-quantity').textContent);
                        total += price * quantity;
                    });

                    document.getElementById('total-price').textContent = total.toLocaleString('id-ID');
                }

                // Modifikasi event listener untuk tombol continue booking
                document.getElementById('continue-booking-btn')?.addEventListener('click', function(e) {
                    e.preventDefault();
                    saveBookingData();

                    const checkin = "{{ $checkin }}";
                    const checkout = "{{ $checkout }}";

                    Swal.fire({
                        title: 'Login Diperlukan',
                        text: 'Anda perlu login terlebih dahulu untuk melanjutkan pemesanan.',
                        icon: 'info',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Login Sekarang',
                        cancelButtonText: 'Nanti Saja'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "{{ route('login') }}?redirect=" +
                                encodeURIComponent(window.location.pathname +
                                    `?checkin=${checkin}&checkout=${checkout}#room-selection`);
                        }
                    });
                });

                // Fungsi untuk menyimpan data pemesanan sementara
                // Fungsi untuk menyimpan data booking sementara
                // Fungsi untuk menyimpan data booking sementara
                function saveBookingData() {
                    const selectedRooms = [];
                    document.querySelectorAll('#selected-rooms [data-room-id]').forEach(room => {
                        selectedRooms.push({
                            id: room.dataset.roomId,
                            name: room.querySelector('h4').textContent,
                            price: parseInt(room.querySelector('p').textContent.replace(/[^\d]/g, '')),
                            quantity: parseInt(room.querySelector('.room-quantity').textContent)
                        });
                    });

                    localStorage.setItem('tempBookingData', JSON.stringify({
                        homestayId: "{{ $homestay->id }}",
                        selectedRooms: selectedRooms,
                        checkin: "{{ $checkin }}",
                        checkout: "{{ $checkout }}"
                    }));
                }

                // Fungsi untuk memulihkan data booking setelah login
                function restoreBookingData() {
                    const tempBookingData = localStorage.getItem('tempBookingData');
                    if (tempBookingData) {
                        const data = JSON.parse(tempBookingData);

                        // Pastikan data tersebut untuk homestay yang sama
                        if (data.homestayId === "{{ $homestay->id }}") {
                            const selectedRoomsContainer = document.getElementById('selected-rooms');

                            // Kosongkan dulu container
                            selectedRoomsContainer.innerHTML = '';

                            // Tambahkan kamar yang dipilih sebelumnya
                            data.selectedRooms.forEach(room => {
                                const roomElement = document.createElement('div');
                                roomElement.className = 'flex justify-between items-center p-3 bg-gray-50 rounded-lg mb-2';
                                roomElement.dataset.roomId = room.id;
                                roomElement.innerHTML = `
                    <div>
                        <h4 class="font-medium">${room.name}</h4>
                        <p class="text-sm text-gray-600">Rp${room.price.toLocaleString('id-ID')}/malam</p>
                    </div>
                    <div class="flex items-center">
                        <span class="mr-4 text-gray-700">Jumlah: <span class="font-medium room-quantity">${room.quantity}</span></span>
                        <button onclick="removeFromBooking('${room.id}')" class="text-red-500 hover:text-red-700">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                `;
                                selectedRoomsContainer.appendChild(roomElement);
                            });

                            // Update total harga
                            updateTotalPrice();

                            // Tampilkan panel pemesanan
                            document.getElementById('multi-room-booking-panel').classList.remove('hidden');

                            // Hapus data sementara dari localStorage
                            localStorage.removeItem('tempBookingData');
                        }
                    }
                }

                // Panggil fungsi ini sebelum redirect ke login
                document.getElementById('continue-booking-btn')?.addEventListener('click', function(e) {
                    e.preventDefault();
                    saveBookingData();

                    const checkin = "{{ $checkin }}";
                    const checkout = "{{ $checkout }}";

                    window.location.href = "{{ route('login') }}?redirect=" +
                        encodeURIComponent(window.location.pathname +
                            `?checkin=${checkin}&checkout=${checkout}#room-selection`);
                });

                // Fungsi untuk menangani submit form pemesanan multi kamar
                function submitMultiRoomBooking() {
                    // Validasi apakah user sudah login
                    @if (!auth()->check())
                        Swal.fire({
                            title: 'Login Diperlukan',
                            text: 'Anda perlu login terlebih dahulu untuk melakukan pemesanan.',
                            icon: 'info',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Login Sekarang',
                            cancelButtonText: 'Nanti Saja'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href =
                                    "{{ route('login') }}?redirect={{ url()->current() }}#room-selection";
                            }
                        });
                        return false;
                    @endif

                    const selectedRooms = document.querySelectorAll('#selected-rooms [data-room-id]');
                    if (selectedRooms.length === 0) {
                        Swal.fire({
                            title: 'Peringatan',
                            text: 'Silakan pilih setidaknya satu kamar',
                            icon: 'warning',
                            confirmButtonText: 'Mengerti'
                        });
                        return false;
                    }

                    const roomData = Array.from(selectedRooms).map(room => {
                        return {
                            id: room.dataset.roomId,
                            quantity: parseInt(room.querySelector('.room-quantity').textContent)
                        };
                    });

                    const form = document.getElementById('multi-room-booking-form');
                    document.getElementById('selected-room-ids').value = JSON.stringify(roomData);

                    // Ambil nilai checkin dan checkout dari form
                    const checkin = form.querySelector('[name="checkin"]').value;
                    const checkout = form.querySelector('[name="checkout"]').value;

                    // Submit form
                    form.submit();
                    return false;
                }
                // Tampilkan panel ketika kamar dipilih
                document.addEventListener('DOMContentLoaded', function() {
                    const selectedRoomsContainer = document.getElementById('selected-rooms');
                    const bookingPanel = document.getElementById('multi-room-booking-panel');

                    // Observer untuk memantau perubahan pada selected rooms
                    const observer = new MutationObserver(function(mutations) {
                        if (selectedRoomsContainer.children.length > 0) {
                            bookingPanel.classList.remove('hidden');
                        } else {
                            bookingPanel.classList.add('hidden');
                        }
                    });

                    observer.observe(selectedRoomsContainer, {
                        childList: true
                    });
                });

                // Variabel untuk menyimpan data gambar dan indeks saat ini
                let galleryImages = [];
                let currentImageIndex = 0;

                // Fungsi untuk membuka gallery modal
                function openGallery(initialIndex) {
                    // Kumpulkan semua gambar dari carousel
                    galleryImages = [];

                    // Tambahkan gambar utama
                    const mainImage = document.getElementById('main-image');
                    galleryImages.push({
                        src: mainImage.src,
                        alt: mainImage.alt
                    });

                    // Tambahkan gambar carousel
                    document.querySelectorAll('.thumbnail-image').forEach((img, index) => {
                        galleryImages.push({
                            src: img.src,
                            alt: img.alt
                        });
                    });

                    // Set indeks gambar awal
                    currentImageIndex = initialIndex;

                    // Tampilkan gambar utama di modal
                    document.getElementById('modal-main-image').src = galleryImages[currentImageIndex].src;
                    document.getElementById('modal-main-image').alt = galleryImages[currentImageIndex].alt;

                    // Update counter
                    document.getElementById('modal-image-counter').textContent = currentImageIndex + 1;
                    document.getElementById('modal-total-images').textContent = galleryImages.length;

                    // Buat thumbnail strip
                    const thumbnailsContainer = document.getElementById('modal-thumbnails');
                    thumbnailsContainer.innerHTML = '';

                    galleryImages.forEach((img, index) => {
                        const thumbnail = document.createElement('img');
                        thumbnail.src = img.src;
                        thumbnail.alt = img.alt;
                        thumbnail.className = `rounded-md ${index === currentImageIndex ? 'active-thumbnail' : ''}`;
                        thumbnail.onclick = () => changeModalImage(index);
                        thumbnailsContainer.appendChild(thumbnail);
                    });

                    // Tampilkan modal
                    document.getElementById('gallery-modal').classList.remove('hidden');
                    document.body.style.overflow = 'hidden';
                }

                // Fungsi untuk menutup gallery modal
                function closeGallery() {
                    document.getElementById('gallery-modal').classList.add('hidden');
                    document.body.style.overflow = '';
                }

                // Fungsi untuk mengganti gambar di modal
                function changeModalImage(index) {
                    if (index < 0 || index >= galleryImages.length) return;

                    currentImageIndex = index;
                    const modalImage = document.getElementById('modal-main-image');

                    // Efek fade out
                    modalImage.style.opacity = '0';

                    setTimeout(() => {
                        modalImage.src = galleryImages[currentImageIndex].src;
                        modalImage.alt = galleryImages[currentImageIndex].alt;
                        modalImage.style.opacity = '1';

                        // Update thumbnail aktif
                        document.querySelectorAll('#modal-thumbnails img').forEach((img, i) => {
                            if (i === currentImageIndex) {
                                img.classList.add('active-thumbnail');
                            } else {
                                img.classList.remove('active-thumbnail');
                            }
                        });

                        // Update counter
                        document.getElementById('modal-image-counter').textContent = currentImageIndex + 1;
                    }, 300);
                }
                // Fungsi untuk navigasi gambar
                function navigateGallery(direction) {
                    let newIndex = currentImageIndex + direction;

                    // Loop ke awal jika melebihi jumlah gambar
                    if (newIndex >= galleryImages.length) {
                        newIndex = 0;
                    } else if (newIndex < 0) {
                        newIndex = galleryImages.length - 1;
                    }

                    changeModalImage(newIndex);
                }

                // Update fungsi changeMainImage untuk menggunakan modal
                function changeMainImage(thumbnailElement, imageSrc) {
                    const index = parseInt(thumbnailElement.getAttribute('data-index'));
                    openGallery(index);
                }

                // Fungsi untuk toggle fullscreen
                function toggleFullscreen() {
                    const modal = document.getElementById('gallery-modal');
                    if (!document.fullscreenElement) {
                        modal.requestFullscreen().catch(err => {
                            console.error(`Error attempting to enable fullscreen: ${err.message}`);
                        });
                    } else {
                        document.exitFullscreen();
                    }
                }

                // Tambahkan di bagian akhir script
                document.addEventListener('keydown', function(e) {
                    const modal = document.getElementById('gallery-modal');
                    if (!modal.classList.contains('hidden')) {
                        if (e.key === 'Escape') {
                            closeGallery();
                        } else if (e.key === 'ArrowLeft') {
                            navigateGallery(-1);
                        } else if (e.key === 'ArrowRight') {
                            navigateGallery(1);
                        }
                    }
                });


                function showLoginAlert() {
                    Swal.fire({
                        title: 'Login Diperlukan',
                        text: 'Anda perlu login terlebih dahulu untuk melakukan pemesanan.',
                        icon: 'info',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Login Sekarang',
                        cancelButtonText: 'Nanti Saja'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Dapatkan tanggal checkin dan checkout dari URL atau form
                            const checkin = "{{ $checkin }}";
                            const checkout = "{{ $checkout }}";

                            // Redirect ke halaman login dengan menyertakan parameter tanggal
                            window.location.href = "{{ route('login') }}?redirect=" +
                                encodeURIComponent(window.location.pathname +
                                    `?checkin=${checkin}&checkout=${checkout}#room-selection`);
                        }
                    });
                }
                // Review Modal Functions
                function openReviewModal() {
                    document.getElementById('review-modal').classList.remove('hidden');
                    document.body.style.overflow = 'hidden';
                }

                function closeReviewModal() {
                    document.getElementById('review-modal').classList.add('hidden');
                    document.body.style.overflow = '';
                    resetStars();
                    document.getElementById('selected-rating').value = 0;
                    document.getElementById('comment').value = '';
                }

                function hoverStar(star) {
                    const rating = parseInt(star.getAttribute('data-rating'));
                    const stars = document.querySelectorAll('#rating-stars i');

                    stars.forEach((s, index) => {
                        if (index < rating) {
                            s.classList.remove('far', 'text-gray-300');
                            s.classList.add('fas', 'text-yellow-400');
                        } else {
                            s.classList.remove('fas', 'text-yellow-400');
                            s.classList.add('far', 'text-gray-300');
                        }
                    });
                }

                function resetStars() {
                    const selectedRating = parseInt(document.getElementById('selected-rating').value);
                    const stars = document.querySelectorAll('#rating-stars i');

                    if (selectedRating === 0) {
                        stars.forEach(s => {
                            s.classList.remove('fas', 'text-yellow-400');
                            s.classList.add('far', 'text-gray-300');
                        });
                    } else {
                        stars.forEach((s, index) => {
                            if (index < selectedRating) {
                                s.classList.remove('far', 'text-gray-300');
                                s.classList.add('fas', 'text-yellow-400');
                            } else {
                                s.classList.remove('fas', 'text-yellow-400');
                                s.classList.add('far', 'text-gray-300');
                            }
                        });
                    }
                }

                function setRating(star) {
                    const rating = parseInt(star.getAttribute('data-rating'));
                    document.getElementById('selected-rating').value = rating;
                }

                // Handle review form submission
                document.getElementById('review-form').addEventListener('submit', function(e) {
                    e.preventDefault();

                    const rating = parseInt(document.getElementById('selected-rating').value);
                    const comment = document.getElementById('comment').value.trim();
                    let isValid = true;

                    // Validate rating
                    if (rating === 0) {
                        document.getElementById('rating-error').classList.remove('hidden');
                        isValid = false;
                    } else {
                        document.getElementById('rating-error').classList.add('hidden');
                    }

                    // Validate comment
                    if (comment === '') {
                        document.getElementById('comment-error').classList.remove('hidden');
                        isValid = false;
                    } else {
                        document.getElementById('comment-error').classList.add('hidden');
                    }

                    if (isValid) {
                        this.submit();
                    }
                });

                // Panggil fungsi restore saat halaman dimuat
                document.addEventListener('DOMContentLoaded', function() {
                    restoreBookingData();

                    // Cek URL untuk parameter success setelah login
                    const urlParams = new URLSearchParams(window.location.search);
                    if (urlParams.has('login_success')) {
                        // Scroll ke bagian room selection
                        document.getElementById('room-selection').scrollIntoView({
                            behavior: 'smooth'
                        });

                        // Tampilkan notifikasi
                        Swal.fire({
                            title: 'Login Berhasil',
                            text: 'Anda telah berhasil login. Silakan lanjutkan pemesanan Anda.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });
                    }
                });

                // Confirm review deletion
                function confirmDeleteReview(reviewId) {
                    Swal.fire({
                        title: 'Hapus Ulasan?',
                        text: "Anda tidak dapat mengembalikan ulasan yang telah dihapus",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, Hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Submit delete form
                            const form = document.createElement('form');
                            form.method = 'POST';
                            form.action = `/reviews/${reviewId}`;

                            const csrfToken = document.createElement('input');
                            csrfToken.type = 'hidden';
                            csrfToken.name = '_token';
                            csrfToken.value = '{{ csrf_token() }}';
                            form.appendChild(csrfToken);

                            const methodInput = document.createElement('input');
                            methodInput.type = 'hidden';
                            methodInput.name = '_method';
                            methodInput.value = 'DELETE';
                            form.appendChild(methodInput);

                            document.body.appendChild(form);
                            form.submit();
                        }
                    });
                }
                // Fungsi untuk mendapatkan parameter URL
                function getUrlParameter(name) {
                    name = name.replace(/[\[\]]/g, '\\$&');
                    const regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)');
                    const results = regex.exec(window.location.href);
                    if (!results) return null;
                    if (!results[2]) return '';
                    return decodeURIComponent(results[2].replace(/\+/g, ' '));
                }

                // Set tanggal default
                const today = new Date();
                const tomorrow = new Date();
                tomorrow.setDate(today.getDate() + 1);

                // Cek parameter URL
                const urlCheckin = getUrlParameter('checkin');
                const urlCheckout = getUrlParameter('checkout');

                let checkinDate = urlCheckin ? new Date(urlCheckin) : today;
                let checkoutDate = urlCheckout ? new Date(urlCheckout) : tomorrow;

                // Validasi tanggal
                if (checkoutDate <= checkinDate) {
                    checkoutDate = new Date(checkinDate);
                    checkoutDate.setDate(checkinDate.getDate() + 1);
                }

                // Set nilai input
                const checkinDateInput = document.getElementById('checkin-date');
                const checkoutDateInput = document.getElementById('checkout-date');
                if (checkinDateInput) checkinDateInput.value = formatInputDate(checkinDate);
                if (checkoutDateInput) checkoutDateInput.value = formatInputDate(checkoutDate);

                // Update tampilan tanggal
                if (document.getElementById('checkin-day')) {
                    document.getElementById('checkin-day').textContent = days[checkinDate.getDay()];
                    document.getElementById('checkout-day').textContent = days[checkoutDate.getDay()];
                }

                if (document.getElementById('checkin-date-text')) {
                    document.getElementById('checkin-date-text').textContent = formatDisplayDate(checkinDate);
                    document.getElementById('checkout-date-text').textContent = formatDisplayDate(checkoutDate);
                }

                // Tanggal checkin dan checkout
                document.getElementById('checkin').addEventListener('change', function() {
                    const checkinDate = new Date(this.value);
                    const checkoutInput = document.getElementById('checkout');
                    const nextDay = new Date(checkinDate);
                    nextDay.setDate(nextDay.getDate() + 1);

                    // Set min date untuk checkout
                    checkoutInput.min = nextDay.toISOString().split('T')[0];

                    // Jika checkout lebih awal dari checkin +1, update checkout
                    const checkoutDate = new Date(checkoutInput.value);
                    if (checkoutDate <= checkinDate) {
                        checkoutInput.value = nextDay.toISOString().split('T')[0];
                    }
                });

                document.addEventListener('DOMContentLoaded', function() {
                    // Cek apakah ada data booking sementara di localStorage
                    const tempBookingData = localStorage.getItem('tempBookingData');
                    const urlParams = new URLSearchParams(window.location.search);
                    const checkin = urlParams.get('checkin');
                    const checkout = urlParams.get('checkout');

                    if (tempBookingData) {
                        const data = JSON.parse(tempBookingData);

                        // Pastikan data tersebut untuk homestay yang sama
                        if (data.homestayId === "{{ $homestay->id }}") {
                            // Pulihkan kamar yang dipilih
                            const selectedRoomsContainer = document.getElementById('selected-rooms');

                            data.selectedRooms.forEach(room => {
                                const roomElement = document.createElement('div');
                                roomElement.className =
                                    'flex justify-between items-center p-3 bg-gray-50 rounded-lg mb-2';
                                roomElement.dataset.roomId = room.id;
                                roomElement.innerHTML = `
                    <div>
                        <h4 class="font-medium">${room.name}</h4>
                        <p class="text-sm text-gray-600">Rp${room.price.toLocaleString('id-ID')}/malam</p>
                    </div>
                    <div class="flex items-center">
                        <span class="mr-4 text-gray-700">Jumlah: <span class="font-medium room-quantity">${room.quantity}</span></span>
                        <button onclick="removeFromBooking('${room.id}')" class="text-red-500 hover:text-red-700">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                `;
                                selectedRoomsContainer.appendChild(roomElement);
                            });

                            // Update total harga
                            updateTotalPrice();

                            // Tampilkan panel pemesanan
                            document.getElementById('multi-room-booking-panel').classList.remove('hidden');

                            // Hapus data sementara dari localStorage
                            localStorage.removeItem('tempBookingData');
                        }
                    }

                    // Jika ada parameter tanggal di URL, update tampilan
                    if (checkin && checkout) {
                        document.getElementById('checkin-date-text').textContent = formatDisplayDate(new Date(checkin));
                        document.getElementById('checkout-date-text').textContent = formatDisplayDate(new Date(checkout));
                    }
                });

                // ===== ANIMATIONS =====
                const animateOnScroll = () => {
                    document.querySelectorAll('.animate').forEach(element => {
                        const elementPosition = element.getBoundingClientRect().top;
                        const screenPosition = window.innerHeight / 1.2;
                        if (elementPosition < screenPosition) {
                            element.style.opacity = '1';
                            element.style.transform = 'translateY(0)';
                        }
                    });
                };

                document.querySelectorAll('.animate').forEach(el => {
                    el.style.opacity = '0';
                    el.style.transform = 'translateY(20px)';
                    el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                });

                animateOnScroll();
                window.addEventListener('scroll', animateOnScroll);
            </script>

        </body>

        </html>
