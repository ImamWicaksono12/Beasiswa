<?php

namespace App\Services;

use App\Models\Beasiswa;
use Illuminate\Support\Collection;

class BeasiswaService
{
    /**
     * Ambil semua data beasiswa, diurutkan dari terbaru.
     */
    public function getAll(): Collection
    {
        return Beasiswa::latest()->get();
    }

    /**
     * Ambil detail satu beasiswa.
     */
    public function getById(Beasiswa $beasiswa): Beasiswa
    {
        return $beasiswa;
    }

    /**
     * Simpan data beasiswa baru.
     */
    public function create(array $data): Beasiswa
    {
        return Beasiswa::create($data);
    }

    /**
     * Update data beasiswa.
     */
    public function update(Beasiswa $beasiswa, array $data): Beasiswa
    {
        $beasiswa->update($data);

        return $beasiswa->fresh();
    }

    /**
     * Hapus data beasiswa.
     */
    public function delete(Beasiswa $beasiswa): void
    {
        $beasiswa->delete();
    }

    /**
     * Toggle status aktif/nonaktif beasiswa.
     */
    public function toggleStatus(Beasiswa $beasiswa): Beasiswa
    {
        $beasiswa->update(['is_active' => !$beasiswa->is_active]);

        return $beasiswa;
    }
}
