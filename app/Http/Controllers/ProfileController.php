<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\User;

class ProfileController extends Controller
{
    public function handleProfile(Request $request)
    {
        $user = Auth::user();

        // Jika request PUT/POST (update data)public function handleProfile(Request $request)
        {
            $user = Auth::user();

            // Debugging: Pastikan $user valid
            if (!$user instanceof \App\Models\User) {
                abort(500, 'Invalid user instance');
            }

            if ($request->isMethod('put')) {
                $validated = $request->validate([
                    'name' => 'required|string|max:255',
                    'email' => 'required|email|unique:users,email,' . $user->id,
                    'no_telepon' => 'nullable|string|max:20'
                ]);

                // PASTIKAN menggunakan only() untuk security
                $user->update($request->only(['name', 'email', 'no_telepon']));

                return back()->with('success', 'Profil diperbarui!');
            }

            return view('profile', [
                'user' => $user,
                'is_editing' => $request->boolean('edit') // Gunakan boolean() untuk konversi
            ]);
        }

        if ($request->isMethod('put')) {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $user->id,
                'no_telepon' => 'nullable|string|max:20'
            ]);

            $user->update($request->all());
            return back()->with('success', 'Profil berhasil diperbarui!');
        }

        // Jika request GET (tampilkan data)
        return view('profile', [
            'user' => $user,
            'is_editing' => $request->has('edit') // Tambahkan parameter ?edit=true di URL untuk mode edit
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        
        if (!$user instanceof \App\Models\User) {
            abort(500, 'Invalid user instance');
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'no_telepon' => ['required', 'string', 'max:20'],
            // Remove password from here if it's not needed for profile updates
        ], [
            'name.required' => 'Nama lengkap wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah digunakan',
            'no_telepon.required' => 'Nomor telepon wajib diisi',
        ]);

        try {
            $user->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Profil berhasil diperbarui'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memperbarui profil',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the user's password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        if (!$user instanceof \App\Models\User) {
            abort(500, 'Invalid user instance');
        }


        $validator = Validator::make($request->all(), [
            'current_password' => ['required', function ($attribute, $value, $fail) use ($user) {
                if (!Hash::check($value, $user->password)) {
                    $fail('Password saat ini salah');
                }
            }],
            'new_password' => ['required', 'min:8', 'different:current_password'],
            'new_password_confirmation' => ['required', 'same:new_password']
        ], [
            'current_password.required' => 'Password saat ini wajib diisi',
            'new_password.required' => 'Password baru wajib diisi',
            'new_password.min' => 'Password minimal 8 karakter',
            'new_password.different' => 'Password baru harus berbeda dengan password lama',
            'new_password_confirmation.required' => 'Konfirmasi password wajib diisi',
            'new_password_confirmation.same' => 'Konfirmasi password tidak cocok'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $user->update([
                'password' => Hash::make($request->new_password)
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Password berhasil diubah'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengubah password',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // Method untuk logout (tetap sama)
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
