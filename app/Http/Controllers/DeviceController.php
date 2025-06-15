<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\CategoryDana;
use App\Models\Device;
use App\Models\Gedung;
use App\Models\Location;
use App\Models\Tipe;
use App\Services\RuckusService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DeviceController extends Controller
{
    protected $ruckusService;
    
    public function __construct(RuckusService $ruckusService)
    {
        $this->ruckusService = $ruckusService;
    }

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
        
        // Get zones from Ruckus service
        $zones = $this->ruckusService->getZone();
        
        // Get all buildings for each zone
        $allBuildings = [];
        if (isset($zones['list'])) {
            foreach ($zones['list'] as $zone) {
                $buildings = $this->ruckusService->getGedung($zone['id']);
                if (isset($buildings['list'])) {
                    $allBuildings[$zone['id']] = $buildings['list'];
                }
            }
        }
        
        return view('admin.devices.create', compact('tipes', 'categoriesDana', 'brands', 'zones', 'allBuildings'));
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

    /**
     * Display move location page for a specific device
     */
    public function moveLocationPage($deviceId)
    {
        // Find the device by device_id
        $device = Device::where('device_id', $deviceId)->firstOrFail();
        $gedungs = Gedung::all();
        
        // Get current location if exists
        $currentLocation = Location::where('device_id', $device->id)
            ->orderBy('created_at', 'desc')
            ->first();
            
        return view('admin.devices.move_location', compact('device', 'gedungs', 'currentLocation'));
    }

    /**
     * Process the move location request from the form
     */
    public function moveLocation(Request $request)
{
    $request->validate([
            'device_id' => 'required|string|exists:devices,device_id',
        'gedung_id' => 'required|exists:gedungs,id',
        'location' => 'required|string|max:255',
    ]);

        // Find the device by device_id
        $device = Device::where('device_id', $request->device_id)->first();
        
        if (!$device) {
            return response()->json([
                'success' => false,
                'message' => 'Device not found.',
            ], 404);
        }

        // Log for debugging
        Log::info('Moving device location', [
            'device_id' => $request->device_id,
            'device' => $device->id,
            'gedung_id' => $request->gedung_id,
            'location' => $request->location,
        ]);

    $location = Location::create([
            'device_id' => $device->id, // Use the actual device ID (primary key)
        'gedung_id' => $request->gedung_id,
        'location' => $request->location,
    ]);

        if ($request->ajax()) {
    return response()->json([
        'success' => true,
        'message' => 'Lokasi perangkat berhasil diperbarui.',
        'location' => $location,
    ]);
        }
        
        return redirect()->route('admin.device')->with('success', 'Lokasi perangkat berhasil diperbarui');
}

    /**
     * Menampilkan detail satu device.
     */
    public function show($id)
    {
        $device = Device::find($id);
        $apSummary = null;
        try {
            $apSummary = app(\App\Services\RuckusService::class)->getApSummary($device->device_id);
            Log::info($apSummary);
        } catch (\Exception $e) {
            Log::error('Error fetching AP summary: ' . $e->getMessage());
        }
        return view('admin.devices.show', compact('device', 'apSummary'));
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
        
        // Get zones from Ruckus service
        $zones = $this->ruckusService->getZone();
        
        // Get all buildings for each zone
        $allBuildings = [];
        if (isset($zones['list'])) {
            foreach ($zones['list'] as $zone) {
                $buildings = $this->ruckusService->getGedung($zone['id']);
                if (isset($buildings['list'])) {
                    $allBuildings[$zone['id']] = $buildings['list'];
                }
            }
        }
        
        return view('admin.devices.edit', compact('device', 'tipes', 'categoriesDana', 'brands', 'zones', 'allBuildings'));
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

    /**
     * Menampilkan informasi device berdasarkan device_id (untuk QR scan public)
     */
    public function publicShow($device_id)
    {
        $device = Device::where('device_id', $device_id)->firstOrFail();
        $apSummary = null;
        try {
            $apSummary = app(\App\Services\RuckusService::class)->getApSummary($device_id);
            Log::info($apSummary);
        } catch (\Exception $e) {
            Log::error('Error fetching AP summary: ' . $e->getMessage());
            $apSummary = null;
        }
        return view('public.device.show', compact('device', 'apSummary'));
    }

    /**
     * Get MAC addresses for a specific building
     */
    public function getMacAddresses($zoneId, $buildingId)
    {
        try {
            Log::info('Getting MAC addresses', [
                'zone_id' => $zoneId,
                'building_id' => $buildingId
            ]);
            
            $macs = $this->ruckusService->getMac($zoneId, $buildingId);
            return response()->json($macs);
        } catch (\Exception $e) {
            Log::error('Error getting MAC addresses', [
                'error' => $e->getMessage(),
                'zone_id' => $zoneId,
                'building_id' => $buildingId
            ]);
            return response()->json(['error' => 'Failed to get MAC addresses'], 500);
        }
    }
}
