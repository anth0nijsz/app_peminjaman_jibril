@extends('layouts.app')

@section('title', 'Daftar Pengembalian')

@section('content')
<div class="page-title">
    <h1><i class="fas fa-undo"></i> Daftar Pengembalian</h1>
    <p>Kelola pengembalian alat</p>
</div>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="fas fa-list"></i> Data Pengembalian</span>
        <a href="{{ route('pengembalians.create') }}" class="btn btn-sm btn-primary">
            <i class="fas fa-plus"></i> Catat Pengembalian
        </a>
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
                        <th>Tanggal Pengembalian</th>
                        <th>Kondisi Alat</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pengembalians as $pengembalian)
                        <tr>
                            <td>{{ ($pengembalians->currentPage() - 1) * $pengembalians->perPage() + $loop->iteration }}</td>
                            <td>{{ $pengembalian->user->name }}</td>
                            <td>{{ $pengembalian->peminjaman->alat->nama_alat }}</td>
                            <td>{{ $pengembalian->jumlah_dikembalikan }}</td>
                            <td>{{ $pengembalian->tanggal_pengembalian->format('d/m/Y') }}</td>
                            <td>
                                @if($pengembalian->kondisi_alat === 'baik')
                                    <span class="badge badge-success">Baik</span>
                                @elseif($pengembalian->kondisi_alat === 'rusak')
                                    <span class="badge badge-warning">Rusak</span>
                                @else
                                    <span class="badge badge-danger">Hilang</span>
                                @endif
                            </td>
                            <td>
                                @if($pengembalian->status === 'belum_dikonfirmasi')
                                    <span class="badge badge-info">Belum Dikonfirmasi</span>
                                @else
                                    <span class="badge badge-success">Dikonfirmasi</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('pengembalians.show', $pengembalian) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted">Tidak ada data pengembalian</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <nav aria-label="Page navigation">
            {{ $pengembalians->links() }}
        </nav>
    </div>
</div>
@endsection
