<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Peminjaman</title>
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
        .status-pending {
            background-color: #fff3cd;
            color: #856404;
            padding: 4px 8px;
            border-radius: 4px;
        }
        .status-disetujui {
            background-color: #d4edda;
            color: #155724;
            padding: 4px 8px;
            border-radius: 4px;
        }
        .status-ditolak {
            background-color: #f8d7da;
            color: #721c24;
            padding: 4px 8px;
            border-radius: 4px;
        }
        .status-dikembalikan {
            background-color: #d1ecf1;
            color: #0c5460;
            padding: 4px 8px;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Laporan Data Peminjaman Alat</h1>
        <p>Sistem Manajemen Peminjaman Alat</p>
        <p>Tanggal: {{ date('d/m/Y H:i:s') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>User</th>
                <th>Alat</th>
                <th>Jumlah</th>
                <th>Tgl. Peminjaman</th>
                <th>Tgl. Kembali</th>
                <th>Status</th>
                <th>Keperluan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($peminjamans as $peminjaman)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $peminjaman->user->name }}</td>
                    <td>{{ $peminjaman->alat->nama_alat }}</td>
                    <td>{{ $peminjaman->jumlah_pinjam }}</td>
                    <td>{{ $peminjaman->tanggal_peminjaman->format('d/m/Y') }}</td>
                    <td>{{ $peminjaman->tanggal_pengembalian_direncanakan->format('d/m/Y') }}</td>
                    <td>
                        <span class="status-{{ str_replace('_', '-', $peminjaman->status) }}">
                            {{ ucfirst(str_replace('_', ' ', $peminjaman->status)) }}
                        </span>
                    </td>
                    <td>{{ Str::limit($peminjaman->keperluan, 30) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8">Tidak ada data peminjaman</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Total Peminjaman: {{ $peminjamans->count() }}</p>
        <p>Dihasilkan oleh Sistem Peminjaman Alat</p>
    </div>
</body>
</html>
