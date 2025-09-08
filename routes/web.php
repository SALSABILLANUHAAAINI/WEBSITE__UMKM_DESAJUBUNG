<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UmkmController;
use App\Http\Controllers\TentangKamiController;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\UmkmSubmissionController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\HomeSettingController;
use App\Http\Controllers\AdminUmkmSubmissionController;
use App\Http\Controllers\HeroController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Admin\ProfileController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Di sini adalah tempat Anda bisa mendaftarkan rute web untuk aplikasi Anda.
| Rute-rute ini dimuat oleh RouteServiceProvider dan semuanya akan
| ditugaskan ke grup middleware "web".
|
*/

//==========================================================================
// RUTE UNTUK PENGGUNA UMUM (USER SIDE)
//==========================================================================

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [TentangKamiController::class, 'show'])->name('about');
Route::get('/katalog', [KatalogController::class, 'userIndex'])->name('katalog');
Route::get('/service', [UmkmSubmissionController::class, 'showForm'])->name('service');
Route::post('/service/submit', [UmkmSubmissionController::class, 'store'])->name('service.submit');

Route::prefix('umkm')->name('umkm.')->group(function () {
    Route::get('/', [UmkmController::class, 'index'])->name('index');
    Route::get('/{umkm}', [UmkmController::class, 'show'])->name('show');
});


//==========================================================================
// RUTE UNTUK ADMINISTRATOR (ADMIN SIDE)
//==========================================================================

// --- Grup Rute Login & Logout (Publik, tidak perlu login) ---
Route::get('/admin/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminLoginController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');


// --- Grup Rute Admin (Wajib Login) ---
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {

    // Dashboard
    Route::view('/dashboard', 'admin.dashboard')->name('dashboard');

    // Pengaturan Halaman
    Route::get('/home', [HomeSettingController::class, 'edit'])->name('home');
    Route::post('/home', [HomeSettingController::class, 'update'])->name('home.update');
    Route::get('/tentang', [TentangKamiController::class, 'edit'])->name('tentang');
    Route::post('/tentang', [TentangKamiController::class, 'update'])->name('tentang.update');
    Route::get('/service-settings', [AdminUmkmSubmissionController::class, 'serviceSettings'])->name('service.settings');
    Route::post('/service-settings', [AdminUmkmSubmissionController::class, 'updateServiceSettings'])->name('service.settings.update');

    // Profil Admin
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Manajemen UMKM
    Route::get('/umkm', [UmkmController::class, 'adminIndex'])->name('umkm.index');
    Route::get('/umkm/create', [UmkmController::class, 'adminCreate'])->name('umkm.create');
    Route::post('/umkm', [UmkmController::class, 'adminStore'])->name('umkm.store');
    Route::get('/umkm/{umkm}/edit', [UmkmController::class, 'adminEdit'])->name('umkm.edit');
    Route::put('/umkm/{umkm}', [UmkmController::class, 'adminUpdate'])->name('umkm.update');
    Route::delete('/umkm/{umkm}', [UmkmController::class, 'destroy'])->name('umkm.destroy');
    Route::put('/umkm/hero', [UmkmController::class, 'updateHero'])->name('umkm.hero.update');

    // Manajemen Produk
    // Route::resource lebih ringkas untuk CRUD standar
    Route::resource('produk', ProductController::class)->except(['show']);

    // Manajemen Katalog
    Route::prefix('katalog')->name('katalog.')->group(function () {
        Route::get('/', [KatalogController::class, 'index'])->name('index');
        Route::get('/tambah', [KatalogController::class, 'create'])->name('tambah');
        Route::post('/store', [KatalogController::class, 'store'])->name('store');
        Route::get('/{katalog}/edit', [KatalogController::class, 'edit'])->name('edit');
        Route::put('/{katalog}', [KatalogController::class, 'update'])->name('update');
        Route::delete('/{katalog}', [KatalogController::class, 'destroy'])->name('destroy');
        Route::put('/', [KatalogController::class, 'updateHero'])->name('hero.update');
    });

    // Manajemen Pendaftaran (Submission)
    Route::prefix('submissions')->name('submissions.')->group(function () {
        Route::get('/', [AdminUmkmSubmissionController::class, 'index'])->name('index');
        Route::get('/{id}', [AdminUmkmSubmissionController::class, 'show'])->name('show');
        Route::post('/accept/{id}', [AdminUmkmSubmissionController::class, 'accept'])->name('accept');
        Route::post('/reject/{id}', [AdminUmkmSubmissionController::class, 'reject'])->name('reject');
    });

    // Rute lain-lain (jika ada)
    // Route::get('/hero', [HeroController::class, 'edit'])->name('hero.edit');
    // Route::put('/hero', [HeroController::class, 'update'])->name('hero.update');
});