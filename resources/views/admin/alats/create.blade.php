@extends('layouts.app')

@section('title', 'Tambah Alat')

@section('content')
<div class="page-title">
    <h1><i class="fas fa-plus-circle"></i> Tambah Alat</h1>
    <p>Tambahkan alat baru ke sistem</p>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="form-section">
            <h3>Form Penambahan Alat</h3>
            <form action="{{ route('alats.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="kategori_id" class="form-label">Kategori <span class="text-danger">*</span></label>
                    <select class="form-select @error('kategori_id') is-invalid @enderror" id="kategori_id" name="kategori_id" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($kategoris as $kategori)
                            <option value="{{ $kategori->id }}" {{ old('kategori_id') === (string)$kategori->id ? 'selected' : '' }}>
                                {{ $kategori->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                    @error('kategori_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="nama_alat" class="form-label">Nama Alat <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('nama_alat') is-invalid @enderror" id="nama_alat" name="nama_alat" value="{{ old('nama_alat') }}" required>
                    @error('nama_alat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="kode_alat" class="form-label">Kode Alat <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('kode_alat') is-invalid @enderror" id="kode_alat" name="kode_alat" value="{{ old('kode_alat') }}" placeholder="Contoh: ALT-001" required>
                    @error('kode_alat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="3">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="jumlah_total" class="form-label">Jumlah Total <span class="text-danger">*</span></label>
                    <input type="number" class="form-control @error('jumlah_total') is-invalid @enderror" id="jumlah_total" name="jumlah_total" value="{{ old('jumlah_total') }}" min="1" required>
                    @error('jumlah_total')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="kondisi" class="form-label">Kondisi <span class="text-danger">*</span></label>
                    <select class="form-select @error('kondisi') is-invalid @enderror" id="kondisi" name="kondisi" required>
                        <option value="">-- Pilih Kondisi --</option>
                        <option value="baik" {{ old('kondisi') === 'baik' ? 'selected' : '' }}>Baik</option>
                        <option value="rusak" {{ old('kondisi') === 'rusak' ? 'selected' : '' }}>Rusak</option>
                        <option value="perlu_perbaikan" {{ old('kondisi') === 'perlu_perbaikan' ? 'selected' : '' }}>Perlu Perbaikan</option>
                    </select>
                    @error('kondisi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="lokasi_penyimpanan" class="form-label">Lokasi Penyimpanan</label>
                    <input type="text" class="form-control @error('lokasi_penyimpanan') is-invalid @enderror" id="lokasi_penyimpanan" name="lokasi_penyimpanan" value="{{ old('lokasi_penyimpanan') }}" placeholder="Contoh: Gudang A - Rak 1">
                    @error('lokasi_penyimpanan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                    <a href="{{ route('alats.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
