<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DeviceController extends Controller
{
    public function index()
    {
        return view('admin.devices.index');
    }

    public function create()
    {
        return view('admin.devices.create');
    }

    public function show()
    {
        return view('admin.devices.show');
    }

    public function details()
    {
        return view('admin.devices.details');
    }
}
