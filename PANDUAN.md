# Sistem Peminjaman Alat

Aplikasi web untuk mengelola sistem peminjaman alat dengan fitur lengkap termasuk manajemen user, kategori, alat, peminjaman, pengembalian, dan laporan.

## 🎯 Fitur Utama

### Untuk Member
- 📋 Melihat daftar alat yang tersedia
- 📝 Mengajukan peminjaman alat
- 📊 Melihat riwayat peminjaman
- ✅ Mencatat pengembalian alat
- 📱 Dashboard personal

### Untuk Operator
- ✔️ Menyetujui/menolak peminjaman
- 📋 Mengelola data peminjaman
- ✅ Mengkonfirmasi pengembalian alat
- 📊 Melihat daftar pengembalian

### Untuk Admin
- 👥 Manajemen pengguna (CRUD)
- 📦 Manajemen alat (CRUD)
- 🏷️ Manajemen kategori alat
- 📋 Melihat semua peminjaman
- 📊 Melihat semua pengembalian
- 🖨️ Cetak laporan (PDF):
  - Laporan Peminjaman
  - Laporan Pengembalian
  - Laporan Data Alat
  - Laporan Data User
- 📈 Dashboard statistik

## 🔐 Sistem Keamanan

- **3 Role Berbeda**: Member, Operator, Admin
- **Middleware Proteksi**: Setiap route dilindungi berdasarkan role
- **Authorization Policies**: Kontrol akses granular
- **Password Hashing**: Bcrypt hashing untuk password
- **CSRF Protection**: Perlindungan CSRF token

## 🗄️ Database Schema

### Users
- id, name, email, password, role, no_identitas, alamat, no_telepon

### Kategoris
- id, nama_kategori, deskripsi

### Alats
- id, kategori_id, nama_alat, kode_alat, deskripsi, jumlah_tersedia, jumlah_total, kondisi, lokasi_penyimpanan

### Peminjamans
- id, user_id, alat_id, tanggal_peminjaman, tanggal_pengembalian_direncanakan, tanggal_pengembalian_aktual, jumlah_pinjam, status, keperluan, catatan_operator, disetujui_oleh

### Pengembalians
- id, peminjaman_id, user_id, tanggal_pengembalian, jumlah_dikembalikan, kondisi_alat, catatan_kondisi, status, dikonfirmasi_oleh, catatan_operator

## 🚀 Instalasi & Konfigurasi

### Prasyarat
- PHP 8.1+
- Composer
- MySQL/MariaDB
- Node.js & npm (untuk asset compilation)

### Langkah Instalasi

1. **Clone atau extract repository**
```bash
cd app_peminjaman
```

2. **Install dependencies**
```bash
composer install
npm install
```

3. **Konfigurasi environment**
```bash
cp .env.example .env
```

4. **Generate app key**
```bash
php artisan key:generate
```

5. **Database migration & seeding**
```bash
php artisan migrate:fresh --seed
```

6. **Build assets**
```bash
npm run build
```

7. **Jalankan server**
```bash
php artisan serve
```

Akses aplikasi di: `http://localhost:8000`

## 👤 Akun Default

### Admin
- Email: `admin@peminjaman.com`
- Password: `password`

### Operator
- Email: `operator@peminjaman.com`
- Password: `password`

### Member
- Email: `member1@peminjaman.com`
- Email: `member2@peminjaman.com`
- Password: `password`

## 📝 Panduan Penggunaan

### Untuk Member

#### Mengajukan Peminjaman
1. Login dengan akun member
2. Klik menu "Daftar Alat" untuk melihat alat tersedia
3. Atau langsung klik "Ajukan Peminjaman" di dashboard
4. Pilih alat yang ingin dipinjam
5. Masukkan jumlah dan tanggal peminjaman/pengembalian
6. Klik tombol "Ajukan"
7. Tunggu persetujuan dari operator/admin

#### Mencatat Pengembalian
1. Klik menu "Pengembalian Saya"
2. Klik "Catat Pengembalian"
3. Pilih peminjaman yang akan dikembalikan
4. Masukkan jumlah yang dikembalikan
5. Pilih kondisi alat
6. Klik "Simpan"

### Untuk Operator

