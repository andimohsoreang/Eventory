<?php

namespace App\Http\Controllers;

use App\Models\CategoryDana;
use Illuminate\Http\Request;

class CategoryDanaController extends Controller
{
    /**
     * Tampilkan halaman index kategori dana.
     */
    public function index()
    {
        $categories = CategoryDana::all();
        return view('admin.categoryDana.index', compact('categories'));
    }

    /**
     * Simpan kategori dana baru.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Slug otomatis dibuat di model (pada method boot)
        CategoryDana::create($validatedData);

        return redirect()
            ->route('admin.category')
            ->with('success', 'Kategori Dana berhasil ditambahkan');
    }

    /**
     * Perbarui kategori dana yang ada.
     */
    public function update(Request $request, CategoryDana $categoryDana)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $categoryDana->update($validatedData);

        return redirect()
            ->route('admin.category')
            ->with('success', 'Kategori Dana berhasil diupdate');
    }

    /**
     * Hapus kategori dana.
     */
    public function destroy(CategoryDana $categoryDana)
    {
        $categoryDana->delete();

        return redirect()
            ->route('admin.category')
            ->with('success', 'Kategori Dana berhasil dihapus');
    }
}
