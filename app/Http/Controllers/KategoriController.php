<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class KategoriController extends Controller
{
    public function index(): View
    {
        $kategoris = Kategori::paginate(10);
        return view('admin.kategoris.index', compact('kategoris'));
    }

    public function create(): View
    {
        return view('admin.kategoris.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        Kategori::create($validated);

        return redirect()->route('kategoris.index')->with('success', 'Kategori berhasil ditambahkan');
    }

    public function edit(Kategori $kategori): View
    {
        return view('admin.kategoris.edit', compact('kategori'));
    }

    public function update(Request $request, Kategori $kategori): RedirectResponse
    {
        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $kategori->update($validated);

        return redirect()->route('kategoris.index')->with('success', 'Kategori berhasil diperbarui');
    }

    public function destroy(Kategori $kategori): RedirectResponse
    {
        if ($kategori->alats()->exists()) {
            return redirect()->route('kategoris.index')
                ->with('error', 'Kategori tidak dapat dihapus karena masih memiliki alat');
        }

        $kategori->delete();
        return redirect()->route('kategoris.index')->with('success', 'Kategori berhasil dihapus');
    }

    public function show(Kategori $kategori): View
    {
        return view('admin.kategoris.show', compact('kategori'));
    }
}
