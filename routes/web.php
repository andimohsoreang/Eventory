<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeviceCategoryController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\GedungController;
use App\Http\Controllers\TipeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});




// Authentication
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/admin/account', [AccountController::class, 'index'])->name('admin.account');
Route::get('/admin/account/create', [AccountController::class,'create'])->name('admin.account.create');

// Dashboard
Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

// Category
Route::get('/admin/category', [CategoryController::class, 'index'])->name('admin.category');


// Category Device
Route::resource('/admin/catdevice', DeviceCategoryController::class);

//Brand
Route::resource('/admin/brands', BrandController::class);

//Tipe
Route::get('/admin/tipe', [TipeController::class, 'index'])->name('admin.tipe');
Route::get('/admin/tipe/show',[TipeController::class, 'show'])->name('admin.tipe.show');

// Gedung
Route::get('admin/gedung', [GedungController::class, 'index'])->name('admin.gedung');


// Devices
Route::get('admin/devices', [DeviceController::class, 'index'])->name('admin.device');
Route::get('admin/devices/create', [DeviceController::class, 'create'])->name('admin.device.create');
Route::get('admin/devices/show', [DeviceController::class, 'show'])->name('admin.device.show');
Route::get('admin/devices/details', [DeviceController::class, 'details'])->name('admin.device.details');
