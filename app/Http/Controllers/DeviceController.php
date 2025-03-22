<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\CategoryDana;
use App\Models\Device;
use App\Models\Gedung;
use App\Models\Location;
use App\Models\Tipe;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    /**
     * Menampilkan daftar device.
     */
    public function index()
    {
        // Jika perlu, ambil data device beserta relasi (tipe, categoryDana, brand)
        $devices = Device::with(['tipe', 'categoryDana', 'brand'])->get();
        $gedungs = Gedung::all();
        return view('admin.devices.index', compact('devices', 'gedungs'));
    }

    /**
     * Menampilkan form untuk membuat device baru.
     */
    public function create()
    {
        $tipes = Tipe::all();
        $categoriesDana = CategoryDana::all();
        $brands = Brand::all();
        return view('admin.devices.create', compact('tipes', 'categoriesDana', 'brands'));
    }

    /**
     * Menyimpan data device baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'device_id' => 'required|string|unique:devices',
            'tipe_id' => 'required|exists:tipes,id',
            'category_dana_id' => 'required',
            'brand_id' => 'required|exists:brands,id',
            'isActive' => 'required|boolean',
            'sticker' => 'image|mimes:jpeg,png,jpg|max:2048',
            'foto_depan' => 'image|mimes:jpeg,png,jpg|max:2048',
            'foto_belakang' => 'image|mimes:jpeg,png,jpg|max:2048',
            'foto_terpasang' => 'image|mimes:jpeg,png,jpg|max:2048',
            'foto_serial' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $device = new Device($request->except(['foto_depan', 'foto_belakang', 'foto_terpasang', 'foto_serial']));


        if ($request->hasFile('sticker')) {
            $device->sticker = $request->file('sticker')->store('devices/stickers', 'public');
        }
        if ($request->hasFile('foto_depan')) {
            $device->foto_depan = $request->file('foto_depan')->store('devices', 'public');
        }
        if ($request->hasFile('foto_belakang')) {
            $device->foto_belakang = $request->file('foto_belakang')->store('devices', 'public');
        }
        if ($request->hasFile('foto_terpasang')) {
            $device->foto_terpasang = $request->file('foto_terpasang')->store('devices', 'public');
        }
        if ($request->hasFile('foto_serial')) {
            $device->foto_serial = $request->file('foto_serial')->store('devices', 'public');
        }

        $device->save();

        return redirect()->route('admin.device')->with('success', 'Device berhasil ditambahkan');
    }

    public function moveLocation(Request $request)
{
    $request->validate([
        'device_id' => 'required|exists:devices,id',
        'gedung_id' => 'required|exists:gedungs,id',
        'location' => 'required|string|max:255',
    ]);

    $location = Location::create([
        'device_id' => $request->device_id,
        'gedung_id' => $request->gedung_id,
        'location' => $request->location,
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Lokasi perangkat berhasil diperbarui.',
        'location' => $location,
    ]);
}

    /**
     * Menampilkan detail satu device.
     */
    public function show($id)
    {
        $device = Device::find($id);
        return view('admin.devices.show', compact('device'));
    }

    /**
     * Menampilkan halaman detail device (bisa digunakan untuk tampilan lebih lengkap).
     */
    public function details(Device $device)
    {
        return view('admin.devices.details', compact('device'));
    }

    /**
     * Menampilkan form untuk mengedit device.
     */
    public function edit(Device $device)
    {
        $tipes = Tipe::all();
        $categoriesDana = CategoryDana::all();
        $brands = Brand::all();
        return view('admin.device.edit', compact('device', 'tipes', 'categoriesDana', 'brands'));
    }

    /**
     * Mengupdate data device yang sudah ada.
     */
    public function update(Request $request, Device $device)
    {
        $validated = $request->validate([
            'device_id' => 'required|string|max:255|unique:devices,device_id,' . $device->id,
            'tipe_id' => 'required|exists:tipes,id',
            'category_dana_id' => 'required|exists:category_danas,id',
            'brand_id' => 'required|exists:brands,id',
            'isActive' => 'required|boolean',
            'sticekr' => 'nullable|string|max:255',
        ]);

        $device->update($validated);

        return redirect()->route('admin.device')->with('success', 'Device berhasil diupdate');
    }

    /**
     * Menghapus data device.
     */
    public function destroy(Device $device)
    {
        $device->delete();
        return redirect()->route('admin.device')->with('success', 'Device berhasil dihapus');
    }
}
