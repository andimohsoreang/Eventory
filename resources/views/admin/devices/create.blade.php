@extends('layouts.app')
@section('content')
@section('title', 'Tambah Device')
@push('links')
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- Sweet Alert -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css" rel="stylesheet">
    
    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        .select2-container--default .select2-selection--single {
            height: 38px;
            border: 1px solid #e2e5e8;
            border-radius: 4px;
            background-color: #fff;
            box-shadow: none;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 36px;
            padding-left: 12px;
            color: #495057;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 36px;
            right: 6px;
        }

        .select2-dropdown {
            border: 1px solid #e2e5e8;
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        .select2-container--default .select2-search--dropdown .select2-search__field {
            border: 1px solid #e2e5e8;
            border-radius: 4px;
            padding: 8px;
        }

        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: #5156be;
            color: white;
        }
    </style>
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
                    
                    <!-- Zone Selection -->
                    <div class="mb-3 row">
                        <label for="zone_id" class="col-sm-3 col-form-label text-end">Zone Ruckus</label>
                        <div class="col-sm-9">
                            <select class="form-control select2" id="zone_id" name="zone_id">
                                <option value="">Pilih Zone Ruckus</option>
                                @if(isset($zones['list']))
                                    @foreach ($zones['list'] as $zone)
                                        <option value="{{ $zone['id'] }}">{{ $zone['name'] }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                    <!-- Building Selection -->
                    <div class="mb-3 row">
                        <label for="building_id" class="col-sm-3 col-form-label text-end">Gedung Ruckus</label>
                        <div class="col-sm-9">
                            <select class="form-control select2" id="building_id" name="building_id">
                                <option value="">Pilih Gedung Ruckus</option>
                            </select>
                        </div>
                    </div>

                    <!-- Device ID with MAC Address Selection -->
                    <div class="mb-3 row">
                        <label for="device_id" class="col-sm-3 col-form-label text-end">Device ID <span
                                class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <input type="text" class="form-control" name="device_id" id="device_id"
                                    placeholder="Masukkan Device ID atau pilih MAC Address" required>
                                <button class="btn btn-outline-secondary" type="button" id="getMacBtn" disabled>
                                    Get MAC
                                </button>
                            </div>
                            <select class="form-control mt-2 d-none" id="mac_addresses">
                                <option value="">Pilih MAC Address</option>
                            </select>
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
                            <select class="form-control select2" name="isActive" id="isActive" required>
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
    <script>
        // Store buildings data from PHP
        const buildingsData = @json($allBuildings);
        
        $(document).ready(function() {
            // Initialize Select2
            $('.select2').select2({
                width: '100%',
                placeholder: function() {
                    return $(this).data('placeholder') || 'Pilih opsi';
                }
            });

            // Function to populate building select based on zone
            function populateBuildings(zoneId) {
                const buildings = buildingsData[zoneId] || [];
                let options = '<option value="">Pilih Gedung</option>';
                
                buildings.forEach(function(building) {
                    options += `<option value="${building.id}">${building.name}</option>`;
                });
                
                $('#building_id').html(options).trigger('change');
            }

            // Zone change handler
            $('#zone_id').on('change', function() {
                const zoneId = $(this).val();
                populateBuildings(zoneId);
                $('#getMacBtn').prop('disabled', true);
                $('#mac_addresses').addClass('d-none').html('<option value="">Pilih MAC Address</option>');
            });

            // Building change handler
            $('#building_id').on('change', function() {
                const buildingId = $(this).val();
                $('#getMacBtn').prop('disabled', !buildingId);
                $('#mac_addresses').addClass('d-none').html('<option value="">Pilih MAC Address</option>');
            });

            // Get MAC addresses button handler
            $('#getMacBtn').on('click', function() {
                const zoneId = $('#zone_id').val();
                const buildingId = $('#building_id').val();
                if (!zoneId || !buildingId) {
                    alert('Please select both Zone and Building first');
                    return;
                }

                $.ajax({
                    url: `/admin/device/get-macs/${zoneId}/${buildingId}`,
                    type: 'GET',
                    beforeSend: function() {
                        $('#getMacBtn').prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Loading...');
                    },
                    success: function(response) {
                        console.log('MAC response:', response);
                        if (response && response.members) {
                            let options = '<option value="">Pilih MAC Address</option>';
                            response.members.forEach(function(ap) {
                                options += `<option value="${ap.apMac}">${ap.apMac} - ${ap.apSerial || 'Unnamed'}</option>`;
                            });
                            $('#mac_addresses')
                                .html(options)
                                .removeClass('d-none')
                                .select2({
                                    width: '100%',
                                    placeholder: 'Pilih MAC Address'
                                });
                        } else {
                            alert('No MAC addresses found for this building');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching MAC addresses:', error);
                        alert('Failed to fetch MAC addresses. Please try again.');
                    },
                    complete: function() {
                        $('#getMacBtn').prop('disabled', false).html('Get MAC');
                    }
                });
            });

            // MAC address selection handler
            $('#mac_addresses').on('change', function() {
                const mac = $(this).val();
                if (mac) {
                    $('#device_id').val(mac);
                }
            });

            // Allow manual device ID input
            $('#device_id').on('input', function() {
                $('#mac_addresses').val('').trigger('change');
            });
        });
    </script>
@endpush
@endsection
