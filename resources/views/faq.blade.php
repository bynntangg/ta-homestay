<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ - WatHome</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        /* Styling khusus FAQ */
        .faq-hero {
            background: linear-gradient(135deg, #1E3A8A 0%, #3B82F6 100%);
            color: white;
            padding: 6rem 0 4rem;
            position: relative;
            overflow: hidden;
        }
        
        .faq-hero:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('/images/hero-pattern.png') center/cover no-repeat;
            opacity: 0.1;
        }
        
        .faq-item {
            border: 1px solid #E5E7EB;
            border-radius: 8px;
            overflow: hidden;
            margin-bottom: 1rem;
            transition: all 0.3s ease;
        }
        
        .faq-item:hover {
            border-color: #3B82F6;
            box-shadow: 0 5px 15px rgba(59, 130, 246, 0.1);
        }
        
        .faq-question {
            padding: 1.5rem;
            background: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
            font-weight: 600;
        }
        
        .faq-answer {
            padding: 0 1.5rem;
            max-height: 0;
            overflow: hidden;
            transition: all 0.3s ease;
            background: #F9FAFB;
        }
        
        .faq-answer.active {
            padding: 1.5rem;
            max-height: 500px;
        }
        
        .faq-category {
            background: #EFF6FF;
            color: #3B82F6;
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-size: 0.9rem;
            margin-right: 1rem;
        }
        
        .search-faq {
            border: 2px solid #E5E7EB;
            border-radius: 50px;
            padding: 0.8rem 1.5rem;
            width: 100%;
            max-width: 600px;
            margin: 0 auto 3rem;
            transition: all 0.3s ease;
        }
        
        .search-faq:focus {
            border-color: #3B82F6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
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
<body class="antialiased">
    <!-- Header -->
    <header class="header py-4 text-white">
        <div class="container mx-auto px-4 flex justify-between items-center">
            <a href="/"
                class="text-3xl font-bold text-white flex items-center transition duration-300 hover:text-blue-100">
                <i class="fas fa-home mr-3 text-blue-200"></i>
                <span>WatHome</span>
                <span class="text-xs ml-2 bg-white bg-opacity-20 text-white px-2 py-1 rounded-full">.com</span>
            </a>
            <nav class="hidden md:flex space-x-8">
                <a href="/" class="text-white-700 hover:text-blue-600">Beranda</a>
                <a href="{{ route('about') }}" class="text-white-700 hover:text-blue-600">Tentang Kami</a>
                <a href="{{ route('contact') }}" class="text-white-700 hover:text-blue-600">Kontak</a>
                <a href="{{ route('faq') }}" class="text-blue-600 font-medium">FAQ</a>
            </nav>
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

    <!-- Hero Section -->
    <section class="faq-hero relative">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-6">Pertanyaan yang Sering Diajukan</h1>
                <p class="text-xl text-blue-100 mb-8">Temukan jawaban atas pertanyaan Anda tentang pemesanan, pembayaran, dan penginapan di WatHome</p>
                
                <!-- Search Box -->
                <div class="relative">
                    <input type="text" placeholder="Cari pertanyaan..." class="search-faq">
                    <button class="absolute right-5 top-1/2 transform -translate-y-1/2 text-gray-400">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Content -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <!-- Kategori: Pemesanan -->
                <h2 class="text-2xl font-bold mb-6 text-gray-800 flex items-center">
                    <i class="fas fa-calendar-check mr-3 text-blue-600"></i> Pemesanan
                </h2>
                
                <div class="mb-8">
                    <div class="faq-item">
                        <div class="faq-question">
                            <span>Bagaimana cara memesan homestay di WatHome?</span>
                            <i class="fas fa-chevron-down text-blue-600 transition-transform"></i>
                        </div>
                        <div class="faq-answer">
                            <p class="text-gray-600">Anda bisa mencari homestay melalui kolom pencarian di beranda, pilih tanggal menginap, lalu klik tombol "Pesan Sekarang". Ikuti langkah-langkah selanjutnya untuk menyelesaikan pemesanan.</p>
                        </div>
                    </div>
                    
                    <div class="faq-item">
                        <div class="faq-question">
                            <span>Apakah saya bisa memesan untuk hari yang sama?</span>
                            <i class="fas fa-chevron-down text-blue-600 transition-transform"></i>
                        </div>
                        <div class="faq-answer">
                            <p class="text-gray-600">Ya, Anda bisa memesan untuk hari yang sama selama homestay masih tersedia. Sistem kami menampilkan ketersediaan real-time.</p>
                        </div>
                    </div>
                    
                    <div class="faq-item">
                        <div class="faq-question">
                            <span>Berapa lama waktu tunggu konfirmasi pemesanan?</span>
                            <i class="fas fa-chevron-down text-blue-600 transition-transform"></i>
                        </div>
                        <div class="faq-answer">
                            <p class="text-gray-600">Konfirmasi pemesanan biasanya diterima dalam waktu 15 menit - 2 jam setelah pembayaran berhasil. Jika lebih dari 4 jam belum menerima konfirmasi, silakan hubungi customer service kami.</p>
                        </div>
                    </div>
                </div>
                
                <!-- Kategori: Pembayaran -->
                <h2 class="text-2xl font-bold mb-6 text-gray-800 flex items-center">
                    <i class="fas fa-credit-card mr-3 text-blue-600"></i> Pembayaran
                </h2>
                
                <div class="mb-8">
                    <div class="faq-item">
                        <div class="faq-question">
                            <span>Metode pembayaran apa saja yang diterima?</span>
                            <i class="fas fa-chevron-down text-blue-600 transition-transform"></i>
                        </div>
                        <div class="faq-answer">
                            <p class="text-gray-600">Kami menerima berbagai metode pembayaran termasuk transfer bank (BCA, Mandiri, BRI, BNI), e-wallet (OVO, Gopay, Dana, ShopeePay), dan kartu kredit (Visa, Mastercard).</p>
                        </div>
                    </div>
                    
                    <div class="faq-item">
                        <div class="faq-question">
                            <span>Apakah ada biaya tambahan untuk pemesanan?</span>
                            <i class="fas fa-chevron-down text-blue-600 transition-transform"></i>
                        </div>
                        <div class="faq-answer">
                            <p class="text-gray-600">Tidak ada biaya tambahan. Harga yang tertera sudah termasuk semua pajak dan biaya layanan. Anda hanya membayar sesuai harga yang ditampilkan.</p>
                        </div>
                    </div>
                    
                    <div class="faq-item">
                        <div class="faq-question">
                            <span>Bagaimana jika pembayaran saya gagal?</span>
                            <i class="fas fa-chevron-down text-blue-600 transition-transform"></i>
                        </div>
                        <div class="faq-answer">
                            <p class="text-gray-600">Jika pembayaran gagal, silakan coba metode pembayaran lainnya. Pemesanan akan otomatis dibatalkan setelah 2 jam jika tidak ada pembayaran yang berhasil. Pastikan saldo atau limit kartu Anda mencukupi.</p>
                        </div>
                    </div>
                </div>
                
                <!-- Kategori: Pembatalan -->
                <h2 class="text-2xl font-bold mb-6 text-gray-800 flex items-center">
                    <i class="fas fa-calendar-times mr-3 text-blue-600"></i> Pembatalan
                </h2>
                
                <div class="mb-8">
                    <div class="faq-item">
                        <div class="faq-question">
                            <span>Bagaimana cara membatalkan pemesanan?</span>
                            <i class="fas fa-chevron-down text-blue-600 transition-transform"></i>
                        </div>
                        <div class="faq-answer">
                            <p class="text-gray-600">Anda bisa membatalkan pemesanan melalui halaman "Pesanan Saya" di akun Anda atau menghubungi customer service kami. Pastikan untuk memeriksa kebijakan pembatalan sebelum melakukan pembatalan.</p>
                        </div>
                    </div>
                    
                    <div class="faq-item">
                        <div class="faq-question">
                            <span>Apakah uang bisa kembali 100% jika dibatalkan?</span>
                            <i class="fas fa-chevron-down text-blue-600 transition-transform"></i>
                        </div>
                        <div class="faq-answer">
                            <p class="text-gray-600">Kebijakan pengembalian dana tergantung pada kebijakan homestay yang Anda pesan dan waktu pembatalan. Pembatalan dalam 24 jam pertama biasanya mendapatkan pengembalian penuh.</p>
                        </div>
                    </div>
                    
                    <div class="faq-item">
                        <div class="faq-question">
                            <span>Berapa lama proses pengembalian dana?</span>
                            <i class="fas fa-chevron-down text-blue-600 transition-transform"></i>
                        </div>
                        <div class="faq-answer">
                            <p class="text-gray-600">Proses pengembalian dana membutuhkan waktu 3-10 hari kerja tergantung metode pembayaran yang digunakan. Dana akan dikembalikan ke rekening/sumber pembayaran asal.</p>
                        </div>
                    </div>
                </div>
                
                <!-- Pertanyaan Lain -->
                <div class="text-center mt-12">
                    <h3 class="text-xl font-bold mb-4">Masih ada pertanyaan?</h3>
                    <p class="text-gray-600 mb-6">Tim support kami siap membantu Anda 24/7</p>
                    <a href="{{ route('contact') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg inline-block transition duration-300">
                        <i class="fas fa-headset mr-2"></i> Hubungi Kami
                    </a>
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
                        <li><a href="{{ route('about') }}" class="text-gray-400 hover:text-white transition">Tentang Kami</a></li>
                        <li><a href="{{ route('contact') }}" class="text-gray-400 hover:text-white transition">Kontak</a></li>
                        <li><a href="{{ route('faq') }}" class="text-gray-400 hover:text-white transition">FAQ</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-lg font-semibold mb-4">Dukungan</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ route('privacy') }}" class="text-gray-400 hover:text-white transition">Kebijakan Privasi</a></li>
                        <li><a href="{{ route('terms') }}" class="text-gray-400 hover:text-white transition">Syarat & Ketentuan</a></li>
                        <li><a href="{{ route('help') }}" class="text-gray-400 hover:text-white transition">Bantuan</a></li>
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
                <p class="text-gray-400 text-sm mb-4 md:mb-0">&copy; {{ date('Y') }} WatHome.com. All rights reserved.</p>
                <div class="flex space-x-4">
                    <a href="https://www.facebook.com/share/167HurYZ9F/" target="_blank" rel="noopener noreferrer" class="text-gray-400 hover:text-white transition">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="https://twitter.com/blog_wathome" target="_blank" rel="noopener noreferrer" class="text-gray-400 hover:text-white transition">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="https://www.instagram.com/wathome.official" target="_blank" rel="noopener noreferrer" class="text-gray-400 hover:text-white transition">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // FAQ Toggle Functionality
        document.querySelectorAll('.faq-question').forEach(question => {
            question.addEventListener('click', () => {
                const answer = question.nextElementSibling;
                const icon = question.querySelector('i');
                
                // Toggle answer
                answer.classList.toggle('active');
                
                // Toggle icon
                if (answer.classList.contains('active')) {
                    icon.classList.remove('fa-chevron-down');
                    icon.classList.add('fa-chevron-up');
                } else {
                    icon.classList.remove('fa-chevron-up');
                    icon.classList.add('fa-chevron-down');
                }
                
                // Close other open FAQs in the same category
                const parentCategory = question.closest('.mb-8');
                parentCategory.querySelectorAll('.faq-answer').forEach(otherAnswer => {
                    if (otherAnswer !== answer && otherAnswer.classList.contains('active')) {
                        otherAnswer.classList.remove('active');
                        const otherIcon = otherAnswer.previousElementSibling.querySelector('i');
                        otherIcon.classList.remove('fa-chevron-up');
                        otherIcon.classList.add('fa-chevron-down');
                    }
                });
            });
        });
        
        // Search Functionality
        const searchInput = document.querySelector('.search-faq');
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const questions = document.querySelectorAll('.faq-question span');
            
            questions.forEach(question => {
                const questionText = question.textContent.toLowerCase();
                const faqItem = question.closest('.faq-item');
                
                if (questionText.includes(searchTerm)) {
                    faqItem.style.display = 'block';
                } else {
                    faqItem.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>