<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\UserPejabatService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserPejabatController extends Controller
{
    public function __construct(
        private UserPejabatService $service
    ) {}

    /**
     * Ambil semua user pejabat (JSON untuk DataTable).
     */
    public function index(Request $request)
    {
        $users = $this->service->getAll(
            search: $request->input('search'),
            role: $request->input('role'),
        );

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
            'role'          => ['required', Rule::in($this->service->getPejabatRoles())],
            'kode_prodi'    => 'nullable|string|max:20',
            'kode_fakultas' => 'nullable|string|max:20',
            'is_active'     => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active', true);

        $user = $this->service->create($validated);

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
        $user = $this->service->getById($user);

        return response()->json($user);
    }

    /**
     * Update data user pejabat.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'username'      => ['required', 'string', 'max:100', Rule::unique('users')->ignore($user->id)],
            'nama'          => 'required|string|max:255',
            'email'         => ['nullable', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password'      => 'nullable|string|min:6|confirmed',
            'role'          => ['required', Rule::in($this->service->getPejabatRoles())],
            'kode_prodi'    => 'nullable|string|max:20',
            'kode_fakultas' => 'nullable|string|max:20',
            'is_active'     => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active', true);

        $user = $this->service->update($user, $validated);

        return response()->json([
            'success' => true,
            'message' => 'User pejabat berhasil diperbarui.',
            'user'    => $user,
        ]);
    }

    /**
     * Hapus user pejabat.
     */
    public function destroy(User $user)
    {
        $this->service->delete($user);

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
        $user = $this->service->toggleStatus($user);

        return response()->json([
            'success'   => true,
            'is_active' => $user->is_active,
            'message'   => $user->is_active ? 'User diaktifkan.' : 'User dinonaktifkan.',
        ]);
    }
}
