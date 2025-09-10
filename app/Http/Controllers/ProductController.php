<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Umkm;
use App\Models\Katalog;

class ProductController extends Controller
{
    // Tampilkan daftar produk dengan pencarian dan pagination
    public function index(Request $request)
    {
        $query = Product::with(['umkm', 'katalog'])
                        ->orderBy('created_at', 'desc');

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function($q) use ($search) {
                $q->where('nama_produk', 'like', "%{$search}%")
                  ->orWhereHas('umkm', function($q2) use ($search) {
                      $q2->where('nama_umkm', 'like', "%{$search}%");
                  })
                  ->orWhereHas('katalog', function($q3) use ($search) {
                      $q3->where('name', 'like', "%{$search}%");
                  });
            });
        }

        $products = $query->paginate(10)->withQueryString();

        $products->getCollection()->transform(function($product) {
            $product->harga = (float) $product->harga;
            return $product;
        });

        return view('admin.product.index', compact('products'));
    }

    // Halaman tambah produk
    public function create()
    {
        $umkms = Umkm::all();
        $katalogs = Katalog::where('is_active', true)->get();
        return view('admin.product.create', compact('umkms', 'katalogs'));
    }

    // Simpan produk baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'umkm_id' => 'required|exists:umkms,id',
            'katalog_id' => 'required|exists:katalogs,id',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp',
        ]);

        $imagePath = null;
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('storage/product_images'), $filename);
            $imagePath = $filename; // simpan nama file
        }

        Product::create([
            'nama_produk' => $request->nama_produk,
            'harga' => (float) $request->harga,
            'umkm_id' => $request->umkm_id,
            'katalog_id' => $request->katalog_id,
            'deskripsi' => $request->deskripsi,
            'product_image' => $imagePath,
        ]);

        return redirect()->route('admin.product.index')
                         ->with('success', 'Produk berhasil ditambahkan.');
    }

    // Halaman edit produk
    public function edit(Product $product)
    {
        $umkms = Umkm::all();
        $katalogs = Katalog::where('is_active', true)->get();
        return view('admin.product.edit', compact('product', 'umkms', 'katalogs'));
    }

    // Update produk
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'umkm_id' => 'required|exists:umkms,id',
            'katalog_id' => 'required|exists:katalogs,id',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp',
        ]);

        $imagePath = $product->product_image;

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            $oldImage = public_path('storage/product_images/' . $product->product_image);
            if ($product->product_image && file_exists($oldImage)) {
                unlink($oldImage);
            }

            $file = $request->file('gambar');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('storage/product_images'), $filename);
            $imagePath = $filename; // simpan nama file baru
        }

        $product->update([
            'nama_produk' => $request->nama_produk,
            'harga' => (float) $request->harga,
            'umkm_id' => $request->umkm_id,
            'katalog_id' => $request->katalog_id,
            'deskripsi' => $request->deskripsi,
            'product_image' => $imagePath,
        ]);

        return redirect()->route('admin.product.index')
                         ->with('success', 'Produk berhasil diperbarui.');
    }

    // Hapus produk
    public function destroy(Product $product)
    {
        $imageFile = public_path('storage/product_images/' . $product->product_image);
        if ($product->product_image && file_exists($imageFile)) {
            unlink($imageFile);
        }

        $product->delete();
        return redirect()->route('admin.product.index')
                         ->with('success', 'Produk berhasil dihapus.');
    }
}
