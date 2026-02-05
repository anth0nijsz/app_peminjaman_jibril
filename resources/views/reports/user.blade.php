<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan User</title>
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
        .role-member {
            background-color: #d1ecf1;
            color: #0c5460;
            padding: 4px 8px;
            border-radius: 4px;
        }
        .role-operator {
            background-color: #d4edda;
            color: #155724;
            padding: 4px 8px;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Laporan Data User</h1>
        <p>Sistem Manajemen Peminjaman Alat</p>
        <p>Tanggal: {{ date('d/m/Y H:i:s') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>No. Identitas</th>
                <th>No. Telepon</th>
                <th>Alamat</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <span class="role-{{ $user->role }}">
                            {{ ucfirst($user->role) }}
                        </span>
                    </td>
                    <td>{{ $user->no_identitas }}</td>
                    <td>{{ $user->no_telepon }}</td>
                    <td>{{ Str::limit($user->alamat, 40) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">Tidak ada data user</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Total User: {{ $users->count() }}</p>
        <p>Dihasilkan oleh Sistem Peminjaman Alat</p>
    </div>
</body>
</html>
