<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Umkm;
use App\Models\Katalog;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // Tampilkan daftar produk
    public function index()
    {
        $products = Product::with(['umkm', 'katalog'])
                           ->orderBy('created_at', 'desc')
                           ->get();
        return view('admin.produk.index', compact('products'));
    }

    // Halaman tambah produk
    public function create()
    {
        $umkms = Umkm::all();
        $katalogs = Katalog::where('is_active', true)->get();
        return view('admin.produk.tambahproduk', compact('umkms', 'katalogs'));
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
            $imagePath = $request->file('gambar')->store('product_images', 'public');
        }

        Product::create([
            'nama_produk' => $request->nama_produk,
            'harga' => $request->harga,
            'umkm_id' => $request->umkm_id,
            'katalog_id' => $request->katalog_id,
            'deskripsi' => $request->deskripsi,
            'product_image' => $imagePath,
        ]);

        return redirect()->route('admin.produk.index')
                         ->with('success', 'Produk berhasil ditambahkan.');
    }

    // Halaman edit produk
    public function edit(Product $product)
    {
        $umkms = Umkm::all();
        $katalogs = Katalog::where('is_active', true)->get();
        return view('admin.produk.editproduk', compact('product', 'umkms', 'katalogs'));
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
            if ($product->product_image && Storage::disk('public')->exists($product->product_image)) {
                Storage::disk('public')->delete($product->product_image);
            }

            $imagePath = $request->file('gambar')->store('product_images', 'public');
        }

        $product->update([
            'nama_produk' => $request->nama_produk,
            'harga' => $request->harga,
            'umkm_id' => $request->umkm_id,
            'katalog_id' => $request->katalog_id,
            'deskripsi' => $request->deskripsi,
            'product_image' => $imagePath,
        ]);

        return redirect()->route('admin.produk.index')
                         ->with('success', 'Produk berhasil diperbarui.');
    }

    // Hapus produk
    public function destroy(Product $product)
    {
        if ($product->product_image && Storage::disk('public')->exists($product->product_image)) {
            Storage::disk('public')->delete($product->product_image);
        }

        $product->delete();
        return redirect()->route('admin.produk.index')
                         ->with('success', 'Produk berhasil dihapus.');
    }
}
