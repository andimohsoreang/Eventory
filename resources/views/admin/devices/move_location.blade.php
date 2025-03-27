@extends('layouts.app')
@section('content')
@section('title', 'Move Device Location')
@push('links')
    <!-- Select2 -->
    <link href="{{ asset('dist/assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css">
    <!-- Sweet Alert -->
    <link href="{{ asset('dist/assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
    <style>
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
            margin-bottom: 20px;
        }
        .building-image {
            max-width: 100%;
            height: auto;
            cursor: crosshair;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        #building-map {
            display: block;
            margin: 0 auto;
            max-width: 100%;
            border: 1px solid #ddd;
        }
    </style>
@endpush

<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box d-md-flex justify-content-md-between align-items-center">
            <h4 class="page-title">Move Device Location</h4>
            <div class="">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.device') }}">Devices</a></li>
                    <li class="breadcrumb-item active">Move Location</li>
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
                        <h4 class="card-title">Device Information</h4>
                    </div>
                    <div class="col text-end">
                        <a href="{{ route('admin.device') }}" class="btn btn-secondary">
                            <i class="ti ti-arrow-left me-1"></i> Back to Devices
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-sm">
                            <tr>
                                <th width="150">Device ID</th>
                                <td>{{ $device->device_id }}</td>
                            </tr>
                            <tr>
                                <th>Type</th>
                                <td>{{ $device->tipe ? $device->tipe->name : '-' }}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>
                                    @if ($device->isActive)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Current Building</th>
                                <td>{{ $currentLocation && $currentLocation->gedung ? $currentLocation->gedung->name : 'Not set' }}</td>
                            </tr>
                        </table>
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
                <h4 class="card-title">Set Device Location</h4>
            </div>
            <div class="card-body">
                <form id="moveLocationForm" action="{{ route('admin.device.move-location') }}" method="POST">
                    @csrf
                    <input type="hidden" name="device_id" value="{{ $device->device_id }}">

                    <div class="mb-3 row">
                        <label for="gedung_id" class="col-sm-2 col-form-label">Building</label>
                        <div class="col-sm-10">
                            <select name="gedung_id" id="gedung_id" class="form-control" required>
                                <option value="" selected disabled>-- Select Building --</option>
                                @foreach ($gedungs as $gedung)
                                    <option value="{{ $gedung->id }}" 
                                        data-image="{{ $gedung->photo_url }}"
                                        @if($currentLocation && $currentLocation->gedung_id == $gedung->id) selected @endif>
                                        {{ $gedung->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label">Image URL</label>
                        <div class="col-sm-10">
                            <div class="form-control-plaintext" id="image-url-display"></div>
                        </div>
                    </div>

                    <div class="mb-4 row" id="building-image-container">
                        <label class="col-sm-2 col-form-label">Building Floor Plan</label>
                        <div class="col-sm-10">
                            <p class="text-muted mb-2">Click on the building image to set the device location</p>
                            <div id="building-image-container-inner" style="position: relative;">
                                <!-- Used for static debugging -->
                                @if(!empty($gedungs) && count($gedungs) > 0 && !empty($gedungs[0]->photo_url))
                                    <img src="{{ asset('dist/assets/images/map-placeholder.png') }}" id="static-map" 
                                         style="display:none; max-width:100%;" alt="Static Map">
                                @endif
                                
                                <!-- Actual image container -->
                                <div id="dynamic-map-container"></div>
                            </div>
                            <div class="alert alert-info mt-2">
                                <i class="ti ti-info-circle me-2"></i> The red dot marks the device position
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="location" class="col-sm-2 col-form-label">Location</label>
                        <div class="col-sm-10">
                            <input type="hidden" name="location" id="location" class="form-control" required>
                            <div id="location-display" class="form-control-plaintext text-muted">
                                No location set
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col-sm-10 offset-sm-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="ti ti-device-floppy me-1"></i> Save Location
                            </button>
                            <a href="{{ route('admin.device') }}" class="btn btn-secondary ms-2">
                                Cancel
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Ensure jQuery is loaded -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@push('scripts')
    <script src="{{ asset('dist/assets/libs/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('dist/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script>
        // Simple approach with window.onload to ensure everything is loaded
        window.onload = function() {
            console.log('Window fully loaded');
            
            // Initialize the building selector
            if ($.fn.select2) {
                $('#gedung_id').select2();
                console.log('Select2 initialized');
            }
            
            // Handle building selection change
            $('#gedung_id').on('change', function() {
                // Get the selected building
                var selectedOption = $(this).find('option:selected');
                var buildingId = selectedOption.val();
                var buildingName = selectedOption.text();
                var imageUrl = selectedOption.attr('data-image');
                
                // Update the image URL display
                $('#image-url-display').html('Loading image from: <a href="' + imageUrl + '" target="_blank">' + imageUrl + '</a>');
                
                // Clear previous location if any
                $('#location').val('');
                $('#location-display').text('No location set');
                $('.location-marker').remove();
                
                // Clear previous image content
                var container = $('#dynamic-map-container');
                container.empty();
                
                if (!imageUrl) {
                    container.html('<div class="alert alert-warning">No image available for this building</div>');
                    return;
                }
                
                // Create new image with cache-busting parameter
                var timestamp = new Date().getTime();
                var imageHtml = '<img src="' + imageUrl + '?t=' + timestamp + '" ' +
                                'id="building-map" class="building-image" alt="' + buildingName + '" ' +
                                'style="cursor:crosshair; max-width:100%; display:block; margin:0 auto;">';
                                
                console.log('Loading image: ' + imageUrl);
                container.html(imageHtml);
                
                // Handle image load event
                $('#building-map').on('load', function() {
                    console.log('Image loaded successfully', this.width, 'x', this.height);
                }).on('error', function() {
                    console.error('Failed to load image');
                    container.html('<div class="alert alert-danger">' +
                                  '<strong>Error loading image</strong><br>' +
                                  'Please check if the image exists at: ' + imageUrl + 
                                  '</div>');
                });
                
                // Set up click handler on the new image
                $(document).on('click', '#building-map', function(e) {
                    var rect = this.getBoundingClientRect();
                    var clickX = e.clientX - rect.left;
                    var clickY = e.clientY - rect.top;
                    
                    // Calculate percentages
                    var percentX = (clickX / this.width) * 100;
                    var percentY = (clickY / this.height) * 100;
                    
                    // Store location
                    var locationValue = percentX.toFixed(2) + ',' + percentY.toFixed(2);
                    $('#location').val(locationValue);
                    $('#location-display').text('Position set at coordinates: ' + locationValue);
                    
                    // Update marker
                    $('.location-marker').remove();
                    var marker = $('<div class="location-marker"></div>').css({
                        position: 'absolute',
                        left: percentX + '%',
                        top: percentY + '%'
                    });
                    $('#building-image-container-inner').append(marker);
                    
                    console.log('Location set to:', locationValue);
                });
            });
            
            // Check if initial building is selected
            if ($('#gedung_id').val()) {
                $('#gedung_id').trigger('change');
            }
            
            // Handle form submission
            $('#moveLocationForm').on('submit', function(e) {
                e.preventDefault();
                
                if (!$('#gedung_id').val()) {
                    Swal.fire('Error', 'Please select a building first', 'error');
                    return false;
                }
                
                if (!$('#location').val()) {
                    Swal.fire('Error', 'Please set a location by clicking on the image', 'error');
                    return false;
                }
                
                // Submit form using AJAX
                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                title: 'Success!',
                                text: response.message,
                                icon: 'success',
                                showCancelButton: true,
                                confirmButtonText: 'Back to Devices List',
                                cancelButtonText: 'Stay on this page'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = "{{ route('admin.device') }}";
                                }
                            });
                        } else {
                            Swal.fire('Error', response.message || 'An error occurred', 'error');
                        }
                    },
                    error: function(xhr) {
                        var errorMessage = 'Failed to update device location';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }
                        Swal.fire('Error', errorMessage, 'error');
                    }
                });
            });
        };
    </script>
@endpush
@endsection 