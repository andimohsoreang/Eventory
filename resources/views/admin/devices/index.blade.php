@extends('layouts.app')
@section('content')
@section('title', 'Master Device')
@push('links')
    <!-- DataTables -->
    <link href="{{ asset('dist/assets/libs/simple-datatables/style.css') }}" rel="stylesheet" type="text/css" />
    
    <!-- Sweet Alert -->
    <link href="{{ asset('dist/assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('dist/assets/libs/animate.css/animate.min.css') }}" rel="stylesheet" type="text/css">
    
    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    
    <style>
        /* Select2 Custom Styles */
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

        .location-marker {
            position: absolute;
            width: 20px;
            height: 20px;
            background-color: red;
            border-radius: 50%;
            border: 2px solid white;
            box-shadow: 0 0 5px rgba(0,0,0,0.5);
            transform: translate(-50%, -50%);
            z-index: 100;
        }
        #building-image-container-inner {
            position: relative;
        }
    </style>
@endpush

<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box d-md-flex justify-content-md-between align-items-center">
            <h4 class="page-title">Device Management</h4>
            <div class="">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item active">Device Management</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h4 class="card-title">Filter Devices</h4>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 col-xl-3">
                        <div id="table_config_filter" class="position-relative">
                            <input type="search" id="search-box" class="form-control ps-5" aria-controls="table_config"
                                placeholder="Search Device..." />
                            <i
                                class="ti ti-search position-absolute top-50 start-0 translate-middle-y fs-6 text-dark ms-3"></i>
                        </div>
                    </div>
                    <div class="col-md-4 col-xl-3">
                        <select id="filter_tipe" class="form-control select2">
                            <option value="">-- Select Device Type --</option>
                            <option value="1">Router</option>
                            <option value="2">Switch</option>
                            <option value="3">Access Point</option>
                            <option value="4">Firewall</option>
                        </select>
                    </div>
                    <div class="col-md-4 col-xl-3">
                        <select id="filter_gedung" class="form-control select2">
                            <option value="">-- Select Building --</option>
                            <option value="1">Gedung A</option>
                            <option value="2">Gedung B</option>
                            <option value="3">Gedung C</option>
                        </select>
                    </div>
                    <div
                        class="col-md-8 col-xl-3 text-end d-flex justify-content-md-end justify-content-center mt-3 mt-md-0">
                        <a href="{{ route('admin.device.create') }}"
                            class="btn btn-primary d-flex align-items-center mb-2 mb-md-0">
                            <i class="ti ti-plus text-white me-1 fs-5"></i> Add Device
                        </a>
                        <a href="#" class="btn btn-success mb-3 mb-md-0 ms-md-2 d-flex align-items-center">
                            <i class="fa fa-download text-white me-2 fs-5"></i> Export to Excel
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h4 class="card-title">Daftar Devices</h4>
                    </div>
                </div>
            </div>
            <div class="card-body pt-0">
                <div class="table-responsive">
                    <table class="table datatable" id="datatable_1">
                        <thead class="table-light">
                            <tr>
                                <th>No.</th>
                                <th>Device ID</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Gedung</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($devices as $device)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $device->device_id }}</td>
                                    <!-- Serial Key removed; device id is used as reference -->
                                    <td>{{ $device->tipe ? $device->tipe->name : '-' }}</td>
                                    <td>
                                        @if ($device->isActive)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>{{ $device->gedung ? $device->gedung->name : '-' }}</td>
                                    <td>
                                        <a href="{{ route('admin.device.show', $device->id) }}"
                                            class="btn btn-outline-info btn-sm">Detail</a>
                                        <a href="{{ route('admin.device.edit', $device->id) }}"
                                            class="btn btn-outline-primary btn-sm">Edit</a>
                                        <button type="button" class="btn btn-outline-danger btn-sm delete-device"
                                                data-id="{{ $device->id }}"
                                                data-name="{{ $device->device_id }}">
                                            <i class="fa fa-trash me-1"></i> Delete
                                        </button>
                                        <a href="{{ route('admin.device.details', $device->id) }}"
                                            class="btn btn-outline-secondary btn-sm">Lihat Device</a>
                                        <a href="{{ route('admin.device.move-location-page', $device->device_id) }}"
                                            class="btn btn-outline-info btn-sm">
                                            <i class="fa fa-map-marker-alt"></i> Move Location
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Move Location -->
<div class="modal fade bd-example-modal-lg" id="moveLocationModal" tabindex="-1" role="dialog"
    aria-labelledby="moveLocationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title m-0" id="moveLocationModalLabel">Move Device Location</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div><!--end modal-header-->
            <div class="modal-body">
                <form id="moveLocationForm">
                    @csrf
                    <input type="hidden" name="device_id" id="device-id-input">

                    <div class="mb-3 row">
                        <label for="gedung_id" class="col-sm-3 col-form-label text-end">Building</label>
                        <div class="col-sm-9">
                            <select name="gedung_id" id="gedung_id" class="form-control select2" required>
                                <option value="" selected hidden>-- Select Building --</option>
                                @foreach ($gedungs as $gedung)
                                    <option value="{{ $gedung->id }}" data-image="{{ $gedung->photo_url }}">
                                        {{ $gedung->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mb-3 row" id="building-image-container" style="display:none;">
                        <label for="location" class="col-sm-3 col-form-label text-end">Building Image</label>
                        <div class="col-sm-9">
                            <div id="building-image-container-inner">
                            <!-- Building image will appear here -->
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="location" class="col-sm-3 col-form-label text-end">Location (Click on the image to
                            set location)</label>
                        <div class="col-sm-9">
                            <input type="hidden" name="location" id="location" class="form-control" required>
                            <small class="form-text text-muted">Click on the building image to set the device
                                location</small>
                        </div>
                    </div>
                </form>
            </div><!--end modal-body-->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="btnSimpanLocation">Simpan Location</button>
            </div><!--end modal-footer-->
        </div><!--end modal-content-->
    </div><!--end modal-dialog-->
</div><!--end modal-->

<script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Modal script loaded.');
    });
