<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\Alat;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Response;

class ReportController extends Controller
{
    public function peminjamanReport()
    {
        $peminjamans = Peminjaman::with(['user', 'alat', 'disetujuiOleh'])->get();
        
        $pdf = Pdf::loadView('reports.peminjaman', compact('peminjamans'));
        return $pdf->download('laporan_peminjaman_' . date('Y-m-d_H-i-s') . '.pdf');
    }

    public function pengembalianReport()
    {
        $pengembalians = Pengembalian::with(['peminjaman.user', 'peminjaman.alat', 'dikonfirmasiOleh'])->get();
        
        $pdf = Pdf::loadView('reports.pengembalian', compact('pengembalians'));
        return $pdf->download('laporan_pengembalian_' . date('Y-m-d_H-i-s') . '.pdf');
    }

    public function alatReport()
    {
        $alats = Alat::with('kategori')->get();
        
        $pdf = Pdf::loadView('reports.alat', compact('alats'));
        return $pdf->download('laporan_alat_' . date('Y-m-d_H-i-s') . '.pdf');
    }

    public function userReport()
    {
        $users = User::where('role', '!=', 'admin')->get();
        
        $pdf = Pdf::loadView('reports.user', compact('users'));
        return $pdf->download('laporan_user_' . date('Y-m-d_H-i-s') . '.pdf');
    }
}
