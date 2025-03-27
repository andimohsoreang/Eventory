<?php

namespace App\Http\Controllers;

use App\Models\Gedung;
use App\Models\Device;
use App\Models\Location;
use Illuminate\Support\Facades\DB;

class LandingController extends Controller
{
    public function index()
    {
        $gedungs = Gedung::withCount(['location as active_device_count' => function($query) {
            $query->whereHas('device', function($q) {
                $q->where('isActive', 1);
            });
        }])->get();

        return view('welcome', compact('gedungs'));
    }

    public function gedungShow($gedung)
    {
        $gedung = \App\Models\Gedung::findOrFail($gedung);
        $activeDevices = \App\Models\Device::where('isActive', 1)
            ->whereHas('location', function($query) use ($gedung) {
                $query->where('gedung_id', $gedung->id)
                    ->whereIn('id', function($subquery) {
                        $subquery->select(\DB::raw('MAX(id)'))
                            ->from('locations')
                            ->groupBy('device_id');
                    });
            })
            ->with(['tipe', 'brand'])
            ->get();
        return view('public.gedung.show', compact('gedung', 'activeDevices'));
    }
} 