</script>
<script>
    $(document).ready(function() {
        // Initialize Select2 with option to maintain DOM properties
        $('.select2').select2({
            width: '100%'
        });

        // Show modal and assign device id when clicking "Move Location"
        $('.move-location').click(function() {
            let deviceId = $(this).data('device-id');
            $('#device-id-input').val(deviceId);
            
            // Reset form
            $('#gedung_id').val('').trigger('change');
            $('#location').val('');
            $('#building-image-container').hide();
            $('.location-marker').remove();
            
            // Show the modal
            var modal = new bootstrap.Modal(document.getElementById('moveLocationModal'));
            modal.show();
        });

        // When building is selected
        $('#gedung_id').on('change', function() {
            // Get the selected option's data-image attribute
            const selectedOption = $(this).find('option:selected');
            const buildingId = selectedOption.val();
            
            if (!buildingId) {
                $('#building-image-container').hide();
                return;
            }
            
            // Get the image URL directly from the option's data attribute
            const buildingImageUrl = selectedOption.attr('data-image');
            console.log('Selected building ID:', buildingId);
            console.log('Selected building image URL:', buildingImageUrl);
            
            const container = $('#building-image-container');
            const imageContainerInner = $('#building-image-container-inner');
            
            // Remove any existing markers
            $('.location-marker').remove();

            if (buildingImageUrl) {
                // Display building image
                imageContainerInner.html(
                    `<img src="${buildingImageUrl}" id="building-map" alt="Building Image" style="max-width: 100%; height: auto; cursor: crosshair;" />`
                );
                container.show();
                $('#location').val('');

                // Add click event to building image after image is loaded
                $('#building-map').on('load', function() {
                    console.log('Building image loaded successfully');
                }).on('error', function() {
                    console.error('Error loading building image:', buildingImageUrl);
                });
                
                // Add click event to building image
                $('#building-map').off('click').on('click', function(e) {
                    // Calculate click position as percentage of image dimensions
                    const rect = this.getBoundingClientRect();
                    const clickX = e.clientX - rect.left;
                    const clickY = e.clientY - rect.top;
                    const percentX = (clickX / this.width) * 100;
                    const percentY = (clickY / this.height) * 100;
                    
                    // Save location as percentages
                    $('#location').val(`${percentX.toFixed(2)},${percentY.toFixed(2)}`);
                    console.log('Location set:', $('#location').val());

                    // Remove any existing markers and add new one
                    $('.location-marker').remove();
                    const marker = $('<div class="location-marker"></div>').css({
                        left: `${percentX}%`,
                        top: `${percentY}%`
                    });
                    $('#building-image-container-inner').append(marker);
                });
            } else {
                console.warn('No image URL available for building ID:', buildingId);
                container.hide();
                $('#location').val('');
            }
        });

        // Submit location via AJAX
        $('#btnSimpanLocation').click(function() {
            // Validate inputs
            if (!$('#gedung_id').val()) {
                Swal.fire('Error!', 'Please select a building first.', 'error');
                return;
            }
            
            if (!$('#location').val()) {
                Swal.fire('Error!', 'Please set the device location by clicking on the building image.', 'error');
                return;
            }

            let formData = new FormData($('#moveLocationForm')[0]);
            $.ajax({
                url: "{{ route('admin.device.move-location') }}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        Swal.fire('Sukses!', response.message, 'success');
                        var modal = bootstrap.Modal.getInstance(document.getElementById('moveLocationModal'));
                        modal.hide();
                        location.reload();
                    }
                },
                error: function(xhr) {
                    let errorMessage = 'Gagal memindahkan lokasi perangkat.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    }
                    Swal.fire('Error!', errorMessage, 'error');
                }
            });
        });
    });
