@extends('layouts.app')

@section('title', 'Kelola Kategori')

@section('content')
<div class="page-title">
    <h1><i class="fas fa-tags"></i> Kelola Kategori</h1>
    <p>Manajemen kategori alat</p>
</div>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="fas fa-tags"></i> Daftar Kategori</span>
        <a href="{{ route('kategoris.create') }}" class="btn btn-sm btn-primary">
            <i class="fas fa-plus"></i> Tambah Kategori
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kategori</th>
                        <th>Deskripsi</th>
                        <th>Jumlah Alat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kategoris as $kategori)
                        <tr>
                            <td>{{ ($kategoris->currentPage() - 1) * $kategoris->perPage() + $loop->iteration }}</td>
                            <td>{{ $kategori->nama_kategori }}</td>
                            <td>{{ Str::limit($kategori->deskripsi, 50) }}</td>
                            <td><span class="badge badge-primary">{{ $kategori->alats()->count() }}</span></td>
                            <td>
                                <a href="{{ route('kategoris.edit', $kategori) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form method="POST" action="{{ route('kategoris.destroy', $kategori) }}" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin?')">
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
                            <td colspan="5" class="text-center text-muted">Tidak ada kategori</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <nav aria-label="Page navigation">
            {{ $kategoris->links() }}
        </nav>
    </div>
</div>
@endsection
