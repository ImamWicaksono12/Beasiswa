<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserPejabatController extends Controller
{
    /**
     * Roles pejabat yang dikelola (exclude mahasiswa & admin).
     */
    private array $pejabatRoles = ['kaprodi', 'wadek', 'warek', 'puskaka'];

    /**
     * Ambil semua user pejabat (JSON untuk DataTable).
     */
    public function index(Request $request)
    {
        $query = User::whereIn('role', $this->pejabatRoles);

        // Filter by role
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        // Search by nama or username
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('username', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $users = $query->latest()->get();

        return response()->json(['data' => $users]);
    }

    /**
     * Simpan user pejabat baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'username'      => 'required|string|max:100|unique:users,username',
            'nama'          => 'required|string|max:255',
            'email'         => 'nullable|email|max:255|unique:users,email',
            'password'      => 'required|string|min:6|confirmed',
            'role'          => ['required', Rule::in($this->pejabatRoles)],
            'kode_prodi'    => 'nullable|string|max:20',
            'kode_fakultas' => 'nullable|string|max:20',
            'is_active'     => 'nullable|boolean',
        ]);

        $validated['password']  = Hash::make($validated['password']);
        $validated['is_active'] = $request->boolean('is_active', true);

        $user = User::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'User pejabat berhasil ditambahkan.',
            'user'    => $user,
        ], 201);
    }

    /**
     * Ambil detail satu user (untuk modal edit).
     */
    public function show(User $user)
    {
        if (!in_array($user->role, $this->pejabatRoles)) {
            return response()->json(['error' => 'User bukan pejabat.'], 403);
        }

        return response()->json($user);
    }

    /**
     * Update data user pejabat.
     */
    public function update(Request $request, User $user)
    {
        if (!in_array($user->role, $this->pejabatRoles)) {
            return response()->json(['error' => 'User bukan pejabat.'], 403);
        }

        $validated = $request->validate([
            'username'      => ['required', 'string', 'max:100', Rule::unique('users')->ignore($user->id)],
            'nama'          => 'required|string|max:255',
            'email'         => ['nullable', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password'      => 'nullable|string|min:6|confirmed',
            'role'          => ['required', Rule::in($this->pejabatRoles)],
            'kode_prodi'    => 'nullable|string|max:20',
            'kode_fakultas' => 'nullable|string|max:20',
            'is_active'     => 'nullable|boolean',
        ]);

        // Hanya update password kalau diisi
        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $validated['is_active'] = $request->boolean('is_active', true);

        $user->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'User pejabat berhasil diperbarui.',
            'user'    => $user->fresh(),
        ]);
    }

    /**
     * Hapus user pejabat.
     */
    public function destroy(User $user)
    {
        if (!in_array($user->role, $this->pejabatRoles)) {
            return response()->json(['error' => 'User bukan pejabat.'], 403);
        }

        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'User pejabat berhasil dihapus.',
        ]);
    }

    /**
     * Toggle status aktif/nonaktif.
     */
    public function toggleStatus(User $user)
    {
        if (!in_array($user->role, $this->pejabatRoles)) {
            return response()->json(['error' => 'User bukan pejabat.'], 403);
        }

        $user->update(['is_active' => !$user->is_active]);

        return response()->json([
            'success'   => true,
            'is_active' => $user->is_active,
            'message'   => $user->is_active ? 'User diaktifkan.' : 'User dinonaktifkan.',
        ]);
    }
}
