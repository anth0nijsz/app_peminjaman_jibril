<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Pengembalian</title>
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
            background-color: #fff3cd;
            color: #856404;
            padding: 4px 8px;
            border-radius: 4px;
        }
        .status-hilang {
            background-color: #f8d7da;
            color: #721c24;
            padding: 4px 8px;
            border-radius: 4px;
        }
        .status-belum-dikonfirmasi {
            background-color: #d1ecf1;
            color: #0c5460;
            padding: 4px 8px;
            border-radius: 4px;
        }
        .status-dikonfirmasi {
            background-color: #d4edda;
            color: #155724;
            padding: 4px 8px;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Laporan Data Pengembalian Alat</h1>
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
                <th>Tgl. Pengembalian</th>
                <th>Kondisi</th>
                <th>Status</th>
                <th>Catatan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pengembalians as $pengembalian)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $pengembalian->user->name }}</td>
                    <td>{{ $pengembalian->peminjaman->alat->nama_alat }}</td>
                    <td>{{ $pengembalian->jumlah_dikembalikan }}</td>
                    <td>{{ $pengembalian->tanggal_pengembalian->format('d/m/Y') }}</td>
                    <td>
                        <span class="status-{{ str_replace('_', '-', $pengembalian->kondisi_alat) }}">
                            {{ ucfirst($pengembalian->kondisi_alat) }}
                        </span>
                    </td>
                    <td>
                        <span class="status-{{ str_replace('_', '-', $pengembalian->status) }}">
                            {{ ucfirst(str_replace('_', ' ', $pengembalian->status)) }}
                        </span>
                    </td>
                    <td>{{ Str::limit($pengembalian->catatan_kondisi, 30) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8">Tidak ada data pengembalian</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Total Pengembalian: {{ $pengembalians->count() }}</p>
        <p>Dihasilkan oleh Sistem Peminjaman Alat</p>
    </div>
</body>
</html>
