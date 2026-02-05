<?php

namespace Database\Seeders;

use App\Models\Alat;
use Illuminate\Database\Seeder;

class AlatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $alats = [
            [
                'kategori_id' => 1,
                'nama_alat' => 'Projector',
                'kode_alat' => 'ALT-001',
                'deskripsi' => 'Projector untuk presentasi',
                'jumlah_tersedia' => 2,
                'jumlah_total' => 2,
                'kondisi' => 'baik',
                'lokasi_penyimpanan' => 'Gudang A - Rak 1',
            ],
            [
                'kategori_id' => 1,
                'nama_alat' => 'Laptop',
                'kode_alat' => 'ALT-002',
                'deskripsi' => 'Laptop untuk kegiatan',
                'jumlah_tersedia' => 3,
                'jumlah_total' => 3,
                'kondisi' => 'baik',
                'lokasi_penyimpanan' => 'Gudang A - Rak 2',
            ],
            [
                'kategori_id' => 2,
                'nama_alat' => 'Sapu',
                'kode_alat' => 'ALT-003',
                'deskripsi' => 'Sapu pembersih',
                'jumlah_tersedia' => 10,
                'jumlah_total' => 10,
                'kondisi' => 'baik',
                'lokasi_penyimpanan' => 'Gudang B - Rak 1',
            ],
            [
                'kategori_id' => 2,
                'nama_alat' => 'Ember',
                'kode_alat' => 'ALT-004',
                'deskripsi' => 'Ember plastik',
                'jumlah_tersedia' => 5,
                'jumlah_total' => 5,
                'kondisi' => 'baik',
                'lokasi_penyimpanan' => 'Gudang B - Rak 2',
            ],
            [
                'kategori_id' => 3,
                'nama_alat' => 'Bola Volley',
                'kode_alat' => 'ALT-005',
                'deskripsi' => 'Bola volley standar',
                'jumlah_tersedia' => 8,
                'jumlah_total' => 8,
                'kondisi' => 'baik',
                'lokasi_penyimpanan' => 'Gudang C - Rak 1',
            ],
            [
                'kategori_id' => 3,
                'nama_alat' => 'Cone Training',
                'kode_alat' => 'ALT-006',
                'deskripsi' => 'Cone untuk latihan',
                'jumlah_tersedia' => 15,
                'jumlah_total' => 15,
                'kondisi' => 'baik',
                'lokasi_penyimpanan' => 'Gudang C - Rak 2',
            ],
            [
                'kategori_id' => 4,
                'nama_alat' => 'Printer',
                'kode_alat' => 'ALT-007',
                'deskripsi' => 'Printer laser',
                'jumlah_tersedia' => 2,
                'jumlah_total' => 2,
                'kondisi' => 'baik',
                'lokasi_penyimpanan' => 'Gudang A - Rak 3',
            ],
            [
                'kategori_id' => 4,
                'nama_alat' => 'Meja Kantor',
                'kode_alat' => 'ALT-008',
                'deskripsi' => 'Meja kantor standar',
                'jumlah_tersedia' => 5,
                'jumlah_total' => 5,
                'kondisi' => 'baik',
                'lokasi_penyimpanan' => 'Gudang D - Rak 1',
            ],
            [
                'kategori_id' => 5,
                'nama_alat' => 'Cangkul',
                'kode_alat' => 'ALT-009',
                'deskripsi' => 'Cangkul untuk penggalian',
                'jumlah_tersedia' => 7,
                'jumlah_total' => 7,
                'kondisi' => 'baik',
                'lokasi_penyimpanan' => 'Gudang E - Rak 1',
            ],
            [
                'kategori_id' => 5,
                'nama_alat' => 'Sekop',
                'kode_alat' => 'ALT-010',
                'deskripsi' => 'Sekop pertanian',
                'jumlah_tersedia' => 12,
                'jumlah_total' => 12,
                'kondisi' => 'baik',
                'lokasi_penyimpanan' => 'Gudang E - Rak 2',
            ],
        ];

        foreach ($alats as $alat) {
            Alat::create($alat);
        }
    }
}
