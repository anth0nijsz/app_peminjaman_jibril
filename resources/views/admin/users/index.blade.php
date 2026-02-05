@extends('layouts.app')

@section('title', 'Kelola User')

@section('content')
<div class="page-title">
    <h1><i class="fas fa-users"></i> Kelola User</h1>
    <p>Manajemen data pengguna sistem</p>
</div>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="fas fa-users"></i> Daftar User</span>
        <a href="{{ route('users.create') }}" class="btn btn-sm btn-primary">
            <i class="fas fa-plus"></i> Tambah User
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>No. Identitas</th>
                        <th>No. Telepon</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>{{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <span class="badge @if($user->role === 'member') badge-primary @elseif($user->role === 'operator') badge-success @else badge-danger @endif">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            <td>{{ $user->no_identitas }}</td>
                            <td>{{ $user->no_telepon }}</td>
                            <td>
                                <a href="{{ route('users.show', $user) }}" class="btn btn-sm btn-primary" title="Lihat">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-warning" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form method="POST" action="{{ route('users.destroy', $user) }}" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">Tidak ada data user</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <nav aria-label="Page navigation">
            {{ $users->links() }}
        </nav>
    </div>
</div>
@endsection
