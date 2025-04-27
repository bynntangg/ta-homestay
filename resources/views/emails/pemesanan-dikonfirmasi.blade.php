<!DOCTYPE html>
<html>

<head>
    <title>Pemesanan Dikonfirmasi</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap');

        body {
            font-family: 'Poppins', Arial, sans-serif;
            line-height: 1.6;
            color: #444;
            background-color: #f7f9fc;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }

        .header {
            background: linear-gradient(135deg, #4CAF50 0%, #2E7D32 100%);
            color: white;
            padding: 30px 20px;
            text-align: center;
            position: relative;
        }

        .header h1 {
            margin: 0;
            font-weight: 600;
            font-size: 28px;
        }

        .header-icon {
            font-size: 48px;
            margin-bottom: 15px;
            display: inline-block;
        }

        .content {
            padding: 30px;
        }

        .footer {
            margin-top: 20px;
            font-size: 12px;
            text-align: center;
            color: #777;
            padding: 20px;
            background-color: #f1f5f9;
            border-top: 1px solid #e1e8ed;
        }

        .button {
            display: inline-block;
            padding: 12px 25px;
            background: linear-gradient(135deg, #4CAF50 0%, #2E7D32 100%);
            color: white;
            text-decoration: none;
            border-radius: 30px;
            font-weight: 500;
            margin: 15px 0;
            box-shadow: 0 4px 10px rgba(76, 175, 80, 0.3);
            transition: all 0.3s ease;
        }

        .button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(76, 175, 80, 0.4);
        }

        .booking-details {
            margin: 25px 0;
            border: 1px solid #e1e8ed;
            padding: 20px;
            border-radius: 10px;
            background-color: #f8fafc;
        }

        .booking-details h3 {
            margin-top: 0;
            color: #2E7D32;
            font-size: 20px;
            border-bottom: 2px solid #e1e8ed;
            padding-bottom: 10px;
        }

        .detail-row {
            display: flex;
            margin-bottom: 10px;
            align-items: center;
        }

        .detail-label {
            font-weight: 500;
            color: #555;
            min-width: 120px;
            display: flex;
            align-items: center;
        }

        .detail-label i {
            margin-right: 8px;
            width: 20px;
            text-align: center;
        }

        .detail-value {
            color: #222;
            font-weight: 400;
        }

        .highlight {
            color: #2E7D32;
            font-weight: 600;
        }

        .thank-you {
            font-size: 18px;
            text-align: center;
            margin: 25px 0;
            color: #2E7D32;
            font-weight: 500;
        }

        .tips-box {
            background-color: #fff8e6;
            border: 1px solid #ffeeba;
            border-left: 5px solid #ffc107;
            color: #856404;
            padding: 20px;
            border-radius: 12px;
            margin: 25px 0;
        }

        .tips-box strong {
            color: #d39e00;
        }


        .homestay-image {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        .contact-info {
            background-color: #e8f5e9;
            padding: 15px;
            border-radius: 8px;
            margin-top: 20px;
            text-align: center;
        }

        .divider {
            height: 1px;
            background: linear-gradient(to right, transparent, #ddd, transparent);
            margin: 25px 0;
        }

        .emoji {
            font-size: 20px;
            margin-right: 5px;
            vertical-align: middle;
        }

        .confetti {
            position: absolute;
            width: 10px;
            height: 10px;
            background-color: rgba(255, 255, 255, 0.7);
            border-radius: 50%;
            animation: fall 5s linear infinite;
        }

        @keyframes fall {
            0% {
                transform: translateY(-20px) rotate(0deg);
                opacity: 1;
            }

            100% {
                transform: translateY(100px) rotate(360deg);
                opacity: 0;
            }
        }

        /* New styles for PDF section */
        .pdf-section {
            border: 1px solid #e1e8ed;
            border-radius: 10px;
            padding: 20px;
            margin-top: 20px;
            background-color: #f8fafc;
        }

        .pdf-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .pdf-title {
            font-size: 18px;
            font-weight: 600;
            color: #2E7D32;
        }

        .pdf-download {
            display: inline-block;
            padding: 8px 15px;
            background: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .pdf-download:hover {
            background: #2E7D32;
        }

        .pdf-preview {
            border: 1px dashed #ccc;
            border-radius: 5px;
            padding: 15px;
            text-align: center;
            background-color: white;
        }

        .pdf-icon {
            font-size: 50px;
            color: #e74c3c;
            margin-bottom: 10px;
        }

        .pdf-filename {
            font-weight: 500;
            margin-top: 10px;
        }

        .pdf-embed {
            width: 100%;
            height: 500px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-top: 15px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <!-- Confetti elements -->
            <div class="confetti" style="left:10%; animation-delay:0s;"></div>
            <div class="confetti" style="left:20%; animation-delay:0.5s;"></div>
            <div class="confetti" style="left:30%; animation-delay:1s;"></div>
            <div class="confetti" style="left:40%; animation-delay:1.5s;"></div>
            <div class="confetti" style="left:50%; animation-delay:2s;"></div>
            <div class="confetti" style="left:60%; animation-delay:2.5s;"></div>
            <div class="confetti" style="left:70%; animation-delay:3s;"></div>
            <div class="confetti" style="left:80%; animation-delay:3.5s;"></div>
            <div class="confetti" style="left:90%; animation-delay:4s;"></div>

            <div class="header-icon">🎉</div>
            <h1>Yeay! Pemesanan Dikonfirmasi!</h1>
        </div>

        <div class="content">
            <p><span class="emoji">👋</span> Halo <span class="highlight">{{ $pemesanan->user->name }}</span>,</p>
            <p><span class="emoji">❤️</span> Terima kasih telah memesan di {{ $pemesanan->homestay->nama }}. Pemesanan
                Anda dengan ID <strong>#{{ $pemesanan->id }}</strong> telah berhasil dikonfirmasi!</p>

            <!-- Placeholder for homestay image -->
            <img src="https://via.placeholder.com/600x180/4CAF50/ffffff?text={{ urlencode($pemesanan->homestay->nama) }}"
                alt="{{ $pemesanan->homestay->nama }}" class="homestay-image">

            <div class="booking-details">
                <h3><span class="emoji">📋</span> Detail Pemesanan</h3>

                <div class="detail-row">
                    <div class="detail-label"><i class="fas fa-home"></i> Homestay:</div>
                    <div class="detail-value">{{ $pemesanan->homestay->nama }}</div>
                </div>

                <div class="detail-row">
                    <div class="detail-label"><i class="fas fa-calendar-check"></i> Check-in:</div>
                    <div class="detail-value highlight">{{ $pemesanan->tanggal_checkin->format('d M Y') }}</div>
                </div>

                <div class="detail-row">
                    <div class="detail-label"><i class="fas fa-calendar-times"></i> Check-out:</div>
                    <div class="detail-value highlight">{{ $pemesanan->tanggal_checkout->format('d M Y') }}</div>
                </div>

                <div class="detail-row">
                    <div class="detail-label"><i class="fas fa-moon"></i> Durasi:</div>
                    <div class="detail-value">
                        {{ $pemesanan->tanggal_checkin->diffInDays($pemesanan->tanggal_checkout) }} malam</div>
                </div>

                <div class="detail-row">
                    <div class="detail-label"><i class="fas fa-door-open"></i> Kamar:</div>
                    <div class="detail-value">
                        @foreach ($pemesanan->kamars as $kamar)
                            <div><span class="emoji">🛏️</span> {{ $kamar->nomor }} ({{ $kamar->tipeKamar->nama }}) -
                                Rp{{ number_format($kamar->pivot->harga, 0, ',', '.') }}</div>
                        @endforeach
                    </div>
                </div>

                <div class="detail-row" style="margin-top: 15px; padding-top: 15px; border-top: 1px dashed #ddd;">
                    <div class="detail-label" style="font-size: 16px;"><i class="fas fa-receipt"></i> Total Pembayaran:
                    </div>
                    <div class="detail-value" style="font-size: 18px; font-weight: 600; color: #2E7D32;">
                        Rp{{ number_format($pemesanan->kamars->sum('pivot.harga'), 0, ',', '.') }}</div>
                </div>
            </div>

            <div class="divider"></div>
            <div class="contact-info">
                <p><span class="emoji">📞</span> Butuh bantuan? Hubungi kami di:<br>
                    <strong><i class="fas fa-phone"></i> +62 882 9478 1090</strong> atau <strong><i
                            class="fas fa-envelope"></i>info@wathome.com</strong>
                </p>
            </div>

            <div class="tips-box">
                <h3 style="margin-top: 0; color: #d39e00;"><i class="fas fa-lightbulb"></i> Tips Untuk Anda</h3>
                <p>
                    <strong>1. Akses Detail Pemesanan:</strong> Untuk melihat detail pemesanan dan download invoice, buka menu <strong>Profil</strong> di pojok kanan atas, lalu pilih <strong>Pesanan Saya</strong>.
                </p>
                <p>
                    <strong>2. Persiapan Check-in:</strong> Pastikan membawa identitas diri yang valid untuk proses check-in yang lancar.
                </p>
                <p>
                    <strong>3. Fasilitas:</strong> Nikmati fasilitas kolam renang, WiFi gratis, dan sarapan pagi selama menginap.
                </p>
            </div>


            <div class="thank-you">
                <span class="emoji">✨</span> Kami menantikan kedatangan Anda! <span class="emoji">🏡</span>
            </div>
        </div>

        <div class="footer">
            <p><span class="emoji">©️</span> {{ date('Y') }} {{ $pemesanan->homestay->nama }}. All rights
                reserved.</p>
            <p><i class="fas fa-map-marker-alt"></i> Dsn. Ketro Watukarung No. 17, Pacitan</p>
        </div>
    </div>
</body>

</html>
