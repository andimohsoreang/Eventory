<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TipeController extends Controller
{
    public function index()
    {
        return view('admin.tipe.index');
    }

    public function show()
    {
        return view('admin.tipe.show');
    }
}
