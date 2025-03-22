<?php

namespace App\Http\Controllers;

use App\Models\Tipe;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class TipeController extends Controller
{
    /**
     * Tampilkan halaman daftar tipe.
     */
    public function index()
    {
        $tipe = Tipe::all();
        return view('admin.tipe.index', compact('tipe'));
    }

    /**
     * Tampilkan detail satu tipe.
     */
    public function show(Tipe $tipe)
    {
        return view('admin.tipe.show', compact('tipe'));
    }

    /**
     * Simpan data tipe baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'file' => 'nullable|', 
            'icon'    => 'nullable|string',
            'isRuckus'=> 'required|boolean',
        ]);

        if ($request->hasFile('file')) {
            $extension = $request->file('file')->getClientOriginalExtension();
            $fileName = uniqid() . '.' . $extension;
            $path = $request->file('file')->storeAs('tipe_files', $fileName, 'public');
            $validated['file'] = $path;
        }
        

        Tipe::create($validated);

        return redirect()->route('admin.tipe')->with('success', 'Tipe berhasil ditambahkan');
    }

    /**
     * Update data tipe yang sudah ada.
     */
    public function update(Request $request, Tipe $tipe)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'slug'    => 'nullable|string|max:255|unique:tipes,slug,' . $tipe->id,
            'file'    => 'nullable|file|mimes:stl,obj,fbx,dae,glb,ply|max:10000',
            'icon'    => 'nullable|string|max:255',
            'isRuckus'=> 'required|boolean',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        // Jika ada file baru, hapus file lama (jika ada) dan simpan file baru
        if ($request->hasFile('file')) {
            if ($tipe->file && Storage::disk('public')->exists($tipe->file)) {
                Storage::disk('public')->delete($tipe->file);
            }
            $path = $request->file('file')->store('tipe_files', 'public');
            $validated['file'] = $path;
        }

        $tipe->update($validated);

        return redirect()->route('admin.tipe')->with('success', 'Tipe berhasil diupdate');
    }

    /**
     * Hapus data tipe.
     */
    public function destroy(Tipe $tipe)
    {
        // Hapus file 3D model jika ada
        if ($tipe->file && Storage::disk('public')->exists($tipe->file)) {
            Storage::disk('public')->delete($tipe->file);
        }

        $tipe->delete();

        return redirect()->route('admin.tipe')->with('success', 'Tipe berhasil dihapus');
    }
}
