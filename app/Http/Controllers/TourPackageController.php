<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\TourPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Inertia\Inertia;

class TourPackageController extends Controller
{
    public function index()
    {
        $packages = TourPackage::latest()->get();

        return Inertia::render('admin/packages/Index', [
            'packages' => $packages,
        ]);
    }

    // public function show($slug)
    // {
    //     $package = TourPackage::where('slug', $slug)
    //         ->where('is_active', true)
    //         ->firstOrFail();

    //     return Inertia::render('public/packages/Show', [
    //         'package' => $package,
    //         'whatsappNumber' => config('services.whatsapp.number', '6281234567890'), // Ganti dengan nomor WA kamu (format 62)
    //     ]);
    // }

    public function show($slug)
    {
        $package = TourPackage::with('services')
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        return Inertia::render('public/packages/Show', [
            'package' => $package,
            'whatsappNumber' => config('services.whatsapp.number', '6281234567890'),
        ]);
    }

    public function create()
    {
        return Inertia::render('admin/packages/Create', [
            'services' => Service::all(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'duration_days' => 'required|integer|min:1',
            'duration_nights' => 'required|integer|min:0',
            'max_capacity' => 'required|integer|min:1',
            'short_description' => 'required|string|max:500',
            'description' => 'nullable|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // Max 2MB
            'services' => 'nullable|array',
            'services.*' => 'exists:services,id',
        ]);

        // Generate slug dari title
        $validated['slug'] = Str::slug($validated['title']).'-'.Str::random(5);

        // Proses upload thumbnail jika ada
        if ($request->hasFile('thumbnail')) {
            $filename = Str::slug($validated['title']).'-'.Str::random(5).'.'.$request->file('thumbnail')->getClientOriginalExtension();
            $request->file('thumbnail')->move(public_path('packages'), $filename);
            $validated['thumbnail'] = '/packages/'.$filename;
        }

        // Pisahkan data services dari array validated agar tidak error saat insert ke table tour_packages
        $serviceIds = $validated['services'] ?? [];
        unset($validated['services']);

        // 1. Buat record TourPackage baru dulu
        $package = TourPackage::create($validated);

        // 2. Hubungkan data services via relasi pivot sync()
        if (! empty($serviceIds)) {
            $package->services()->sync($serviceIds);
        }

        Inertia::flash('toast', ['type' => 'success', 'message' => 'Paket wisata berhasil ditambahkan!']);

        return redirect()->route('admin.packages.index');
    }

    public function edit(TourPackage $package)
    {
        return Inertia::render('admin/packages/Edit', [
            'package' => $package,
            'services' => Service::all(),
        ]);
    }

    public function update(Request $request, TourPackage $package)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'short_description' => 'required|string|max:500',
            'price' => 'required|numeric|min:0',
            'duration_days' => 'required|integer|min:1',
            'duration_nights' => 'required|integer|min:0',
            'max_capacity' => 'required|integer|min:1',
            'is_active' => 'boolean',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'services' => 'nullable|array',
            'services.*' => 'exists:services,id',
        ]);

        // Update slug jika title berubah
        if ($package->title !== $validated['title']) {
            $validated['slug'] = Str::slug($validated['title']).'-'.Str::random(5);
        }

        // Cek jika ada upload foto baru
        if ($request->hasFile('thumbnail')) {
            // Hapus foto lama jika ada
            if ($package->thumbnail) {
                $oldPath = public_path($package->thumbnail);
                if (File::exists($oldPath)) {
                    File::delete($oldPath);
                }
            }

            // Simpan foto baru
            $filename = Str::slug($validated['title']).'-'.Str::random(5).'.'.$request->file('thumbnail')->getClientOriginalExtension();
            $request->file('thumbnail')->move(public_path('packages'), $filename);
            $validated['thumbnail'] = '/packages/'.$filename;
        } else {
            // Jangan timpa thumbnail jika tidak ada file baru yang diunggah
            unset($validated['thumbnail']);
        }

        // Pisahkan data services dari array validated agar tidak error SQL
        $serviceIds = $validated['services'] ?? [];
        unset($validated['services']);

        // 1. Update data dasar paket wisata
        $package->update($validated);

        // 2. Sync relasi pivot services (akan otomatis menghapus/menambah pivot yang dicentang)
        $package->services()->sync($serviceIds);

        Inertia::flash('toast', ['type' => 'success', 'message' => 'Paket berhasil diperbarui']);

        return redirect()->route('admin.packages.index');
    }

    public function destroy(TourPackage $package)
    {
        // Hapus file gambar jika ada
        if ($package->thumbnail) {
            $path = public_path($package->thumbnail);
            if (File::exists($path)) {
                File::delete($path);
            }
        }

        $package->delete();

        Inertia::flash('toast', ['type' => 'success', 'message' => 'Paket berhasil dihapus']);

        return redirect()->back();
    }
}
