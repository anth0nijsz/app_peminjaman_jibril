<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Alat;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PeminjamanController extends Controller
{
    use AuthorizesRequests;

    public function index(): View
    {
        if (auth()->user()->isAdmin() || auth()->user()->isOperator()) {
            $peminjamans = Peminjaman::with(['user', 'alat'])->paginate(10);
        } else {
            $peminjamans = auth()->user()->peminjamans()->with('alat')->paginate(10);
        }
        return view('peminjamans.index', compact('peminjamans'));
    }

    public function indexApprove(): View
    {
        $peminjamans = Peminjaman::where('status', 'pending')->with(['user', 'alat'])->paginate(10);
        return view('peminjamans.approve', compact('peminjamans'));
    }

    public function create(Request $request): View
    {
        $alats = Alat::where('kondisi', 'baik')->where('jumlah_tersedia', '>', 0)->get();
        $selectedAlatId = $request->get('alat_id');
        return view('member.peminjamans.create', compact('alats', 'selectedAlatId'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'alat_id' => 'required|exists:alats,id',
            'tanggal_peminjaman' => 'required|date|after_or_equal:today',
            'tanggal_pengembalian_direncanakan' => 'required|date|after:tanggal_peminjaman',
            'jumlah_pinjam' => 'required|integer|min:1',
            'keperluan' => 'nullable|string',
        ]);

        $alat = Alat::findOrFail($validated['alat_id']);

        if ($alat->jumlah_tersedia < $validated['jumlah_pinjam']) {
            return redirect()->back()->with('error', 'Jumlah alat yang tersedia tidak mencukupi');
        }

        $validated['user_id'] = auth()->id();
        $validated['status'] = 'pending';

        Peminjaman::create($validated);

        return redirect()->route('peminjamans.index')->with('success', 'Pengajuan peminjaman berhasil dibuat');
    }

    public function show(Peminjaman $peminjaman): View
    {
        $this->authorize('view', $peminjaman);
        return view('peminjamans.show', compact('peminjaman'));
    }

    public function approve(Request $request, Peminjaman $peminjaman): RedirectResponse
    {
        $this->authorize('approve', $peminjaman);

        $peminjaman->update([
            'status' => 'disetujui',
            'disetujui_oleh' => auth()->id(),
            'catatan_operator' => $request->catatan_operator,
        ]);

        $alat = $peminjaman->alat;
        $alat->decrement('jumlah_tersedia', $peminjaman->jumlah_pinjam);

        return redirect()->route('peminjamans.index')->with('success', 'Peminjaman disetujui');
    }

    public function reject(Request $request, Peminjaman $peminjaman): RedirectResponse
    {
        $this->authorize('approve', $peminjaman);

        $peminjaman->update([
            'status' => 'ditolak',
            'disetujui_oleh' => auth()->id(),
            'catatan_operator' => $request->catatan_operator,
        ]);

        return redirect()->route('peminjamans.index')->with('success', 'Peminjaman ditolak');
    }

    public function destroy(Peminjaman $peminjaman): RedirectResponse
    {
        if ($peminjaman->status !== 'pending') {
            return redirect()->back()->with('error', 'Hanya peminjaman pending yang dapat dihapus');
        }

        $peminjaman->delete();
        return redirect()->back()->with('success', 'Peminjaman dihapus');
    }
}
