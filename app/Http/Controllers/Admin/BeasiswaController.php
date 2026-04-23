<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Beasiswa;
use App\Services\BeasiswaService;
use Illuminate\Http\Request;

class BeasiswaController extends Controller
{
    public function __construct(
        private BeasiswaService $service
    ) {}

    /**
     * Tampilkan semua data beasiswa.
     */
    public function index()
    {
        $beasiswas = $this->service->getAll();

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

        $this->service->create($validated);

        return redirect()->route('admin.beasiswa.index')
            ->with('success', 'Program beasiswa berhasil ditambahkan.');
    }

    /**
     * Tampilkan form edit (JSON untuk modal AJAX).
     */
    public function edit(Beasiswa $beasiswa)
    {
        return response()->json($this->service->getById($beasiswa));
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

        $this->service->update($beasiswa, $validated);

        return redirect()->route('admin.beasiswa.index')
            ->with('success', 'Program beasiswa berhasil diperbarui.');
    }

    /**
     * Hapus data beasiswa.
     */
    public function destroy(Beasiswa $beasiswa)
    {
        $this->service->delete($beasiswa);

        return redirect()->route('admin.beasiswa.index')
            ->with('success', 'Program beasiswa berhasil dihapus.');
    }

    /**
     * Toggle status aktif/non-aktif via AJAX.
     */
    public function toggleStatus(Beasiswa $beasiswa)
    {
        $beasiswa = $this->service->toggleStatus($beasiswa);

        return response()->json([
            'success'   => true,
            'is_active' => $beasiswa->is_active,
            'message'   => $beasiswa->is_active ? 'Beasiswa diaktifkan.' : 'Beasiswa dinonaktifkan.',
        ]);
    }
}
