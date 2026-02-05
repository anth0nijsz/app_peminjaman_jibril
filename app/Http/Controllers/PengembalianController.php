<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PengembalianController extends Controller
{
    use AuthorizesRequests;

    public function formPengembalian(): View
    {
        $peminjamans = Peminjaman::where('status', 'disetujui')
            ->whereDoesntHave('pengembalian')
            ->where('user_id', auth()->id())
            ->with(['user', 'alat.kategori'])
            ->get();
        
        $riwayatPengembalian = Pengembalian::whereHas('peminjaman', function($q) {
            $q->where('user_id', auth()->id());
        })
        ->with(['peminjaman.alat', 'peminjaman.user'])
        ->orderBy('created_at', 'desc')
        ->get();
        
        return view('pengembalians.form', compact('peminjamans', 'riwayatPengembalian'));
    }

    public function index(): View
    {
        if (auth()->user()->isOperator() || auth()->user()->isAdmin()) {
            $pengembalians = Pengembalian::with(['peminjaman.user', 'peminjaman.alat'])
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        } else {
            $pengembalians = Pengembalian::whereHas('user', function($q) {
                $q->where('id', auth()->id());
            })->paginate(10);
        }
        return view('pengembalians.index', compact('pengembalians'));
    }

    public function create(): View
    {
        $peminjamans = Peminjaman::where('status', 'disetujui')
            ->whereDoesntHave('pengembalian')
            ->with(['user', 'alat'])
            ->get();
        return view('pengembalians.create', compact('peminjamans'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'peminjaman_id' => 'required|exists:peminjamans,id',
            'jumlah_dikembalikan' => 'required|integer|min:1',
            'kondisi_alat' => 'required|in:baik,rusak,hilang',
            'catatan_kondisi' => 'nullable|string',
        ]);

        $peminjaman = Peminjaman::findOrFail($validated['peminjaman_id']);

        if ($peminjaman->status !== 'disetujui') {
            return redirect()->back()->with('error', 'Peminjaman tidak dapat dikembalikan');
        }

        if ($validated['jumlah_dikembalikan'] > $peminjaman->jumlah_pinjam) {
            return redirect()->back()->with('error', 'Jumlah pengembalian melebihi jumlah peminjaman');
        }

        $pengembalian = Pengembalian::create([
            'peminjaman_id' => $validated['peminjaman_id'],
            'user_id' => auth()->id(),
            'tanggal_pengembalian' => now()->toDateString(),
            'jumlah_dikembalikan' => $validated['jumlah_dikembalikan'],
            'kondisi_alat' => $validated['kondisi_alat'],
            'catatan_kondisi' => $validated['catatan_kondisi'],
        ]);

        if ($validated['kondisi_alat'] === 'hilang') {
            $peminjaman->alat->decrement('jumlah_total', $validated['jumlah_dikembalikan']);
        }

        return redirect()->route('pengembalians.index')->with('success', 'Pengembalian berhasil dicatat');
    }

    public function show(Pengembalian $pengembalian): View
    {
        return view('pengembalians.show', compact('pengembalian'));
    }

    public function confirm(Request $request, Pengembalian $pengembalian): RedirectResponse
    {
        $this->authorize('confirm', $pengembalian);

        $pengembalian->update([
            'status' => 'dikonfirmasi',
            'dikonfirmasi_oleh' => auth()->id(),
            'catatan_operator' => $request->catatan_operator,
        ]);

        $peminjaman = $pengembalian->peminjaman;

        if ($pengembalian->kondisi_alat === 'baik') {
            $peminjaman->alat->increment('jumlah_tersedia', $pengembalian->jumlah_dikembalikan);
        } elseif ($pengembalian->kondisi_alat === 'rusak') {
            $peminjaman->alat->decrement('jumlah_tersedia', $pengembalian->jumlah_dikembalikan);
            $peminjaman->alat->update(['kondisi' => 'perlu_perbaikan']);
        }

        if ($pengembalian->jumlah_dikembalikan == $peminjaman->jumlah_pinjam) {
            $peminjaman->update(['status' => 'dikembalikan']);
        }

        return redirect()->route('pengembalians.index')->with('success', 'Pengembalian dikonfirmasi');
    }
}