#### Menyetujui Peminjaman
1. Login dengan akun operator
2. Klik "Data Peminjaman"
3. Cari peminjaman dengan status "Pending"
4. Klik tombol "Detail"
5. Pilih "Setujui" atau "Tolak"
6. Tambahkan catatan jika diperlukan
7. Klik tombol sesuai aksi

#### Mengkonfirmasi Pengembalian
1. Klik "Data Pengembalian"
2. Cari pengembalian yang belum dikonfirmasi
3. Klik "Detail"
4. Periksa kondisi alat
5. Klik "Konfirmasi Pengembalian"
6. Tambahkan catatan jika ada
7. Klik tombol "Konfirmasi"

### Untuk Admin

#### Mengelola User
1. Klik "Kelola User"
2. Klik "Tambah User" untuk menambah user baru
3. Isi form dengan data lengkap
4. Pilih role (Member atau Operator)
5. Klik "Simpan"
6. Untuk edit/delete, gunakan tombol di tabel

#### Mengelola Kategori
1. Klik "Kategori Alat"
2. Klik "Tambah Kategori"
3. Isi nama dan deskripsi kategori
4. Klik "Simpan"

#### Mengelola Alat
1. Klik "Kelola Alat"
2. Klik "Tambah Alat"
3. Pilih kategori
4. Isi data alat (nama, kode, deskripsi, jumlah, kondisi)
5. Masukkan lokasi penyimpanan
6. Klik "Simpan"

#### Mencetak Laporan
1. Klik salah satu laporan di sidebar:
   - "Laporan Peminjaman"
   - "Laporan Pengembalian"
   - "Laporan Alat"
   - "Laporan User"
2. File PDF akan diunduh otomatis

## 🎨 Desain & Styling

- **Frontend Framework**: Bootstrap 5
- **CSS Utility**: Tailwind CSS
- **Icons**: Font Awesome 6
- **Color Scheme**: 
  - Primary: #667eea (Ungu)
  - Secondary: #10b981 (Hijau)
  - Danger: #ef4444 (Merah)
  - Warning: #f59e0b (Kuning)

## 📦 Struktur Folder

```
app_peminjaman/
├── app/
│   ├── Http/
│   │   ├── Controllers/        # Business logic
│   │   ├── Middleware/         # Custom middleware
│   │   └── Requests/           # Form validation
│   ├── Models/                 # Database models
│   ├── Policies/               # Authorization policies
│   └── Providers/
├── database/
│   ├── migrations/             # Database migrations
│   ├── seeders/                # Data seeders
│   └── factories/
├── resources/
│   ├── views/
│   │   ├── admin/              # Admin views
│   │   ├── operator/           # Operator views
│   │   ├── member/             # Member views
│   │   ├── layouts/            # Layout templates
│   │   ├── reports/            # PDF reports
│   │   └── peminjamans/        # Shared views
│   ├── css/                    # CSS files
│   └── js/                     # JavaScript files
├── routes/
│   ├── web.php                 # Web routes
│   └── auth.php                # Authentication routes
├── config/
│   ├── app.php
│   ├── database.php
│   ├── auth.php
│   └── ...
└── public/
    ├── index.php
    └── build/                  # Compiled assets
```

## 🔧 Teknologi yang Digunakan

- **Framework**: Laravel 11
- **Database**: MySQL
- **Frontend**: Bootstrap 5, Tailwind CSS, Font Awesome
- **Package Manager**: Composer, npm
- **Build Tool**: Vite
- **PDF**: Barryvdh Laravel DomPDF

## 📋 Validasi

- Email harus unik dan format valid
- Password minimal 8 karakter
- No. Identitas harus unik
- Kode alat harus unik
- Tanggal pengembalian harus lebih besar dari tanggal peminjaman
- Jumlah peminjaman tidak boleh melebihi stok yang tersedia

## 🐛 Troubleshooting

### "Class not found" Error
```bash
composer autoload --dump
```

### Migration Error
```bash
php artisan migrate:reset
php artisan migrate:fresh --seed
```

### Assets tidak update
```bash
npm run dev
# atau
npm run build
```

### Permission Denied (Linux/Mac)
```bash
chmod -R 775 storage bootstrap/cache
```

## 📞 Support

Untuk pertanyaan atau laporan bug, silakan hubungi tim development.

## 📄 Lisensi

Aplikasi ini dibuat untuk keperluan manajemen peminjaman alat.

---

**Versi**: 1.0.0  
**Terakhir Update**: 27 Januari 2026
