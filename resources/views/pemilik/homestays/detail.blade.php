<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $homestay->nama }} - Detail Homestay</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-50">
    <div class="container mx-auto px-4 py-8">
        <!-- Homestay Header -->
        <div class="flex flex-col md:flex-row gap-6 mb-8">
            <!-- Homestay Image -->
            <div class="w-full md:w-1/2 lg:w-2/3">
                <div class="rounded-xl overflow-hidden bg-gray-100 aspect-[4/3]">
                    @if ($homestay->foto)
                        <img src="data:image/jpeg;base64,{{ base64_encode($homestay->foto) }}"
                            alt="{{ $homestay->nama }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-gray-200">
                            <span class="text-gray-500">No Image</span>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Homestay Info -->
            <div class="w-full md:w-1/2 lg:w-1/3">
                <div class="bg-white rounded-xl shadow-sm p-6 h-full">
                    <h1 class="text-2xl font-bold text-gray-800 mb-4">{{ $homestay->nama }}</h1>

                    <div class="flex items-center text-gray-600 mb-4">
                        <i class="fas fa-map-marker-alt mr-2"></i>
                        <span>{{ $homestay->alamat }}</span>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Deskripsi</h3>
                        <p class="text-gray-600">{{ $homestay->deskripsi }}</p>
                    </div>

                    @if ($homestay->rating > 0)
                        <div class="flex items-center mb-4">
                            <div class="flex mr-1">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $homestay->rating)
                                        <i class="fas fa-star text-yellow-400"></i>
                                    @else
                                        <i class="far fa-star text-gray-300"></i>
                                    @endif
                                @endfor
                            </div>
                            <span class="text-sm font-medium text-gray-700 ml-1">{{ $homestay->rating }}.0</span>
                        </div>
                    @endif

                    @if (!empty($homestay->fasilitas))
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">Fasilitas</h3>
                            <div class="flex flex-wrap gap-2">
                                @php
                                    // Daftar semua fasilitas yang mungkin beserta label dan ikonnya
                                    $allFacilities = [
                                        'wifi' => ['label' => 'WiFi', 'icon' => 'wifi'],
                                        'parkir' => ['label' => 'Parkir', 'icon' => 'parking'],
                                        'ac' => ['label' => 'AC', 'icon' => 'snowflake'],
                                        'kolam_renang' => ['label' => 'Kolam Renang', 'icon' => 'swimming-pool'],
                                        'breakfast' => ['label' => 'Breakfast', 'icon' => 'utensils'],
                                        'tv' => ['label' => 'TV', 'icon' => 'tv'],
                                        'shower' => ['label' => 'Shower', 'icon' => 'shower'],
                                        'kitchen' => ['label' => 'Kitchen', 'icon' => 'kitchen-set'],
                                    ];

                                    // Pastikan fasilitas adalah array
                                    $facilities = is_array($homestay->fasilitas)
                                        ? $homestay->fasilitas
                                        : json_decode($homestay->fasilitas, true) ?? [];
                                @endphp

                                @foreach ($allFacilities as $key => $facility)
                                    @if (!empty($facilities[$key]))
                                        <span
                                            class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-sm flex items-center">
                                            <i class="fas fa-{{ $facility['icon'] }} mr-1"></i>
                                            {{ $facility['label'] }}
                                        </span>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Room Types Section - Modified with Cinema Seat Style -->
        <div class="mb-12">
            <h2 class="text-xl font-bold text-gray-800 mb-6">Tipe Kamar & Ketersediaan</h2>

            @foreach ($homestay->tipe_kamars as $tipe_kamar)
                <div class="bg-white rounded-xl shadow-sm p-6 mb-8 border border-gray-200">
                    <div class="flex flex-col md:flex-row gap-8">
                        <!-- Room Type Info -->
                        <div class="md:w-1/3">
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $tipe_kamar->nama }}</h3>
                            <p class="text-gray-600 text-sm mb-4">{{ $tipe_kamar->deskripsi }}</p>
                            <div class="text-lg font-bold text-blue-600 mb-4">
                                Rp{{ number_format($tipe_kamar->harga, 0, ',', '.') }}/malam
                            </div>

                            @if ($tipe_kamar->foto)
                                <div class="aspect-[4/3] bg-gray-100 rounded-lg overflow-hidden mb-4">
                                    <img src="data:image/jpeg;base64,{{ base64_encode($tipe_kamar->foto) }}"
                                        alt="{{ $tipe_kamar->nama }}" class="w-full h-full object-cover">
                                </div>
                            @endif
                        </div>

                        <!-- Room Availability - Cinema Seat Style -->
                        <div class="md:w-2/3">
                            <h4 class="text-md font-medium text-gray-700 mb-4">Ketersediaan Kamar</h4>

                            <div class="grid grid-cols-5 sm:grid-cols-8 md:grid-cols-10 gap-3">
                                @foreach ($tipe_kamar->kamars as $kamar)
                                    <div class="relative text-center">
                                        <div class="w-full aspect-square rounded-md flex items-center justify-center 
                                  {{ $kamar->ketersediaan ? 'bg-green-500 hover:bg-green-600' : 'bg-gray-300 hover:bg-gray-400' }} 
                                  transition-colors cursor-default"
                                            title="Kamar {{ $kamar->nomor }} - {{ $kamar->ketersediaan ? 'Tersedia' : 'Tidak Tersedia' }}">
                                            <span class="text-white font-medium">{{ $kamar->nomor }}</span>
                                        </div>
                                        @if (!$kamar->ketersediaan)
                                            <div
                                                class="absolute top-0 left-0 w-full h-full flex items-center justify-center">
                                                <div class="w-8 h-[2px] bg-red-500 transform rotate-45"></div>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>

                            <div class="mt-6 flex items-center justify-between">
                                <div class="flex items-center space-x-4">
                                    <div class="flex items-center">
                                        <div class="w-4 h-4 bg-green-500 rounded-sm mr-2"></div>
                                        <span class="text-sm text-gray-600">Tersedia</span>
                                    </div>
                                    <div class="flex items-center">
                                        <div class="w-4 h-4 bg-gray-300 rounded-sm mr-2 relative">
                                            <div
                                                class="absolute top-1/2 left-0 w-full h-[2px] bg-red-500 transform rotate-45">
                                            </div>
                                        </div>
                                        <span class="text-sm text-gray-600">Tidak Tersedia</span>
                                    </div>
                                </div>

                                <div class="text-sm text-gray-500">
                                    {{ $tipe_kamar->kamars->where('ketersediaan', 1)->count() }} dari
                                    {{ $tipe_kamar->kamars->count() }} kamar tersedia
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-6 mt-12">
        <div class="container mx-auto px-4 text-center">
            <p>&copy; {{ date('Y') }} WatHome.com. Semua Hak Cipta Dilindungi.</p>
        </div>
    </footer>
</body>

</html>
