<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Collection;

class UserPejabatService
{
    /**
     * Roles pejabat yang dikelola (exclude mahasiswa & admin).
     */
    private array $pejabatRoles = ['kaprodi', 'wadek', 'warek', 'puskaka'];

    /**
     * Ambil daftar roles pejabat yang valid.
     */
    public function getPejabatRoles(): array
    {
        return $this->pejabatRoles;
    }

    /**
     * Cek apakah user memiliki role pejabat.
     *
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     */
    public function ensureIsPejabat(User $user): void
    {
        if (!in_array($user->role, $this->pejabatRoles)) {
            abort(403, 'User bukan pejabat.');
        }
    }

    /**
     * Ambil semua user pejabat dengan filter opsional.
     */
    public function getAll(?string $search = null, ?string $role = null): Collection
    {
        $query = User::whereIn('role', $this->pejabatRoles);

        if ($role) {
            $query->where('role', $role);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('username', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        return $query->latest()->get();
    }

    /**
     * Ambil detail satu user pejabat.
     */
    public function getById(User $user): User
    {
        $this->ensureIsPejabat($user);

        return $user;
    }

    /**
     * Simpan user pejabat baru.
     */
    public function create(array $data): User
    {
        $data['password']  = Hash::make($data['password']);
        $data['is_active'] = $data['is_active'] ?? true;

        return User::create($data);
    }

    /**
     * Update data user pejabat.
     */
    public function update(User $user, array $data): User
    {
        $this->ensureIsPejabat($user);

        // Hanya update password kalau diisi
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $data['is_active'] = $data['is_active'] ?? true;

        $user->update($data);

        return $user->fresh();
    }

    /**
     * Hapus user pejabat.
     */
    public function delete(User $user): void
    {
        $this->ensureIsPejabat($user);

        $user->delete();
    }

    /**
     * Toggle status aktif/nonaktif user pejabat.
     */
    public function toggleStatus(User $user): User
    {
        $this->ensureIsPejabat($user);

        $user->update(['is_active' => !$user->is_active]);

        return $user;
    }
}
