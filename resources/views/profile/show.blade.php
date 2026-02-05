@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')
<div class="page-title">
    <h1><i class="fas fa-user-circle"></i> Profil Saya</h1>
    <p>Kelola informasi profil dan keamanan akun Anda</p>
</div>

<div class="row">
    <div class="col-md-4 mb-4">
        <!-- Profile Photo Card -->
        <div class="card" style="text-align: center;">
            <div class="card-body pt-4">
                <div style="width: 150px; height: 150px; margin: 0 auto 20px; border-radius: 50%; overflow: hidden; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; color: white;">
                    @if(Auth::user()->profile_photo)
                        <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="{{ Auth::user()->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                    @else
                        <i class="fas fa-user" style="font-size: 4rem;"></i>
                    @endif
                </div>
                <h5>{{ Auth::user()->name }}</h5>
                <p class="text-muted">{{ Auth::user()->email }}</p>
                <div class="mb-3">
                    <span class="badge" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                        <i class="fas fa-tag"></i> {{ ucfirst(Auth::user()->role) }}
                    </span>
                </div>
                <a href="{{ route('profile.edit') }}" class="btn btn-sm btn-primary w-100">
                    <i class="fas fa-edit"></i> Edit Profil
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <!-- Profile Information -->
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-id-card"></i> Informasi Pribadi
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label" style="color: #64748b; font-weight: 600;">Username</label>
                        <p style="color: #1e293b; font-size: 1.05rem;">{{ Auth::user()->name }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color: #64748b; font-weight: 600;">Email</label>
                        <p style="color: #1e293b; font-size: 1.05rem;">{{ Auth::user()->email }}</p>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label" style="color: #64748b; font-weight: 600;">No. Identitas</label>
                        <p style="color: #1e293b; font-size: 1.05rem;">{{ Auth::user()->no_identitas ?? '-' }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color: #64748b; font-weight: 600;">No. Telepon</label>
                        <p style="color: #1e293b; font-size: 1.05rem;">{{ Auth::user()->no_telepon ?? '-' }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label class="form-label" style="color: #64748b; font-weight: 600;">Alamat</label>
                        <p style="color: #1e293b; font-size: 1.05rem;">{{ Auth::user()->alamat ?? '-' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Account Security -->
        <div class="card">
            <div class="card-header">
                <i class="fas fa-lock"></i> Keamanan Akun
            </div>
            <div class="card-body">
                <p class="text-muted mb-3">Kelola password dan keamanan akun Anda di sini.</p>
                <a href="{{ route('profile.edit') }}" class="btn btn-warning">
                    <i class="fas fa-key"></i> Ganti Password
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Statistics -->
<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-chart-bar"></i> Statistik Aktivitas
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 text-center">
                        <h5 style="color: #667eea;">{{ Auth::user()->peminjamans()->count() }}</h5>
                        <p class="text-muted">Total Peminjaman</p>
                    </div>
                    <div class="col-md-4 text-center">
                        <h5 style="color: #667eea;">{{ Auth::user()->peminjamans()->where('status', 'disetujui')->count() }}</h5>
                        <p class="text-muted">Sedang Dipinjam</p>
                    </div>
                    <div class="col-md-4 text-center">
                        <h5 style="color: #667eea;">{{ Auth::user()->peminjamans()->where('status', 'dikembalikan')->count() }}</h5>
                        <p class="text-muted">Sudah Dikembalikan</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
