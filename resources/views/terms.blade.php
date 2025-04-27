<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Syarat & Ketentuan - WatHome</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        /* Styling khusus Syarat & Ketentuan */
        .terms-hero {
            background: linear-gradient(135deg, #1E3A8A 0%, #3B82F6 100%);
            color: white;
            padding: 6rem 0 4rem;
            position: relative;
            overflow: hidden;
        }
        
        .terms-hero:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('/images/hero-pattern.png') center/cover no-repeat;
            opacity: 0.1;
        }
        
        .terms-container {
            max-width: 800px;
            margin: 0 auto;
        }
        
        .terms-section {
            margin-bottom: 3rem;
        }
        
        .terms-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1E3A8A;
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #EFF6FF;
        }
        
        .terms-subtitle {
            font-size: 1.2rem;
            font-weight: 600;
            color: #3B82F6;
            margin: 2rem 0 1rem;
        }
        
        .terms-list {
            list-style-type: decimal;
            padding-left: 1.5rem;
            margin: 1rem 0;
        }
        
        .terms-list li {
            margin-bottom: 1rem;
        }
        
        .terms-list ul {
            list-style-type: lower-alpha;
            padding-left: 1.5rem;
            margin-top: 0.5rem;
        }
        
        .terms-note {
            background: #EFF6FF;
            border-left: 4px solid #3B82F6;
            padding: 1rem;
            margin: 2rem 0;
            border-radius: 0 4px 4px 0;
        }
        
        .terms-highlight {
            background: #EFF6FF;
            padding: 1rem;
            border-radius: 6px;
            margin: 1rem 0;
            font-weight: 500;
        }
        
        .terms-table {
            width: 100%;
            border-collapse: collapse;
            margin: 1rem 0;
        }
        
        .terms-table th, .terms-table td {
            border: 1px solid #E5E7EB;
            padding: 0.75rem;
            text-align: left;
        }
        
        .terms-table th {
            background-color: #EFF6FF;
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
                <a href="{{ route('terms') }}" class="text-blue-600 font-medium">Syarat & Ketentuan</a>
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
    <section class="terms-hero relative">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-6">Syarat & Ketentuan</h1>
            <p class="text-xl text-blue-100">Terakhir diperbarui: {{ date('d F Y', strtotime('2023-11-01')) }}</p>
        </div>
    </section>

    <!-- Terms Content -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="terms-container bg-white p-8 md:p-12 rounded-lg shadow-sm">
                <div class="terms-note">
                    <strong>Penting:</strong> Dengan mengakses atau menggunakan layanan WatHome ("Platform"), Anda menyetujui untuk terikat oleh Syarat & Ketentuan ini. Silakan baca dengan seksama.
                </div>
                
                <div class="terms-section">
                    <h2 class="terms-title">1. Penggunaan Platform</h2>
                    <ol class="terms-list">
                        <li>
                            <strong>Eligibilitas:</strong>
                            <ul>
                                <li>Anda harus berusia minimal 18 tahun untuk membuat akun dan melakukan pemesanan</li>
                                <li>Dengan membuat akun, Anda menjamin bahwa semua informasi yang diberikan akurat dan lengkap</li>
                            </ul>
                        </li>
                        <li>
                            <strong>Akun Pengguna:</strong>
                            <ul>
                                <li>Anda bertanggung jawab untuk menjaga kerahasiaan informasi akun Anda</li>
                                <li>Anda setuju untuk tidak mentransfer atau membagikan akses akun kepada pihak lain</li>
                            </ul>
                        </li>
                        <li>
                            <strong>Konten:</strong>
                            <ul>
                                <li>Anda tidak boleh mengunggah konten yang melanggar hak cipta, bersifat tidak senonoh, atau melanggar hukum</li>
                                <li>Kami berhak menghapus konten yang melanggar ketentuan ini tanpa pemberitahuan</li>
                            </ul>
                        </li>
                    </ol>
                </div>
                
                <div class="terms-section">
                    <h2 class="terms-title">2. Pemesanan & Pembayaran</h2>
                    <ol class="terms-list">
                        <li>
                            <strong>Proses Pemesanan:</strong>
                            <ul>
                                <li>Pemesanan hanya dianggap valid setelah pembayaran lunas diterima</li>
                                <li>Kami akan mengirimkan konfirmasi pemesanan melalui email setelah pembayaran berhasil</li>
                            </ul>
                        </li>
                        <li>
                            <strong>Harga & Pajak:</strong>
                            <ul>
                                <li>Harga yang ditampilkan sudah termasuk semua pajak dan biaya wajib</li>
                                <li>Kami berhak mengubah harga tanpa pemberitahuan sebelumnya untuk pemesanan yang belum dikonfirmasi</li>
                            </ul>
                        </li>
                        <li>
                            <strong>Metode Pembayaran:</strong>
                            <ul>
                                <li>Kami menerima berbagai metode pembayaran elektronik yang tersedia di Platform</li>
                                <li>Pembayaran dengan kartu kredit mungkin dikenakan verifikasi tambahan</li>
                            </ul>
                        </li>
                    </ol>
                    
                    <div class="terms-highlight">
                        <i class="fas fa-exclamation-circle text-blue-600 mr-2"></i> Pembatalan atau perubahan pemesanan setelah pembayaran dikonfirmasi mungkin dikenakan biaya sesuai kebijakan penyedia homestay.
                    </div>
                </div>
                
                <div class="terms-section">
                    <h2 class="terms-title">3. Kebijakan Pembatalan</h2>
                    
                    <h3 class="terms-subtitle">3.1 Oleh Pengguna</h3>
                    <table class="terms-table">
                        <thead>
                            <tr>
                                <th>Waktu Pembatalan</th>
                                <th>Pengembalian Dana</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Lebih dari 7 hari sebelum check-in</td>
                                <td>100% (dikurangi biaya administrasi 5%)</td>
                            </tr>
                            <tr>
                                <td>3-7 hari sebelum check-in</td>
                                <td>50% dari total pembayaran</td>
                            </tr>
                            <tr>
                                <td>Kurang dari 3 hari sebelum check-in</td>
                                <td>Tidak ada pengembalian</td>
                            </tr>
                        </tbody>
                    </table>
                    
                    <h3 class="terms-subtitle">3.2 Oleh Penyedia Homestay</h3>
                    <p>Jika penyedia homestay membatalkan pemesanan Anda, kami akan:</p>
                    <ul class="terms-list">
                        <li>Memberikan pengembalian dana penuh</li>
                        <li>Menawarkan alternatif penginapan dengan kualitas setara (jika tersedia)</li>
                        <li>Memberikan kompensasi berupa voucher (jika berlaku)</li>
                    </ul>
                </div>
                
                <div class="terms-section">
                    <h2 class="terms-title">4. Tanggung Jawab Pengguna</h2>
                    <ol class="terms-list">
                        <li>
                            <strong>Perilaku selama Menginap:</strong>
                            <ul>
                                <li>Anda bertanggung jawab atas kerusakan properti yang disebabkan selama masa menginap</li>
                                <li>Anda setuju untuk mematuhi peraturan yang berlaku di homestay</li>
                            </ul>
                        </li>
                        <li>
                            <strong>Keamanan:</strong>
                            <ul>
                                <li>Jaga barang berharga Anda - kami tidak bertanggung jawab atas kehilangan atau pencurian</li>
                                <li>Laporkan insiden segera kepada penyedia homestay dan pihak berwajib jika diperlukan</li>
                            </ul>
                        </li>
                        <li>
                            <strong>Kepatuhan Hukum:</strong>
                            <ul>
                                <li>Anda setuju untuk mematuhi semua hukum dan peraturan yang berlaku selama menggunakan layanan kami</li>
                                <li>Penggunaan platform untuk aktivitas ilegal dilarang keras</li>
                            </ul>
                        </li>
                    </ol>
                </div>
                
                <div class="terms-section">
                    <h2 class="terms-title">5. Kebijakan Perubahan & Pembaruan</h2>
                    <ol class="terms-list">
                        <li>Kami dapat mengubah Syarat & Ketentuan ini dari waktu ke waktu</li>
                        <li>Perubahan material akan diberitahukan melalui email atau pemberitahuan di Platform</li>
                        <li>Penggunaan berkelanjutan setelah perubahan berarti Anda menerima ketentuan yang diperbarui</li>
                    </ol>
                </div>
                
                <div class="terms-section">
                    <h2 class="terms-title">6. Penyelesaian Sengketa</h2>
                    <ol class="terms-list">
                        <li>
                            <strong>Mediasi:</strong> Kami mendorong penyelesaian melalui jalur musyawarah terlebih dahulu
                        </li>
                        <li>
                            <strong>Hukum yang Berlaku:</strong> Syarat & Ketentuan ini tunduk pada hukum Republik Indonesia
                        </li>
                        <li>
                            <strong>Yurisdiksi:</strong> Sengketa yang tidak terselesaikan akan diajukan ke pengadilan yang berwenang di Pacitan, Jawa Timur
                        </li>
                    </ol>
                    
                    <div class="terms-highlight">
                        <i class="fas fa-info-circle text-blue-600 mr-2"></i> Untuk keluhan atau pertanyaan, silakan hubungi tim dukungan kami sebelum mengambil tindakan hukum.
                    </div>
                </div>
                
                <div class="terms-section">
                    <h2 class="terms-title">7. Kontak</h2>
                    <p>Untuk pertanyaan tentang Syarat & Ketentuan ini, hubungi:</p>
                    <ul class="terms-list">
                        <li><strong>Email:</strong> <a href="mailto:legal@wathome.com" class="text-blue-600 hover:underline">legal@wathome.com</a></li>
                        <li><strong>Telepon:</strong> +62 812 3456 7890 (Jam kerja: 08.00-17.00 WIB)</li>
                        <li><strong>Alamat:</strong> Jl. Pantai Teleng Ria No. 17, Pacitan, Jawa Timur</li>
                    </ul>
                </div>
                
                <div class="terms-note mt-8">
                    <p><strong>Pengakuan:</strong> Dengan menggunakan layanan WatHome, Anda mengakui bahwa telah membaca, memahami, dan menyetujui semua Syarat & Ketentuan yang tercantum di atas.</p>
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