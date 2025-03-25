<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css">
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        .swiper-container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .swiper-pagination {
            position: absolute;
            bottom: 15px;
            left: 0;
            right: 0;
            text-align: center;
            z-index: 10;
        }

        .swiper-button-next,
        .swiper-button-prev {
            color: #fff;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            z-index: 10;
        }

        .swiper-button-next {
            right: 10px;
        }

        .swiper-button-prev {
            left: 10px;
        }

        /* Custom styles for "Mau ke mana?" section */
        .hero-section {
            width: 100%;
            max-width: 1500px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .hero-heading {
            text-align: left;
            font-size: 3rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
        }

        .hero-form {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            justify-content: flex-start;
            flex-wrap: wrap;
        }

        .hero-form input,
        .hero-form select {
            border: 1px solid #ddd;
            padding: 1rem;
            border-radius: 8px;
            width: calc(33.333% - 1.5rem);
            box-sizing: border-box;
        }

        .hero-form button {
            padding: 1.2rem 3rem;
            background-color: #3b82f6;
            color: #fff;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-left: auto;
            white-space: nowrap;
        }

        .hero-form button:hover {
            background-color: #2563eb;
        }

        /* Features Section Wrapper */
        .features-wrapper {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            margin-top: 40px;
        }

        .feature-item {
            background-color: #f87171;
            color: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            flex-basis: 30%;
            display: flex;
            align-items: center;
            justify-content: flex-start;
        }

        .feature-item i {
            font-size: 2rem;
            margin-right: 1rem;
        }

        /* Photo Grid Section */
        .photo-grid-section {
            margin-top: 40px;
            text-align: center;
        }

        .photo-grid-section h2 {
            font-size: 2rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
        }

        .photo-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 20px;
            margin-top: 20px;
        }

        .photo-item {
            position: relative;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .photo-item img {
            width: 100%;
            height: 350px;
            object-fit: cover;
        }

        .photo-item p {
            position: absolute;
            bottom: 10px;
            left: 10px;
            color: white;
            font-size: 1.2rem;
            font-weight: bold;
            text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.7);
        }

        .faq-section {
            margin-top: 40px;
        }

        .faq-question {
            background: #f9f9f9;
            cursor: pointer;
            padding: 15px;
            border: 1px solid #ddd;
            margin-bottom: 5px;
            border-radius: 5px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .faq-answer {
            padding: 15px;
            border-left: 3px solid #3b82f6;
            background: #f1f5f9;
            display: none;
        }
    </style>
</head>

<body class="antialiased bg-gray-100">

    <!-- Navbar -->
<header class="bg-white shadow-md py-4">
    <div class="container mx-auto px-4 flex justify-between items-center">
        <a href="/" class="text-2xl font-bold text-red-600 flex items-center">
            <i class="fas fa-hotel mr-2"></i> WatHome.com
        </a>
        
        <!-- Profile Dropdown -->
        <div class="relative">
            <button id="profile-menu-button" class="flex items-center space-x-2 focus:outline-none">
                <span class="hidden sm:inline text-gray-700">{{ Auth::user()->name ?? 'Guest' }}</span>
                <div class="w-10 h-10 rounded-full bg-blue-500 flex items-center justify-center text-white">
                    <i class="fas fa-user"></i>
                </div>
            </button>
            
            <!-- Dropdown Menu -->
            <div id="profile-dropdown" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">
                <a href="{{ route('profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profil Saya</a>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Pemesanan</a>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Pengaturan</a>
                <div class="border-t border-gray-200"></div>
                <a href="{{ route('welcome') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Keluar</a>
                
                <!-- Logout Form -->
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</header>

    <!-- Hero Section -->
    <main class="hero-section">
        <!-- "Mau ke mana?" Section -->
        <div class="text-left mt-10">
            <h1 class="hero-heading">Mau ke mana?</h1>
            <div class="hero-form">
                <form action="#" method="GET" class="w-full flex gap-4">
                    <input type="text" placeholder="Ke mana?"
                        class="focus:outline-none focus:ring focus:ring-blue-300">
                    <input type="date" class="focus:outline-none focus:ring focus:ring-blue-300">
                    <select class="focus:outline-none focus:ring focus:ring-blue-300">
                        <option>2 traveler, 1 kamar</option>
                    </select>
                    <button type="submit">
                        <i class="fas fa-search mr-2"></i> Cari
                    </button>
                </form>
            </div>
        </div>

        <!-- Features Section -->
        <div class="features-wrapper">
            <div class="feature-item">
                <i class="fas fa-bed"></i>
                <p>Temukan dan pesan penginapan yang indah Anda</p>
            </div>
            <div class="feature-item">
                <i class="fas fa-tags"></i>
                <p>Lebih hemat dengan Harga Member</p>
            </div>
            <div class="feature-item">
                <i class="fas fa-calendar-check"></i>
                <p>Opsi pembatalan gratis jika rencana berubah</p>
            </div>
        </div>

        <div class="photo-grid-section">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Daftar Homestay</h2>
            <div class="photo-grid">
                @foreach ($homestays as $homestay)
                    <div class="photo-item group">
                        <a href="{{ route('pemilik.homestays.detail', $homestay->id) }}" class="block h-full">
                            @if ($homestay->foto)
                                <img src="data:image/jpeg;base64,{{ base64_encode($homestay->foto) }}"
                                    alt="{{ $homestay->nama }}"
                                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                            @else
                                <div
                                    class="w-full h-full flex items-center justify-center bg-gradient-to-br from-gray-100 to-gray-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            @endif

                            <!-- Info yang selalu tampil -->
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent flex flex-col justify-end p-4">
                                <h3 class="text-white font-bold text-lg text-center">{{ $homestay->nama }}</h3>
                                <!-- Rating di tengah -->
                                <div class="flex justify-center mb-2">

                                    @php $rating = (int)($homestay->rating ?? 0); @endphp
                                    <div class="flex items-center">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $rating)
                                                <span class="text-yellow-400 text-sm">★</span>
                                            @else
                                                <span class="text-gray-300 text-sm">★</span>
                                            @endif
                                        @endfor
                                        <span
                                            class="text-white text-sm ml-1">{{ $rating > 0 ? $rating . '.0' : 'No rating' }}</span>
                                    </div>
                                </div>

                            </div>

                            <!-- Info tambahan yang muncul saat hover -->
                            <div
                                class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-4">
                        </a>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Photo Grid Wisata -->
        <div class="photo-grid-section">
            <h2>Jelajahi Wisata Pacitan</h2>
            <div class="photo-grid text-center">
                <div class="photo-item">
                    <img src="/images/GONG.jpeg" alt="Apartemen">
                    <p>Goa Gong</p>
                </div>
                <div class="photo-item">
                    <img src="/images/KASAP.jpeg" alt="Apartemen Keluarga">
                    <p>Pantai Kasap</p>
                </div>
                <div class="photo-item">
                    <img src="/images/KLAYAR.jpeg" alt="Cocok untuk Keluarga">
                    <p>Pantai Klayar</p>
                </div>
                <div class="photo-item">
                    <img src="/images/PANGASAN.jpeg" alt="Vila">
                    <p>Pantai Pangasan</p>
                </div>
                <div class="photo-item">
                    <img src="/images/WK.jpeg" alt="Resor">
                    <p>Pantai Watukarung</p>
                </div>
            </div>
        </div>
        <!-- FAQ Section -->
        <div class="faq-section">
            <h2 class="text-2xl font-bold">FAQ</h2>
            <div>
                <div class="faq-question">Bagaimana cara memesan hotel di WatHome.com? <span>+</span></div>
                <div class="faq-answer">Cari destinasi Anda, pilih tanggal, dan ikuti petunjuk pemesanan.</div>
                <div class="faq-question">Bagaimana cara mendapatkan harga murah di WatHome.com? <span>+</span></div>
                <div class="faq-answer">Gunakan filter harga dan cari penawaran diskon spesial.</div>
                <div class="faq-question">Di mana saya bisa menemukan promo di WatHome.com? <span>+</span></div>
                <div class="faq-answer">Kunjungi bagian "Promo" atau cari penawaran selama proses pemesanan.</div>
            </div>
        </div>
    </main>
    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-6 mt-10 w-full">
        <div class="container mx-auto px-4">
            <!-- Top Section -->
            <div class="flex flex-wrap justify-between items-center w-full">
                <!-- Social Media -->
                <div class="mb-4 lg:mb-0">
                    <h3 class="text-lg font-bold mb-2">Ikuti Kami</h3>
                    <div class="flex gap-4">
                        <a href="https://www.facebook.com" target="_blank" class="hover:text-blue-500">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://www.twitter.com" target="_blank" class="hover:text-blue-400">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="https://www.instagram.com" target="_blank" class="hover:text-pink-500">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="https://www.linkedin.com" target="_blank" class="hover:text-blue-600">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>

                <!-- Contact Info -->
                <div>
                    <h3 class="text-lg font-bold mb-2">Kontak Kami</h3>
                    <p>
                        <i class="fas fa-envelope"></i> <a href="mailto:info@wathome.com"
                            class="hover:text-blue-400">info@wathome.com</a>
                    </p>
                    <p>
                        <i class="fas fa-phone-alt"></i> <a href="tel:+621234567890" class="hover:text-blue-400">+62
                            123
                            456 7890</a>
                    </p>
                    <p>
                        <i class="fas fa-map-marker-alt"></i> Jl. Mawar No. 123, Jakarta, Indonesia
                    </p>
                </div>
            </div>

            <!-- Bottom Section -->
            <div class="mt-6 border-t border-gray-700 pt-4 text-center w-full">
                <p>&copy; 2025 WatHome.com. Semua Hak Cipta Dilindungi.</p>
            </div>
        </div>
    </footer>

    <script>
        // FAQ toggle
        document.querySelectorAll('.faq-question').forEach(question => {
            question.addEventListener('click', () => {
                const answer = question.nextElementSibling;
                answer.style.display = answer.style.display === 'block' ? 'none' : 'block';
                
                // Toggle icon +/-
                const icon = question.querySelector('span');
                if (answer.style.display === 'block') {
                    icon.textContent = '-';
                } else {
                    icon.textContent = '+';
                }
            });
        });
    
        // Profile dropdown toggle
        const profileButton = document.getElementById('profile-menu-button');
        const profileDropdown = document.getElementById('profile-dropdown');
    
        if (profileButton && profileDropdown) {
            profileButton.addEventListener('click', (e) => {
                e.stopPropagation();
                profileDropdown.classList.toggle('hidden');
            });
    
            // Close dropdown when clicking outside
            document.addEventListener('click', () => {
                profileDropdown.classList.add('hidden');
            });
        }
    
        // Prevent dropdown close when clicking inside
        if (profileDropdown) {
            profileDropdown.addEventListener('click', (e) => {
                e.stopPropagation();
            });
        }
    </script>

</body>

</html>
