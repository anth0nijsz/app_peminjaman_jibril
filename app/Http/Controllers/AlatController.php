<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class AlatController extends Controller
{
    public function index(): View
    {
        $alats = Alat::with('kategori')->paginate(10);
        return view('admin.alats.index', compact('alats'));
    }

    public function create(): View
    {
        $kategoris = Kategori::all();
        return view('admin.alats.create', compact('kategoris'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
            'nama_alat' => 'required|string|max:255',
            'kode_alat' => 'required|string|unique:alats,kode_alat',
            'deskripsi' => 'nullable|string',
            'jumlah_total' => 'required|integer|min:1',
            'kondisi' => 'required|in:baik,rusak,perlu_perbaikan',
            'lokasi_penyimpanan' => 'nullable|string',
        ]);

        $validated['jumlah_tersedia'] = $validated['jumlah_total'];

        Alat::create($validated);

        return redirect()->route('alats.index')->with('success', 'Alat berhasil ditambahkan');
    }

    public function edit(Alat $alat): View
    {
        $kategoris = Kategori::all();
        return view('admin.alats.edit', compact('alat', 'kategoris'));
    }

    public function update(Request $request, Alat $alat): RedirectResponse
    {
        $validated = $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
            'nama_alat' => 'required|string|max:255',
            'kode_alat' => 'required|string|unique:alats,kode_alat,' . $alat->id,
            'deskripsi' => 'nullable|string',
            'jumlah_total' => 'required|integer|min:1',
            'kondisi' => 'required|in:baik,rusak,perlu_perbaikan',
            'lokasi_penyimpanan' => 'nullable|string',
        ]);

        $alat->update($validated);

        return redirect()->route('alats.index')->with('success', 'Alat berhasil diperbarui');
    }

    public function destroy(Alat $alat): RedirectResponse
    {
        if ($alat->peminjamans()->whereIn('status', ['pending', 'disetujui'])->exists()) {
            return redirect()->route('alats.index')
                ->with('error', 'Alat tidak dapat dihapus karena masih ada peminjaman aktif');
        }

        $alat->delete();
        return redirect()->route('alats.index')->with('success', 'Alat berhasil dihapus');
    }

    public function show(Alat $alat): View
    {
        return view('admin.alats.show', compact('alat'));
    }

    public function listAlat(Request $request): View
    {
        $query = Alat::where('kondisi', 'baik')->where('jumlah_tersedia', '>', 0);

        if ($request->has('search') && $request->search) {
            $query->where('nama_alat', 'like', '%' . $request->search . '%');
        }

        if ($request->has('kategori') && $request->kategori) {
            $query->where('kategori_id', $request->kategori);
        }

        $alats = $query->with('kategori')->paginate(12);
        return view('member.alats.list', compact('alats'));
    }
}
