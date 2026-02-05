@extends('layouts.app')

@section('title', 'Detail Kategori')

@section('content')
<div class="page-title">
    <h1><i class="fas fa-tag"></i> Detail Kategori</h1>
    <p>Informasi kategori alat</p>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-info-circle"></i> Informasi Kategori
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th style="width: 200px">Nama Kategori</th>
                        <td>{{ $kategori->nama_kategori }}</td>
                    </tr>
                    <tr>
                        <th>Deskripsi</th>
                        <td>{{ $kategori->deskripsi ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Jumlah Alat</th>
                        <td>{{ $kategori->alats()->count() }} unit</td>
                    </tr>
                    <tr>
                        <th>Dibuat Tanggal</th>
                        <td>{{ $kategori->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                </table>

                <div class="d-flex gap-2 mt-4">
                    <a href="{{ route('kategoris.edit', $kategori) }}" class="btn btn-warning">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <a href="{{ route('kategoris.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-toolbox"></i> Daftar Alat
            </div>
            <div class="card-body">
                <div class="list-group">
                    @foreach($kategori->alats as $alat)
                        <a href="{{ route('alats.edit', $alat) }}" class="list-group-item list-group-item-action">
                            {{ $alat->nama_alat }}
                            <span class="badge badge-primary float-end">{{ $alat->jumlah_tersedia }} / {{ $alat->jumlah_total }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
