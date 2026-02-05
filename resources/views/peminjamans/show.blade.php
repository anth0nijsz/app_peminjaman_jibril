@extends('layouts.app')

@section('title', 'Detail Peminjaman')

@section('content')
<div class="page-title">
    <h1><i class="fas fa-file"></i> Detail Peminjaman</h1>
    <p>Informasi lengkap peminjaman</p>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-info-circle"></i> Informasi Peminjaman
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th style="width: 200px">User</th>
                        <td>{{ $peminjaman->user->name }}</td>
                    </tr>
                    <tr>
                        <th>Alat</th>
                        <td>{{ $peminjaman->alat->nama_alat }}</td>
                    </tr>
                    <tr>
                        <th>Jumlah Pinjam</th>
                        <td>{{ $peminjaman->jumlah_pinjam }} unit</td>
                    </tr>
                    <tr>
                        <th>Tanggal Peminjaman</th>
                        <td>{{ $peminjaman->tanggal_peminjaman->format('d/m/Y') }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Kembali Direncanakan</th>
                        <td>{{ $peminjaman->tanggal_pengembalian_direncanakan->format('d/m/Y') }}</td>
                    </tr>
                    @if($peminjaman->tanggal_pengembalian_aktual)
                        <tr>
                            <th>Tanggal Kembali Aktual</th>
                            <td>{{ $peminjaman->tanggal_pengembalian_aktual->format('d/m/Y') }}</td>
                        </tr>
                    @endif
                    <tr>
                        <th>Keperluan</th>
                        <td>{{ $peminjaman->keperluan ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            @if($peminjaman->status === 'pending')
                                <span class="badge badge-warning">Pending - Menunggu Persetujuan</span>
                            @elseif($peminjaman->status === 'disetujui')
                                <span class="badge badge-success">Disetujui</span>
                            @elseif($peminjaman->status === 'ditolak')
                                <span class="badge badge-danger">Ditolak</span>
                            @else
                                <span class="badge badge-info">Dikembalikan</span>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        @if($peminjaman->catatan_operator)
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-comment"></i> Catatan Operator
                </div>
                <div class="card-body">
                    <p>{{ $peminjaman->catatan_operator }}</p>
                </div>
            </div>
        @endif

        @if(auth()->user()->isOperator() || auth()->user()->isAdmin())
            @if($peminjaman->status === 'pending')
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-check-circle"></i> Tindakan Operator
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <form action="{{ route('peminjamans.approve', $peminjaman) }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="catatan" class="form-label">Catatan (Opsional)</label>
                                        <textarea class="form-control" name="catatan_operator" rows="3"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-success">
                                        <i class="fas fa-check"></i> Setujui Peminjaman
                                    </button>
                                </form>
                            </div>
                            <div class="col-md-6">
                                <form action="{{ route('peminjamans.reject', $peminjaman) }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="catatan" class="form-label">Alasan Penolakan</label>
                                        <textarea class="form-control" name="catatan_operator" rows="3" required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fas fa-times"></i> Tolak Peminjaman
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endif

        @if(auth()->user()->isMember() && $peminjaman->status === 'pending')
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-trash"></i> Hapus Pengajuan
                </div>
                <div class="card-body">
                    <p>Anda masih dapat menghapus pengajuan peminjaman yang status masih pending.</p>
                    <form action="{{ route('peminjamans.destroy', $peminjaman) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash"></i> Hapus Pengajuan
                        </button>
                    </form>
                </div>
            </div>
        @endif
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-toolbox"></i> Detail Alat
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th>Nama</th>
                        <td>{{ $peminjaman->alat->nama_alat }}</td>
                    </tr>
                    <tr>
                        <th>Kode</th>
                        <td><code>{{ $peminjaman->alat->kode_alat }}</code></td>
                    </tr>
                    <tr>
                        <th>Kategori</th>
                        <td>{{ $peminjaman->alat->kategori->nama_kategori }}</td>
                    </tr>
                    <tr>
                        <th>Tersedia</th>
                        <td>{{ $peminjaman->alat->jumlah_tersedia }} / {{ $peminjaman->alat->jumlah_total }}</td>
                    </tr>
                    <tr>
                        <th>Kondisi</th>
                        <td>
                            @if($peminjaman->alat->kondisi === 'baik')
                                <span class="badge badge-success">Baik</span>
                            @elseif($peminjaman->alat->kondisi === 'rusak')
                                <span class="badge badge-danger">Rusak</span>
                            @else
                                <span class="badge badge-warning">Perlu Perbaikan</span>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                <i class="fas fa-user"></i> Data Peminjam
            </div>
            <div class="card-body">
                <table class="table table-borderless table-sm">
                    <tr>
                        <th>Nama</th>
                        <td>{{ $peminjaman->user->name }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $peminjaman->user->email }}</td>
                    </tr>
                    <tr>
                        <th>No. Identitas</th>
                        <td>{{ $peminjaman->user->no_identitas }}</td>
                    </tr>
                    <tr>
                        <th>No. Telepon</th>
                        <td>{{ $peminjaman->user->no_telepon }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="mt-4">
    <a href="{{ route('peminjamans.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>
@endsection
