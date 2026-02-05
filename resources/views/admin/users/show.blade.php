@extends('layouts.app')

@section('title', 'Detail User')

@section('content')
<div class="page-title">
    <h1><i class="fas fa-user"></i> Detail User</h1>
    <p>Informasi lengkap pengguna</p>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-info-circle"></i> Informasi User
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th style="width: 200px">Nama</th>
                        <td>{{ $user->name }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <th>Role</th>
                        <td>
                            <span class="badge @if($user->role === 'member') badge-primary @elseif($user->role === 'operator') badge-success @else badge-danger @endif">
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th>No. Identitas</th>
                        <td>{{ $user->no_identitas }}</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td>{{ $user->alamat }}</td>
                    </tr>
                    <tr>
                        <th>No. Telepon</th>
                        <td>{{ $user->no_telepon }}</td>
                    </tr>
                    <tr>
                        <th>Dibuat Tanggal</th>
                        <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                </table>

                <div class="d-flex gap-2 mt-4">
                    <a href="{{ route('users.edit', $user) }}" class="btn btn-warning">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <a href="{{ route('users.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-book"></i> Statistik Peminjaman
            </div>
            <div class="card-body">
                <div class="stats-card" style="background: white; box-shadow: none; padding: 15px;">
                    <p style="color: #667eea; font-weight: 700; font-size: 1.5rem;">{{ $user->peminjamans()->count() }}</p>
                    <p style="color: #64748b; margin: 0;">Total Peminjaman</p>
                </div>
                <div class="stats-card" style="background: white; box-shadow: none; padding: 15px; margin-top: 10px;">
                    <p style="color: #10b981; font-weight: 700; font-size: 1.5rem;">{{ $user->peminjamans()->where('status', 'dikembalikan')->count() }}</p>
                    <p style="color: #64748b; margin: 0;">Dikembalikan</p>
                </div>
                <div class="stats-card" style="background: white; box-shadow: none; padding: 15px; margin-top: 10px;">
                    <p style="color: #f59e0b; font-weight: 700; font-size: 1.5rem;">{{ $user->peminjamans()->where('status', 'disetujui')->count() }}</p>
                    <p style="color: #64748b; margin: 0;">Sedang Dipinjam</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
