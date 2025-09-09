<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\Umkm;
use App\Models\Katalog;

class ProductController extends Controller
{
    /**
     * List all products
     */
    public function index()
    {
        $products = Product::with(['umkm', 'katalog'])->paginate(10);
        return view('admin.product.index', compact('products'));
    }

    /**
     * Show create form
     */
    public function create()
    {
        $umkms = Umkm::all();
        $katalogs = Katalog::all();
        return view('admin.product.create', compact('umkms', 'katalogs'));
    }

    /**
     * Store new product
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'umkm_id' => 'required|exists:umkms,id',
            'katalog_id' => 'required|exists:katalogs,id',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'deskripsi' => 'nullable|string',
        ]);

        $path = null;
        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('product_images', 'public');
        }

        Product::create([
            'nama_produk' => $request->nama_produk,
            'harga' => $request->harga,
            'umkm_id' => $request->umkm_id,
            'katalog_id' => $request->katalog_id,
            'product_image' => $path,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('admin.product.index')
                         ->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Show edit form
     */
    public function edit(Product $product)
    {
        $umkms = Umkm::all();
        $katalogs = Katalog::all();
        return view('admin.product.edit', compact('product', 'umkms', 'katalogs'));
    }

    /**
     * Update product
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'umkm_id' => 'required|exists:umkms,id',
            'katalog_id' => 'required|exists:katalogs,id',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'deskripsi' => 'nullable|string',
        ]);

        $path = $product->product_image;

        if ($request->hasFile('gambar')) {
            // hapus file lama jika ada
            if ($product->product_image && Storage::disk('public')->exists($product->product_image)) {
                Storage::disk('public')->delete($product->product_image);
            }
            $path = $request->file('gambar')->store('product_images', 'public');
        }

        $product->update([
            'nama_produk' => $request->nama_produk,
            'harga' => $request->harga,
            'umkm_id' => $request->umkm_id,
            'katalog_id' => $request->katalog_id,
            'product_image' => $path,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('admin.product.index')
                         ->with('success', 'Produk berhasil diperbarui.');
    }

    /**
     * Delete product
     */
    public function destroy(Product $product)
    {
        if ($product->product_image && Storage::disk('public')->exists($product->product_image)) {
            Storage::disk('public')->delete($product->product_image);
        }

        $product->delete();

        return redirect()->route('admin.product.index')
                         ->with('success', 'Produk berhasil dihapus.');
    }
}
