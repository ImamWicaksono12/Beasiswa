<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Beasiswa;
use Illuminate\Http\Request;

class BeasiswaController extends Controller
{
    /**
     * Tampilkan semua data beasiswa.
     */
    public function index()
    {
        $beasiswas = Beasiswa::latest()->get();
        return view('admin.beasiswa.index', compact('beasiswas'));
    }

    /**
     * Simpan data beasiswa baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_beasiswa'        => 'required|string|max:255',
            'sumber_dana'          => 'required|string|max:255',
            'nominal'              => 'required|integer|min:0',
            'kategori_dana'        => 'required|in:fully_funded,partially_funded,one_shoot',
            'link_pendaftaran_luar' => 'nullable|url|max:500',
        ]);

        $validated['is_active'] = $request->has('is_active');

        Beasiswa::create($validated);

        return redirect()->route('admin.beasiswa.index')
            ->with('success', 'Program beasiswa berhasil ditambahkan.');
    }

    /**
     * Tampilkan form edit (JSON untuk modal AJAX).
     */
    public function edit(Beasiswa $beasiswa)
    {
        return response()->json($beasiswa);
    }

    /**
     * Update data beasiswa.
     */
    public function update(Request $request, Beasiswa $beasiswa)
    {
        $validated = $request->validate([
            'nama_beasiswa'        => 'required|string|max:255',
            'sumber_dana'          => 'required|string|max:255',
            'nominal'              => 'required|integer|min:0',
            'kategori_dana'        => 'required|in:fully_funded,partially_funded,one_shoot',
            'link_pendaftaran_luar' => 'nullable|url|max:500',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $beasiswa->update($validated);

        return redirect()->route('admin.beasiswa.index')
            ->with('success', 'Program beasiswa berhasil diperbarui.');
    }

    /**
     * Hapus data beasiswa.
     */
    public function destroy(Beasiswa $beasiswa)
    {
        $beasiswa->delete();

        return redirect()->route('admin.beasiswa.index')
            ->with('success', 'Program beasiswa berhasil dihapus.');
    }

    /**
     * Toggle status aktif/non-aktif via AJAX.
     */
    public function toggleStatus(Beasiswa $beasiswa)
    {
        $beasiswa->update(['is_active' => !$beasiswa->is_active]);

        return response()->json([
            'success'   => true,
            'is_active' => $beasiswa->is_active,
            'message'   => $beasiswa->is_active ? 'Beasiswa diaktifkan.' : 'Beasiswa dinonaktifkan.',
        ]);
    }
}
