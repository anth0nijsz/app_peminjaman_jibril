@extends('layouts.app')

@section('title', 'Member Dashboard')

@section('content')
<div class="page-title">
    <h1><i class="fas fa-home"></i> Dashboard Member</h1>
    <p>Kelola peminjaman alat Anda</p>
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
                        <p class="mb-0">Role: <span class="badge bg-success text-white">{{ ucfirst(Auth::user()->role) }}</span></p>
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
            <i class="fas fa-list"></i>
            <h3>{{ auth()->user()->peminjamans()->count() }}</h3>
            <p>Total Peminjaman</p>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="stats-card">
            <i class="fas fa-clock"></i>
            <h3>{{ auth()->user()->peminjamans()->where('status', 'disetujui')->count() }}</h3>
            <p>Sedang Dipinjam</p>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="stats-card">
            <i class="fas fa-check-circle"></i>
            <h3>{{ auth()->user()->peminjamans()->where('status', 'dikembalikan')->count() }}</h3>
            <p>Sudah Dikembalikan</p>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="fas fa-book"></i> Peminjaman Saya</span>
                <a href="{{ route('peminjamans.create') }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-plus"></i> Ajukan Peminjaman
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Alat</th>
                                <th>Kategori</th>
                                <th>Jumlah</th>
                                <th>Tanggal Peminjaman</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse(auth()->user()->peminjamans()->with(['alat.kategori'])->latest()->get() as $peminjaman)
                                <tr>
                                    <td>{{ $peminjaman->alat->nama_alat }}</td>
                                    <td>{{ $peminjaman->alat->kategori->nama_kategori }}</td>
                                    <td>{{ $peminjaman->jumlah_pinjam }}</td>
                                    <td>{{ $peminjaman->tanggal_peminjaman->format('d/m/Y') }}</td>
                                    <td>
                                        @if($peminjaman->status === 'pending')
                                            <span class="badge badge-warning">Pending</span>
                                        @elseif($peminjaman->status === 'disetujui')
                                            <span class="badge badge-success">Disetujui</span>
                                        @elseif($peminjaman->status === 'ditolak')
                                            <span class="badge badge-danger">Ditolak</span>
                                        @else
                                            <span class="badge badge-info">Dikembalikan</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('peminjamans.show', $peminjaman) }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted">Anda belum membuat peminjaman</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-toolbox"></i> Alat Tersedia
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach(\App\Models\Alat::where('kondisi', 'baik')->where('jumlah_tersedia', '>', 0)->take(6)->get() as $alat)
                        <div class="col-md-4 mb-4">
                            <div class="card" style="border: 2px solid #667eea;">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $alat->nama_alat }}</h5>
                                    <p class="card-text text-muted">{{ $alat->kategori->nama_kategori }}</p>
                                    <p class="card-text"><small>{{ $alat->deskripsi }}</small></p>
                                    <p class="card-text"><strong>Tersedia: {{ $alat->jumlah_tersedia }} dari {{ $alat->jumlah_total }}</strong></p>
                                    <a href="{{ route('peminjamans.create') }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-plus"></i> Pinjam
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="text-center mt-3">
                    <a href="{{ route('alats.list') }}" class="btn btn-primary">
                        <i class="fas fa-list"></i> Lihat Semua Alat
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
