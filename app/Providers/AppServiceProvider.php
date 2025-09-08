<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use App\Models\Umkm;
use App\Models\Katalog;
use App\Models\Product;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
{
    // Membuat View Composer untuk view 'admin.dashboard'
    View::composer('admin.dashboard', function ($view) {
        
        // 1. Ambil jumlah UMKM
        $jumlahUmkm = Umkm::count();

        // 2. Ambil jumlah Kategori Katalog
        $jumlahKatalog = Katalog::count();

        // 3. Ambil 5 produk terbaru untuk ditampilkan
        $recentProducts = Product::latest()->take(3)->get();

        // 4. Ambil 5 katalog terbaru untuk ditampilkan
        $recentKatalogs = Katalog::latest()->take(3)->get();

        // 4. Kirim semua data ini ke view
        $view->with([
            'jumlahUmkm' => $jumlahUmkm,
            'jumlahKatalog' => $jumlahKatalog,
            'recentProducts' => $recentProducts,
            'recentKatalogs' => $recentKatalogs,
        ]);
    });
}
}
