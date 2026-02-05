@extends('layouts.app')

@section('title', 'Persetujuan Peminjaman')

@section('content')
<div class="page-title">
    <h1><i class="fas fa-check-circle"></i> Persetujuan Peminjaman</h1>
    <p>Kelola permohonan peminjaman yang menunggu persetujuan</p>
</div>

<div class="card">
    <div class="card-header">
        <i class="fas fa-list"></i> Daftar Peminjaman Pending
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
                        <th>Keperluan</th>
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
                            <td>{{ Str::limit($peminjaman->keperluan, 50) }}</td>
                            <td>
                                <a href="{{ route('peminjamans.show', $peminjaman) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-eye"></i> Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">Tidak ada peminjaman pending</td>
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
