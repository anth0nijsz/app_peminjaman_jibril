@extends('layouts.app')

@section('title', 'Operator Dashboard')

@section('content')
<div class="page-title">
    <h1><i class="fas fa-chart-bar"></i> Dashboard Operator</h1>
    <p>Kelola peminjaman dan pengembalian alat</p>
</div>

<!-- User Info Card -->
<div class="row mb-4">
    <div class="col-md-12">
        <div class="card" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
            <div class="card-body" style="color: white;">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h5><i class="fas fa-user-circle"></i> Selamat datang, {{ Auth::user()->name }}</h5>
                        <p class="mb-0">Email: {{ Auth::user()->email }}</p>
                        <p class="mb-0">Role: <span class="badge bg-info text-white">{{ ucfirst(Auth::user()->role) }}</span></p>
                    </div>
                    <div class="col-md-4 text-end">
                        <a href="{{ route('profile.edit') }}" class="btn btn-light btn-sm">
                            <i class="fas fa-edit"></i> Edit Profile
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-4 mb-3">
        <div class="stats-card">
            <i class="fas fa-clock"></i>
            <h3>{{ \App\Models\Peminjaman::where('status', 'pending')->count() }}</h3>
            <p>Peminjaman Pending</p>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="stats-card">
            <i class="fas fa-check"></i>
            <h3>{{ \App\Models\Peminjaman::where('status', 'disetujui')->count() }}</h3>
            <p>Peminjaman Disetujui</p>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="stats-card">
            <i class="fas fa-exclamation"></i>
            <h3>{{ \App\Models\Pengembalian::where('status', 'belum_dikonfirmasi')->count() }}</h3>
            <p>Pengembalian Menunggu</p>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-list"></i> Peminjaman yang Membutuhkan Persetujuan
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>User</th>
                                <th>Alat</th>
                                <th>Jumlah</th>
                                <th>Tanggal Peminjaman</th>
                                <th>Keperluan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse(\App\Models\Peminjaman::where('status', 'pending')->with(['user', 'alat'])->latest()->get() as $peminjaman)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $peminjaman->user->name }}</td>
                                    <td>{{ $peminjaman->alat->nama_alat }}</td>
                                    <td>{{ $peminjaman->jumlah_pinjam }}</td>
                                    <td>{{ $peminjaman->tanggal_peminjaman->format('d/m/Y') }}</td>
                                    <td>{{ $peminjaman->keperluan }}</td>
                                    <td><span class="badge badge-warning">Pending</span></td>
                                    <td>
                                        <a href="{{ route('peminjamans.show', $peminjaman) }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-eye"></i> Lihat
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center text-muted">Tidak ada peminjaman pending</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
