<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Katalog;
use App\Models\HeroKatalog;
use App\Models\Product;

class KatalogController extends Controller
{
    // ------------------- USER SIDE -------------------
    public function userIndex(Request $request)
    {
        $katalogs = Katalog::all();
        $heroKatalog = HeroKatalog::first();

        $query = Product::query()->with(['umkm', 'katalog']); // eager load untuk menghindari N+1

        // Filter search
        if ($request->filled('search')) {
            $query->where('nama_produk', 'like', '%' . $request->search . '%');
        }

        // Filter kategori
        if ($request->filled('kategori') && strtolower($request->kategori) !== 'semua') {
            $kategoriFilter = strtolower($request->kategori);
            $query->whereHas('katalog', function($q) use ($kategoriFilter){
                $q->whereRaw('LOWER(name) = ?', [$kategoriFilter]);
            });
        }

        // Pagination 10 produk per halaman
        $products = $query->latest()->paginate(10)->withQueryString();

        return view('user.katalog.index', compact('katalogs', 'heroKatalog', 'products'));
    }

    // ------------------- ADMIN SIDE -------------------
    public function index()
    {
        $katalogs = Katalog::orderBy('created_at','desc')->get();
        $heroKatalog = HeroKatalog::first();
        if (!$heroKatalog) {
            $heroKatalog = new HeroKatalog();
            $heroKatalog->hero = 'Explore Our Clients';
        }
        return view('admin.katalog.katalogsetting', compact('katalogs', 'heroKatalog'));
    }

    public function create()
    {
        return view('admin.katalog.tambahkatalog');
    }

    public function edit(Katalog $katalog)
    {
        return view('admin.katalog.editkatalog', compact('katalog'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori' => 'required|array',
            'kategori.*.nama' => 'required|string|max:255',
            'kategori.*.aktif' => 'nullable|boolean',
        ]);

        foreach ($request->kategori as $item) {
            Katalog::create([
                'name' => $item['nama'],
                'is_active' => isset($item['aktif']) ? true : false,
            ]);
        }

        return redirect()->route('admin.katalog.index')
                         ->with('success','Kategori berhasil ditambahkan.');
    }

    public function update(Request $request, Katalog $katalog)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'is_active' => 'nullable|boolean'
        ]);

        $katalog->update([
            'name' => $request->name,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.katalog.index')
                         ->with('success','Kategori berhasil diperbarui.');
    }

    public function destroy(Katalog $katalog)
    {
        $katalog->delete();
        return redirect()->back()->with('success','Kategori berhasil dihapus.');
    }

    public function updateHero(Request $request)
    {
        $request->validate([
            'hero' => 'required|string|max:255',
        ]);

        $hero = HeroKatalog::first() ?? new HeroKatalog();
        $hero->hero = $request->hero;
        $hero->save();

        return redirect()->route('admin.katalog.index')
                        ->with('success', 'Hero Katalog berhasil diperbarui');
    }
}
