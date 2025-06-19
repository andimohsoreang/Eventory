@extends('layouts.app')
@section('content')
@section('title', 'Edit Device')
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
                    <li class="breadcrumb-item"><a href="{{ route('admin.device') }}">Device</a></li>
                    <li class="breadcrumb-item active">Edit Device</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- Form Edit Device -->
<div class="row justify-content-center">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Form Edit Device</h4>
            </div>
            <div class="card-body">
                <form id="deviceForm" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{ $device->id }}">
                    
                    <!-- Zone Selection -->
                    <div class="mb-3 row">
                        <label for="zone_id" class="col-sm-3 col-form-label text-end">Zone Ruckus</label>
                        <div class="col-sm-9">
                            <select class="form-control select2" id="zone_id" name="zone_id">
                                <option value="">Pilih Zone Ruckus</option>
                                @if(isset($zones['list']))
                                    @foreach ($zones['list'] as $zone)
                                        <option value="{{ $zone['id'] }}" {{ $device->zone_id == $zone['id'] ? 'selected' : '' }}>
                                            {{ $zone['name'] }}
                                        </option>
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
                                @if(isset($buildings))
                                    @foreach ($buildings as $building)
                                        <option value="{{ $building['id'] }}" {{ $device->building_id == $building['id'] ? 'selected' : '' }}>
                                            {{ $building['name'] }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                    <!-- Device ID -->
                    <div class="mb-3 row">
                        <label for="device_id" class="col-sm-3 col-form-label text-end">Device ID <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="device_id" id="device_id" value="{{ $device->device_id }}" required>
                        </div>
                    </div>

                    <!-- Tipe Device -->
                    <div class="mb-3 row">
                        <label for="tipe_id" class="col-sm-3 col-form-label text-end">Tipe Device <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-control select2" name="tipe_id" id="tipe_id" required>
                                <option value="">-- Pilih Tipe Device --</option>
                                @foreach ($tipes as $tipe)
                                    <option value="{{ $tipe->id }}" {{ $device->tipe_id == $tipe->id ? 'selected' : '' }}>
                                        {{ $tipe->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Category Dana -->
                    <div class="mb-3 row">
                        <label for="category_dana_id" class="col-sm-3 col-form-label text-end">Category Dana <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-control select2" name="category_dana_id" id="category_dana_id" required>
                                <option value="">-- Pilih Category Dana --</option>
                                @foreach ($categoriesDana as $cat)
                                    <option value="{{ $cat->id }}" {{ $device->category_dana_id == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Brand -->
                    <div class="mb-3 row">
                        <label for="brand_id" class="col-sm-3 col-form-label text-end">Brand <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-control select2" name="brand_id" id="brand_id" required>
                                <option value="">-- Pilih Brand --</option>
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}" {{ $device->brand_id == $brand->id ? 'selected' : '' }}>
                                        {{ $brand->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Status (isActive) -->
                    <div class="mb-3 row">
                        <label for="isActive" class="col-sm-3 col-form-label text-end">Status <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-control select2" name="isActive" id="isActive" required>
                                <option value="">-- Pilih Status --</option>
                                <option value="1" {{ $device->isActive ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ !$device->isActive ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                    </div>

                    <!-- Current Sticker Image -->
                    @if($device->sticker)
                    <div class="mb-3 row">
                        <label class="col-sm-3 col-form-label text-end">Current BMN Sticker</label>
                        <div class="col-sm-9">
                            <img src="{{ asset('storage/' . $device->sticker) }}" alt="Current Sticker" class="img-thumbnail" style="max-height: 100px;">
                        </div>
                    </div>
                    @endif

                    <!-- Sticker (BMN Sticker) -->
                    <div class="mb-3 row">
                        <label for="sticker" class="col-sm-3 col-form-label text-end">Update BMN Sticker</label>
                        <div class="col-sm-9">
                            <input type="file" class="form-control" id="sticker" name="sticker" accept="image/*">
                            <small class="form-text text-muted">Format: PNG/JPG (max: 2MB). Leave empty to keep current image.</small>
                        </div>
                    </div>

                    <!-- Device Photos Section -->
                    <h5 class="mb-3 mt-4">Foto Device</h5>

                    <!-- Foto Depan -->
                    <div class="mb-3 row">
                        <label for="foto_depan" class="col-sm-3 col-form-label text-end">Foto Depan</label>
                        <div class="col-sm-9">
                            @if($device->foto_depan)
                                <img src="{{ asset('storage/' . $device->foto_depan) }}" alt="Foto Depan" class="img-thumbnail mb-2" style="max-height: 100px;">
                            @endif
                            <input type="file" class="form-control" name="foto_depan" id="foto_depan" accept="image/*">
                        </div>
                    </div>

                    <!-- Foto Belakang -->
                    <div class="mb-3 row">
                        <label for="foto_belakang" class="col-sm-3 col-form-label text-end">Foto Belakang</label>
                        <div class="col-sm-9">
                            @if($device->foto_belakang)
                                <img src="{{ asset('storage/' . $device->foto_belakang) }}" alt="Foto Belakang" class="img-thumbnail mb-2" style="max-height: 100px;">
                            @endif
                            <input type="file" class="form-control" name="foto_belakang" id="foto_belakang" accept="image/*">
                        </div>
                    </div>

                    <!-- Foto Terpasang -->
                    <div class="mb-3 row">
                        <label for="foto_terpasang" class="col-sm-3 col-form-label text-end">Foto Terpasang</label>
                        <div class="col-sm-9">
                            @if($device->foto_terpasang)
                                <img src="{{ asset('storage/' . $device->foto_terpasang) }}" alt="Foto Terpasang" class="img-thumbnail mb-2" style="max-height: 100px;">
                            @endif
                            <input type="file" class="form-control" name="foto_terpasang" id="foto_terpasang" accept="image/*">
                        </div>
                    </div>

                    <!-- Foto Serial -->
                    <div class="mb-3 row">
                        <label for="foto_serial" class="col-sm-3 col-form-label text-end">Foto Serial</label>
                        <div class="col-sm-9">
                            @if($device->foto_serial)
                                <img src="{{ asset('storage/' . $device->foto_serial) }}" alt="Foto Serial" class="img-thumbnail mb-2" style="max-height: 100px;">
                            @endif
                            <input type="file" class="form-control" name="foto_serial" id="foto_serial" accept="image/*">
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-12 text-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-save me-1"></i> Update Device
                            </button>
                            <a href="{{ route('admin.device') }}" class="btn btn-secondary ms-2">
                                <i class="fa fa-arrow-left me-1"></i> Back
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
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>
    
    <script>
        $(document).ready(function() {
            // Initialize Select2
            $('.select2').select2({
                width: '100%',
                placeholder: function() {
                    return $(this).data('placeholder') || 'Select an option';
                }
            });

            // Store buildings data from PHP
            const buildingsData = @json($allBuildings ?? []);
            
            // Function to populate building select based on zone
            function populateBuildings(zoneId) {
                const buildings = buildingsData[zoneId] || [];
                let options = '<option value="">Pilih Gedung</option>';
                
                buildings.forEach(function(building) {
                    const selected = building.id == '{{ $device->building_id }}' ? 'selected' : '';
                    options += `<option value="${building.id}" ${selected}>${building.name}</option>`;
                });
                
                $('#building_id').html(options).trigger('change');
            }

            // Zone change handler
            $('#zone_id').on('change', function() {
                const zoneId = $(this).val();
                populateBuildings(zoneId);
            });

            // Initialize buildings if zone is selected
            if ($('#zone_id').val()) {
                populateBuildings($('#zone_id').val());
            }

            // Handle form submission
            $('#deviceForm').on('submit', function(e) {
                e.preventDefault();
                
                // Create FormData object to handle file uploads
                const formData = new FormData(this);
                
                $.ajax({
                    url: "{{ route('admin.device.update', $device->id) }}",
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        Swal.fire({
                            title: 'Please Wait',
                            text: 'Updating device information...',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: response.message || 'Device has been updated successfully',
                            showCancelButton: true,
                            confirmButtonText: 'View Device List',
                            cancelButtonText: 'Continue Editing'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "{{ route('admin.device') }}";
                            }
                        });
                    },
                    error: function(xhr) {
                        let errorMessage = 'An error occurred while updating the device.';
                        
                        if (xhr.status === 422) {
                            // Validation errors
                            const errors = xhr.responseJSON.errors;
                            errorMessage = '<div class="text-left">';
                            Object.keys(errors).forEach(function(key) {
                                errorMessage += `<p class="mb-1">• ${errors[key][0]}</p>`;
                            });
                            errorMessage += '</div>';
                        } else if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }

                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            html: errorMessage
                        });
                    }
                });
            });
        });
    </script>
@endpush
@endsection
