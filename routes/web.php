<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomestayController;
use App\Http\Controllers\TipeKamarController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\ManagementPemilikController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\PrivacyController;
use App\Http\Controllers\HelpController;
use App\Http\Controllers\TermsController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\PemilikController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CarouselController;
use PHPUnit\TextUI\Help;

Route::get('/', [DashboardController::class, 'pengguna']);
Route::get('/home', [DashboardController::class, 'pengguna'])->name('home');
Route::get('/login', [AuthenticatedSessionController::class, 'create'])
    ->middleware('guest')
    ->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->middleware('guest')
    ->name('login.post');
Route::get('/register', function () {
    return view('auth.register');
})->middleware('guest')->name('register');
Route::post('/register', [RegisteredUserController::class, 'store'])
    ->middleware('guest')
    ->name('register.post');

// Redirect berdasarkan role
Route::get('/dashboard', function () {
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    $role = Auth::user()->role;
    $routeName = $role . '.dashboard';

    if (!Route::has($routeName)) {
        abort(404, 'Dashboard tidak ditemukan untuk role ini.');
    }

    return redirect()->route($routeName);
})->middleware(['auth', 'verified']);


Route::middleware(['auth', 'role:master'])->prefix('master')->group(function () {
    Route::get('/dashboard', [MasterController::class, 'index'])->name('dashboard.master');
});

Route::middleware(['auth', 'role:pemilik'])->prefix('pemilik')->group(function () {
    Route::get('/dashboard', [PemilikController::class, 'index'])->name('dashboard.pemilik');
});

Route::middleware(['auth', 'role:pengguna'])->prefix('pengguna')->group(function () {
    Route::get('/dashboard', [PenggunaController::class, 'index'])->name('dashboard.pengguna');
});

// Routes untuk ulasan
Route::middleware(['auth'])->group(function () {
    Route::get('/reviews', [ReviewController::class, 'index'])->name('dashboard.pengguna');
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store')->middleware('auth');
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
});

Route::middleware(['auth'])->group(function () {
    // Display profile page (GET)
    Route::get('/profile', [ProfileController::class, 'handleProfile'])->name('profile');

    // Update profile (PUT)
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    // Update password (PUT)
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');

    // Logout (POST)
    Route::post('/logout', [ProfileController::class, 'logout'])->name('logout');
});
// Route untuk pemilik
Route::prefix('pemilik')->group(function () {
    // Resource routes with custom names
    Route::resource('homestays', HomestayController::class)->names([
        'index' => 'pemilik.homestays.index',
        'store' => 'pemilik.homestays.store',
        'edit' => 'pemilik.homestays.edit',
        'showDetail' => 'pemilik.homestays.showDetail',
        'update' => 'pemilik.homestays.update',
        'destroy' => 'pemilik.homestays.destroy',
    ]);

    // Additional detail route (show)
    Route::get('pemilik/homestays/{id}', [HomestayController::class, 'show'])
        ->name('pemilik.homestays.detail');
});

Route::get('/dashboard', [DashboardController::class, 'pengguna'])->name('dashboard.pengguna');

Route::get('/homestays/{homestay}', [HomestayController::class, 'show'])
    ->name('pemilik.detail.homestay');
// routes/web.php
Route::post('/homestays/{homestay}/check-availability', [HomestayController::class, 'checkAvailability'])
    ->name('homestays.check-availability');
Route::get('/dashboard/pengguna', [DashboardController::class, 'pengguna'])
    ->name('dashboard.pengguna');
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

Route::get('/pemesanan', [PemesananController::class, 'index'])->name('pemesanan.index');
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
    Route::resource('carousel', CarouselController::class)->names([
        'index' => 'pemilik.carousel.index',
        'create' => 'pemilik.carousel.create',
        'store' => 'pemilik.carousel.store',
        'show' => 'pemilik.carousel.show',
        'edit' => 'pemilik.carousel.edit',
        'update' => 'pemilik.carousel.update',
        'destroy' => 'pemilik.carousel.destroy',
    ]);
});



