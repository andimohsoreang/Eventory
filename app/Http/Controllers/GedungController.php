<?php

namespace App\Http\Controllers;

use App\Models\Gedung;
use App\Models\Device;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class GedungController extends Controller
{
    /**
     * Menampilkan daftar gedung.
     */
    public function index()
    {
        // Mengambil semua data gedung beserta relasi parent (jika ada)
        $gedungs = Gedung::with('parent')->get();
        $parent = Gedung::all();
        return view('admin.gedung.index', compact('gedungs', 'parent'));
    }

    /**
     * Menampilkan detail satu gedung beserta device yang berada di gedung tersebut.
     */
    public function show(Gedung $gedung)
    {
        // Get all devices currently in this building
        $currentDevices = Device::whereHas('location', function($query) use ($gedung) {
            $query->where('gedung_id', $gedung->id)
                ->whereIn('id', function($subquery) {
                    $subquery->select(DB::raw('MAX(id)'))
                        ->from('locations')
                        ->groupBy('device_id');
                });
        })->with(['tipe', 'brand', 'location' => function($query) {
            $query->latest()->first();
        }])->get();
        
        // Get history of all devices that have been in this building
        $deviceHistory = Location::where('gedung_id', $gedung->id)
            ->with(['device', 'device.tipe'])
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy('device_id');
            
        // Get count of devices by type
        $devicesByType = Device::whereHas('location', function($query) use ($gedung) {
            $query->where('gedung_id', $gedung->id)
                ->whereIn('id', function($subquery) {
                    $subquery->select(DB::raw('MAX(id)'))
                        ->from('locations')
                        ->groupBy('device_id');
                });
        })
        ->join('tipes', 'devices.tipe_id', '=', 'tipes.id')
        ->select('tipes.name as type_name', DB::raw('count(*) as count'))
        ->groupBy('tipes.name')
        ->get();
        
        return view('admin.gedung.show', compact('gedung', 'currentDevices', 'deviceHistory', 'devicesByType'));
    }

    /**
     * Menyimpan data gedung baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'      => 'required|string|max:255',
            'lokasi'    => 'nullable|string',
            'parent_id' => 'nullable|exists:gedungs,id',
            'photo'     => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Jika slug tidak diisi, buat otomatis dari name
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        // Jika ada foto, simpan dengan ekstensi asli file
        if ($request->hasFile('photo')) {
            $extension = $request->file('photo')->getClientOriginalExtension();
            $fileName = uniqid() . '.' . $extension;
            $path = $request->file('photo')->storeAs('gedung_photos', $fileName, 'public');
            $validated['photo'] = $path;
        }

        Gedung::create($validated);

        return redirect()->route('admin.gedung')->with('success', 'Gedung berhasil ditambahkan');
    }

    /**
     * Mengupdate data gedung yang sudah ada.
     */
    public function update(Request $request, Gedung $gedung)
    {
        $validated = $request->validate([
            'name'      => 'required|string|max:255',
            'lokasi'    => 'nullable|string',
            'slug'      => 'nullable|string|max:255|unique:gedungs,slug,' . $gedung->id,
            'parent_id' => 'nullable|exists:gedungs,id',
            'photo'     => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        // Jika ada foto baru, hapus foto lama (jika ada) dan simpan yang baru
        if ($request->hasFile('photo')) {
            if ($gedung->photo && Storage::disk('public')->exists($gedung->photo)) {
                Storage::disk('public')->delete($gedung->photo);
            }
            $extension = $request->file('photo')->getClientOriginalExtension();
            $fileName = uniqid() . '.' . $extension;
            $path = $request->file('photo')->storeAs('gedung_photos', $fileName, 'public');
            $validated['photo'] = $path;
        }

        $gedung->update($validated);

        return redirect()->route('admin.gedung')->with('success', 'Gedung berhasil diupdate');
    }

    /**
     * Menghapus data gedung.
     */
    public function destroy(Gedung $gedung)
    {
        if ($gedung->photo && Storage::disk('public')->exists($gedung->photo)) {
            Storage::disk('public')->delete($gedung->photo);
        }

        $gedung->delete();

        return redirect()->route('admin.gedung')->with('success', 'Gedung berhasil dihapus');
    }

    /**
     * Menampilkan form edit untuk gedung.
     */
    public function edit(Gedung $gedung)
    {
        $parent = Gedung::all();
        return view('admin.gedung.edit', compact('gedung', 'parent'));
    }
}
