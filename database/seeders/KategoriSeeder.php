<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategoris = [
            [
                'nama_kategori' => 'Alat Elektronik',
                'deskripsi' => 'Peralatan elektronik umum',
            ],
            [
                'nama_kategori' => 'Alat Kebersihan',
                'deskripsi' => 'Peralatan kebersihan dan pembersih',
            ],
            [
                'nama_kategori' => 'Alat Olahraga',
                'deskripsi' => 'Peralatan olahraga dan kebugaran',
            ],
            [
                'nama_kategori' => 'Alat Kantor',
                'deskripsi' => 'Peralatan kantor dan administrasi',
            ],
            [
                'nama_kategori' => 'Alat Pertanian',
                'deskripsi' => 'Peralatan pertanian dan berkebun',
            ],
        ];

        foreach ($kategoris as $kategori) {
            Kategori::create($kategori);
        }
    }
}
