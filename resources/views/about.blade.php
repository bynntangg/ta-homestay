<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami - WatHome</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* Tambahan styling khusus untuk halaman about */
        .about-hero {
            background: linear-gradient(135deg, #1E3A8A 0%, #3B82F6 100%);
            color: white;
            padding: 6rem 0 4rem;
            position: relative;
            overflow: hidden;
        }
        
        .about-hero:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('/images/hero-pattern.png') center/cover no-repeat;
            opacity: 0.1;
        }
        
        .mission-card {
            border-left: 4px solid #3B82F6;
            transition: all 0.3s ease;
        }
        
        .mission-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        
        .team-member {
            transition: all 0.3s ease;
        }
        
        .team-member:hover {
            transform: translateY(-10px);
        }
        
        .team-social {
            opacity: 0;
            transition: all 0.3s ease;
        }
        
        .team-member:hover .team-social {
            opacity: 1;
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
                <a href="{{ route('about') }}" class="text-blue-600 font-medium">Tentang Kami</a>
                <a href="{{ route('contact') }}" class="text-white-700 hover:text-blue-600">Kontak</a>
                <a href="{{ route('faq') }}" class="text-white-700 hover:text-blue-600">FAQ</a>
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
    <section class="about-hero relative">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-6">Tentang WatHome</h1>
                <p class="text-xl text-blue-100 mb-8">Platform terdepan untuk menemukan penginapan terbaik di kawasan Wisata Watukarung, Pacitan</p>
            </div>
        </div>
    </section>

    <!-- About Content -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row items-center gap-12">
                <div class="md:w-1/2">
                    <img src="/images/wathome.jpg" alt="Tentang WatHome" class="rounded-xl shadow-lg w-50">
                </div>
                <div class="md:w-1/3">
                    <h2 class="text-3xl font-bold mb-6 text-gray-800">Cerita Kami</h2>
                    <p class="text-gray-600 mb-4">WatHome didirikan pada tahun 2020 dengan misi untuk memudahkan wisatawan menemukan penginapan berkualitas di kawasan Wisata Watukarung, Pacitan. Kami memahami betapa pentingnya pengalaman menginap yang nyaman selama berlibur.</p>
                    <p class="text-gray-600 mb-6">Dengan jaringan homestay terluas di Pacitan, kami menghubungkan Anda dengan penginapan terbaik mulai dari villa mewah hingga homestay ekonomis dengan pemandangan pantai yang menakjubkan.</p>
                    <div class="flex flex-wrap gap-4">
                        <div class="bg-blue-50 text-blue-800 px-4 py-2 rounded-full font-medium">
                            <i class="fas fa-check-circle mr-2"></i> Terverifikasi
                        </div>
                        <div class="bg-blue-50 text-blue-800 px-4 py-2 rounded-full font-medium">
                            <i class="fas fa-map-marker-alt mr-2"></i> Lokasi Strategis
                        </div>
                        <div class="bg-blue-50 text-blue-800 px-4 py-2 rounded-full font-medium">
                            <i class="fas fa-headset mr-2"></i> Support 24/7
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12 text-gray-800">Visi & Misi Kami</h2>
            
            <div class="grid md:grid-cols-3 gap-8">
                <div class="mission-card bg-white p-8 rounded-lg shadow-sm">
                    <div class="text-blue-600 text-4xl mb-4">
                        <i class="fas fa-bullseye"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-gray-800">Visi</h3>
                    <p class="text-gray-600">Menjadi platform pemesanan penginapan terdepan di Pacitan yang menghubungkan wisatawan dengan penginapan terbaik dan memberikan pengalaman liburan tak terlupakan.</p>
                </div>
                
                <div class="mission-card bg-white p-8 rounded-lg shadow-sm">
                    <div class="text-blue-600 text-4xl mb-4">
                        <i class="fas fa-hand-holding-heart"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-gray-800">Misi 1</h3>
                    <p class="text-gray-600">Menyediakan berbagai pilihan penginapan berkualitas dengan standar kenyamanan tinggi dan fasilitas lengkap untuk semua jenis wisatawan.</p>
                </div>
                
                <div class="mission-card bg-white p-8 rounded-lg shadow-sm">
                    <div class="text-blue-600 text-4xl mb-4">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-gray-800">Misi 2</h3>
                    <p class="text-gray-600">Meningkatkan kesejahteraan masyarakat lokal dengan mempromosikan homestay milik warga dan mendorong perkembangan pariwisata berkelanjutan.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12 text-gray-800">Tim Kami</h2>
            
            <div class="grid sm:grid-cols-2 md:grid-cols-4 gap-8">
                <div class="team-member text-center">
                    <div class="relative mb-4 mx-auto w-48 h-48 rounded-full overflow-hidden border-4 border-white shadow-lg">
                        <img src="/images/bintang.webp" alt="Founder" class="w-full h-full object-cover">
                        <div class="team-social absolute inset-0 bg-blue-600/80 flex items-center justify-center space-x-4">
                            <a href="https://www.instagram.com/bynntangg_" target="_blank" rel="noopener noreferrer"
                            class="text-white hover:text-blue-100"><i class="fab fa-instagram"></i></a>
                        </a>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold mb-1">Bintang Permana S.T</h3>
                    <p class="text-blue-600 font-medium mb-2">Founder & CEO</p>
                    <p class="text-gray-600 text-sm">Pecinta pantai dan penggiat pariwisata Pacitan</p>
                </div>
                
                <div class="team-member text-center">
                    <div class="relative mb-4 mx-auto w-48 h-48 rounded-full overflow-hidden border-4 border-white shadow-lg">
                        <img src="/images/herlina.png" alt="CTO" class="w-full h-full object-cover">
                        <div class="team-social absolute inset-0 bg-blue-600/80 flex items-center justify-center space-x-4">
                            <a href="https://www.instagram.com/hrlnapril" target="_blank" rel="noopener noreferrer"
                            class="text-white hover:text-blue-100"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold mb-1">Herlina Aprilia I.S.</h3>
                    <p class="text-blue-600 font-medium mb-2">Chief Technology Officer</p>
                    <p class="text-gray-600 text-sm">Ahli teknologi dengan passion di bidang travel</p>
                </div>
                
                <div class="team-member text-center">
                    <div class="relative mb-4 mx-auto w-48 h-48 rounded-full overflow-hidden border-4 border-white shadow-lg">
                        <img src="/images/haris.png" alt="Marketing" class="w-full h-full object-cover">
                        <div class="team-social absolute inset-0 bg-blue-600/80 flex items-center justify-center space-x-4">
                            <a href="https://www.instagram.com/yoresss._" target="_blank" rel="noopener noreferrer"
                            class="text-white hover:text-blue-100"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold mb-1">Abdirahman Harish A.</h3>
                    <p class="text-blue-600 font-medium mb-2">Head of Marketing</p>
                    <p class="text-gray-600 text-sm">Spesialis pemasaran digital dan branding</p>
                </div>
                
                <div class="team-member text-center">
                    <div class="relative mb-4 mx-auto w-48 h-48 rounded-full overflow-hidden border-4 border-white shadow-lg">
                        <img src="/images/pandu.png" alt="Operations" class="w-full h-full object-cover">
                        <div class="team-social absolute inset-0 bg-blue-600/80 flex items-center justify-center space-x-4">
                            <a href="https://www.instagram.com/panduuu.__" target="_blank" rel="noopener noreferrer"
                            class="text-white hover:text-blue-100"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold mb-1">Zulfikar Pandu A.</h3>
                    <p class="text-blue-600 font-medium mb-2">Head of Operations</p>
                    <p class="text-gray-600 text-sm">Pengalaman 10+ tahun di industri hospitality</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-16 bg-blue-600 text-white">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-4 gap-8 text-center">
                <div class="p-6">
                    <div class="text-4xl font-bold mb-2">500+</div>
                    <div class="text-blue-100">Penginapan Terdaftar</div>
                </div>
                <div class="p-6">
                    <div class="text-4xl font-bold mb-2">50K+</div>
                    <div class="text-blue-100">Wisatawan Puas</div>
                </div>
                <div class="p-6">
                    <div class="text-4xl font-bold mb-2">95%</div>
                    <div class="text-blue-100">Rating Positif</div>
                </div>
                <div class="p-6">
                    <div class="text-4xl font-bold mb-2">24/7</div>
                    <div class="text-blue-100">Layanan Pelanggan</div>
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
        // Animasi untuk team member
        document.querySelectorAll('.team-member').forEach(member => {
            member.addEventListener('mouseenter', function() {
                this.querySelector('.team-social').style.opacity = '1';
            });
            
            member.addEventListener('mouseleave', function() {
                this.querySelector('.team-social').style.opacity = '0';
            });
        });
    </script>
</body>
</html>