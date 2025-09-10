<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UmkmSubmission;
use App\Models\ProductSubmission;
use App\Models\Umkm;
use App\Models\Product;
use App\Models\ServiceSetting;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdminUmkmSubmissionController extends Controller
{
    public function serviceSettings()
    {
        $submissions = UmkmSubmission::with('products')
            ->orderBy('created_at', 'desc')
            ->get();

        $settings = ServiceSetting::first();
        return view('admin.setting.form', compact('submissions', 'settings'));
    }

    public function updateServiceSettings(Request $request)
    {
        $validated = $request->validate([
            'judul_hero' => 'nullable|string|max:255',
            'subjudul_hero' => 'nullable|string',
        ]);

        ServiceSetting::updateOrCreate(['id' => 1], $validated);
        return redirect()->back()->with('success', 'Service settings berhasil diperbarui.');
    }

    public function index()
    {
        $submissions = UmkmSubmission::with('products')->orderBy('created_at','desc')->get();
        return view('admin.submissions.index', compact('submissions'));
    }

    public function show($id)
    {
        $submission = UmkmSubmission::with('products')->findOrFail($id);
        return view('admin.submissions.show', compact('submission'));
    }

    public function accept($id)
    {
        $submission = UmkmSubmission::with('products')->findOrFail($id);

        DB::beginTransaction();
        try {
            $umkm = Umkm::create([
                'nama_umkm' => $submission->nama_umkm,
                'owner' => $submission->owner,
                'deskripsi' => $submission->deskripsi,
                'alamat' => $submission->alamat,
                'kontak' => $submission->kontak,
                'gambar' => $submission->gambar, // <-- ganti logo jadi gambar
                'gmaps' => $submission->gmaps,
                'social' => $submission->social,
                'store' => $submission->store,
            ]);

            foreach ($submission->products as $productSub) {
                Product::create([
                    'umkm_id' => $umkm->id,
                    'nama_produk' => $productSub->nama_produk,
                    'harga' => $productSub->harga,
                    'deskripsi' => $productSub->deskripsi,
                    'product_image' => $productSub->product_image,
                ]);
            }

            $submission->status = 'accepted';
            $submission->save();

            DB::commit();
            return redirect()->route('admin.service.settings')
                ->with('success', 'Submission diterima, data UMKM & produk sudah dibuat.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Gagal accept submission: " . $e->getMessage());
            return redirect()->route('admin.service.settings')
                ->with('error', 'Terjadi kesalahan saat memproses submission.');
        }
    }

    public function reject($id)
    {
        $submission = UmkmSubmission::findOrFail($id);
        $submission->status = 'rejected';
        $submission->save();

        return redirect()->route('admin.service.settings')
            ->with('success', 'Submission ditolak.');
    }
}
