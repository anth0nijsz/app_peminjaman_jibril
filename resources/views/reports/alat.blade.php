<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Alat</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px solid #667eea;
            padding-bottom: 15px;
        }
        .header h1 {
            color: #667eea;
            margin: 0;
        }
        .header p {
            margin: 5px 0;
            color: #666;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th {
            background-color: #667eea;
            color: white;
            padding: 12px;
            text-align: left;
            font-weight: bold;
        }
        td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 12px;
            color: #666;
        }
        .status-baik {
            background-color: #d4edda;
            color: #155724;
            padding: 4px 8px;
            border-radius: 4px;
        }
        .status-rusak {
            background-color: #f8d7da;
            color: #721c24;
            padding: 4px 8px;
            border-radius: 4px;
        }
        .status-perlu-perbaikan {
            background-color: #fff3cd;
            color: #856404;
            padding: 4px 8px;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Laporan Data Alat</h1>
        <p>Sistem Manajemen Peminjaman Alat</p>
        <p>Tanggal: {{ date('d/m/Y H:i:s') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Alat</th>
                <th>Nama Alat</th>
                <th>Kategori</th>
                <th>Tersedia</th>
                <th>Total</th>
                <th>Kondisi</th>
                <th>Lokasi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($alats as $alat)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $alat->kode_alat }}</td>
                    <td>{{ $alat->nama_alat }}</td>
                    <td>{{ $alat->kategori->nama_kategori }}</td>
                    <td>{{ $alat->jumlah_tersedia }}</td>
                    <td>{{ $alat->jumlah_total }}</td>
                    <td>
                        <span class="status-{{ str_replace('_', '-', $alat->kondisi) }}">
                            {{ ucfirst(str_replace('_', ' ', $alat->kondisi)) }}
                        </span>
                    </td>
                    <td>{{ $alat->lokasi_penyimpanan ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8">Tidak ada data alat</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Total Alat: {{ $alats->count() }}</p>
        <p>Dihasilkan oleh Sistem Peminjaman Alat</p>
    </div>
</body>
</html>
