<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    /**
     * Tampilkan halaman index account.
     */
    public function index()
    {
        $accounts = User::with('role')->get();
        $roles = Role::all();
        return view('admin.account.index', compact('accounts', 'roles'));
    }

    /**
     * Simpan account baru.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role_id' => 'required|exists:roles,id',
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Akun berhasil ditambahkan'
            ]);
        }

        return redirect()
            ->route('admin.account')
            ->with('success', 'Akun berhasil ditambahkan');
    }

    /**
     * Perbarui account yang ada.
     */
    public function update(Request $request, User $account)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $account->id,
            'role_id' => 'required|exists:roles,id',
        ]);

        // Update password hanya jika diisi
        if ($request->filled('password')) {
            $request->validate([
                'password' => 'string|min:8',
            ]);
            $validatedData['password'] = Hash::make($request->password);
        }

        $account->update($validatedData);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Akun berhasil diupdate'
            ]);
        }

        return redirect()
            ->route('admin.account')
            ->with('success', 'Akun berhasil diupdate');
    }

    /**
     * Hapus account.
     */
    public function destroy(User $account)
    {
        $account->delete();

        return redirect()
            ->route('admin.account')
            ->with('success', 'Akun berhasil dihapus');
    }
}
