@extends('layouts.app')

@section('title', 'Edit Profil')

@section('content')
<div class="page-title">
    <h1><i class="fas fa-user-edit"></i> Edit Profil Saya</h1>
    <p>Perbarui informasi profil dan pengaturan keamanan Anda</p>
</div>

<div class="row">
    <div class="col-md-8">
        <!-- Update Profile Information -->
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-user"></i> Informasi Profil
            </div>
            <div class="card-body">
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <!-- Profile Photo -->
                    <div class="mb-4">
                        <label for="profile_photo" class="form-label" style="font-weight: 600;">Foto Profil</label>
                        <div style="display: flex; gap: 20px; align-items: flex-start;">
                            <div style="width: 150px; height: 150px; border-radius: 10px; overflow: hidden; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; color: white;">
                                @if(Auth::user()->profile_photo)
                                    <img id="photoPreview" src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="Preview" style="width: 100%; height: 100%; object-fit: cover;">
                                @else
                                    <i class="fas fa-image" style="font-size: 3rem;"></i>
                                @endif
                            </div>
                            <div style="flex: 1;">
                                <input type="file" class="form-control @error('profile_photo') is-invalid @enderror" id="profile_photo" name="profile_photo" accept="image/*" onchange="previewPhoto(this)">
                                <small class="form-text text-muted d-block mt-2">
                                    <i class="fas fa-info-circle"></i> Format: JPG, PNG. Ukuran maksimal: 2MB
                                </small>
                                @error('profile_photo')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Name -->
                    <div class="mb-3">
                        <label for="name" class="form-label" style="font-weight: 600;">Username</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', Auth::user()->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label" style="font-weight: 600;">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', Auth::user()->email) }}" required>
                        @error('email')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- No. Identitas -->
                    <div class="mb-3">
                        <label for="no_identitas" class="form-label" style="font-weight: 600;">No. Identitas (KTP/SIM)</label>
                        <input type="text" class="form-control @error('no_identitas') is-invalid @enderror" id="no_identitas" name="no_identitas" value="{{ old('no_identitas', Auth::user()->no_identitas) }}">
                        @error('no_identitas')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- No. Telepon -->
                    <div class="mb-3">
                        <label for="no_telepon" class="form-label" style="font-weight: 600;">No. Telepon</label>
                        <input type="tel" class="form-control @error('no_telepon') is-invalid @enderror" id="no_telepon" name="no_telepon" value="{{ old('no_telepon', Auth::user()->no_telepon) }}">
                        @error('no_telepon')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Alamat -->
                    <div class="mb-3">
                        <label for="alamat" class="form-label" style="font-weight: 600;">Alamat</label>
                        <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="3">{{ old('alamat', Auth::user()->alamat) }}</textarea>
                        @error('alamat')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <!-- Security Card -->
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-lock"></i> Keamanan
            </div>
            <div class="card-body">
                <p class="mb-3" style="font-size: 0.9rem;">Lindungi akun Anda dengan mengubah password secara berkala.</p>
                <a href="#changePassword" data-bs-toggle="collapse" class="btn btn-warning w-100" role="button">
                    <i class="fas fa-key"></i> Ganti Password
                </a>
            </div>
        </div>

        <!-- Info Card -->
        <div class="card">
            <div class="card-header">
                <i class="fas fa-info-circle"></i> Informasi Akun
            </div>
            <div class="card-body">
                <p><strong>Role:</strong> <span class="badge" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">{{ ucfirst(Auth::user()->role) }}</span></p>
                <p><strong>Member Sejak:</strong> <br>{{ Auth::user()->created_at->format('d M Y') }}</p>
                <p class="text-muted mb-0" style="font-size: 0.85rem;"><i class="fas fa-shield-alt"></i> Akun Anda dilindungi</p>
            </div>
        </div>
    </div>
</div>

<!-- Change Password Section -->
<div class="collapse" id="changePassword">
    <div class="card mt-4">
        <div class="card-header">
            <i class="fas fa-key"></i> Ganti Password
        </div>
        <div class="card-body">
            <form action="{{ route('password.update') }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Current Password -->
                <div class="mb-3">
                    <label for="current_password" class="form-label" style="font-weight: 600;">Password Saat Ini</label>
                    <input type="password" class="form-control @error('current_password') is-invalid @enderror" id="current_password" name="current_password" required>
                    @error('current_password')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <!-- New Password -->
                <div class="mb-3">
                    <label for="password" class="form-label" style="font-weight: 600;">Password Baru</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                    @error('password')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label" style="font-weight: 600;">Konfirmasi Password Baru</label>
                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" required>
                    @error('password_confirmation')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success">
                    <i class="fas fa-check"></i> Ganti Password
                </button>
            </form>
        </div>
    </div>
</div>

<script>
function previewPhoto(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('photoPreview').src = e.target.result;
            document.getElementById('photoPreview').parentElement.style.backgroundImage = 'none';
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection
