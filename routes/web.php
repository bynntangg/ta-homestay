<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardPemilikController;
use App\Http\Controllers\HomestayController;
use App\Http\Controllers\TipeKamarController;
use App\Http\Controllers\KamarController;


Route::get('/home', function () {
    $role = Auth::user()->role;
    switch ($role) {
        case 'pengguna':
            return redirect()->route('dashboard.pengguna');
        case 'pemilik':
            return redirect()->route('dashboard.pemilik');
        case 'master':
            return redirect()->route('dashboard.master');
        default:
            return redirect('/');
    }
})->middleware('auth');


Route::middleware('auth')->group(function () {
    Route::get('/dashboard/pengguna', [DashboardController::class, 'pengguna'])->name('dashboard.pengguna');
    Route::get('/dashboard/pemilik', [DashboardController::class, 'pemilik'])->name('dashboard.pemilik');
    Route::get('/dashboard/master', [DashboardController::class, 'master'])->name('dashboard.master');
});

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::post('/logout', [ProfileController::class, 'logout'])->name('logout');
});

// Route untuk pemilik
Route::prefix('pemilik')->group(function () {
    Route::resource('homestays', HomestayController::class)->names([
        'index' => 'pemilik.homestays.index',
        'store' => 'pemilik.homestays.store',
        'edit' => 'pemilik.homestays.edit',
        'update' => 'pemilik.homestays.update',
        'destroy' => 'pemilik.homestays.destroy',
    ]);
});


Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::prefix('pemilik')->group(function () {
    Route::resource('tipe_kamar', TipeKamarController::class)->names([
        'index' => 'pemilik.tipe_kamar.index',
        'create' => 'pemilik.tipe_kamar.create',
        'store' => 'pemilik.tipe_kamar.store',
        'show' => 'pemilik.tipe_kamar.show',
        'edit' => 'pemilik.tipe_kamar.edit',
        'update' => 'pemilik.tipe_kamar.update',
        'destroy' => 'pemilik.tipe_kamar.destroy',
    ]);
});

Route::prefix('pemilik')->group(function () {
    Route::resource('kamar', KamarController::class)->names([
        'index' => 'pemilik.kamars.index',
        'create' => 'pemilik.kamars.create',
        'store' => 'pemilik.kamars.store',
        'show' => 'pemilik.kamars.show',
        'edit' => 'pemilik.kamars.edit',
        'update' => 'pemilik.kamars.update',
        'destroy' => 'pemilik.kamars.destroy',
    ]);
});

Route::prefix('pemilik')->group(function () {
    Route::get('/dashboard', [DashboardPemilikController::class, 'index'])->name('pemilik.dashboard.index');
});
require __DIR__.'/auth.php';
