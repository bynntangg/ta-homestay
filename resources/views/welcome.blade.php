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
        <div class="container mx-auto flex justify-between items-center px-4">
            <a href="/" class="text-2xl font-bold text-red-600 flex items-center">
                <i class="fas fa-hotel mr-2"></i> WatHome.com
            </a>
        </div>
    </header>

    <!-- Hero Section -->
    <main class="hero-section">
        <!-- "Mau ke mana?" Section -->
        <div class="text-left mt-10">
            <h1 class="hero-heading">Mau ke mana?</h1>
            <div class="hero-form">
                <form action="#" method="GET" class="w-full flex gap-4">
                    <input type="text" placeholder="Ke mana?" class="focus:outline-none focus:ring focus:ring-blue-300">
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

        <!-- Member Section -->
        <div class="mt-10 text-center">
            <div class="bg-indigo-600 text-white py-6 rounded-lg shadow-md">
                <p class="text-lg">Member hemat minimum 10% di lebih dari 100.000 hotel di seluruh dunia jika login</p>
                <div class="flex justify-center mt-4 gap-4">
                    <a href="{{ route('login') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded transition duration-200 flex items-center">
                        <i class="fas fa-sign-in-alt mr-2"></i> Login sekarang
                    </a>
                    <a href="{{ route('register') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-6 rounded transition duration-200 flex items-center">
                        <i class="fas fa-user-plus mr-2"></i> Register
                    </a>
                </div>
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

        <!-- Photo Grid Section -->
        <div class="photo-grid-section">
            <h2>Temukan tempat menginap favorit baru Anda</h2>
            <div class="photo-grid">
                <div class="photo-item">
                    <img src="/images/apatemen.jpg" alt="Apartemen">
                    <p>Apartemen</p>
                </div>
                <div class="photo-item">
                    <img src="/images/family.jpg" alt="Apartemen Keluarga">
                    <p>Apartemen Keluarga</p>
                </div>
                <div class="photo-item">
                    <img src="/images/familyhappy.jpg" alt="Cocok untuk Keluarga">
                    <p>Cocok untuk Keluarga</p>
                </div>
                <div class="photo-item">
                    <img src="/images/vila.jpg" alt="Vila">
                    <p>Vila</p>
                </div>
                <div class="photo-item">
                    <img src="/images/resot.jpg" alt="Resor">
                    <p>Resor</p>
                </div>
            </div>
        </div>

         <!-- Photo Grid Section -->
         <div class="photo-grid-section">
            <h2>Jelajahi Wisata Pacitan</h2>
            <div class="photo-grid">
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
    <!-- FAQ -->
    <section class="py-12">
        <h2 class="text-2xl font-bold">FAQ</h2>
        <div class="max-w-4xl mx-auto mt-6">
            <details class="border p-4 rounded-lg mb-4">
                <summary class="font-semibold cursor-pointer">Bagaimana cara memesan homestay?</summary>
                <p class="mt-2 text-gray-600">Cari destinasi Anda, pilih tanggal, dan ikuti petunjuk pemesanan.</p>
            </details>
            <details class="border p-4 rounded-lg mb-4">
                <summary class="font-semibold cursor-pointer">Bagaimana cara mendapatkan harga murah di WatHome.com?</summary>
                <p class="mt-2 text-gray-600">Gunakan filter harga dan cari penawaran diskon spesial.</p>
            </details>
            <details class="border p-4 rounded-lg mb-4">
                <summary class="font-semibold cursor-pointer">Di mana saya bisa menemukan promo di WatHome.com?</summary>
                <p class="mt-2 text-gray-600">Kunjungi bagian "Promo" atau cari penawaran selama proses pemesanan.</p>
            </details>
        </div>
    </section>
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
                        <i class="fas fa-envelope"></i> <a href="mailto:info@wathome.com" class="hover:text-blue-400">info@wathome.com</a>
                    </p>
                    <p>
                        <i class="fas fa-phone-alt"></i> <a href="tel:+621234567890" class="hover:text-blue-400">+62 123 456 7890</a>
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
    document.querySelectorAll('.faq-question').forEach(question => {
        question.addEventListener('click', () => {
            const answer = question.nextElementSibling;
            answer.style.display = answer.style.display === 'block' ? 'none' : 'block';
        });
    });
</script>
</body>
</html>
