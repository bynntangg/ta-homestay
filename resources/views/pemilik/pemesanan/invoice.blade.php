<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Pemesanan - WatHome</title>
    <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f9fafb;
            padding: 32px 0;
            color: #374151;
        }
        
        .invoice-container {
            max-width: 800px;
            margin: 0 auto;
            background-color: white;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            border-radius: 0.5rem;
            overflow: hidden;
        }
        
        .watermark {
            position: absolute;
            opacity: 0.1;
            font-size: 5rem;
            transform: rotate(-30deg);
            z-index: 0;
            color: white;
            pointer-events: none;
        }
        
        .divider {
            border-top: 1px dashed #e5e7eb;
            margin: 1rem 0;
        }
        
        /* Header Styles */
        .invoice-header {
            background-color: #2563eb;
            color: white;
            padding: 24px;
            position: relative;
        }
        
        .invoice-header h1 {
            font-size: 1.875rem;
            font-weight: 700;
            margin-bottom: 4px;
        }
        
        .invoice-header p {
            color: #bfdbfe;
        }
        
        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            position: relative;
            z-index: 1;
        }
        
        /* Invoice Info Styles */
        .invoice-info {
            padding: 24px;
            display: grid;
            grid-template-columns: 1fr;
            gap: 32px;
        }
        
        @media (min-width: 768px) {
            .invoice-info {
                grid-template-columns: 1fr 1fr;
            }
        }
        
        .info-section h2 {
            font-size: 1.125rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 8px;
        }
        
        .info-section p {
            margin-bottom: 4px;
        }
        
        .info-section .font-medium {
            font-weight: 500;
        }
        
        .info-section .text-gray-600 {
            color: #4b5563;
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
        }
        
        /* Status Badge */
        .status-badge {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 9999px;
            font-size: 0.75rem;
            text-transform: capitalize;
        }
        
        .bg-green-100 {
            background-color: #dcfce7;
        }
        
        .text-green-800 {
            color: #166534;
        }
        
        .bg-yellow-100 {
            background-color: #fef9c3;
        }
        
        .text-yellow-800 {
            color: #854d0e;
        }
        
        .bg-red-100 {
            background-color: #fee2e2;
        }
        
        .text-red-800 {
            color: #991b1b;
        }
        
        /* Order Details */
        .order-details {
            padding: 0 24px 8px;
        }
        
        .order-details h2 {
            font-size: 1.125rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 16px;
        }
        
        .order-summary {
            background-color: #f9fafb;
            border-radius: 0.5rem;
            padding: 16px;
            margin-bottom: 16px;
        }
        
        .order-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 16px;
            margin-bottom: 8px;
        }
        
        @media (min-width: 768px) {
            .order-grid {
                grid-template-columns: 1fr 1fr 1fr;
            }
        }
        
        .room-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 4px;
        }
        
        .room-tag {
            background-color: #dbeafe;
            color: #1e40af;
            padding: 4px 12px;
            border-radius: 9999px;
            font-size: 0.875rem;
        }
        
        /* Items Table */
        .items-table {
            padding: 0 24px 16px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        th {
            background-color: #f3f4f6;
            text-align: left;
            padding: 8px 16px;
            color: #374151;
            font-weight: 500;
        }
        
        th.text-right {
            text-align: right;
        }
        
        td {
            padding: 12px 16px;
            border-bottom: 1px solid #e5e7eb;
        }
        
        td.text-right {
            text-align: right;
        }
        
        /* Total Section */
        .total-section {
            padding: 0 24px 24px;
        }
        
        .total-container {
            display: flex;
            justify-content: flex-end;
        }
        
        .total-grid {
            width: 100%;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
        }
        
        @media (min-width: 768px) {
            .total-grid {
                width: 50%;
            }
        }
        
        .total-grid p:last-child,
        .total-grid p:nth-last-child(2) {
            margin-top: 8px;
        }
        
        .text-lg {
            font-size: 1.125rem;
        }
        
        .font-bold {
            font-weight: 700;
        }
        
        .text-blue-600 {
            color: #2563eb;
        }
        
        /* QR Code Section */
        .qr-section {
            padding: 0 24px 16px;
        }
        
        .qr-section h3 {
            font-weight: 500;
            color: #1f2937;
            font-size: 1.125rem;
            margin-bottom: 16px;
        }
        
        .qr-container {
            display: flex;
            flex-direction: column;
            background-color: #f9fafb;
            padding: 24px;
            border-radius: 0.5rem;
            align-items: center;
        }
        
        @media (min-width: 768px) {
            .qr-container {
                flex-direction: row;
            }
        }
        
        .qr-code-container {
            margin-bottom: 16px;
        }
        
        @media (min-width: 768px) {
            .qr-code-container {
                margin-bottom: 0;
                margin-right: 24px;
            }
        }
        
        .qr-code-container img {
            width: 192px;
            height: 192px;
        }
        
        @media (min-width: 768px) {
            .qr-code-container img {
                width: 256px;
                height: 256px;
            }
        }
        
        .qr-info {
            text-align: center;
        }
        
        @media (min-width: 768px) {
            .qr-info {
                text-align: left;
            }
        }
        
        .qr-info p {
            margin-bottom: 8px;
            color: #4b5563;
        }
        
        .qr-info .text-sm {
            font-size: 0.875rem;
        }
        
        .qr-notice {
            background-color: #dbeafe;
            color: #1e40af;
            padding: 12px;
            border-radius: 0.5rem;
            display: inline-block;
            margin-top: 16px;
        }
        
        /* Payment Instructions */
        .payment-instructions {
            background-color: #f9fafb;
            padding: 24px;
            border-top: 1px solid #e5e7eb;
        }
        
        .payment-instructions h2 {
            font-size: 1.125rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 8px;
        }
        
        .payment-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 16px;
            margin-top: 16px;
        }
        
        @media (min-width: 768px) {
            .payment-grid {
                grid-template-columns: 1fr 1fr;
            }
        }
        
        .payment-card {
            background-color: white;
            padding: 16px;
            border-radius: 0.375rem;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
        }
        
        .payment-card h3 {
            font-weight: 500;
            color: #1f2937;
            margin-bottom: 8px;
        }
        
        .payment-details {
            font-size: 0.875rem;
            color: #4b5563;
        }
        
        .payment-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 4px;
        }
        
        .info-list {
            list-style: none;
            font-size: 0.875rem;
            color: #4b5563;
        }
        
        .info-list li {
            display: flex;
            align-items: flex-start;
            margin-bottom: 8px;
        }
        
        .info-list i {
            margin-right: 8px;
            margin-top: 2px;
            color: #3b82f6;
        }
        
        /* Footer */
        .invoice-footer {
            padding: 24px;
            background-color: #f3f4f6;
            text-align: center;
            color: #4b5563;
            font-size: 0.875rem;
        }
        
        .footer-buttons {
            display: flex;
            justify-content: center;
            gap: 16px;
            margin-top: 16px;
        }
        
        .btn {
            padding: 8px 16px;
            border-radius: 0.375rem;
            display: inline-flex;
            align-items: center;
            cursor: pointer;
            transition: background-color 0.2s;
        }
        
        .btn i {
            margin-right: 8px;
        }
        
        .btn-primary {
            background-color: #2563eb;
            color: white;
            border: none;
        }
        
        .btn-primary:hover {
            background-color: #1d4ed8;
        }
        
        .btn-secondary {
            background-color: white;
            color: #374151;
            border: 1px solid #d1d5db;
        }
        
        .btn-secondary:hover {
            background-color: #f9fafb;
        }
        
        /* Print Styles */
        @media print {
            .no-print {
                display: none !important;
            }
            
            body {
                padding: 0;
                background: white;
            }
            
            .invoice-container {
                box-shadow: none;
                border: none;
            }
            
            @page {
                size: auto;
                margin: 10mm;
            }
        }
    </style>
