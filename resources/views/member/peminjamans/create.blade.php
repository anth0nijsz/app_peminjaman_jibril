@extends('layouts.app')

@section('title', 'Ajukan Peminjaman')

@section('content')
<div class="page-title">
    <h1><i class="fas fa-plus-circle"></i> Ajukan Peminjaman</h1>
    <p>Buat permohonan peminjaman alat baru</p>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="form-section">
            <h3>Form Pengajuan Peminjaman</h3>
            <form action="{{ route('peminjamans.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="alat_id" class="form-label">Pilih Alat <span class="text-danger">*</span></label>
                    <select class="form-select @error('alat_id') is-invalid @enderror" id="alat_id" name="alat_id" required>
                        <option value="">-- Pilih Alat --</option>
                        @foreach($alats as $alat)
                            <option value="{{ $alat->id }}" 
                                @if(old('alat_id') && old('alat_id') === (string)$alat->id) selected 
                                @elseif(!old('alat_id') && isset($selectedAlatId) && $selectedAlatId == $alat->id) selected
                                @endif>
                                {{ $alat->nama_alat }} (Tersedia: {{ $alat->jumlah_tersedia }})
                            </option>
                        @endforeach
                    </select>
                    @error('alat_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="jumlah_pinjam" class="form-label">Jumlah Pinjam <span class="text-danger">*</span></label>
                    <input type="number" class="form-control @error('jumlah_pinjam') is-invalid @enderror" id="jumlah_pinjam" name="jumlah_pinjam" value="{{ old('jumlah_pinjam') }}" min="1" required>
                    @error('jumlah_pinjam')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="tanggal_peminjaman" class="form-label">Tanggal Peminjaman <span class="text-danger">*</span></label>
                    <input type="date" class="form-control @error('tanggal_peminjaman') is-invalid @enderror" id="tanggal_peminjaman" name="tanggal_peminjaman" value="{{ old('tanggal_peminjaman') }}" required>
                    @error('tanggal_peminjaman')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="tanggal_pengembalian_direncanakan" class="form-label">Tanggal Pengembalian <span class="text-danger">*</span></label>
                    <input type="date" class="form-control @error('tanggal_pengembalian_direncanakan') is-invalid @enderror" id="tanggal_pengembalian_direncanakan" name="tanggal_pengembalian_direncanakan" value="{{ old('tanggal_pengembalian_direncanakan') }}" required>
                    @error('tanggal_pengembalian_direncanakan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="keperluan" class="form-label">Keperluan</label>
                    <textarea class="form-control @error('keperluan') is-invalid @enderror" id="keperluan" name="keperluan" rows="4">{{ old('keperluan') }}</textarea>
                    <small class="text-muted">Jelaskan untuk apa alat ini akan digunakan</small>
                    @error('keperluan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-paper-plane"></i> Ajukan
                    </button>
                    <a href="{{ route('peminjamans.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-info-circle"></i> Petunjuk
            </div>
            <div class="card-body">
                <p><strong>Langkah-langkah mengajukan peminjaman:</strong></p>
                <ol>
                    <li>Pilih alat yang ingin dipinjam</li>
                    <li>Masukkan jumlah yang akan dipinjam</li>
                    <li>Tentukan tanggal peminjaman</li>
                    <li>Tentukan tanggal pengembalian</li>
                    <li>Jelaskan keperluan penggunaan alat</li>
                    <li>Klik tombol Ajukan</li>
                </ol>
                <p><strong>Status peminjaman:</strong></p>
                <ul>
                    <li><span class="badge badge-warning">Pending</span> - Menunggu persetujuan</li>
                    <li><span class="badge badge-success">Disetujui</span> - Siap diambil</li>
                    <li><span class="badge badge-danger">Ditolak</span> - Tidak disetujui</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
