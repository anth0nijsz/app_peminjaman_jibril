@extends('layouts.app')

@section('title', 'Kelola Alat')

@section('content')
<div class="page-title">
    <h1><i class="fas fa-toolbox"></i> Kelola Alat</h1>
    <p>Manajemen data alat</p>
</div>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="fas fa-list"></i> Daftar Alat</span>
        <a href="{{ route('alats.create') }}" class="btn btn-sm btn-primary">
            <i class="fas fa-plus"></i> Tambah Alat
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Nama Alat</th>
                        <th>Kategori</th>
                        <th>Tersedia</th>
                        <th>Total</th>
                        <th>Kondisi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($alats as $alat)
                        <tr>
                            <td>{{ ($alats->currentPage() - 1) * $alats->perPage() + $loop->iteration }}</td>
                            <td><code>{{ $alat->kode_alat }}</code></td>
                            <td>{{ $alat->nama_alat }}</td>
                            <td>{{ $alat->kategori->nama_kategori }}</td>
                            <td>{{ $alat->jumlah_tersedia }}</td>
                            <td>{{ $alat->jumlah_total }}</td>
                            <td>
                                @if($alat->kondisi === 'baik')
                                    <span class="badge badge-success">Baik</span>
                                @elseif($alat->kondisi === 'rusak')
                                    <span class="badge badge-danger">Rusak</span>
                                @else
                                    <span class="badge badge-warning">Perlu Perbaikan</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('alats.edit', $alat) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form method="POST" action="{{ route('alats.destroy', $alat) }}" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted">Tidak ada data alat</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <nav aria-label="Page navigation">
            {{ $alats->links() }}
        </nav>
    </div>
</div>
@endsection
