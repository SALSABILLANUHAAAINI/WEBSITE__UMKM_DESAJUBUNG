<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Umkm;
use App\Models\Katalog;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['umkm', 'katalog'])->orderBy('created_at', 'desc');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('nama_produk', 'like', "%{$search}%")
                  ->orWhereHas('umkm', function ($q) use ($search) {
                      $q->where('nama_umkm', 'like', "%{$search}%");
                  });
        }

        $products = $query->paginate(10)->withQueryString();
        // DIUBAH: Mengarahkan ke folder view "product"
        return view('admin.product.index', compact('products'));
    }

    public function create()
    {
        $umkms = Umkm::all();
        $katalogs = Katalog::where('is_active', true)->get();
        // DIUBAH: Mengarahkan ke folder view "product" dan file "create.blade.php"
        return view('admin.product.create', compact('umkms', 'katalogs'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'umkm_id' => 'required|exists:umkms,id',
            'katalog_id' => 'required|exists:katalogs,id',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $validatedData['product_image'] = $request->file('gambar')->store('product_images', 'public');
        }

        Product::create($validatedData);

        // DIUBAH: Redirect ke route "admin.product.index"
        return redirect()->route('admin.product.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Product $product)
    {
        $umkms = Umkm::all();
        $katalogs = Katalog::where('is_active', true)->get();
        // DIUBAH: Mengarahkan ke folder view "product" dan file "edit.blade.php"
        return view('admin.product.edit', compact('product', 'umkms', 'katalogs'));
    }

    public function update(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'umkm_id' => 'required|exists:umkms,id',
            'katalog_id' => 'required|exists:katalogs,id',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            if ($product->product_image && Storage::disk('public')->exists($product->product_image)) {
                Storage::disk('public')->delete($product->product_image);
            }
            $validatedData['product_image'] = $request->file('gambar')->store('product_images', 'public');
        }

        $product->update($validatedData);

        // DIUBAH: Redirect ke route "admin.product.index"
        return redirect()->route('admin.product.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        if ($product->product_image && Storage::disk('public')->exists($product->product_image)) {
            Storage::disk('public')->delete($product->product_image);
        }
        $product->delete();
        
        // DIUBAH: Redirect ke route "admin.product.index"
        return redirect()->route('admin.product.index')->with('success', 'Produk berhasil dihapus.');
    }
}