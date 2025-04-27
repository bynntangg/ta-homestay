<div class="grid grid-cols-1 md:grid-cols-2 gap-8">
    <div>
        <h4 class="text-lg font-semibold mb-4">Tautan Cepat</h4>
        <ul class="space-y-2">
            <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-white transition">Beranda</a></li>
            <li><a href="{{ route('about') }}" class="text-gray-400 hover:text-white transition">Tentang Kami</a></li>
            <li><a href="{{ route('contact') }}" class="text-gray-400 hover:text-white transition">Kontak</a></li>
        </ul>
    </div>

    <div>
        <h4 class="text-lg font-semibold mb-4">Dukungan</h4>
        <ul class="space-y-2">
            <li><a href="{{ route('faq') }}" class="text-gray-400 hover:text-white transition">FAQ</a></li>
            <li><a href="{{ route('privacy') }}" class="text-gray-400 hover:text-white transition">Kebijakan Privasi</a></li>
            <li><a href="{{ route('terms') }}" class="text-gray-400 hover:text-white transition">Syarat & Ketentuan</a></li>
        </ul>
    </div>
</div>