<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CategoryDanaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeviceCategoryController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\GedungController;
use App\Http\Controllers\TipeController;
use App\Http\Controllers\DeviceNoteController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', [\App\Http\Controllers\LandingController::class, 'index'])->name('landing');

// Authentication
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// User Management
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users');
    Route::post('/admin/users', [UserController::class, 'store'])->name('admin.users.store');
    Route::put('/admin/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
});

Route::get('/admin/account', [AccountController::class, 'index'])->name('admin.account');
Route::post('/admin/account', [AccountController::class, 'store'])->name('admin.account.store');
Route::put('/admin/account/{account}', [AccountController::class, 'update'])->name('admin.account.update');
Route::delete('/admin/account/{account}', [AccountController::class, 'destroy'])->name('admin.account.destroy');

// Dashboard
Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

// Category
// Route::get('/admin/category', [CategoryController::class, 'index'])->name('admin.category');
Route::get('/admin/category', [CategoryDanaController::class, 'index'])->name('admin.category');
Route::post('/admin/category', [CategoryDanaController::class, 'store'])->name('admin.category.store');
Route::put('/admin/category/{categoryDana}', [CategoryDanaController::class, 'update'])->name('admin.category.update');
Route::delete('/admin/category/{categoryDana}', [CategoryDanaController::class, 'destroy'])->name('admin.category.destroy');

Route::get('/admin/brand', [BrandController::class, 'index'])->name('admin.brand');
Route::post('/admin/brand', [BrandController::class, 'store'])->name('admin.brand.store');
Route::put('/admin/brand/{brand}', [BrandController::class, 'update'])->name('admin.brand.update');
Route::delete('/admin/brand/{brand}', [BrandController::class, 'destroy'])->name('admin.brand.destroy');

Route::get('/admin/tipe', [TipeController::class, 'index'])->name('admin.tipe');
Route::get('/admin/tipe/{tipe}', [TipeController::class, 'show'])->name('admin.tipe.show');
Route::post('/admin/tipe', [TipeController::class, 'store'])->name('admin.tipe.store');
Route::put('/admin/tipe/{tipe}', [TipeController::class, 'update'])->name('admin.tipe.update');
Route::delete('/admin/tipe/{tipe}', [TipeController::class, 'destroy'])->name('admin.tipe.destroy');

Route::get('/admin/brands', [BrandController::class, 'index'])->name('admin.brand');
Route::post('/admin/brands', [BrandController::class, 'store'])->name('admin.brand.store');
Route::put('/admin/brands/{brand}', [BrandController::class, 'update'])->name('admin.brand.update');
Route::delete('/admin/brands/{brand}', [BrandController::class, 'destroy'])->name('admin.brand.destroy');

// Gedung
Route::get('/admin/gedung', [GedungController::class, 'index'])->name('admin.gedung');
Route::get('/admin/gedung/{gedung}', [GedungController::class, 'show'])->name('admin.gedung.show');
Route::post('/admin/gedung', [GedungController::class, 'store'])->name('admin.gedung.store');
Route::put('/admin/gedung/{gedung}', [GedungController::class, 'update'])->name('admin.gedung.update');
Route::delete('/admin/gedung/{gedung}', [GedungController::class, 'destroy'])->name('admin.gedung.destroy');
Route::get('/admin/gedung/{gedung}/edit', [GedungController::class, 'edit'])->name('admin.gedung.edit');
Route::get('/gedung/{gedung}/device', [\App\Http\Controllers\LandingController::class, 'gedungShow'])->name('public.gedung.show');
Route::get('/admin/zone/{zoneId}/buildings', [GedungController::class, 'getGedungByZone'])->name('admin.zone.buildings');

Route::get('/admin/device', [DeviceController::class, 'index'])->name('admin.device');
Route::get('/admin/device/create', [DeviceController::class, 'create'])->name('admin.device.create');
Route::post('/admin/device', [DeviceController::class, 'store'])->name('admin.device.store');
Route::get('/admin/device/{id}/show', [DeviceController::class, 'show'])->name('admin.device.show');
Route::get('/admin/device/{device}/edit', [DeviceController::class, 'edit'])->name('admin.device.edit');
Route::put('/admin/device/{device}', [DeviceController::class, 'update'])->name('admin.device.update');
Route::delete('/admin/device/{device}', [DeviceController::class, 'destroy'])->name('admin.device.destroy');
Route::post('/admin/device/move-location', [DeviceController::class, 'moveLocation'])->name('admin.device.move-location');
Route::get('/admin/device/{deviceId}/move-location', [DeviceController::class, 'moveLocationPage'])->name('admin.device.move-location-page');
Route::get('admin/devices/{id}/details', [DeviceController::class, 'show'])->name('admin.device.details');
Route::get('/admin/device/get-macs/{zoneId}/{buildingId}', [DeviceController::class, 'getMacAddresses'])->name('admin.device.get-macs');

// Devices
Route::get('admin/devices', [DeviceController::class, 'index'])->name('admin.device');
// Route::get('admin/devices/create', [DeviceController::class, 'create'])->name('admin.device.create');
Route::get('device/public/{device_id}', [DeviceController::class, 'publicShow'])->name('admin.device.public');

// Device Notes routes
Route::post('/admin/device/{device}/notes', [DeviceNoteController::class, 'store'])->name('admin.device.notes.store');
Route::delete('/admin/device/notes/{note}', [DeviceNoteController::class, 'destroy'])->name('admin.device.notes.destroy');