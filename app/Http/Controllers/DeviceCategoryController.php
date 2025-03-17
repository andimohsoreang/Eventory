<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DeviceCategoryController extends Controller
{
    public function index()
    {
        return view('admin.catdevices.index');
    }
}