</head>

<body>
    <div class="invoice-container">
        <!-- Invoice Header -->
        <div class="invoice-header">
            <div class="watermark">WATHOME</div>
            <div class="header-content">
                <div>
                    <h1>INVOICE</h1>
                    <p>WatHome - Pemesanan Homestay</p>
                </div>
                <div style="text-align: right;">
                    <p>Nomor Invoice</p>
                    <p style="font-weight: 700; font-size: 1.25rem;">{{ $pemesanan->id }}</p>
                </div>
            </div>
        </div>

        <!-- Invoice Info -->
        <div class="invoice-info">
            <div class="info-section">
                <h2>Detail Pemesan</h2>
                <p class="font-medium">{{ Auth::user()->name }}</p>
                <p class="text-gray-600">{{ Auth::user()->email }}</p>
                <p class="text-gray-600">{{ $pemesanan->nomor_identitas }}</p>
            </div>

            <div class="info-section">
                <h2>Detail Invoice</h2>
                <div class="info-grid">
                    <p class="text-gray-600">Tanggal Pembuatan:</p>
                    <p>{{ $pemesanan->created_at->format('d M Y H:i') }}</p>

                    <p class="text-gray-600">Metode Pembayaran:</p>
                    <p>Transfer Bank ({{ $pemesanan->homestay->nama_bank }})</p>
                </div>
            </div>
        </div>

        <!-- Order Details -->
        <div class="order-details">
            <h2>Detail Pemesanan</h2>

            <div style="margin-bottom: 16px;">
                <h3 style="font-weight: 500; color: #374151;">{{ $pemesanan->homestay->nama }}</h3>
                <p class="text-gray-600">{{ $pemesanan->homestay->alamat }}</p>
            </div>

            <div class="order-summary">
                <div class="order-grid">
                    <div>
                        <p class="text-gray-600">Check-in</p>
                        <p style="font-weight: 500;">{{ $pemesanan->tanggal_checkin->format('d M Y') }} (13:00)</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Check-out</p>
                        <p style="font-weight: 500;">{{ $pemesanan->tanggal_checkout->format('d M Y') }} (12:00)</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Durasi</p>
                        <p style="font-weight: 500;">
                            {{ $pemesanan->tanggal_checkin->diffInDays($pemesanan->tanggal_checkout) }} Malam
                        </p>
                    </div>
                </div>

                <div style="margin-top: 8px;">
                    <p class="text-gray-600">Nomor Kamar:</p>
                    <div class="room-tags">
                        @foreach ($pemesanan->kamars as $kamar)
                            <span class="room-tag">
                                {{ $kamar->nomor }} ({{ $kamar->tipeKamar->nama }})
                            </span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Items Table -->
        <div class="items-table">
            <div style="overflow-x: auto;">
                <table>
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th style="text-align: right;">Harga</th>
                            <th style="text-align: right;">Jumlah</th>
                            <th style="text-align: right;">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pemesanan->kamars->groupBy('tipe_kamar_id') as $tipeKamarId => $kamars)
                            @php
                                $tipeKamar = $kamars->first()->tipeKamar;
                                $durasi = $pemesanan->tanggal_checkin->diffInDays($pemesanan->tanggal_checkout);
                                $jumlahKamar = $kamars->count();
                            @endphp
                            <tr>
                                <td>
                                    <p style="font-weight: 500;">{{ $tipeKamar->nama }}</p>
                                    <p style="font-size: 0.875rem; color: #4b5563;">{{ $durasi }} Malam</p>
                                </td>
                                <td style="text-align: right;">Rp{{ number_format($tipeKamar->harga, 0, ',', '.') }}</td>
                                <td style="text-align: right;">{{ $jumlahKamar }} Kamar</td>
                                <td style="text-align: right;">
                                    Rp{{ number_format($tipeKamar->harga * $jumlahKamar * $durasi, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Total Section -->
        <div class="total-section">
            <div class="divider"></div>
            <div class="total-container">
                <div class="total-grid">
                    <p class="text-gray-600">Subtotal:</p>
                    <p style="text-align: right;">Rp{{ number_format($pemesanan->total_harga, 0, ',', '.') }}</p>

                    <p class="text-gray-600">Pajak (0%):</p>
                    <p style="text-align: right;">Rp0</p>

                    <p class="text-gray-600">Diskon:</p>
                    <p style="text-align: right;">Rp0</p>

                    <p class="font-bold text-lg text-gray-800">Total:</p>
                    <p class="font-bold text-lg text-blue-600" style="text-align: right;">
                        Rp{{ number_format($pemesanan->total_harga, 0, ',', '.') }}
                    </p>
                </div>
            </div>
        </div>

        <!-- QR Code for check-in -->
        <div class="qr-section">
            <h3>QR Code Check-in</h3>
            <div class="qr-container">
                <div class="qr-code-container">
                    <img src="{{ asset('storage/' . $pemesanan->qr_code) }}" alt="QR Code untuk check-in" loading="lazy">
                </div>
                <div class="qr-info">
                    <p>Tunjukkan QR code ini saat check-in di homestay</p>
                    <p class="text-sm">Pastikan QR code terlihat jelas dan tidak rusak</p>
                    <div class="qr-notice">
                        <i class="fas fa-info-circle" style="margin-right: 8px;"></i>
                        Nomor Pemesanan: <strong>{{ $pemesanan->id }}</strong>
                    </div>
                </div>
            </div>
        </div>

        <!-- Payment Instructions -->
        <div class="payment-instructions">
            <h2>Instruksi Pembayaran</h2>
            <div class="payment-grid">
                <div class="payment-card">
                    <h3>Transfer Bank</h3>
                    <div class="payment-details">
                        <p style="margin-bottom: 8px;">Silakan transfer ke rekening berikut:</p>
                        <div class="payment-row">
                            <span>Bank</span>
                            <span style="font-weight: 500;">{{ $pemesanan->homestay->nama_bank }}</span>
                        </div>
                        <div class="payment-row">
                            <span>Nomor Rekening</span>
                            <span style="font-weight: 500;">{{ $pemesanan->homestay->nomor_rekening }}</span>
                        </div>
                        <div class="payment-row">
                            <span>Atas Nama</span>
                            <span style="font-weight: 500;">{{ $pemesanan->homestay->atas_nama }}</span>
                        </div>
                        <div class="payment-row">
                            <span>Jumlah Transfer</span>
                            <span style="font-weight: 700; color: #2563eb;">
                                Rp{{ number_format($pemesanan->total_harga, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="payment-card">
                    <h3>Informasi Tambahan</h3>
                    <ul class="info-list">
                        <li>
                            <i class="fas fa-info-circle"></i>
                            <span>Harap transfer tepat sesuai jumlah di atas</span>
                        </li>
                        <li>
                            <i class="fas fa-clock"></i>
                            <span>Pesanan akan otomatis dibatalkan jika tidak dibayar dalam 24 jam</span>
                        </li>
                        <li>
                            <i class="fas fa-qrcode"></i>
                            <span>Tunjukkan QR code saat check-in di homestay</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="invoice-footer no-print">
            <p>Terima kasih telah memesan di WatHome</p>
            <p style="margin-top: 4px;">Jika ada pertanyaan, hubungi kami di hello@wathome.com atau +62 812 3456 7890</p>
            <div class="footer-buttons">
                <button onclick="window.print()" class="btn btn-primary">
                    <i class="fas fa-print"></i> Cetak Invoice
                </button>
                <a href="{{ route('dashboard.pengguna') }}" class="btn btn-secondary">
                    <i class="fas fa-home"></i> Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>

    <script>
        // Fungsi untuk mengunduh invoice sebagai PDF
        function downloadPDF() {
            console.log("Mengunduh invoice sebagai PDF");
        }
    </script>
</body>

</html>