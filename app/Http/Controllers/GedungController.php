<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GedungController extends Controller
{
    public function index()
    {
        return view('admin.gedung.index');
    }
}
