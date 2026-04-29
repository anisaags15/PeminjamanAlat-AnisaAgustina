<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Peminjaman Alat</title>
    <style>
        body { font-family: sans-serif; padding: 20px; line-height: 1.6; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #000; padding-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid #333; }
        th { background-color: #f2f2f2; padding: 10px; text-align: left; }
        td { padding: 8px; font-size: 14px; }
        .status { text-transform: capitalize; font-weight: bold; }
        
        /* Mengatur tampilan saat diprint */
        @media print {
            @page { margin: 1cm; }
            .no-print { display: none; }
            body { padding: 0; }
        }
    </style>
</head>
<body>

    <div class="header">
        <h2 style="margin:0;">LAPORAN DATA PEMINJAMAN ALAT</h2>
        <p style="margin:5px 0;">Dicetak pada: {{ date('d F Y H:i') }}</p>
    </div>

    <button onclick="window.print()" class="no-print" style="margin-bottom: 20px; padding: 10px; cursor: pointer;">
        Klik untuk Cetak / Save PDF
    </button>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Peminjam</th>
                <th>Nama Alat</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($peminjamans as $index => $p)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $p->user->name }}</td>
                <td>{{ $p->alat->nama_alat }}</td>
                <td>{{ $p->tanggal_pinjam }}</td>
                <td>{{ $p->tanggal_kembali }}</td>
                <td class="status">{{ $p->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div style="margin-top: 50px; text-align: right;">
        <p>Petugas Perpustakaan/Laboratorium,</p>
        <br><br><br>
        <p><strong>( ____________________ )</strong></p>
    </div>

    <script>
        // Otomatis buka dialog print saat halaman dimuat
        window.onload = function() {
            window.print();
        };
    </script>
</body>
</html>