</script>

@push('scripts')
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- SweetAlert2 -->
    <script src="{{ asset('dist/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    
    <!-- Select2 -->
    <script src="{{ asset('dist/assets/libs/select2/js/select2.min.js') }}"></script>
    
    <!-- DataTables -->
    <script src="{{ asset('dist/assets/libs/simple-datatables/umd/simple-datatables.js') }}"></script>
    <script src="{{ asset('dist/assets/js/pages/datatable.init.js') }}"></script>

    <!-- Custom Script -->
    <script type="text/javascript">
        // Wait for document ready and ensure jQuery is loaded
        window.addEventListener('DOMContentLoaded', function() {
            // Check if jQuery is loaded
            if (typeof jQuery != 'undefined') {
                // Initialize Select2 after ensuring the plugin is loaded
                if ($.fn.select2) {
                    $('.select2').select2({
                        width: '100%',
                        placeholder: function() {
                            return $(this).data('placeholder') || 'Select an option';
                        }
                    });
                }

                // Handle device deletion
                $(document).on('click', '.delete-device', function() {
                const deviceId = $(this).data('id');
                const deviceName = $(this).data('name');
                
                Swal.fire({
                    title: 'Are you sure?',
                    html: `You are about to delete device: <br><strong>${deviceName}</strong>`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `/admin/device/${deviceId}`,
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                _method: 'DELETE'
                            },
                            beforeSend: function() {
                                Swal.fire({
                                    title: 'Please Wait',
                                    text: 'Deleting device...',
                                    allowOutsideClick: false,
                                    didOpen: () => {
                                        Swal.showLoading();
                                    }
                                });
                            },
                            success: function(response) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Deleted!',
                                    text: response.message || 'Device has been deleted successfully',
                                    confirmButtonColor: '#28a745'
                                }).then(() => {
                                    location.reload();
                                });
                            },
                            error: function(xhr) {
                                let errorMessage = 'Failed to delete the device.';
                                if (xhr.responseJSON && xhr.responseJSON.message) {
                                    errorMessage = xhr.responseJSON.message;
                                }
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error!',
                                    text: errorMessage,
                                    confirmButtonColor: '#dc3545'
                                });
                            }
                        });
                    }
                });
            });

            // Handle filter changes
            $('#filter_tipe, #filter_gedung').on('change', function() {
                // Add your filter logic here
                // You can use the datatable API to filter the results
            });

            // Handle search
            $('#search-box').on('keyup', function() {
                // Add your search logic here
                // You can use the datatable API to search
            });
            } else {
                console.error('jQuery is not loaded');
            }
        });
    </script>
@endpush

@push('scripts')
<script type="text/javascript">
    // Fallback initialization if the first one fails
    document.addEventListener('DOMContentLoaded', function() {
        // Try to initialize after a short delay to ensure all scripts are loaded
        setTimeout(function() {
            if (typeof jQuery != 'undefined' && typeof $.fn.select2 != 'undefined') {
                try {
                    $('.select2').select2({
                        width: '100%',
                        placeholder: function() {
                            return $(this).data('placeholder') || 'Select an option';
                        }
                    });
                    console.log('Select2 initialized successfully');
                } catch (e) {
                    console.error('Error initializing Select2:', e);
                }
            } else {
                console.error('Required libraries not loaded:', {
                    'jQuery': typeof jQuery != 'undefined',
                    'Select2': typeof $.fn.select2 != 'undefined'
                });
            }
        }, 1000);
    });
</script>
@endpush
@endsection
