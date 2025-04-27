    <!DOCTYPE html>
    <html lang="id">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Proses Pemesanan - WatHome</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
            rel="stylesheet">
        <style>
            body {
                font-family: 'Poppins', sans-serif;
            }

            .step {
                position: relative;
                min-height: 1em;
                color: gray;
            }

            .step+.step {
                margin-top: 1.5em
            }

            .step>div:first-child {
                position: static;
                height: 0;
            }

            .step>div:not(:first-child) {
                margin-left: 1.5em;
                padding-left: 1em;
            }

            .step.step-active {
                color: #2563eb;
            }

            .step.step-active .step-dot {
                background-color: #2563eb;
                border-color: #2563eb;
            }

            .step.step-completed .step-dot {
                background-color: #16a34a;
                border-color: #16a34a;
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

            .step-dot {
                position: relative;
                width: 1.5em;
                height: 1.5em;
                line-height: 1.5em;
                border-radius: 100%;
                background-color: #e5e7eb;
                border: 2px solid #e5e7eb;
            }

            .step-line {
                position: absolute;
                top: 1.5em;
                left: 0.75em;
                height: calc(100% - 1.5em);
                width: 2px;
                background-color: #e5e7eb;
            }

            .step.step-active .step-line {
                background-color: #2563eb;
            }

            .step.step-completed .step-line {
                background-color: #16a34a;
            }

            .step:last-child .step-line {
                display: none;
            }

            .payment-method {
                transition: all 0.3s ease;
            }

            .payment-method:hover {
                transform: translateY(-3px);
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            }

            .payment-method.active {
                border-color: #2563eb;
                background-color: #eff6ff;
            }

            .header {
                background-color: white;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
                position: sticky;
                top: 0;
                z-index: 1000;
                transition: all 0.3s ease;
            }

            .header.scrolled {
                padding: 0.5rem 0;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
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
                @if (isset($homestay) && $homestay)
                    <a href="{{ url()->previous() }}"
                        class="hover:text-blue-600 transition text-gray-800 font-medium truncate max-w-xs">
                        {{ $homestay->nama }}
                    </a>
                @else
                    <span class="text-gray-800 font-medium truncate max-w-xs">
                        Homestay Tidak Ditemukan
                    </span>
                @endif

                <span class="mx-2">/</span>
                <span class="text-gray-800 font-medium">
                    @if ($step == 1)
                        Informasi Pengguna
                    @elseif($step == 2)
                        Pembayaran
                    @else
                        Konfirmasi
                    @endif
                </span>
            </div>

            <div class="max-w-4xl mx-auto">
                <!-- Progress Steps -->
                <div class="bg-white rounded-xl shadow-md p-6 mb-8">
                    <div class="flex justify-between mb-8">
                        <!-- Step 1 -->
                        <div class="step {{ $step >= 1 ? 'step-completed' : '' }}">
                            <div>
                                <div class="step-dot flex items-center justify-center">
                                    @if ($step >= 1)
                                        <i class="fas fa-check text-white text-xs"></i>
                                    @else
                                        <span class="text-gray-400 font-bold text-xs">1</span>
                                    @endif
                                </div>
                                <div class="step-line {{ $step >= 2 ? 'step-completed' : '' }}"></div>
                            </div>
                            <div>
                                <div class="text-xs font-semibold">Langkah 1</div>
                                <div class="text-sm">Informasi Pengguna</div>
                            </div>
                        </div>

                        <!-- Step 2 -->
                        <div class="step {{ $step >= 2 ? ($step == 2 ? 'step-active' : 'step-completed') : '' }}">
                            <div>
                                <div class="step-dot flex items-center justify-center">
                                    @if ($step > 2)
                                        <i class="fas fa-check text-white text-xs"></i>
                                    @else
                                        <span
                                            class="{{ $step == 2 ? 'text-white' : 'text-gray-400' }} font-bold text-xs">2</span>
                                    @endif
                                </div>
                                <div class="step-line {{ $step >= 3 ? 'step-completed' : '' }}"></div>
                            </div>
                            <div>
                                <div class="text-xs font-semibold">Langkah 2</div>
                                <div class="text-sm">Informasi Pembayaran</div>
                            </div>
                        </div>

                        <!-- Step 3 -->
                        <div class="step {{ $step == 3 ? 'step-active' : '' }}">
                            <div>
                                <div class="step-dot flex items-center justify-center">
                                    <span
                                        class="{{ $step == 3 ? 'text-white' : 'text-gray-400' }} font-bold text-xs">3</span>
                                </div>
                            </div>
                            <div>
                                <div class="text-xs font-semibold">Langkah 3</div>
                                <div class="text-sm">Pesanan Dikonfirmasi</div>
                            </div>
                        </div>
                    </div>

                    @if ($step == 1)
                        <!-- STEP 1: Informasi Pengguna -->
                        <form action="{{ route('pemilik.pemesanan.store-step1') }}" method="POST">
                            @csrf
                            <h2 class="text-xl font-bold text-gray-800 mb-6">Informasi Pengguna</h2>

                            <div class="mb-6">
                                <h3 class="font-semibold text-gray-800 mb-4">Data Diri</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                                    <div>
                                        <label class="block text-gray-700 mb-2">Nama Lengkap</label>
                                        <input type="text" class="w-full px-4 py-2 border rounded-lg"
                                            value="{{ Auth::user()->name }}" disabled>
                                    </div>
                                    <div>
                                        <label class="block text-gray-700 mb-2">Email</label>
                                        <input type="email" class="w-full px-4 py-2 border rounded-lg"
                                            value="{{ Auth::user()->email }}" disabled>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                                    <div>
                                        <label for="checkin" class="block text-gray-700 mb-2">Tanggal Check-in</label>
                                        <input type="date" id="checkin" name="checkin"
                                            value="{{ old('checkin', session('checkin')) }}"
                                            min="{{ now()->format('Y-m-d') }}"
                                            class="w-full px-4 py-2 border rounded-lg" required>
                                    </div>
                                    <div>
                                        <label for="checkout" class="block text-gray-700 mb-2">Tanggal
                                            Check-out</label>
                                        <input type="date" id="checkout" name="checkout"
                                            value="{{ old('checkout', session('checkout')) }}"
                                            min="{{ now()->addDay()->format('Y-m-d') }}"
                                            class="w-full px-4 py-2 border rounded-lg" required>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                                    <div>
                                        <label for="tipe_identitas" class="block text-gray-700 mb-2">Tipe
                                            Identitas</label>
                                        <select id="tipe_identitas" name="tipe_identitas"
                                            class="w-full px-4 py-2 border rounded-lg" required>
                                            <option value="">Pilih Tipe Identitas</option>
                                            <option value="KTP"
                                                {{ old('tipe_identitas') == 'KTP' ? 'selected' : '' }}>
                                                KTP</option>
                                            <option value="SIM"
                                                {{ old('tipe_identitas') == 'SIM' ? 'selected' : '' }}>
                                                SIM</option>
                                            <option value="Paspor"
                                                {{ old('tipe_identitas') == 'Paspor' ? 'selected' : '' }}>Paspor
                                            </option>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="nomor_identitas" class="block text-gray-700 mb-2">Nomor
                                            Identitas</label>
                                        <input type="text" id="nomor_identitas" name="nomor_identitas"
                                            value="{{ old('nomor_identitas') }}"
                                            class="w-full px-4 py-2 border rounded-lg" required>
                                    </div>
                                </div>
                            </div>

                            <!-- Reservation Summary -->
                            <div class="border border-gray-200 rounded-lg p-4 mb-6 bg-gray-50">
                                <h3 class="font-bold text-lg text-gray-800 mb-3">Ringkasan Pemesanan</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <h4 class="font-medium text-gray-700 mb-1">Homestay</h4>
                                        <p class="text-gray-600">{{ $homestay->nama }}</p>
                                    </div>

                                    @if ($isMultiRoom)
                                        <!-- Tampilan multi-room -->
                                        <div>
                                            <h4 class="font-medium text-gray-700 mb-1">Jumlah Tipe Kamar</h4>
                                            <p class="text-gray-600">{{ count($tipeKamars) }} Tipe</p>
                                        </div>
                                        <div>
                                            <h4 class="font-medium text-gray-700 mb-1">Total Kamar</h4>
                                            <p class="text-gray-600">{{ $jumlahKamar }} Kamar</p>
                                        </div>
                                    @else
                                        <!-- Tampilan single-room -->
                                        <div>
                                            <h4 class="font-medium text-gray-700 mb-1">Tipe Kamar</h4>
                                            <p class="text-gray-600">{{ $tipeKamar->nama }}</p>
                                        </div>
                                        <div>
                                            <h4 class="font-medium text-gray-700 mb-1">Jumlah Kamar</h4>
                                            <p class="text-gray-600"><span id="summary-jumlah-kamar">1</span> Kamar
                                            </p>
                                        </div>
                                    @endif

                                    <div>
                                        <h4 class="font-medium text-gray-700 mb-1">Harga per Kamar per Malam</h4>
                                        @if ($isMultiRoom)
                                            <p class="text-gray-600">Bervariasi (lihat detail)</p>
                                        @else
                                            <p class="text-gray-600">
                                                Rp{{ number_format($tipeKamar->harga, 2, ',', '.') }}
                                            </p>
                                        @endif
                                    </div>

                                    <div>
                                        <h4 class="font-medium text-gray-700 mb-1">Check-in</h4>
                                        <p class="text-gray-600">
                                            {{ \Carbon\Carbon::parse(session('checkin'))->format('d M Y') }} (13:00)
                                        </p>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-gray-700 mb-1">Check-out</h4>
                                        <p class="text-gray-600">
                                            {{ \Carbon\Carbon::parse(session('checkout'))->format('d M Y') }} (12:00)
                                        </p>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-gray-700 mb-1">Durasi</h4>
                                        <p class="text-gray-600">
                                            {{ \Carbon\Carbon::parse(session('checkin'))->diffInDays(session('checkout')) }}
                                            Malam
                                        </p>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-gray-700 mb-1">Total Harga</h4>
                                        <p class="text-blue-600 font-bold" id="total-harga">
                                            @if ($isMultiRoom)
                                                Rp{{ number_format($totalHarga * \Carbon\Carbon::parse(session('checkin'))->diffInDays(session('checkout')), 2, ',', '.') }}
                                            @else
                                                Rp{{ number_format($tipeKamar->harga * \Carbon\Carbon::parse(session('checkin'))->diffInDays(session('checkout')), 2, ',', '.') }}
                                            @endif
                                        </p>
                                    </div>
                                </div>

                                <!-- Detail kamar untuk multi-room -->
                                @if ($isMultiRoom)
                                    <div class="mt-4">
                                        <h4 class="font-semibold text-gray-800 mb-2">Detail Kamar:</h4>
                                        @foreach ($tipeKamars as $tipe)
                                            <div class="border-t border-gray-200 pt-3 mt-3">
                                                <p class="font-medium">{{ $tipe['nama'] }} ({{ $tipe['quantity'] }}
                                                    Kamar)</p>
                                                <p class="text-gray-600">
                                                    Rp{{ number_format($tipe['harga'], 2, ',', '.') }} /malam</p>
                                                <p class="text-sm text-gray-500">Tersedia: {{ $tipe['available'] }}
                                                    kamar
                                                </p>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                            <!-- Navigation Buttons -->
                            <div class="flex justify-between pt-4 border-t border-gray-200">
                                <a href="{{ url()->previous() }}"
                                    class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 font-medium hover:bg-gray-50 transition">
                                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                                </a>                                
                                <button type="submit"
                                    class="px-6 py-2 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition flex items-center">
                                    Lanjutkan <i class="fas fa-arrow-right ml-2"></i>
                                </button>
                            </div>
                        </form>
                    @elseif($step == 2)
                        <!-- STEP 2: Informasi Pembayaran -->
                        <form action="{{ route('pemilik.pemesanan.store-step2') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <h2 class="text-xl font-bold text-gray-800 mb-6">Informasi Pembayaran</h2>

                            @php
                                $checkin = session('checkin');
                                $checkout = session('checkout');
                                $durasi = \Carbon\Carbon::parse($checkin)->diffInDays($checkout);
                            @endphp

                            <!-- Payment Methods -->
                            <div class="mb-8">
                                <h3 class="font-semibold text-gray-800 mb-4">Metode Pembayaran</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div
                                        class="payment-method active border-2 border-blue-500 rounded-lg p-4 cursor-pointer">
                                        <div class="flex items-center">
                                            <div class="bg-blue-100 p-2 rounded-full mr-3">
                                                <i class="fas fa-university text-blue-600"></i>
                                            </div>
                                            <div>
                                                <h4 class="font-medium text-gray-800">Transfer Bank</h4>
                                                <p class="text-sm text-gray-600">Transfer langsung ke rekening homestay
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Bank Transfer Details -->
                            <div class="border border-gray-200 rounded-lg p-5 mb-6 bg-gray-50">
                                <h3 class="font-semibold text-gray-800 mb-3">Rekening Pembayaran</h3>
                                <div class="space-y-3">
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Nama Bank</span>
                                        <span class="font-medium">{{ $homestay->nama_bank }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Nomor Rekening</span>
                                        <span class="font-medium">{{ $homestay->nomor_rekening }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Atas Nama</span>
                                        <span class="font-medium">{{ $homestay->atas_nama }}</span>
                                    </div>

                                    @if ($isMultiRoom)
                                        <!-- Display for multi-room -->
                                        <div class="flex justify-between">
                                            <span class="text-gray-600">Jumlah Tipe Kamar</span>
                                            <span class="font-medium">{{ count($tipeKamars) }} Tipe</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-gray-600">Total Kamar</span>
                                            <span class="font-medium">{{ $jumlahKamar }} Kamar</span>
                                        </div>
                                    @else
                                        <!-- Display for single room -->
                                        <div class="flex justify-between">
                                            <span class="text-gray-600">Jumlah Kamar</span>
                                            <span class="font-medium">{{ session('jumlah_kamar', 1) }} Kamar</span>
                                        </div>
                                    @endif

                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Durasi Menginap</span>
                                        <span class="font-medium">
                                            {{ \Carbon\Carbon::parse(session('checkin'))->diffInDays(session('checkout')) }}
                                            Malam
                                        </span>
                                    </div>

                                    @if ($isMultiRoom)
                                        <!-- Display varying prices for multi-room -->
                                        <div class="flex justify-between">
                                            <span class="text-gray-600">Harga Kamar</span>
                                            <span class="font-medium">Bervariasi (lihat detail)</span>
                                        </div>
                                    @else
                                        <!-- Display single price for single room -->
                                        <div class="flex justify-between">
                                            <span class="text-gray-600">Harga per Kamar per Malam</span>
                                            <span
                                                class="font-medium">Rp{{ number_format($tipeKamar->harga, 2, ',', '.') }}</span>
                                        </div>
                                    @endif

                                    <div class="flex justify-between border-t border-gray-200 pt-2">
                                        <span class="text-gray-600 font-semibold">Total Pembayaran</span>
                                        <span class="text-blue-600 font-bold">
                                            Rp{{ number_format($totalHarga * \Carbon\Carbon::parse(session('checkin'))->diffInDays(session('checkout')), 2, ',', '.') }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Detail kamar untuk multi-room -->
                                @if ($isMultiRoom)
                                    <div class="mt-4">
                                        <h4 class="font-semibold text-gray-800 mb-2">Detail Kamar:</h4>
                                        @foreach ($tipeKamars as $tipe)
                                            <div class="border-t border-gray-200 pt-3 mt-3">
                                                <p class="font-medium">{{ $tipe['nama'] }} ({{ $tipe['quantity'] }}
                                                    Kamar)</p>
                                                <p class="text-gray-600">
                                                    Rp{{ number_format($tipe['harga'], 2, ',', '.') }} /malam</p>
                                                <p class="text-sm text-gray-500">Subtotal:
                                                    Rp{{ number_format($tipe['harga'] * $tipe['quantity'] * $durasi, 2, ',', '.') }}
                                                </p>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>

                            <!-- Rest of the step 2 content (payment proof upload and buttons) remains the same -->
                            <!-- Payment Proof Upload -->
                            <div class="mb-8">
                                <h3 class="font-semibold text-gray-800 mb-3">Bukti Pembayaran</h3>
                                <p class="text-sm text-gray-600 mb-4">Silakan upload bukti transfer Anda. Pastikan foto
                                    bukti transfer jelas terbaca.</p>

                                <div
                                    class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center bg-gray-50">
                                    <div id="upload-container" class="cursor-pointer">
                                        <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-3"></i>
                                        <p class="text-gray-600 mb-2">Klik untuk upload bukti transfer</p>
                                        <p class="text-xs text-gray-500">Format: JPG, PNG (Maks. 2MB)</p>
                                        <input type="file" id="payment_proof" name="payment_proof" class="hidden"
                                            accept="image/*" required>
                                    </div>
                                    <div id="preview-container" class="hidden mt-4">
                                        <img id="preview-image" src="#" alt="Preview Bukti Transfer"
                                            class="max-w-full h-auto max-h-64 mx-auto rounded-lg">
                                        <button id="change-image" type="button"
                                            class="mt-3 text-sm text-blue-600 hover:text-blue-800">Ganti
                                            Gambar</button>
                                    </div>
                                </div>
                                @error('payment_proof')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Navigation Buttons -->
                            <div class="flex justify-between pt-4 border-t border-gray-200">
                                <button type="button" onclick="window.history.back()"
                                    class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 font-medium hover:bg-gray-50 transition">
                                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                                </button>
                                <button type="submit"
                                    class="px-6 py-2 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition flex items-center">
                                    Lanjutkan <i class="fas fa-arrow-right ml-2"></i>
                                </button>
                            </div>
                        </form>
                    @elseif($step == 3)
                        <!-- STEP 3: Konfirmasi Sukses -->
                        <div class="text-center py-8">
                            <div
                                class="bg-green-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6">
                                <i class="fas fa-check text-green-600 text-3xl"></i>
                            </div>
                            <h2 class="text-2xl font-bold text-gray-800 mb-2">Pemesanan Berhasil!</h2>
                            <p class="text-gray-600 mb-8">Pesanan Anda telah berhasil dibuat dan sedang menunggu
                                konfirmasi dari pemilik homestay.</p>

                            <!-- Tutorial Box -->
                            <div
                                class="max-w-md mx-auto bg-blue-50 border border-blue-200 rounded-lg p-4 mb-8 text-left">
                                <div class="flex items-start">
                                    <div class="bg-blue-100 p-2 rounded-full mr-3">
                                        <i class="fas fa-info-circle text-blue-600"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-blue-800 mb-2">Cara Mengecek Detail Pemesanan:
                                        </h4>
                                        <ol class="list-decimal list-inside text-sm text-gray-700 space-y-1">
                                            <li>Klik foto profil Anda di pojok kanan atas</li>
                                            <li>Pilih menu <span class="font-medium">"Pesanan Saya"</span></li>
                                            <li>Anda akan melihat daftar semua pemesanan Anda</li>
                                            <li>Klik pemesanan yang ingin dilihat detailnya</li>
                                        </ol>
                                    </div>
                                </div>
                            </div>

                            <!-- Booking Details -->
                            <div class="max-w-md mx-auto bg-gray-50 rounded-lg p-6 text-left mb-8">
                                <h3 class="font-bold text-lg text-gray-800 mb-4">Detail Pemesanan</h3>
                                <div class="space-y-3">
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Homestay</span>
                                        <span class="text-gray-800 font-medium truncate max-w-xs">
                                            {{ $pemesanan->homestay->nama ?? 'Homestay Tidak Ditemukan' }}
                                        </span>
                                    </div>

                                    @if ($isMultiRoom)
                                        <!-- Display all room types for multi-room booking -->
                                        @foreach ($pemesanan->kamars->groupBy('tipe_kamar_id') as $tipeKamarId => $kamars)
                                            @php
                                                $tipeKamar = $kamars->first()->tipeKamar;
                                            @endphp
                                            <div class="flex justify-between">
                                                <span class="text-gray-600">Tipe Kamar {{ $loop->iteration }}</span>
                                                <span class="font-medium">{{ $tipeKamar->nama }}
                                                    ({{ $kamars->count() }}
                                                    Kamar)
                                                </span>
                                            </div>
                                            <div class="flex justify-between">
                                                <span class="text-gray-600">Harga {{ $tipeKamar->nama }}</span>
                                                <span
                                                    class="font-medium">Rp{{ number_format($tipeKamar->harga, 2, ',', '.') }}
                                                    /malam</span>
                                            </div>
                                        @endforeach
                                    @else
                                        <!-- Display single room type for single room booking -->
                                        <div class="flex justify-between">
                                            <span class="text-gray-600">Tipe Kamar</span>
                                            <span
                                                class="font-medium">{{ $pemesanan->kamars->first()->tipeKamar->nama }}</span>
                                        </div>
                                    @endif

                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Total Kamar</span>
                                        <span class="font-medium">{{ $pemesanan->jumlah_kamar }} Kamar</span>
                                    </div>

                                    <div class="mt-4">
                                        <h4 class="font-medium text-gray-700 mb-2">Nomor Kamar:</h4>
                                        <div class="flex flex-wrap gap-2">
                                            @foreach ($pemesanan->kamars as $kamar)
                                                <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">
                                                    {{ $kamar->nomor }} ({{ $kamar->tipeKamar->nama }})
                                                </span>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Check-in</span>
                                        <span class="font-medium">{{ $pemesanan->tanggal_checkin->format('d M Y') }}
                                            (13:00)</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Check-out</span>
                                        <span class="font-medium">{{ $pemesanan->tanggal_checkout->format('d M Y') }}
                                            (12:00)</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Durasi</span>
                                        <span class="font-medium">
                                            {{ $pemesanan->tanggal_checkin->diffInDays($pemesanan->tanggal_checkout) }}
                                            Malam
                                        </span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Total Pembayaran</span>
                                        <span class="text-blue-600 font-bold">
                                            Rp{{ number_format($pemesanan->total_harga, 2, ',', '.') }}
                                        </span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Status</span>
                                        <span
                                            class="font-medium capitalize">{{ str_replace('_', ' ', $pemesanan->status_pemesanan) }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Action -->
                            <div class="flex justify-center gap-4">
                                <a href="{{ route('dashboard.pengguna') }}"
                                    class="px-6 py-2 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition duration-200 flex items-center">
                                    <i class="fas fa-home mr-2"></i> Kembali ke Beranda
                                </a>

                                <a href="{{ route('pemilik.pemesanan.riwayat') }}"
                                    class="px-6 py-2 bg-green-600 text-white rounded-lg font-medium hover:bg-green-700 transition duration-200 flex items-center">
                                    <i class="fas fa-receipt mr-2"></i> Lihat Detail Pesanan
                                </a>
                            </div>

                        </div>
                    @endif
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
                            pilihan
                            homestay berkualitas.</p>
                    </div>
                    <div>
                        <h4 class="text-lg font-semibold mb-4">Tautan Cepat</h4>
                        <ul class="space-y-2">
                            <li><a href="{{ route('about') }}"
                                    class="text-gray-400 hover:text-white transition">Tentang Kami</a></li>
                            <li><a href="{{ route('contact') }}"
                                    class="text-gray-400 hover:text-white transition">Kontak</a></li>
                            <li><a href="{{ route('faq') }}"
                                    class="text-gray-400 hover:text-white transition">FAQ</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-lg font-semibold mb-4">Dukungan</h4>
                        <ul class="space-y-2">
                            <li><a href="{{ route('privacy') }}"
                                    class="text-gray-400 hover:text-white transition">Kebijakan Privasi</a></li>
                            <li><a href="{{ route('terms') }}"
                                    class="text-gray-400 hover:text-white transition">Syarat & Ketentuan</a></li>
                            <li><a href="{{ route('help') }}"
                                    class="text-gray-400 hover:text-white transition">Bantuan</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-lg font-semibold mb-4">Hubungi Kami</h4>
                        <ul class="space-y-2 text-gray-400">
                            <li class="flex items-center">
                                <i class="fas fa-map-marker-alt mr-3 text-blue-400"></i> Jl. Pantai Teleng Ria No. 17,
                                Pacitan
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-phone-alt mr-3 text-blue-400"></i> +62 812 3456 7890
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-envelope mr-3 text-blue-400"></i> hello@wathome.com
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="border-t border-gray-800 pt-6 flex flex-col md:flex-row justify-between items-center">
                    <p class="text-gray-400 text-sm mb-4 md:mb-0">&copy; {{ date('Y') }} WatHome.com. All rights
                        reserved.</p>
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
            document.addEventListener('DOMContentLoaded', function() {
                // Upload preview pembayaran
                if (document.getElementById('upload-container')) {
                    document.getElementById('upload-container').addEventListener('click', function() {
                        document.getElementById('payment_proof').click();
                    });

                    document.getElementById('payment_proof').addEventListener('change', function(e) {
                        if (e.target.files.length > 0) {
                            const file = e.target.files[0];
                            const reader = new FileReader();

                            reader.onload = function(event) {
                                document.getElementById('preview-image').src = event.target.result;
                                document.getElementById('upload-container').classList.add('hidden');
                                document.getElementById('preview-container').classList.remove('hidden');
                            };

                            reader.readAsDataURL(file);
                        }
                    });

                    document.getElementById('change-image').addEventListener('click', function() {
                        document.getElementById('payment_proof').value = '';
                        document.getElementById('upload-container').classList.remove('hidden');
                        document.getElementById('preview-container').classList.add('hidden');
                    });
                }

                // Untuk single room booking
                if (!{{ $isMultiRoom ? 'true' : 'false' }}) {
                    const jumlahKamarSelect = document.getElementById('jumlah_kamar');
                    const checkinInput = document.getElementById('checkin');
                    const checkoutInput = document.getElementById('checkout');
                    const summaryJumlahKamar = document.getElementById('summary-jumlah-kamar');
                    const totalHargaElement = document.getElementById('total-harga');
                    const hargaPerKamar = {{ $isMultiRoom ? 0 : $tipeKamar->harga ?? 0 }};

                    function calculateTotalPrice() {
                        const jumlahKamar = parseInt(jumlahKamarSelect.value);
                        const checkin = new Date(checkinInput.value);
                        const checkout = new Date(checkoutInput.value);

                        if (checkin && checkout && !isNaN(checkin.getTime()) && !isNaN(checkout.getTime())) {
                            const jumlahMalam = Math.ceil((checkout - checkin) / (1000 * 60 * 60 * 24));
                            const totalHarga = jumlahKamar * hargaPerKamar * jumlahMalam;

                            summaryJumlahKamar.textContent = jumlahKamar;
                            totalHargaElement.textContent = 'Rp' + totalHarga.toLocaleString('id-ID');
                        }
                    }

                    // Inisialisasi total harga
                    calculateTotalPrice();

                    // Event listeners untuk input perubahan
                    if (jumlahKamarSelect) jumlahKamarSelect.addEventListener('change', calculateTotalPrice);
                    if (checkinInput) checkinInput.addEventListener('change', calculateTotalPrice);
                    if (checkoutInput) checkoutInput.addEventListener('change', calculateTotalPrice);

                    // Validasi tanggal checkin dan checkout
                    if (checkinInput && checkoutInput) {
                        checkinInput.addEventListener('change', function() {
                            const checkinDate = new Date(this.value);
                            const nextDay = new Date(checkinDate);
                            nextDay.setDate(checkinDate.getDate() + 1);

                            checkoutInput.min = nextDay.toISOString().split('T')[0];

                            if (new Date(checkoutInput.value) < nextDay) {
                                checkoutInput.value = '';
                            }

                            calculateTotalPrice();
                        });
                    }
                }

            });
        </script>
    </body>

    </html>
