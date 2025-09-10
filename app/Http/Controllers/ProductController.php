<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Umkm;
use App\Models\Katalog;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['umkm', 'katalog'])->orderBy('created_at','desc');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_produk','like',"%{$search}%")
                  ->orWhereHas('umkm', fn($q2) => $q2->where('nama_umkm','like',"%{$search}%"))
                  ->orWhereHas('katalog', fn($q3) => $q3->where('name','like',"%{$search}%"));
            });
        }

        $products = $query->paginate(10)->withQueryString();
        return view('admin.product.index', compact('products'));
    }

    public function create()
    {
        $umkms = Umkm::all();
        $katalogs = Katalog::where('is_active', true)->get();
        return view('admin.product.create', compact('umkms','katalogs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_produk'=>'required|string|max:255',
            'harga'=>'required|numeric',
            'umkm_id'=>'required|exists:umkms,id',
            'katalog_id'=>'required|exists:katalogs,id',
            'deskripsi'=>'nullable|string',
            'gambar'=>'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $fileName = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('product_images'), $fileName);
            $imagePath = 'product_images/'.$fileName;
        }

        Product::create([
            'nama_produk' => $request->nama_produk,
            'harga' => (float)$request->harga,
            'umkm_id' => $request->umkm_id,
            'katalog_id' => $request->katalog_id,
            'deskripsi' => $request->deskripsi,
            'product_image' => $imagePath,
        ]);

        return redirect()->route('admin.product.index')->with('success','Produk berhasil ditambahkan.');
    }

    public function edit(Product $product)
    {
        $umkms = Umkm::all();
        $katalogs = Katalog::where('is_active', true)->get();
        return view('admin.product.edit', compact('product','umkms','katalogs'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'nama_produk'=>'required|string|max:255',
            'harga'=>'required|numeric',
            'umkm_id'=>'required|exists:umkms,id',
            'katalog_id'=>'required|exists:katalogs,id',
            'deskripsi'=>'nullable|string',
            'gambar'=>'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $imagePath = $product->product_image;

        if ($request->hasFile('gambar')) {
            $oldImage = public_path($product->product_image);
            if ($product->product_image && file_exists($oldImage)) unlink($oldImage);

            $file = $request->file('gambar');
            $fileName = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('product_images'), $fileName);
            $imagePath = 'product_images/'.$fileName;
        }

        $product->update([
            'nama_produk'=>$request->nama_produk,
            'harga'=>(float)$request->harga,
            'umkm_id'=>$request->umkm_id,
            'katalog_id'=>$request->katalog_id,
            'deskripsi'=>$request->deskripsi,
            'product_image'=>$imagePath,
        ]);

        return redirect()->route('admin.product.index')->with('success','Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        if ($product->product_image) {
            $file = public_path($product->product_image);
            if (file_exists($file)) unlink($file);
        }

        $product->delete();
        return redirect()->route('admin.product.index')->with('success','Produk berhasil dihapus.');
    }
}
