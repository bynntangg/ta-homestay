<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pusat Bantuan - WatHome</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        /* Styling khusus halaman Bantuan */
        .help-hero {
            background: linear-gradient(135deg, #1E3A8A 0%, #3B82F6 100%);
            color: white;
            padding: 6rem 0 4rem;
            position: relative;
            overflow: hidden;
        }
        
        .help-hero:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('/images/hero-pattern.png') center/cover no-repeat;
            opacity: 0.1;
        }
        
        .help-search {
            max-width: 600px;
            margin: 0 auto 3rem;
            position: relative;
        }
        
        .help-search input {
            width: 100%;
            padding: 1rem 1.5rem;
            border-radius: 50px;
            border: 2px solid #E5E7EB;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        
        .help-search input:focus {
            border-color: #3B82F6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
            outline: none;
        }
        
        .help-search button {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #6B7280;
            cursor: pointer;
        }
        
        .help-categories {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 3rem;
        }
        
        .help-category {
            background: white;
            border-radius: 10px;
            padding: 1.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }
        
        .help-category:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        }
        
        .help-category-icon {
            width: 50px;
            height: 50px;
            background: #EFF6FF;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
            color: #3B82F6;
            font-size: 1.25rem;
        }
        
        .help-articles {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }
        
        .help-article {
            border-bottom: 1px solid #E5E7EB;
            padding: 1.5rem;
        }
        
        .help-article:last-child {
            border-bottom: none;
        }
        
        .help-article-question {
            font-weight: 600;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
        }
        
        .help-article-answer {
            max-height: 0;
            overflow: hidden;
            transition: all 0.3s ease;
            color: #6B7280;
        }
        
        .help-article-answer.active {
            max-height: 500px;
            padding-top: 1rem;
        }
        
        .help-contact {
            background: #EFF6FF;
            border-radius: 10px;
            padding: 2rem;
            text-align: center;
            margin-top: 3rem;
        }
        
        @media (max-width: 640px) {
            .help-categories {
                grid-template-columns: 1fr;
            }
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
                <a href="{{ route('privacy') }}" class="text-white-700 hover:text-blue-600">Kebijakan Privasi</a>
                <a href="{{ route('terms') }}" class="text-white-700 hover:text-blue-600">Syarat & Ketentuan</a>
                <a href="{{ route('help') }}" class="text-blue-600 font-medium">Bantuan</a>
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
    <section class="help-hero relative">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-6">Pusat Bantuan</h1>
            <p class="text-xl text-blue-100 mb-8">Temukan solusi untuk masalah Anda atau hubungi tim dukungan kami</p>
            
            <!-- Search Box -->
            <div class="help-search">
                <input type="text" placeholder="Cari solusi...">
                <button type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </section>

    <!-- Help Content -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <!-- Kategori Bantuan -->
            <h2 class="text-2xl font-bold mb-6 text-gray-800">Kategori Bantuan</h2>
            <div class="help-categories">
                <a href="#pemesanan" class="help-category">
                    <div class="help-category-icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <h3 class="font-semibold mb-2">Pemesanan</h3>
                    <p class="text-gray-600 text-sm">Proses pemesanan, perubahan, dan konfirmasi</p>
                </a>
                
                <a href="#pembayaran" class="help-category">
                    <div class="help-category-icon">
                        <i class="fas fa-credit-card"></i>
                    </div>
                    <h3 class="font-semibold mb-2">Pembayaran</h3>
                    <p class="text-gray-600 text-sm">Metode pembayaran, voucher, dan refund</p>
                </a>
                
                <a href="#akun" class="help-category">
                    <div class="help-category-icon">
                        <i class="fas fa-user-circle"></i>
                    </div>
                    <h3 class="font-semibold mb-2">Akun</h3>
                    <p class="text-gray-600 text-sm">Masuk, daftar, dan pengaturan akun</p>
                </a>
                
                <a href="#homestay" class="help-category">
                    <div class="help-category-icon">
                        <i class="fas fa-home"></i>
                    </div>
                    <h3 class="font-semibold mb-2">Homestay</h3>
                    <p class="text-gray-600 text-sm">Fasilitas, lokasi, dan kebijakan</p>
                </a>
            </div>
            
            <!-- Artikel Bantuan -->
            <h2 class="text-2xl font-bold mb-6 text-gray-800">Pertanyaan Umum</h2>
            <div class="help-articles">
                <!-- Pemesanan -->
                <div class="help-article" id="pemesanan">
                    <div class="help-article-question">
                        <span>Bagaimana cara memesan homestay di WatHome?</span>
                        <i class="fas fa-chevron-down text-blue-600"></i>
                    </div>
                    <div class="help-article-answer">
                        <p>Untuk memesan homestay:</p>
                        <ol class="list-decimal pl-5 mt-2 space-y-2">
                            <li>Cari homestay menggunakan kolom pencarian di beranda</li>
                            <li>Pilih tanggal check-in dan check-out</li>
                            <li>Pilih jumlah tamu dan kamar</li>
                            <li>Klik "Pesan Sekarang"</li>
                            <li>Isi data tamu dan pilih metode pembayaran</li>
                            <li>Lakukan pembayaran sesuai instruksi</li>
                            <li>Anda akan menerima email konfirmasi setelah pembayaran berhasil</li>
                        </ol>
                    </div>
                </div>
                
                <div class="help-article">
                    <div class="help-article-question">
                        <span>Bagaimana cara mengubah atau membatalkan pemesanan?</span>
                        <i class="fas fa-chevron-down text-blue-600"></i>
                    </div>
                    <div class="help-article-answer">
                        <p>Untuk perubahan atau pembatalan:</p>
                        <ul class="list-disc pl-5 mt-2 space-y-2">
                            <li>Masuk ke akun Anda dan buka halaman "Pesanan Saya"</li>
                            <li>Pilih pemesanan yang ingin diubah/dibatalkan</li>
                            <li>Ikuti instruksi yang tersedia</li>
                            <li>Perubahan tergantung pada ketersediaan dan kebijakan homestay</li>
                            <li>Pembatalan mungkin dikenakan biaya sesuai kebijakan yang berlaku</li>
                        </ul>
                        <p class="mt-3">Untuk bantuan lebih lanjut, hubungi tim dukungan kami.</p>
                    </div>
                </div>
                
                <!-- Pembayaran -->
                <div class="help-article" id="pembayaran">
                    <div class="help-article-question">
                        <span>Metode pembayaran apa saja yang diterima?</span>
                        <i class="fas fa-chevron-down text-blue-600"></i>
                    </div>
                    <div class="help-article-answer">
                        <p>WatHome menerima berbagai metode pembayaran:</p>
                        <div class="grid grid-cols-2 gap-4 mt-3">
                            <div class="flex items-center">
                                <i class="fas fa-university mr-3 text-blue-600"></i>
                                <span>Transfer Bank (BCA, Mandiri, BRI, BNI)</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-mobile-alt mr-3 text-blue-600"></i>
                                <span>E-Wallet (OVO, Dana, Gopay, ShopeePay)</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-credit-card mr-3 text-blue-600"></i>
                                <span>Kartu Kredit (Visa, Mastercard)</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-store mr-3 text-blue-600"></i>
                                <span>Minimarket (Alfamart, Indomaret)</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="help-article">
                    <div class="help-article-question">
                        <span>Berapa lama waktu tunggu untuk pengembalian dana?</span>
                        <i class="fas fa-chevron-down text-blue-600"></i>
                    </div>
                    <div class="help-article-answer">
                        <p>Waktu pengembalian dana bervariasi tergantung metode pembayaran:</p>
                        <ul class="list-disc pl-5 mt-2 space-y-2">
                            <li><strong>Kartu Kredit:</strong> 3-10 hari kerja</li>
                            <li><strong>Transfer Bank:</strong> 1-3 hari kerja</li>
                            <li><strong>E-Wallet:</strong> 1-7 hari kerja</li>
                        </ul>
                        <p class="mt-3">Proses mungkin memakan waktu lebih lama jika ada investigasi tambahan yang diperlukan.</p>
                    </div>
                </div>
                
                <!-- Akun -->
                <div class="help-article" id="akun">
                    <div class="help-article-question">
                        <span>Bagaimana cara mengubah password akun saya?</span>
                        <i class="fas fa-chevron-down text-blue-600"></i>
                    </div>
                    <div class="help-article-answer">
                        <p>Untuk mengubah password:</p>
                        <ol class="list-decimal pl-5 mt-2 space-y-2">
                            <li>Masuk ke akun Anda</li>
                            <li>Klik foto profil di pojok kanan atas</li>
                            <li>Pilih "Pengaturan Akun"</li>
                            <li>Pilih tab "Keamanan"</li>
                            <li>Klik "Ubah Password"</li>
                            <li>Masukkan password lama dan password baru</li>
                            <li>Klik "Simpan Perubahan"</li>
                        </ol>
                        <p class="mt-3">Jika lupa password, gunakan fitur "Lupa Password" di halaman login.</p>
                    </div>
                </div>
                
                <!-- Homestay -->
                <div class="help-article" id="homestay">
                    <div class="help-article-question">
                        <span>Apa saja fasilitas yang biasanya tersedia di homestay?</span>
                        <i class="fas fa-chevron-down text-blue-600"></i>
                    </div>
                    <div class="help-article-answer">
                        <p>Fasilitas bervariasi tergantung homestay, tetapi umumnya termasuk:</p>
                        <div class="grid grid-cols-2 gap-4 mt-3">
                            <div class="flex items-center">
                                <i class="fas fa-wifi mr-3 text-blue-600"></i>
                                <span>Wi-Fi gratis</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-car mr-3 text-blue-600"></i>
                                <span>Tempat parkir</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-utensils mr-3 text-blue-600"></i>
                                <span>Dapur lengkap</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-tv mr-3 text-blue-600"></i>
                                <span>TV dan AC</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-water mr-3 text-blue-600"></i>
                                <span>Air panas</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-umbrella-beach mr-3 text-blue-600"></i>
                                <span>Akses ke pantai</span>
                            </div>
                        </div>
                        <p class="mt-3">Selalu periksa detail fasilitas di halaman homestay sebelum memesan.</p>
                    </div>
                </div>
            </div>
            
            <!-- Kontak Bantuan -->
            <div class="help-contact">
                <h3 class="text-xl font-bold mb-3">Masih butuh bantuan?</h3>
                <p class="text-gray-600 mb-4">Tim dukungan kami siap membantu Anda 24/7</p>
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="{{ route('contact') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg inline-block transition duration-300">
                        <i class="fas fa-envelope mr-2"></i> Hubungi Kami
                    </a>
                    <a href="tel:+6281234567890" class="bg-white hover:bg-gray-100 text-blue-600 border border-blue-600 px-6 py-2 rounded-lg inline-block transition duration-300">
                        <i class="fas fa-phone-alt mr-2"></i> +62 882 9478 1090
                    </a>
                    <a href="https://wa.me/6281234567890" class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-lg inline-block transition duration-300">
                        <i class="fab fa-whatsapp mr-2"></i> WhatsApp
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
        document.querySelectorAll('.help-article-question').forEach(question => {
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
            });
        });
        
        // Search Functionality
        const searchInput = document.querySelector('.help-search input');
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const questions = document.querySelectorAll('.help-article-question span');
            
            questions.forEach(question => {
                const questionText = question.textContent.toLowerCase();
                const article = question.closest('.help-article');
                
                if (questionText.includes(searchTerm)) {
                    article.style.display = 'block';
                } else {
                    article.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>