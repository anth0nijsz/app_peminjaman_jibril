@extends('layouts.app')

@section('title', 'Ajukan Pengembalian Barang')

@section('content')
<div class="page-title">
    <h1><i class="fas fa-undo"></i> Ajukan Pengembalian Barang</h1>
    <p>Catat pengembalian alat yang telah dipinjam</p>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-file-alt"></i> Form Pengembalian Barang</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('pengembalians.store') }}" method="POST">
                    @csrf

                    <!-- Pilih Peminjaman -->
                    <div class="mb-3">
                        <label for="peminjaman_id" class="form-label">
                            <strong>Pilih Peminjaman <span class="text-danger">*</span></strong>
                        </label>
                        <select class="form-select @error('peminjaman_id') is-invalid @enderror" 
                                id="peminjaman_id" name="peminjaman_id" required>
                            <option value="">-- Pilih Peminjaman yang Akan Dikembalikan --</option>
                            @forelse($peminjamans as $peminjaman)
                                <option value="{{ $peminjaman->id }}" 
                                        {{ old('peminjaman_id') === (string)$peminjaman->id ? 'selected' : '' }}>
                                    {{ $peminjaman->alat->nama_alat }} 
                                    (Dipinjam: {{ $peminjaman->tgl_pinjam->format('d-m-Y') }})
                                </option>
                            @empty
                                <option value="" disabled>Tidak ada peminjaman yang dapat dikembalikan</option>
                            @endforelse
                        </select>
                        @error('peminjaman_id')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Jumlah Dikembalikan -->
                    <div class="mb-3">
                        <label for="jumlah_dikembalikan" class="form-label">
                            <strong>Jumlah Dikembalikan <span class="text-danger">*</span></strong>
                        </label>
                        <input type="number" 
                               class="form-control @error('jumlah_dikembalikan') is-invalid @enderror" 
                               id="jumlah_dikembalikan" 
                               name="jumlah_dikembalikan" 
                               value="{{ old('jumlah_dikembalikan', 1) }}" 
                               min="1" 
                               required>
                        @error('jumlah_dikembalikan')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Kondisi Alat -->
                    <div class="mb-3">
                        <label for="kondisi_alat" class="form-label">
                            <strong>Kondisi Alat saat Dikembalikan <span class="text-danger">*</span></strong>
                        </label>
                        <select class="form-select @error('kondisi_alat') is-invalid @enderror" 
                                id="kondisi_alat" name="kondisi_alat" required>
                            <option value="">-- Pilih Kondisi --</option>
                            <option value="baik" {{ old('kondisi_alat') === 'baik' ? 'selected' : '' }}>
                                Baik (Tidak ada kerusakan)
                            </option>
                            <option value="rusak" {{ old('kondisi_alat') === 'rusak' ? 'selected' : '' }}>
                                Rusak (Ada kerusakan)
                            </option>
                            <option value="hilang" {{ old('kondisi_alat') === 'hilang' ? 'selected' : '' }}>
                                Hilang (Tidak ditemukan)
                            </option>
                        </select>
                        @error('kondisi_alat')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Catatan Kondisi -->
                    <div class="mb-4">
                        <label for="catatan_kondisi" class="form-label">
                            <strong>Catatan Kondisi</strong>
                        </label>
                        <textarea class="form-control @error('catatan_kondisi') is-invalid @enderror" 
                                  id="catatan_kondisi" 
                                  name="catatan_kondisi" 
                                  rows="4" 
                                  placeholder="Jelaskan kerusakan atau kondisi khusus alat jika ada...">{{ old('catatan_kondisi') }}</textarea>
                        <small class="text-muted d-block mt-2">
                            Opsional - Jelaskan secara detail jika ada kerusakan atau kondisi lainnya
                        </small>
                        @error('catatan_kondisi')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-check"></i> Ajukan Pengembalian
                        </button>
                        <a href="{{ route('pengembalians.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Informasi Samping -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-info-circle"></i> Panduan Pengembalian</h5>
            </div>
            <div class="card-body">
                <p><strong>Langkah-langkah:</strong></p>
                <ol class="small">
                    <li>Pilih peminjaman yang akan dikembalikan</li>
                    <li>Masukkan jumlah alat yang dikembalikan</li>
                    <li>Pilih kondisi alat saat dikembalikan</li>
                    <li>Jika ada kerusakan, jelaskan di catatan</li>
                    <li>Klik "Ajukan Pengembalian"</li>
                </ol>

                <hr>

                <p><strong>Kondisi Alat:</strong></p>
                <div class="mb-2">
                    <span class="badge bg-success">Baik</span>
                    <small>Alat tidak ada kerusakan</small>
                </div>
                <div class="mb-2">
                    <span class="badge bg-warning text-dark">Rusak</span>
                    <small>Ada kerusakan pada alat</small>
                </div>
                <div class="mb-2">
                    <span class="badge bg-danger">Hilang</span>
                    <small>Alat tidak ditemukan</small>
                </div>

                <hr>

                <div class="alert alert-info small mb-0">
                    <i class="fas fa-lightbulb"></i> 
                    <strong>Catatan:</strong> Pengembalian harus dikonfirmasi oleh operator sebelum diproses lebih lanjut.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
