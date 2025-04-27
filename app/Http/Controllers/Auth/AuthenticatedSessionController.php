<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    public function create(): View
    {
        return view('auth.login', [
            'redirect' => request()->query('redirect')
        ]);
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        // Redirect ke URL tujuan jika ada, atau ke dashboard sesuai role
        if ($request->filled('redirect')) {
            // Tambahkan parameter login_success=1 ke URL redirect
            $redirectUrl = $request->input('redirect');

            // Parse URL untuk menambahkan parameter
            $urlParts = parse_url($redirectUrl);
            $query = [];
            if (isset($urlParts['query'])) {
                parse_str($urlParts['query'], $query);
            }
            $query['login_success'] = '1';

            // Bangun kembali URL dengan parameter baru
            $newQuery = http_build_query($query);
            $redirectUrl = $urlParts['path'] . '?' . $newQuery;

            if (isset($urlParts['fragment'])) {
                $redirectUrl .= '#' . $urlParts['fragment'];
            }

            return redirect($redirectUrl);
        }

        return $this->redirectToDashboard();
    }

    protected function redirectToDashboard(): RedirectResponse
    {
        $roleRoutes = [
            'master' => 'dashboard.master',
            'pemilik' => 'dashboard.pemilik',
            'pengguna' => 'dashboard.pengguna'
        ];

        return redirect()->intended(
            route($roleRoutes[Auth::user()->role] ?? 'dashboard.pengguna')
        );
    }


    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
