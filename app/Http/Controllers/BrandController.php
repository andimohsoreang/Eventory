<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    /**
     * Tampilkan daftar brand.
     */
    public function index()
    {
        $brands = Brand::all();
        return view('admin.brands.index', compact('brands'));
    }

    /**
     * Simpan data brand baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            // Jika slug tidak diisi, otomatis dibuat dari name.
            'slug' => 'nullable|string|max:255|unique:brands,slug',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->only('name', 'slug');

        // Jika slug tidak diisi, generate slug dari nama
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        // Cek dan simpan file logo jika ada
        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('logos', 'public');
            $data['logo'] = $path;
        }

        Brand::create($data);

        return redirect()->route('admin.brand')->with('success', 'Brand berhasil ditambahkan');
    }

    /**
     * Update data brand yang sudah ada.
     */
    public function update(Request $request, Brand $brand)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:brands,slug,' . $brand->id,
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->only('name', 'slug');

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        // Jika ada file logo baru, hapus logo lama (jika ada) dan simpan logo baru
        if ($request->hasFile('logo')) {
            if ($brand->logo && Storage::disk('public')->exists($brand->logo)) {
                Storage::disk('public')->delete($brand->logo);
            }
            $path = $request->file('logo')->store('logos', 'public');
            $data['logo'] = $path;
        }

        $brand->update($data);

        return redirect()->route('admin.brand')->with('success', 'Brand berhasil diupdate');
    }

    /**
     * Hapus data brand.
     */
    public function destroy(Brand $brand)
    {
        if ($brand->logo && Storage::disk('public')->exists($brand->logo)) {
            Storage::disk('public')->delete($brand->logo);
        }

        $brand->delete();

        return redirect()->route('admin.brand')->with('success', 'Brand berhasil dihapus');
    }
}
