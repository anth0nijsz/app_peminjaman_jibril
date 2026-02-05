@extends('layouts.app')

@section('title', 'Detail Alat')

@section('content')
<div class="page-title">
    <h1><i class="fas fa-toolbox"></i> Detail Alat</h1>
    <p>Informasi lengkap alat</p>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-info-circle"></i> Informasi Alat
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th style="width: 200px">Nama Alat</th>
                        <td>{{ $alat->nama_alat }}</td>
                    </tr>
                    <tr>
                        <th>Kode Alat</th>
                        <td><code>{{ $alat->kode_alat }}</code></td>
                    </tr>
                    <tr>
                        <th>Kategori</th>
                        <td>{{ $alat->kategori->nama_kategori }}</td>
                    </tr>
                    <tr>
                        <th>Deskripsi</th>
                        <td>{{ $alat->deskripsi ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Jumlah Total</th>
                        <td>{{ $alat->jumlah_total }} unit</td>
                    </tr>
                    <tr>
                        <th>Jumlah Tersedia</th>
                        <td><span class="badge badge-success">{{ $alat->jumlah_tersedia }}</span></td>
                    </tr>
                    <tr>
                        <th>Jumlah Terpinjam</th>
                        <td><span class="badge badge-warning">{{ $alat->jumlah_total - $alat->jumlah_tersedia }}</span></td>
                    </tr>
                    <tr>
                        <th>Kondisi</th>
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
                    <tr>
                        <th>Lokasi Penyimpanan</th>
                        <td>{{ $alat->lokasi_penyimpanan ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Dibuat Tanggal</th>
                        <td>{{ $alat->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                </table>

                <div class="d-flex gap-2 mt-4">
                    <a href="{{ route('alats.edit', $alat) }}" class="btn btn-warning">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <a href="{{ route('alats.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-chart-bar"></i> Statistik
            </div>
            <div class="card-body">
                <div class="stats-card" style="background: white; box-shadow: none; padding: 15px; border-bottom: 1px solid #e2e8f0;">
                    <p style="color: #10b981; font-weight: 700; font-size: 1.8rem;">{{ $alat->jumlah_tersedia }}</p>
                    <p style="color: #64748b; margin: 0;">Tersedia</p>
                </div>
                <div class="stats-card" style="background: white; box-shadow: none; padding: 15px; border-bottom: 1px solid #e2e8f0;">
                    <p style="color: #f59e0b; font-weight: 700; font-size: 1.8rem;">{{ $alat->jumlah_total - $alat->jumlah_tersedia }}</p>
                    <p style="color: #64748b; margin: 0;">Terpinjam</p>
                </div>
                <div class="stats-card" style="background: white; box-shadow: none; padding: 15px;">
                    <p style="color: #667eea; font-weight: 700; font-size: 1.8rem;">{{ $alat->peminjamans()->where('status', 'disetujui')->count() }}</p>
                    <p style="color: #64748b; margin: 0;">Peminjaman Aktif</p>
                </div>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                <i class="fas fa-history"></i> Peminjaman Terakhir
            </div>
            <div class="card-body">
                @forelse($alat->peminjamans()->latest()->take(5)->get() as $peminjaman)
                    <div class="mb-2 pb-2 border-bottom">
                        <small>
                            <strong>{{ $peminjaman->user->name }}</strong><br>
                            {{ $peminjaman->tanggal_peminjaman->format('d/m/Y') }}
                            <span class="badge badge-sm @if($peminjaman->status === 'disetujui') badge-success @elseif($peminjaman->status === 'ditolak') badge-danger @else badge-info @endif">
                                {{ $peminjaman->status }}
                            </span>
                        </small>
                    </div>
                @empty
                    <small class="text-muted">Tidak ada peminjaman</small>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
