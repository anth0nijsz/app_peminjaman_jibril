@extends('layouts.app')

@section('title', 'Daftar Alat Tersedia')

@section('content')
<div class="page-title">
    <h1><i class="fas fa-list"></i> Daftar Alat Tersedia</h1>
    <p>Lihat semua alat yang dapat dipinjam</p>
</div>

<div class="row mb-4">
    <div class="col-md-12">
        <div class="form-section">
            <form method="GET" class="row g-3">
                <div class="col-md-5">
                    <input type="text" name="search" class="form-control" placeholder="Cari alat..." value="{{ request('search') }}">
                </div>
                <div class="col-md-5">
                    <select name="kategori" class="form-select">
                        <option value="">Semua Kategori</option>
                        @foreach(\App\Models\Kategori::all() as $kat)
                            <option value="{{ $kat->id }}" @if(request('kategori') == $kat->id) selected @endif>{{ $kat->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-search"></i> Cari
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="row">
    @forelse($alats as $alat)
        <div class="col-md-4 mb-4">
            <div class="card h-100" style="border: 2px solid #667eea; transition: all 0.3s ease;">
                <div class="card-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                    <h5 class="mb-0">{{ $alat->nama_alat }}</h5>
                </div>
                <div class="card-body">
                    <p class="card-text">
                        <small class="text-muted">
                            <strong>Kategori:</strong> {{ $alat->kategori->nama_kategori }}<br>
                            <strong>Kode:</strong> <code>{{ $alat->kode_alat }}</code><br>
                            <strong>Deskripsi:</strong> {{ Str::limit($alat->deskripsi, 60) }}
                        </small>
                    </p>
                    <div class="mb-3">
                        <strong>Ketersediaan:</strong>
                        <div class="progress" style="height: 25px;">
                            <div class="progress-bar" role="progressbar" style="width: {{ ($alat->jumlah_tersedia / $alat->jumlah_total) * 100 }}%; background: linear-gradient(135deg, #10b981 0%, #059669 100%); display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; font-size: 0.875rem;">
                                {{ $alat->jumlah_tersedia }} / {{ $alat->jumlah_total }}
                            </div>
                        </div>
                    </div>
                    <p>
                        <strong>Lokasi:</strong> {{ $alat->lokasi_penyimpanan ?? '-' }}<br>
                        <strong>Kondisi:</strong>
                        @if($alat->kondisi === 'baik')
                            <span class="badge badge-success">Baik</span>
                        @elseif($alat->kondisi === 'rusak')
                            <span class="badge badge-danger">Rusak</span>
                        @else
                            <span class="badge badge-warning">Perlu Perbaikan</span>
                        @endif
                    </p>
                </div>
                <div class="card-footer" style="background: #f8f9fa;">
                    @if($alat->jumlah_tersedia > 0)
                        <a href="{{ route('peminjamans.create', ['alat_id' => $alat->id]) }}" class="btn btn-primary btn-sm w-100">
                            <i class="fas fa-plus"></i> Pinjam Alat Ini
                        </a>
                    @else
                        <button class="btn btn-secondary btn-sm w-100" disabled>
                            <i class="fas fa-lock"></i> Stok Habis
                        </button>
                    @endif
                </div>
            </div>
        </div>
    @empty
        <div class="col-md-12">
            <div class="alert alert-info">
                <i class="fas fa-info-circle"></i> Tidak ada alat tersedia saat ini
            </div>
        </div>
    @endforelse
</div>

<nav aria-label="Page navigation">
    {{ $alats->links() }}
</nav>
@endsection
