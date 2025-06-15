<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\DeviceNote;
use Illuminate\Http\Request;

class DeviceNoteController extends Controller
{
    /**
     * Store a newly created note in storage.
     */
    public function store(Request $request, Device $device)
    {
        $request->validate([
            'description' => 'required|string'
        ]);

        $device->notes()->create([
            'description' => $request->description
        ]);

        return redirect()->back()->with('success', 'Note added successfully');
    }

    /**
     * Remove the specified note from storage.
     */
    public function destroy(DeviceNote $note)
    {
        $note->delete();
        return redirect()->back()->with('success', 'Note deleted successfully');
    }
} 