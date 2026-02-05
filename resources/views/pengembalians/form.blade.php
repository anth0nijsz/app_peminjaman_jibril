@extends('layouts.app')

@section('title', 'Pengembalian Barang')

@section('content')
<div class="page-title">
    <h1><i class="fas fa-undo"></i> Pengembalian Barang</h1>
    <p>Ajukan pengembalian untuk barang yang telah dipinjam</p>
</div>

@if($peminjamans->isEmpty())
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-info" role="alert">
                <i class="fas fa-info-circle"></i> Anda tidak memiliki peminjaman aktif yang dapat dikembalikan.
                <a href="{{ route('peminjamans.index') }}" class="alert-link">Lihat daftar peminjaman Anda</a>
            </div>
        </div>
    </div>
@else
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-list"></i> Daftar Peminjaman yang Dapat Dikembalikan</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Alat</th>
                                    <th>Kategori</th>
                                    <th>Jumlah Pinjam</th>
                                    <th>Tanggal Pinjam</th>
                                    <th>Rencana Kembali</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($peminjamans as $index => $peminjaman)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            <strong>{{ $peminjaman->alat->nama_alat }}</strong>
                                            <br>
                                            <small class="text-muted">Kode: {{ $peminjaman->alat->kode_alat }}</small>
                                        </td>
                                        <td>
                                            <span class="badge bg-primary">{{ $peminjaman->alat->kategori->nama_kategori }}</span>
                                        </td>
                                        <td class="text-center">
                                            <strong>{{ $peminjaman->jumlah_pinjam }}</strong> unit
                                        </td>
                                        <td>
                                            @if($peminjaman->tanggal_peminjaman)
                                                {{ \Carbon\Carbon::parse($peminjaman->tanggal_peminjaman)->format('d-m-Y') }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>
                                            @if($peminjaman->tanggal_pengembalian_direncanakan)
                                                {{ \Carbon\Carbon::parse($peminjaman->tanggal_pengembalian_direncanakan)->format('d-m-Y') }}
                                                @if(\Carbon\Carbon::parse($peminjaman->tanggal_pengembalian_direncanakan) < now())
                                                    <br>
                                                    <small class="text-danger"><i class="fas fa-exclamation-triangle"></i> Telat</small>
                                                @endif
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-primary" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#modalPengembalian{{ $peminjaman->id }}">
                                                <i class="fas fa-check"></i> Kembalikan
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Modal Pengembalian -->
                                    <div class="modal fade" id="modalPengembalian{{ $peminjaman->id }}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Pengembalian - {{ $peminjaman->alat->nama_alat }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <form action="{{ route('pengembalians.store') }}" method="POST">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <input type="hidden" name="peminjaman_id" value="{{ $peminjaman->id }}">

                                                        <!-- Info Peminjaman -->
                                                        <div class="alert alert-light border">
                                                            <strong>Informasi Peminjaman:</strong>
                                                            <ul class="mb-0 mt-2">
                                                                <li>Alat: <strong>{{ $peminjaman->alat->nama_alat }}</strong></li>
                                                                <li>Jumlah: <strong>{{ $peminjaman->jumlah_pinjam }} unit</strong></li>
                                                                <li>Dipinjam: <strong>{{ $peminjaman->tanggal_peminjaman ? \Carbon\Carbon::parse($peminjaman->tanggal_peminjaman)->format('d-m-Y') : '-' }}</strong></li>
                                                                <li>Rencana Kembali: <strong>{{ $peminjaman->tanggal_pengembalian_direncanakan ? \Carbon\Carbon::parse($peminjaman->tanggal_pengembalian_direncanakan)->format('d-m-Y') : '-' }}</strong></li>
                                                            </ul>
                                                        </div>

                                                        <!-- Jumlah Dikembalikan -->
                                                        <div class="mb-3">
                                                            <label for="jumlah_{{ $peminjaman->id }}" class="form-label">
                                                                <strong>Jumlah Dikembalikan <span class="text-danger">*</span></strong>
                                                            </label>
                                                            <input type="number" 
                                                                   class="form-control" 
                                                                   id="jumlah_{{ $peminjaman->id }}" 
                                                                   name="jumlah_dikembalikan" 
                                                                   value="{{ $peminjaman->jumlah_pinjam }}" 
                                                                   min="1" 
                                                                   max="{{ $peminjaman->jumlah_pinjam }}"
                                                                   required>
                                                            <small class="text-muted">Maksimal {{ $peminjaman->jumlah_pinjam }} unit</small>
                                                        </div>

                                                        <!-- Kondisi Alat -->
                                                        <div class="mb-3">
                                                            <label for="kondisi_{{ $peminjaman->id }}" class="form-label">
                                                                <strong>Kondisi Alat <span class="text-danger">*</span></strong>
                                                            </label>
                                                            <select class="form-select" 
                                                                    id="kondisi_{{ $peminjaman->id }}" 
                                                                    name="kondisi_alat" required>
                                                                <option value="">-- Pilih Kondisi --</option>
                                                                <option value="baik">✓ Baik (Tidak ada kerusakan)</option>
                                                                <option value="rusak">⚠ Rusak (Ada kerusakan)</option>
                                                                <option value="hilang">✕ Hilang (Tidak ditemukan)</option>
                                                            </select>
                                                        </div>

                                                        <!-- Catatan -->
                                                        <div class="mb-3">
                                                            <label for="catatan_{{ $peminjaman->id }}" class="form-label">
                                                                Catatan Kondisi (Opsional)
                                                            </label>
                                                            <textarea class="form-control" 
                                                                      id="catatan_{{ $peminjaman->id }}" 
                                                                      name="catatan_kondisi" 
                                                                      rows="3"
                                                                      placeholder="Jelaskan jika ada kerusakan..."></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                            <i class="fas fa-times"></i> Batal
                                                        </button>
                                                        <button type="submit" class="btn btn-primary">
                                                            <i class="fas fa-check"></i> Ajukan Pengembalian
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

<!-- Riwayat Pengembalian -->
@if(isset($riwayatPengembalian) && $riwayatPengembalian->isNotEmpty())
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-history"></i> Riwayat Pengembalian</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Alat</th>
                                    <th>Jumlah</th>
                                    <th>Kondisi</th>
                                    <th>Tanggal Kembalikan</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($riwayatPengembalian as $riwayat)
                                    <tr>
                                        <td>
                                            @if($riwayat->peminjaman && $riwayat->peminjaman->alat)
                                                {{ $riwayat->peminjaman->alat->nama_alat }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>{{ $riwayat->jumlah_dikembalikan ?? '-' }} unit</td>
                                        <td>
                                            @if($riwayat->kondisi_alat === 'baik')
                                                <span class="badge bg-success">Baik</span>
                                            @elseif($riwayat->kondisi_alat === 'rusak')
                                                <span class="badge bg-warning text-dark">Rusak</span>
                                            @elseif($riwayat->kondisi_alat === 'hilang')
                                                <span class="badge bg-danger">Hilang</span>
                                            @else
                                                <span class="badge bg-secondary">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($riwayat->created_at)
                                                {{ $riwayat->created_at->format('d-m-Y H:i') }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>
                                            @if($riwayat->status === 'pending')
                                                <span class="badge bg-info">Menunggu Konfirmasi</span>
                                            @elseif($riwayat->status === 'dikonfirmasi')
                                                <span class="badge bg-success">Dikonfirmasi</span>
                                            @else
                                                <span class="badge bg-secondary">Ditolak</span>
                                            @endif
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
@endif
@endsection
