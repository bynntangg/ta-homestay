<!DOCTYPE html>
<html>
<head>
    <title>{{ $title }}</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h1 { margin: 0; font-size: 24px; }
        .header p { margin: 5px 0 0; font-size: 14px; color: #666; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table th, table td { border: 1px solid #ddd; padding: 8px; }
        table th { background-color: #f2f2f2; text-align: left; }
        .text-right { text-align: right; }
        .badge { padding: 3px 6px; border-radius: 3px; font-size: 12px; }
        .badge-primary { background-color: #4e73df; color: white; }
        .badge-warning { background-color: #f6c23e; color: black; }
        .badge-info { background-color: #36b9cc; color: white; }
        .badge-secondary { background-color: #858796; color: white; }
        .badge-danger { background-color: #e74a3b; color: white; }
        .footer {
            margin-top: 30px;
            padding-top: 10px;
            border-top: 1px solid #ddd;
            text-align: right;
            font-weight: bold;
        }
        .total-label {
            font-size: 14px;
            color: #555;
        }
        .total-value {
            font-size: 16px;
            color: #2e59d9;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>{{ $title }}</h1>
        <p>Dibuat pada: {{ $date }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Pelanggan</th>
                <th>Homestay</th>
                <th>Tanggal</th>
                <th class="text-right">Total</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pemesanans as $pemesanan)
            <tr>
                <td>#{{ $pemesanan->id }}</td>
                <td>{{ $pemesanan->user->name }}</td>
                <td>{{ $pemesanan->homestay->nama }}</td>
                <td>{{ $pemesanan->created_at->format('d M Y') }}</td>
                <td class="text-right">Rp {{ number_format($pemesanan->total_harga_display, 0, ',', '.') }}</td>
                <td>
                    @if ($pemesanan->status_pemesanan == 'dikonfirmasi')
                        <span class="badge badge-primary">Dikonfirmasi</span>
                    @elseif($pemesanan->status_pemesanan == 'menunggu_konfirmasi')
                        <span class="badge badge-warning">Menunggu</span>
                    @elseif($pemesanan->status_pemesanan == 'check_in')
                        <span class="badge badge-info">Check In</span>
                    @elseif($pemesanan->status_pemesanan == 'check_out')
                        <span class="badge badge-secondary">Check Out</span>
                    @elseif($pemesanan->status_pemesanan == 'dibatalkan')
                        <span class="badge badge-danger">Dibatalkan</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
     <!-- Tambahkan footer untuk total -->
     <div class="footer">
        <div class="total-label">Total 10 Pemesanan Terbaru:</div>
        <div class="total-value">Rp {{ number_format($totalSemuaHarga, 0, ',', '.') }}</div>
    </div>
</body>
</html>