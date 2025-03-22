@extends('layouts.app')
@section('content')
@section('title', 'Tambah Device')
@push('links')
    <!-- Sweet Alert -->
    <link href="{{ asset('dist/assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
    <!-- Select2 -->
    <link href="{{ asset('dist/assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css">
@endpush

<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box d-md-flex justify-content-md-between align-items-center">
            <h4 class="page-title">Device</h4>
            <div class="">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="#">Device</a></li>
                    <li class="breadcrumb-item active">Tambah Device</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- Form Create Device -->
<div class="row justify-content-center">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Form Tambah Device</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.device.store') }}" method="POST" enctype="multipart/form-data"
                    id="deviceForm">
                    @csrf
                    <!-- Device ID (misal, nama perangkat sebagai identitas) -->
                    <div class="mb-3 row">
                        <label for="device_id" class="col-sm-3 col-form-label text-end">Device ID <span
                                class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="device_id" id="device_id"
                                placeholder="Masukkan Device ID" required>
                        </div>
                    </div>

                    <!-- Tipe Device -->
                    <div class="mb-3 row">
                        <label for="tipe_id" class="col-sm-3 col-form-label text-end">Tipe Device <span
                                class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-control select2" name="tipe_id" id="tipe_id" required>
                                <option value="">-- Pilih Tipe Device --</option>
                                @foreach ($tipes as $tipe)
                                    <option value="{{ $tipe->id }}">{{ $tipe->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Category Dana -->
                    <div class="mb-3 row">
                        <label for="category_dana_id" class="col-sm-3 col-form-label text-end">Category Dana <span
                                class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-control select2" name="category_dana_id" id="category_dana_id" required>
                                <option value="">-- Pilih Category Dana --</option>
                                @foreach ($categoriesDana as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Brand -->
                    <div class="mb-3 row">
                        <label for="brand_id" class="col-sm-3 col-form-label text-end">Brand <span
                                class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-control select2" name="brand_id" id="brand_id" required>
                                <option value="">-- Pilih Brand --</option>
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Status (isActive) -->
                    <div class="mb-3 row">
                        <label for="isActive" class="col-sm-3 col-form-label text-end">Status <span
                                class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-control" name="isActive" id="isActive" required>
                                <option value="">-- Pilih Status --</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>

                    <!-- Sticker (BMN Sticker) sebagai Gambar -->
                    <div class="mb-3 row">
                        <label for="sticker" class="col-sm-3 col-form-label text-end">BMN Sticker <span
                                class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="file" class="form-control" id="sticker" name="sticker" accept="image/*"
                                required>
                            <small class="form-text text-muted">Format: PNG/JPG (max: 2MB)</small>
                        </div>
                    </div>



                    <!-- Foto Device (Opsional) -->
                    <h5 class="mb-3 mt-4">Foto Device</h5>
                    <!-- Foto Depan -->
                    <div class="mb-3 row">
                        <label for="foto_depan" class="col-sm-3 col-form-label text-end">Foto Depan</label>
                        <div class="col-sm-9">
                            <input type="file" class="form-control" name="foto_depan" id="foto_depan"
                                accept="image/*">
                        </div>
                    </div>

                    <!-- Foto Belakang -->
                    <div class="mb-3 row">
                        <label for="foto_belakang" class="col-sm-3 col-form-label text-end">Foto Belakang</label>
                        <div class="col-sm-9">
                            <input type="file" class="form-control" name="foto_belakang" id="foto_belakang"
                                accept="image/*">
                        </div>
                    </div>

                    <!-- Foto Terpasang -->
                    <div class="mb-3 row">
                        <label for="foto_terpasang" class="col-sm-3 col-form-label text-end">Foto Terpasang</label>
                        <div class="col-sm-9">
                            <input type="file" class="form-control" name="foto_terpasang" id="foto_terpasang"
                                accept="image/*">
                        </div>
                    </div>

                    <!-- Foto Serial -->
                    <div class="mb-3 row">
                        <label for="foto_serial" class="col-sm-3 col-form-label text-end">Foto Serial</label>
                        <div class="col-sm-9">
                            <input type="file" class="form-control" name="foto_serial" id="foto_serial"
                                accept="image/*">
                        </div>
                    </div>


                    <div class="row mt-4">
                        <div class="col-12 text-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-save me-1"></i> Simpan
                            </button>
                            <a href="{{ route('admin.device') }}" class="btn btn-secondary ms-2">
                                <i class="fa fa-arrow-left me-1"></i> Kembali
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <!-- Select2 -->
    <script src="{{ asset('dist/assets/libs/select2/js/select2.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@endpush
@endsection
