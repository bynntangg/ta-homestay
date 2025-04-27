<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    /**
     * Menampilkan form tambah pemilik baru
     */
    public function index()
    {
        $users = User::where('role', 'pengguna')->get();
        return view('master.management-user', compact('users'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'no_telepon' => 'nullable|string|max:20',
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|in:pengguna,pemilik,master',
        ]);

        if ($request->filled('password')) {
            $validated['password'] = bcrypt($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('master.management-user')->with('success', 'Pengguna berhasil diperbarui');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('master.management-user')->with('success', 'Pengguna berhasil dihapus');
    }

    public function createOwner()
    {
        $users = User::where('role', 'pemilik')->orderBy('created_at', 'desc')->get();
        return view('master.create-owner', compact('users'));
    }

    /**
     * Menyimpan data pemilik baru ke database
     */
    public function storeOwner(Request $request)
    {
        // Validasi data input
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'no_telepon' => ['required', 'string', 'max:15', 'unique:users'],
            'password' => ['required', Rules\Password::defaults()],
        ]);

        // Membuat user baru dengan role pemilik
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'no_telepon' => $request->no_telepon,
            'password' => Hash::make($request->password),
            'role' => 'pemilik', // Role khusus untuk pemilik
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('master.create-owner') // Sesuaikan dengan route tujuan
            ->with('success', 'Data pemilik berhasil ditambahkan!');
    }
    public function updateOwner(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'no_telepon' => 'required|string|max:20',
            'password' => 'nullable|min:8',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->no_telepon = $request->no_telepon;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->back()->with('success', 'Data pemilik berhasil diperbarui');
    }

    public function deleteOwner($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'Data pemilik berhasil dihapus');
    }
}
