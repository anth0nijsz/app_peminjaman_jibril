@extends('layouts.app')

@section('title', 'Daftar Peminjaman')

@section('content')
<div class="page-title">
    <h1><i class="fas fa-book"></i> Daftar Peminjaman</h1>
    <p>Kelola semua peminjaman alat</p>
</div>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="fas fa-list"></i> Data Peminjaman</span>
        @if(auth()->user()->isMember())
            <a href="{{ route('peminjamans.create') }}" class="btn btn-sm btn-primary">
                <i class="fas fa-plus"></i> Ajukan Peminjaman
            </a>
        @endif
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>User</th>
                        <th>Alat</th>
                        <th>Jumlah</th>
                        <th>Tanggal Peminjaman</th>
                        <th>Tanggal Kembali</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($peminjamans as $peminjaman)
                        <tr>
                            <td>{{ ($peminjamans->currentPage() - 1) * $peminjamans->perPage() + $loop->iteration }}</td>
                            <td>{{ $peminjaman->user->name }}</td>
                            <td>{{ $peminjaman->alat->nama_alat }}</td>
                            <td>{{ $peminjaman->jumlah_pinjam }}</td>
                            <td>{{ $peminjaman->tanggal_peminjaman->format('d/m/Y') }}</td>
                            <td>{{ $peminjaman->tanggal_pengembalian_direncanakan->format('d/m/Y') }}</td>
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
                            <td colspan="8" class="text-center text-muted">Tidak ada data peminjaman</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <nav aria-label="Page navigation">
            {{ $peminjamans->links() }}
        </nav>
    </div>
</div>
@endsection
