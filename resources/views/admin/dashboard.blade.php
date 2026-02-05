@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="page-title">
    <h1><i class="fas fa-chart-line"></i> Dashboard Admin</h1>
    <p>Selamat datang di panel administrasi sistem peminjaman alat</p>
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
                        <p class="mb-0">Role: <span class="badge bg-warning text-dark">{{ ucfirst(Auth::user()->role) }}</span></p>
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
    <div class="col-md-3 mb-3">
        <div class="stats-card">
            <i class="fas fa-users"></i>
            <h3>{{ \App\Models\User::count() }}</h3>
            <p>Total User</p>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="stats-card">
            <i class="fas fa-toolbox"></i>
            <h3>{{ \App\Models\Alat::count() }}</h3>
            <p>Total Alat</p>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="stats-card">
            <i class="fas fa-book"></i>
            <h3>{{ \App\Models\Peminjaman::count() }}</h3>
            <p>Total Peminjaman</p>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="stats-card">
            <i class="fas fa-undo"></i>
            <h3>{{ \App\Models\Pengembalian::count() }}</h3>
            <p>Total Pengembalian</p>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-clock"></i> Peminjaman Pending
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Alat</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(\App\Models\Peminjaman::where('status', 'pending')->latest()->take(5)->get() as $peminjaman)
                                <tr>
                                    <td>{{ $peminjaman->user->name }}</td>
                                    <td>{{ $peminjaman->alat->nama_alat }}</td>
                                    <td><span class="badge badge-warning">{{ $peminjaman->status }}</span></td>
                                    <td>
                                        <a href="{{ route('peminjamans.show', $peminjaman) }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-check-circle"></i> Pengembalian Belum Dikonfirmasi
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Alat</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(\App\Models\Pengembalian::where('status', 'belum_dikonfirmasi')->latest()->take(5)->get() as $pengembalian)
                                <tr>
                                    <td>{{ $pengembalian->user->name }}</td>
                                    <td>{{ $pengembalian->peminjaman->alat->nama_alat }}</td>
                                    <td><span class="badge badge-info">{{ $pengembalian->status }}</span></td>
                                    <td>
                                        <a href="{{ route('pengembalians.show', $pengembalian) }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <i class="fas fa-tools"></i> Alat dengan Jumlah Terbatas
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Kode Alat</th>
                        <th>Nama Alat</th>
                        <th>Kategori</th>
                        <th>Tersedia</th>
                        <th>Total</th>
                        <th>Kondisi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(\App\Models\Alat::where('jumlah_tersedia', '<', 5)->get() as $alat)
                        <tr>
                            <td><code>{{ $alat->kode_alat }}</code></td>
                            <td>{{ $alat->nama_alat }}</td>
                            <td>{{ $alat->kategori->nama_kategori }}</td>
                            <td><span class="badge badge-warning">{{ $alat->jumlah_tersedia }}</span></td>
                            <td>{{ $alat->jumlah_total }}</td>
                            <td>
                                @if($alat->kondisi === 'baik')
                                    <span class="badge badge-success">Baik</span>
                                @elseif($alat->kondisi === 'rusak')
                                    <span class="badge badge-danger">Rusak</span>
                                @else
                                    <span class="badge badge-warning">Perlu Perbaikan</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
