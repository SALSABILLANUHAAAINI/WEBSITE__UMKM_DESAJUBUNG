<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UmkmController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HomeSettingController;
use App\Http\Controllers\TentangKamiController;
use App\Http\Controllers\AdminUmkmSubmissionController;
use App\Http\Controllers\UmkmSubmissionController;
use App\Http\Controllers\HeroController;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\ProductController;

// ---------------- USER SIDE ----------------
Route::get('/', [HomeController::class, 'index'])->name('home');

// UMKM user (index & show)
Route::prefix('umkm')->name('umkm.')->group(function () {
    Route::get('/', [UmkmController::class, 'index'])->name('index');
    Route::get('/{umkm}', [UmkmController::class, 'show'])->name('show');
});

// Halaman statis user
Route::get('/about', [TentangKamiController::class, 'show'])->name('about');
Route::get('/katalog', [KatalogController::class, 'userIndex'])->name('katalog');
Route::view('/katalog/show', 'user.katalog.show')->name('katalog.show');

// UMKM submission user
Route::get('/service', [UmkmSubmissionController::class, 'showForm'])->name('service');
Route::post('/service/submit', [UmkmSubmissionController::class, 'store'])->name('service.submit');

// ---------------- ADMIN SIDE ----------------
// Login admin
Route::view('/admin/login', 'admin.login.login')->name('admin.login');

// Semua route admin tanpa auth middleware
Route::prefix('admin')->name('admin.')->group(function () {

    // Dashboard & Sidebar
    Route::view('/dashboard', 'admin.dashboard')->name('dashboard');
    Route::view('/sidebar', 'admin.partials.sidebar')->name('sidebar');

    // Home & Tentang
    Route::get('/home', [HomeSettingController::class, 'edit'])->name('home');
    Route::post('/home', [HomeSettingController::class, 'update'])->name('home.update');

    Route::get('/tentang', [TentangKamiController::class, 'edit'])->name('tentang'); 
    Route::post('/tentang', [TentangKamiController::class, 'update'])->name('tentang.update');

    // Hero
    Route::get('/hero', [HeroController::class, 'edit'])->name('hero.edit');
    Route::put('/hero', [HeroController::class, 'update'])->name('hero.update');

    // Produk
    Route::prefix('produk')->name('produk.')->group(function () {
        Route::get('/', [ProductController::class,'index'])->name('index');
        Route::get('/tambah', [ProductController::class,'create'])->name('tambah');
        Route::post('/store', [ProductController::class,'store'])->name('store');
        Route::get('/{product}/edit', [ProductController::class,'edit'])->name('edit');
        Route::put('/{product}', [ProductController::class,'update'])->name('update');
        Route::delete('/{product}', [ProductController::class,'destroy'])->name('destroy');
    });

    // UMKM
    Route::prefix('umkm')->name('umkm.')->group(function () {
        Route::get('/', [UmkmController::class, 'adminIndex'])->name('index');
        Route::get('/create', [UmkmController::class, 'adminCreate'])->name('create');
        Route::put('/hero', [UmkmController::class, 'updateHero'])->name('hero.update');
        Route::post('/', [UmkmController::class, 'adminStore'])->name('store');
        Route::get('/{umkm}/edit', [UmkmController::class, 'adminEdit'])->name('edit');
        Route::put('/{umkm}', [UmkmController::class,'adminUpdate'])->name('update');
        Route::delete('/{umkm}', [UmkmController::class, 'destroy'])->name('destroy');
    });

    // Submissions UMKM (langsung di bawah admin)
    Route::prefix('submissions')->name('submissions.')->group(function () {
        Route::get('/', [AdminUmkmSubmissionController::class, 'index'])->name('index');
        Route::get('/{id}', [AdminUmkmSubmissionController::class,'show'])->name('show'); // admin.submissions.show
        Route::post('/accept/{id}', [AdminUmkmSubmissionController::class,'accept'])->name('accept');
        Route::post('/reject/{id}', [AdminUmkmSubmissionController::class,'reject'])->name('reject');
    });

    // Service Settings
    Route::get('/service-settings', [AdminUmkmSubmissionController::class, 'serviceSettings'])->name('service.settings'); // admin.service.settings
    Route::post('/service-settings', [AdminUmkmSubmissionController::class, 'updateServiceSettings'])->name('service.settings.update');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::prefix('katalog')->name('katalog.')->group(function () {
        Route::get('/', [KatalogController::class,'index'])->name('index');
        Route::get('/tambah', [KatalogController::class,'create'])->name('tambah');
        Route::post('/store', [KatalogController::class,'store'])->name('store');
        Route::get('/{katalog}/edit', [KatalogController::class,'edit'])->name('edit');
        Route::put('/{katalog}', [KatalogController::class,'update'])->name('update');
        Route::delete('/{katalog}', [KatalogController::class,'destroy'])->name('destroy');

        // Hero langsung di halaman index, route unik supaya tidak bentrok
        Route::put('/', [KatalogController::class,'updateHero'])->name('hero.update');
    });
});
