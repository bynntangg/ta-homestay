<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kebijakan Privasi - WatHome</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        /* Styling khusus Kebijakan Privasi */
        .privacy-hero {
            background: linear-gradient(135deg, #1E3A8A 0%, #3B82F6 100%);
            color: white;
            padding: 6rem 0 4rem;
            position: relative;
            overflow: hidden;
        }
        
        .privacy-hero:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('/images/hero-pattern.png') center/cover no-repeat;
            opacity: 0.1;
        }
        
        .privacy-container {
            max-width: 800px;
            margin: 0 auto;
        }
        
        .privacy-section {
            margin-bottom: 3rem;
        }
        
        .privacy-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1E3A8A;
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #EFF6FF;
        }
        
        .privacy-subtitle {
            font-size: 1.2rem;
            font-weight: 600;
            color: #3B82F6;
            margin: 2rem 0 1rem;
        }
        
        .privacy-list {
            list-style-type: disc;
            padding-left: 1.5rem;
            margin: 1rem 0;
        }
        
        .privacy-list li {
            margin-bottom: 0.5rem;
        }
        
        .privacy-update {
            background: #EFF6FF;
            border-left: 4px solid #3B82F6;
            padding: 1rem;
            margin: 2rem 0;
            border-radius: 0 4px 4px 0;
        }
        
        .privacy-highlight {
            background: #EFF6FF;
            padding: 1rem;
            border-radius: 6px;
            margin: 1rem 0;
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
                <a href="{{ route('privacy') }}" class="text-blue-600 font-medium">Kebijakan Privasi</a>
                <a href="{{ route('terms') }}" class="text-white-700 hover:text-blue-600">Syarat & Ketentuan</a>
                <a href="{{ route('help') }}" class="text-white-700 hover:text-blue-600">Bantuan</a>
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
    <section class="privacy-hero relative">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-6">Kebijakan Privasi</h1>
            <p class="text-xl text-blue-100">Terakhir diperbarui: {{ date('d F Y', strtotime('2023-11-01')) }}</p>
        </div>
    </section>

    <!-- Privacy Content -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="privacy-container bg-white p-8 md:p-12 rounded-lg shadow-sm">
                <div class="privacy-update">
                    <strong>Pembaruan Penting:</strong> Kebijakan Privasi ini terakhir diperbarui pada {{ date('d F Y', strtotime('2023-11-01')) }} dan berlaku efektif segera setelah dipublikasikan.
                </div>
                
                <div class="privacy-section">
                    <p>WatHome ("kami", "kita", atau "kita") berkomitmen untuk melindungi privasi Anda. Kebijakan Privasi ini menjelaskan bagaimana kami mengumpulkan, menggunakan, mengungkapkan, dan melindungi informasi yang Anda berikan saat menggunakan layanan kami.</p>
                </div>
                
                <div class="privacy-section">
                    <h2 class="privacy-title">1. Informasi yang Kami Kumpulkan</h2>
                    <p>Kami mengumpulkan beberapa jenis informasi dari dan tentang pengguna layanan kami, termasuk:</p>
                    
                    <h3 class="privacy-subtitle">Informasi Pribadi</h3>
                    <ul class="privacy-list">
                        <li>Nama lengkap</li>
                        <li>Alamat email</li>
                        <li>Nomor telepon</li>
                        <li>Alamat fisik</li>
                        <li>Informasi pembayaran (diamankan dan diproses oleh pihak ketiga yang terpercaya)</li>
                        <li>Data identitas (untuk verifikasi pemesanan)</li>
                    </ul>
                    
                    <h3 class="privacy-subtitle">Informasi Non-Pribadi</h3>
                    <ul class="privacy-list">
                        <li>Data penggunaan layanan</li>
                        <li>Informasi perangkat dan koneksi</li>
                        <li>Data lokasi (jika diizinkan)</li>
                        <li>Cookie dan teknologi pelacakan serupa</li>
                    </ul>
                </div>
                
                <div class="privacy-section">
                    <h2 class="privacy-title">2. Bagaimana Kami Menggunakan Informasi Anda</h2>
                    <p>Kami menggunakan informasi yang kami kumpulkan untuk berbagai tujuan, termasuk:</p>
                    <ul class="privacy-list">
                        <li>Menyediakan, mengoperasikan, dan memelihara layanan kami</li>
                        <li>Memproses transaksi dan mengelola pemesanan</li>
                        <li>Mengkomunikasikan pembaruan, promosi, dan informasi akun</li>
                        <li>Meningkatkan pengalaman pengguna dan layanan kami</li>
                        <li>Memenuhi kewajiban hukum dan peraturan</li>
                        <li>Mencegah penipuan dan penyalahgunaan</li>
                    </ul>
                    
                    <div class="privacy-highlight">
                        <strong>Dasar Hukum:</strong> Pemrosesan data pribadi didasarkan pada persetujuan Anda, kebutuhan kontraktual, kepentingan sah kami, atau kewajiban hukum.
                    </div>
                </div>
                
                <div class="privacy-section">
                    <h2 class="privacy-title">3. Berbagi Informasi</h2>
                    <p>Kami dapat membagikan informasi Anda dalam situasi berikut:</p>
                    
                    <h3 class="privacy-subtitle">Dengan Penyedia Layanan</h3>
                    <p>Kepada penyedia homestay untuk memenuhi pemesanan Anda, termasuk:</p>
                    <ul class="privacy-list">
                        <li>Nama dan informasi kontak untuk konfirmasi</li>
                        <li>Detail pemesanan (tanggal, jumlah tamu)</li>
                    </ul>
                    
                    <h3 class="privacy-subtitle">Dengan Penyedia Jasa Pihak Ketiga</h3>
                    <ul class="privacy-list">
                        <li>Penyedia pembayaran untuk memproses transaksi</li>
                        <li>Layanan analitik untuk meningkatkan platform kami</li>
                        <li>Layanan pemasaran (dengan persetujuan Anda)</li>
                    </ul>
                    
                    <h3 class="privacy-subtitle">Untuk Kepatuhan Hukum</h3>
                    <p>Jika diperlukan oleh hukum atau permintaan pemerintah yang sah.</p>
                </div>
                
                <div class="privacy-section">
                    <h2 class="privacy-title">4. Keamanan Data</h2>
                    <p>Kami menerapkan langkah-langkah keamanan teknis dan organisasi yang sesuai untuk melindungi informasi pribadi Anda, termasuk:</p>
                    <ul class="privacy-list">
                        <li>Enkripsi data selama transmisi</li>
                        <li>Penyimpanan data yang aman</li>
                        <li>Pembatasan akses berdasarkan kebutuhan</li>
                        <li>Pelatihan karyawan tentang privasi data</li>
                    </ul>
                    
                    <div class="privacy-highlight">
                        <strong>Perhatian:</strong> Tidak ada metode transmisi melalui internet atau penyimpanan elektronik yang 100% aman. Kami tidak dapat menjamin keamanan mutlak tetapi berkomitmen untuk melindungi data Anda sesuai dengan standar industri.
                    </div>
                </div>
                
                <div class="privacy-section">
                    <h2 class="privacy-title">5. Hak Privasi Anda</h2>
                    <p>Anda memiliki hak tertentu terkait data pribadi Anda:</p>
                    <ul class="privacy-list">
                        <li><strong>Akses:</strong> Meminta salinan data pribadi Anda</li>
                        <li><strong>Perbaikan:</strong> Memperbaiki data yang tidak akurat</li>
                        <li><strong>Penghapusan:</strong> Meminta penghapusan data dalam kondisi tertentu</li>
                        <li><strong>Pembatasan:</strong> Membatasi pemrosesan data Anda</li>
                        <li><strong>Keberatan:</strong> Menolak pemrosesan data tertentu</li>
                        <li><strong>Portabilitas:</strong> Menerima data Anda dalam format terstruktur</li>
                    </ul>
                    
                    <p>Untuk menggunakan hak-hak ini, silakan hubungi kami melalui informasi kontak di bawah.</p>
                </div>
                
                <div class="privacy-section">
                    <h2 class="privacy-title">6. Penyimpanan Data</h2>
                    <p>Kami menyimpan data pribadi Anda hanya selama diperlukan untuk tujuan yang dijelaskan dalam kebijakan ini, termasuk:</p>
                    <ul class="privacy-list">
                        <li>Selama akun Anda aktif</li>
                        <li>Sebagaimana diperlukan untuk menyediakan layanan</li>
                        <li>Untuk mematuhi kewajiban hukum (misalnya untuk pajak, peraturan)</li>
                        <li>Untuk menyelesaikan sengketa atau penegakan perjanjian kami</li>
                    </ul>
                </div>
                
                <div class="privacy-section">
                    <h2 class="privacy-title">7. Perubahan pada Kebijakan Ini</h2>
                    <p>Kami dapat memperbarui Kebijakan Privasi kami dari waktu ke waktu. Kami akan memberi tahu Anda tentang perubahan material dengan memposting pemberitahuan di situs kami sebelum perubahan berlaku dan memperbarui tanggal "Terakhir Diperbarui" di bagian atas kebijakan ini.</p>
                    
                    <div class="privacy-highlight">
                        <strong>Kontinuitas Layanan:</strong> Dengan terus menggunakan layanan kami setelah perubahan berlaku, Anda menyetujui kebijakan yang diperbarui.
                    </div>
                </div>
                
                <div class="privacy-section">
                    <h2 class="privacy-title">8. Hubungi Kami</h2>
                    <p>Jika Anda memiliki pertanyaan tentang Kebijakan Privasi ini atau praktik privasi kami, silakan hubungi kami melalui:</p>
                    <ul class="privacy-list">
                        <li>Email: <a href="mailto:privacy@wathome.com" class="text-blue-600 hover:underline">privacy@wathome.com</a></li>
                        <li>Telepon: +62 812 3456 7890 (08.00-17.00 WIB)</li>
                        <li>Alamat: Jl. Pantai Teleng Ria No. 17, Pacitan, Jawa Timur</li>
                    </ul>
                    
                    <p class="mt-4">Untuk permintaan terkait hak privasi Anda, silakan gunakan formulir kontak kami atau kirim email ke alamat di atas dengan subjek "Permintaan Hak Privasi".</p>
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
</body>
</html>