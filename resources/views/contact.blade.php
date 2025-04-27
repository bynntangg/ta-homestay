<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hubungi Kami - WatHome</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        /* Tambahan styling khusus untuk halaman contact */
        .contact-hero {
            background: linear-gradient(135deg, #1E3A8A 0%, #3B82F6 100%);
            color: white;
            padding: 6rem 0 4rem;
            position: relative;
            overflow: hidden;
        }

        .contact-hero:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('/images/hero-pattern.png') center/cover no-repeat;
            opacity: 0.1;
        }

        .contact-card {
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .contact-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .contact-icon {
            width: 60px;
            height: 60px;
            background: #EFF6FF;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: #3B82F6;
            margin-bottom: 1.5rem;
        }

        .form-input {
            border: 1px solid #E5E7EB;
            border-radius: 8px;
            padding: 12px 16px;
            width: 100%;
            transition: all 0.3s ease;
        }

        .form-input:focus {
            border-color: #3B82F6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .map-container {
            height: 400px;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
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
                <a href="{{ route('about') }}" class="text-white-700 hover:text-blue-600">Tentang Kami</a>
                <a href="{{ route('contact') }}" class="text-blue-600 font-medium">Kontak</a>
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
    <section class="contact-hero relative">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-6">Hubungi Kami</h1>
                <p class="text-xl text-blue-100 mb-8">Tim kami siap membantu Anda dengan segala pertanyaan atau
                    kebutuhan informasi tentang penginapan di Watukarung</p>
            </div>
        </div>
    </section>

    <!-- Contact Info Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-3 gap-8">
                <div class="contact-card bg-white p-8 rounded-lg text-center">
                    <div class="contact-icon mx-auto">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2 text-gray-800">Alamat Kami</h3>
                    <p class="text-gray-600">Dsn. Ketro Watukarung No. 17<br>Pacitan, Jawa Timur</p>
                </div>

                <div class="contact-card bg-white p-8 rounded-lg text-center">
                    <div class="contact-icon mx-auto">
                        <i class="fas fa-phone-alt"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2 text-gray-800">Telepon</h3>
                    <p class="text-gray-600 mb-1">+62 882 9478 1090</p>
                    <p class="text-gray-600">+62 813 4567 8901</p>
                    <div class="mt-4">
                        <span class="inline-block bg-green-100 text-green-800 text-xs px-2 py-1 rounded">WhatsApp
                            Available</span>
                    </div>
                </div>

                <div class="contact-card bg-white p-8 rounded-lg text-center">
                    <div class="contact-icon mx-auto">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2 text-gray-800">Email</h3>
                    <p class="text-gray-600 mb-1">info@wathome.com</p>
                    <p class="text-gray-600">support@wathome.com</p>
                    <div class="mt-4">
                        <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">Response within
                            24 hours</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="flex flex-col lg:flex-row gap-12 mx-auto lg:w-3/4">
                <div class="lg:w-1/2">
                    <h2 class="text-3xl font-bold mb-6 text-gray-800">Lokasi Kami</h2>
                    <div class="map-container">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3949.382655308693!2d111.0418743147849!3d-8.16346628439933!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7b9d8a2d5e5b1f%3A0x3a3b3b3b3b3b3b3b!2sPantai%20Teleng%20Ria!5e0!3m2!1sen!2sid!4v1620000000000!5m2!1sen!2sid"
                            width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
                <div class="lg:w-1/2 flex flex-col justify-center">
                    <div class="grid grid-cols-2 gap-4">
                        <a href="https://www.facebook.com/share/167HurYZ9F/" target="_blank" rel="noopener noreferrer"
                            class="flex items-center justify-center bg-blue-50 text-blue-600 p-3 rounded-lg hover:bg-blue-100 transition">
                            <i class="fab fa-facebook-f mr-2"></i> Facebook
                        </a>
                        <a href="https://www.instagram.com/wathome.official" target="_blank" rel="noopener noreferrer"
                            class="flex items-center justify-center bg-blue-50 text-blue-600 p-3 rounded-lg hover:bg-blue-100 transition">
                            <i class="fab fa-instagram mr-2"></i> Instagram
                        </a>
                        <a href="https://twitter.com/blog_wathome" target="_blank" rel="noopener noreferrer"
                            class="flex items-center justify-center bg-blue-50 text-blue-600 p-3 rounded-lg hover:bg-blue-100 transition">
                            <i class="fab fa-twitter mr-2"></i> Twitter
                        </a>
                        <a href="https://wa.me/6288294781090" target="_blank" rel="noopener noreferrer"
                            class="flex items-center justify-center bg-blue-50 text-blue-600 p-3 rounded-lg hover:bg-blue-100 transition">
                            <i class="fab fa-whatsapp mr-2"></i> WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12 text-gray-800">Pertanyaan Umum</h2>

            <div class="max-w-3xl mx-auto space-y-4">
                <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                    <div
                        class="faq-question p-4 border-b border-gray-100 flex justify-between items-center cursor-pointer">
                        <h3 class="font-medium">Berapa lama waktu respon untuk pesan yang dikirim?</h3>
                        <span class="text-blue-600">+</span>
                    </div>
                    <div class="faq-answer p-4 hidden">
                        <p class="text-gray-600">Kami biasanya merespon dalam waktu 1-2 jam pada jam kerja (08.00-17.00
                            WIB). Untuk pesan di luar jam kerja, kami akan merespon maksimal 24 jam setelah pesan
                            diterima.</p>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                    <div
                        class="faq-question p-4 border-b border-gray-100 flex justify-between items-center cursor-pointer">
                        <h3 class="font-medium">Bagaimana cara menghubungi customer service secara langsung?</h3>
                        <span class="text-blue-600">+</span>
                    </div>
                    <div class="faq-answer p-4 hidden">
                        <p class="text-gray-600">Anda dapat menghubungi kami langsung melalui nomor telepon +62 882
                            9478 1090 (08.00-17.00 WIB) atau melalui WhatsApp di nomor yang sama (24 jam).</p>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                    <div
                        class="faq-question p-4 border-b border-gray-100 flex justify-between items-center cursor-pointer">
                        <h3 class="font-medium">Apakah ada kantor yang bisa dikunjungi langsung?</h3>
                        <span class="text-blue-600">+</span>
                    </div>
                    <div class="faq-answer p-4 hidden">
                        <p class="text-gray-600">Ya, kantor kami di Dsn. Ketro Watukarung No. 17, Pacitan buka setiap
                            hari dari jam 09.00-16.00 WIB. Namun kami sarankan untuk membuat janji terlebih dahulu via
                            telepon.</p>
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
                <p class="text-gray-400 text-sm mb-4 md:mb-0">&copy; {{ date('Y') }} WatHome.com. All rights
                    reserved.</p>
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
        // FAQ Toggle
        document.querySelectorAll('.faq-question').forEach(question => {
            question.addEventListener('click', () => {
                const answer = question.nextElementSibling;
                const isOpen = answer.style.display === 'block';

                // Close all answers first
                document.querySelectorAll('.faq-answer').forEach(ans => {
                    ans.style.display = 'none';
                });

                // Toggle current answer
                answer.style.display = isOpen ? 'none' : 'block';

                // Update all indicators
                document.querySelectorAll('.faq-question span').forEach(indicator => {
                    indicator.textContent = '+';
                });

                // Update current indicator
                if (!isOpen) {
                    question.querySelector('span').textContent = '-';
                }
            });
        });
    </script>
</body>

</html>
