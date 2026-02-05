@extends('layouts.app')

@section('title', 'Detail Pengembalian')

@section('content')
<div class="page-title">
    <h1><i class="fas fa-file"></i> Detail Pengembalian</h1>
    <p>Informasi lengkap pengembalian</p>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-info-circle"></i> Informasi Pengembalian
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th style="width: 200px">User</th>
                        <td>{{ $pengembalian->user->name }}</td>
                    </tr>
                    <tr>
                        <th>Alat</th>
                        <td>{{ $pengembalian->peminjaman->alat->nama_alat }}</td>
                    </tr>
                    <tr>
                        <th>Jumlah Dikembalikan</th>
                        <td>{{ $pengembalian->jumlah_dikembalikan }} unit</td>
                    </tr>
                    <tr>
                        <th>Tanggal Pengembalian</th>
                        <td>{{ $pengembalian->tanggal_pengembalian->format('d/m/Y') }}</td>
                    </tr>
                    <tr>
                        <th>Kondisi Alat</th>
                        <td>
                            @if($pengembalian->kondisi_alat === 'baik')
                                <span class="badge badge-success">Baik</span>
                            @elseif($pengembalian->kondisi_alat === 'rusak')
                                <span class="badge badge-warning">Rusak</span>
                            @else
                                <span class="badge badge-danger">Hilang</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Catatan Kondisi</th>
                        <td>{{ $pengembalian->catatan_kondisi ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Status Konfirmasi</th>
                        <td>
                            @if($pengembalian->status === 'belum_dikonfirmasi')
                                <span class="badge badge-info">Belum Dikonfirmasi</span>
                            @else
                                <span class="badge badge-success">Dikonfirmasi</span>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        @if($pengembalian->catatan_operator)
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-comment"></i> Catatan Operator
                </div>
                <div class="card-body">
                    <p>{{ $pengembalian->catatan_operator }}</p>
                </div>
            </div>
        @endif

        @if((auth()->user()->isOperator() || auth()->user()->isAdmin()) && $pengembalian->status === 'belum_dikonfirmasi')
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-check-circle"></i> Konfirmasi Pengembalian
                </div>
                <div class="card-body">
                    <form action="{{ route('pengembalians.confirm', $pengembalian) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="catatan_operator" class="form-label">Catatan Operator (Opsional)</label>
                            <textarea class="form-control" name="catatan_operator" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-check"></i> Konfirmasi Pengembalian
                        </button>
                    </form>
                </div>
            </div>
        @endif
    </div>

    <div class="col-md-4">
        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-toolbox"></i> Data Peminjaman
            </div>
            <div class="card-body">
                <table class="table table-borderless table-sm">
                    <tr>
                        <th>Jumlah Pinjam</th>
                        <td>{{ $pengembalian->peminjaman->jumlah_pinjam }} unit</td>
                    </tr>
                    <tr>
                        <th>Tgl. Peminjaman</th>
                        <td>{{ $pengembalian->peminjaman->tanggal_peminjaman->format('d/m/Y') }}</td>
                    </tr>
                    <tr>
                        <th>Tgl. Kembali Direncanakan</th>
                        <td>{{ $pengembalian->peminjaman->tanggal_pengembalian_direncanakan->format('d/m/Y') }}</td>
                    </tr>
                    <tr>
                        <th>Status Peminjaman</th>
                        <td>
                            @if($pengembalian->peminjaman->status === 'disetujui')
                                <span class="badge badge-success">Disetujui</span>
                            @else
                                <span class="badge badge-info">Dikembalikan</span>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <i class="fas fa-user"></i> Data Peminjam
            </div>
            <div class="card-body">
                <table class="table table-borderless table-sm">
                    <tr>
                        <th>Nama</th>
                        <td>{{ $pengembalian->user->name }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $pengembalian->user->email }}</td>
                    </tr>
                    <tr>
                        <th>No. Telepon</th>
                        <td>{{ $pengembalian->user->no_telepon }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="mt-4">
    <a href="{{ route('pengembalians.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>
@endsection
