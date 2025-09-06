<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UmkmSubmission;
use App\Models\ProductSubmission;
use App\Models\Umkm;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdminUmkmSubmissionController extends Controller
{
    // Halaman service settings
    public function serviceSettings()
    {
        $submissions = UmkmSubmission::with('products')->orderBy('created_at', 'desc')->get();
        return view('admin.setting.form', compact('submissions'));
    }

    // Index semua submission pending
    public function index()
    {
        $submissions = UmkmSubmission::where('status', 'pending')
                        ->with('products')->get();
        return view('admin.submissions.index', compact('submissions'));
    }

    // Tampilkan detail submission
    public function show($id)
    {
        $submission = UmkmSubmission::with('products')->findOrFail($id);
        return view('admin.submissions.show', compact('submission'));
    }

    // Accept submission
    public function accept($id)
    {
        $submission = UmkmSubmission::with('products')->findOrFail($id);

        Log::info("DEBUG: Accepting submission", [
            'submission_id' => $submission->id,
            'products_count' => $submission->products->count()
        ]);

        DB::beginTransaction();
        try {
            // Pindahkan logo
            $newLogoPath = null;
            if ($submission->logo && Storage::disk('public')->exists($submission->logo)) {
                $newLogoPath = 'umkm_logos/' . basename($submission->logo);
                Storage::disk('public')->move($submission->logo, $newLogoPath);
            } else {
                Log::warning("Logo tidak ditemukan atau tidak ada: " . $submission->logo);
            }

            // Simpan UMKM baru
            $umkm = Umkm::create([
                'nama_umkm' => $submission->nama_umkm,
                'owner'     => $submission->owner,
                'deskripsi' => $submission->deskripsi,
                'alamat'    => $submission->alamat,
                'kontak'    => $submission->kontak,
                'logo'      => $newLogoPath,
                'gmaps'     => $submission->gmaps,
                'social'    => $submission->social,
                'store'     => $submission->store,
            ]);

            // Masukkan produk
            foreach($submission->products as $productSub){
                $newProductPath = null;
                if ($productSub->product_image && Storage::disk('public')->exists($productSub->product_image)) {
                    $newProductPath = 'product_images/' . basename($productSub->product_image);
                    Storage::disk('public')->move($productSub->product_image, $newProductPath);
                } else {
                    Log::warning("Produk image tidak ditemukan atau tidak ada: " . $productSub->product_image);
                }

                Product::create([
                    'umkm_id' => $umkm->id,
                    'nama_produk' => $productSub->nama_produk,
                    'harga' => $productSub->harga,
                    'deskripsi' => $productSub->deskripsi,
                    'product_image' => $newProductPath,
                ]);

                $productSub->delete();
            }

            $submission->delete();
            DB::commit();

            return redirect()->route('admin.service.settings')
                     ->with('success', 'Submission diterima dan dipindahkan ke tabel UMKM & Product.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("ERROR: Gagal accept submission", [
                'submission_id' => $submission->id,
                'error' => $e->getMessage()
            ]);
            return redirect()->route('admin.service.settings')
                     ->with('error', 'Terjadi kesalahan saat memproses submission.');
        }
    }

    // Reject submission
    public function reject($id)
    {
        $submission = UmkmSubmission::findOrFail($id);
        $submission->status = 'rejected';
        $submission->save();

        return redirect()->route('admin.service.settings')
                         ->with('success', 'Submission ditolak.');
    }
}