Route::prefix('pemilik')->group(function () {
    Route::get('/management', [ManagementPemilikController::class, 'index'])->name('pemilik.management.index');
    Route::get('/management/laporan', [ManagementPemilikController::class, 'generateReport'])
        ->name('pemilik.management.laporan');
});






Route::get('/tentang-kami', [AboutController::class, 'index'])->name('about');
Route::get('/kontak', [ContactController::class, 'index'])->name('contact');
Route::get('/faq', [FaqController::class, 'index'])->name('faq');
Route::get('/kebijakan-privasi', [PrivacyController::class, 'index'])->name('privacy');
Route::get('/syarat-ketentuan', [TermsController::class, 'index'])->name('terms');
Route::get('/bantuan', [HelpController::class, 'index'])->name('help');

// routes/web.php
Route::prefix('pemilik')->group(function () {
    Route::get('/pemesanan', [PemesananController::class, 'index'])->name('pemilik.pemesanan.index');
    Route::post('/pemesanan/store-step1', [PemesananController::class, 'storeStep1'])->name('pemilik.pemesanan.store-step1');
    Route::post('/pemesanan/store-step2', [PemesananController::class, 'storeStep2'])->name('pemilik.pemesanan.store-step2');
    Route::post('/create', [PemesananController::class, 'create'])->name('pemesanan.create');
    Route::get('/pemesanan/konfirmasi', [PemesananController::class, 'konfirmasi'])
        ->name('pemilik.pemesanan.konfirmasi');
    Route::get('/pemesanan/riwayat', [PemesananController::class, 'riwayatPemesanan'])
        ->name('pemilik.pemesanan.riwayat');
    Route::get('/pemesanan/{id}', [PemesananController::class, 'show'])
        ->name('pemilik.pemesanan.detail');
    Route::get('/pemesanan/detail-user/{id}', [PemesananController::class, 'detailUser'])
        ->name('pemilik.pemesanan.detail-user');
    Route::put('/pemesanan/{id}/konfirmasi', [PemesananController::class, 'prosesKonfirmasi'])
        ->name('pemilik.pemesanan.prosesKonfirmasi');
    Route::post('/pemesanan/batal-user/{id}', [PemesananController::class, 'prosesBatalUser'])
        ->name('pemilik.pemesanan.prosesBatalUser');
    Route::put('/pemesanan/{id}/batal', [PemesananController::class, 'prosesBatalAdmin'])
        ->name('pemilik.pemesanan.prosesBatalAdmin');
    Route::put('/pemesanan/{pemesanan}/checkin', [PemesananController::class, 'checkin'])
        ->name('pemilik.pemesanan.checkin');
    Route::put('/pemesanan/{pemesanan}/checkout', [PemesananController::class, 'checkout'])
        ->name('pemilik.pemesanan.checkout');
    Route::get('/pemilik/pemesanan/{id}/invoice', [PemesananController::class, 'invoice'])
        ->name('pemilik.pemesanan.invoice');
        Route::post('/pemesanan/{id}/ajukan-refund', [PemesananController::class, 'ajukanRefund'])
    ->name('pemilik.pemesanan.ajukan_refund');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/master/create-owner', [UserController::class, 'createOwner'])->name('master.create-owner');
    Route::post('/master/store-owner', [UserController::class, 'storeOwner'])->name('master.store-owner');
    Route::put('/master/owners/{id}', [UserController::class, 'updateOwner'])->name('master.update-owner');
    Route::delete('/master/owners/{id}', [UserController::class, 'deleteOwner'])->name('master.delete-owner');
    Route::get('/master', [UserController::class, 'index'])->name('master.management-user');
    Route::get('/master/{user}/edit', [UserController::class, 'edit'])->name('master.management-user.edit');
    Route::put('/master/{user}', [UserController::class, 'update'])->name('master.management-user.update');
    Route::delete('/master/{user}', [UserController::class, 'destroy'])->name('master.management-user.destroy');
    Route::get('/master/management', [DashboardController::class, 'management'])->name('master.management');
});
