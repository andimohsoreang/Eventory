@extends('layouts.app')
@section('content')
@section('title', 'Device Details')
@push('links')
    <link href="{{ asset('dist/assets/libs/simple-datatables/style.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('dist/assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('dist/assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css">
    <style>
        :root {
            --primary-color: #4361ee;
            --success-color: #2ecc71;
            --warning-color: #f39c12;
            --danger-color: #e74c3c;
            --info-color: #3498db;
            --gray-light: #f8f9fa;
            --gray-medium: #e9ecef;
            --gray-dark: #495057;
        }

        .page-header {
            margin-bottom: 1.5rem;
        }

        .device-title {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1rem;
        }

        .device-id {
            font-size: 0.875rem;
            color: var(--gray-dark);
            background-color: var(--gray-light);
            padding: 0.25rem 0.75rem;
            border-radius: 1rem;
        }

        .status-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 2rem;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        .status-active {
            background-color: rgba(46, 204, 113, 0.15);
            color: var(--success-color);
        }

        .status-inactive {
            background-color: rgba(149, 165, 166, 0.15);
            color: var(--gray-dark);
        }

        .section-card {
            border-radius: 0.5rem;
            border: none;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
            margin-bottom: 1.5rem;
            overflow: hidden;
        }

        .section-card .card-header {
            background-color: white;
            border-bottom: 1px solid var(--gray-medium);
            padding: 1rem 1.25rem;
        }

        .section-card .card-title {
            margin-bottom: 0;
            font-size: 1rem;
            font-weight: 600;
            color: var(--gray-dark);
        }

        .section-card .card-body {
            padding: 1.25rem;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }

        .info-item {
            margin-bottom: 0.5rem;
        }

        .info-label {
            font-size: 0.875rem;
            color: var(--gray-dark);
            font-weight: 500;
            margin-bottom: 0.25rem;
        }

        .info-value {
            font-size: 0.9375rem;
        }

        .device-qr {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 1.5rem;
        }

        .device-qr img,
        .device-qr svg {
            border: 1px solid var(--gray-medium);
            padding: 0.5rem;
            border-radius: 0.5rem;
            background-color: white;
        }

        .device-qr-label {
            margin-top: 0.5rem;
            font-size: 0.875rem;
            color: var(--gray-dark);
        }

        .map-container {
            position: relative;
            margin-top: 1.25rem;
            border-radius: 0.5rem;
            overflow: hidden;
            border: 1px solid var(--gray-medium);
        }

        .map-container img {
            width: 100%;
            height: auto;
            display: block;
        }

        .map-marker {
            position: absolute;
            width: 16px;
            height: 16px;
            background-color: var(--danger-color);
            border-radius: 50%;
            border: 2px solid white;
            box-shadow: 0 0 0 2px rgba(0, 0, 0, 0.1);
            transform: translate(-50%, -50%);
        }

        .photo-gallery {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
            gap: 0.75rem;
            margin-top: 1rem;
        }

        .photo-item {
            border-radius: 0.5rem;
            overflow: hidden;
            position: relative;
            aspect-ratio: 1/1;
            border: 1px solid var(--gray-medium);
        }

        .photo-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .photo-caption {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.7), transparent);
            color: white;
            padding: 0.5rem;
            font-size: 0.75rem;
            text-align: center;
        }

        /* Modal styles */
        .modal-header {
            padding: 1rem 1.25rem;
            border-bottom: 1px solid var(--gray-medium);
        }

        .modal-body {
            padding: 1.25rem;
        }

        .modal-footer {
            padding: 1rem 1.25rem;
            border-top: 1px solid var(--gray-medium);
        }
    </style>
@endpush

<div class="row">
    <div class="col-12">
        <div class="page-header d-flex justify-content-between align-items-center">
            <div>
                <h4 class="page-title mb-1">Device Details</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="#">Device Management</a></li>
                        <li class="breadcrumb-item active">Device Details</li>
                    </ol>
                </nav>
            </div>
            <a href="#" class="btn btn-outline-secondary btn-sm">
                <i class="fa fa-arrow-left me-1"></i> Back to Devices
            </a>
        </div>
    </div>
</div>

<div class="row">
    <!-- Map Location -->
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Device Location</h4>
            </div>
            <div class="card-body">
                <div class="location-container mt-2" id="location-container">
                    <img src="{{ asset('uploads/gedung/photo/building-a.jpg') }}" alt="Building Map" id="building-map">
                    <!-- Marker at 50% from left, 40% from top -->
                    <div class="marker" style="left: 50%; top: 40%;"></div>
                </div>
                <p class="mt-2"><strong>Coordinates:</strong> 50.00,40.00</p>
            </div>
        </div>
    </div>

    <!-- Location History -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Location History</h4>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th>Building</th>
                            <th>Location</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Gedung A</td>
                            <td>Server Room 302</td>
                            <td>16 Mar 2025</td>
                        </tr>
                        <tr>
                            <td>Gedung B</td>
                            <td>Network Center</td>
                            <td>10 Mar 2025</td>
                        </tr>
                        <tr>
                            <td>Gedung A</td>
                            <td>Storage Room 101</td>
                            <td>02 Mar 2025</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Main Content - Left Column -->
    <div class="col-lg-8">
        <!-- Device Information Card -->
        <div class="card section-card">
            <div class="card-body">
                <div class="device-title">
                    <h5 class="mb-0 fw-bold">{{ $device->tipe ? $device->tipe->name : 'Unknown Device' }}</h5>
                    <span class="device-id">{{ $device->device_id }}</span>
                    <span class="status-badge {{ $device->isActive ? 'status-active' : 'status-inactive' }}">
                        {{ $device->isActive ? 'Active' : 'Inactive' }}
                    </span>
                </div>

                <div class="info-grid mb-4">
                    @if ($device->sticekr)
                        <div class="info-item">
                            <div class="info-label">Serial Key</div>
                            <div class="info-value">{{ $device->sticekr }}</div>
                        </div>
                    @endif
                </div>

                <!-- QR Code Display -->
                <div class="device-qr">
                    @if ($device->qr)
                        {!! $device->qr !!}
                    @else
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ $device->device_id }}"
                            alt="QR Code" width="150">
                    @endif
                    <div class="device-qr-label">Scan to view device details</div>
                </div>

                <!-- Map Container (Static for now) -->
                <div class="map-container">
                    <img src="{{ asset('uploads/gedung/photo/building-a.jpg') }}" alt="Building Map" id="building-map">
                    <div class="map-marker" style="left: 50%; top: 40%;"></div>
                </div>
                <div class="text-center mt-2 text-muted small">Coordinates: 50.00, 40.00</div>
            </div>
        </div>

        <!-- Device Photos Card -->
        <div class="card section-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="card-title">Device Photos</h6>
            </div>
            <div class="card-body">
                <div class="photo-gallery">
                    @if ($device->foto_depan)
                        <div class="photo-item">
                            <img src="{{ asset($device->foto_depan) }}" alt="Device Front View">
                            <div class="photo-caption">Front View</div>
                        </div>
                    @endif
                    @if ($device->foto_belakang)
                        <div class="photo-item">
                            <img src="{{ asset($device->foto_belakang) }}" alt="Device Back View">
                            <div class="photo-caption">Back View</div>
                        </div>
                    @endif
                    @if ($device->foto_terpasang)
                        <div class="photo-item">
                            <img src="{{ asset($device->foto_terpasang) }}" alt="Device Installed">
                            <div class="photo-caption">Installed in Rack</div>
                        </div>
                    @endif
                    @if ($device->foto_serial)
                        <div class="photo-item">
                            <img src="{{ asset($device->foto_serial) }}" alt="Device Serial">
                            <div class="photo-caption">Device Serial</div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar - Right Column -->
    <div class="col-lg-4">
        <!-- Actions Card -->
        <div class="card section-card">
            <div class="card-header">
                <h6 class="card-title">Actions</h6>
            </div>
            <div class="card-body">
                <div class="action-buttons">
                    <button class="btn btn-outline-warning action-button">
                        <i class="fa fa-pencil btn-icon"></i> Edit Device
                    </button>
                    <button class="btn btn-outline-info action-button" data-bs-toggle="modal"
                        data-bs-target="#moveLocationModal" data-device-id="{{ $device->device_id }}">
                        <i class="fa fa-map-marker btn-icon"></i> Move Location
                    </button>
                    <button class="btn btn-outline-primary action-button">
                        <i class="fa fa-print btn-icon"></i> Print QR Code
                    </button>
                    <button class="btn btn-outline-danger action-button" onclick="return confirm('Are you sure?')">
                        <i class="fa fa-trash btn-icon"></i> Delete Device
                    </button>
                </div>
            </div>
        </div>

        <!-- Location History Card -->
        @if ($device->location && $device->location->count() > 0)
            <div class="card section-card">
                <div class="card-header">
                    <h6 class="card-title">Location History</h6>
                </div>
                <div class="card-body p-0">
                    <table class="table table-sm history-table mb-0">
                        <thead>
                            <tr>
                                <th>Building</th>
                                <th>Location</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($device->location as $loc)
                                <tr>
                                    <td>{{ $loc->building ?? '-' }}</td>
                                    <td>{{ $loc->room ?? '-' }}</td>
                                    <td>{{ $loc->updated_at->format('d M Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

        <!-- 3D Model Placeholder -->

        <div class="card section-card">
            <div class="card-header">
                <h6 class="card-title">3D Model</h6>
            </div>
            <div class="card-body">
                <div class="card-body">
                    @if ($device->tipe->file)
                        <model-viewer class="product-3d-viewer" alt="Model 3D {{ $device->tipe->name }}"
                            src="{{ $device->tipe->file_url }}" shadow-intensity="1" camera-controls
                            touch-action="pan-y"
                            style="width: 100%; height: 500px; background-color: #f0f0f0; border-radius: 8px;">
                        </model-viewer>
                        <div class="text-center mt-3">
                            <p class="text-muted">Gunakan mouse untuk memutar, zoom, dan pan model.</p>
                        </div>
                    @else
                        <div class="alert alert-info text-center">
                            <i class="fas fa-cube fa-4x mb-3"></i>
                            <p>Tidak ada model 3D yang tersedia untuk tipe ini.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Move Location -->
<div class="modal fade" id="moveLocationModal" tabindex="-1" aria-labelledby="moveLocationModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="moveLocationModalLabel">Move Device Location</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="moveLocationForm" class="row g-3">
                    <input type="hidden" name="device_id" id="device-id-input" value="{{ $device->device_id }}">
                    <div class="col-md-6">
                        <label for="gedung_id" class="form-label">Building</label>
                        <select name="gedung_id" id="gedung_id" class="form-control select2" required>
                            <option value="" selected hidden>-- Select Building --</option>
                            <option value="1" data-image="{{ asset('uploads/gedung/photo/building-a.jpg') }}">
                                Gedung A</option>
                            <option value="2" data-image="{{ asset('uploads/gedung/photo/building-b.jpg') }}">
                                Gedung B</option>
                            <option value="3" data-image="{{ asset('uploads/gedung/photo/building-c.jpg') }}">
                                Gedung C</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="floor" class="form-label">Floor</label>
                        <select name="floor" id="floor" class="form-control select2" required>
                            <option value="" selected hidden>-- Select Floor --</option>
                            <option value="1">1st Floor</option>
                            <option value="2">2nd Floor</option>
                            <option value="3">3rd Floor</option>
                            <option value="4">4th Floor</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="room" class="form-label">Room</label>
                        <input type="text" name="room" id="room" class="form-control"
                            placeholder="Enter room number or name" />
                    </div>
                    <div class="col-md-6">
                        <label for="rack" class="form-label">Rack</label>
                        <input type="text" name="rack" id="rack" class="form-control"
                            placeholder="Enter rack identifier (e.g. Rack 05-B)" />
                    </div>
                    <div class="col-md-6">
                        <label for="position" class="form-label">Position</label>
                        <input type="text" name="position" id="position" class="form-control"
                            placeholder="Enter position (e.g. U24-U25)" />
                    </div>
                    <div class="col-12">
                        <label for="notes" class="form-label">Notes</label>
                        <textarea name="notes" id="notes" class="form-control" rows="2"
                            placeholder="Add notes about this location"></textarea>
                    </div>
                    <div class="col-12" id="building-image-container" style="display:none;">
                        <label class="form-label">Building Image <small class="text-muted">(Click on the image to set
                                location)</small></label>
                        <div id="building-image" class="position-relative border rounded overflow-hidden"></div>
                        <input type="hidden" name="location" id="location" class="form-control" required />
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="btnSimpanLocation">Save Location</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script src="{{ asset('dist/assets/libs/simple-datatables/umd/simple-datatables.js') }}"></script>
    <script src="{{ asset('dist/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('dist/assets/libs/select2/js/select2.min.js') }}"></script>
    <script type="module" src="https://ajax.googleapis.com/ajax/libs/model-viewer/4.0.0/model-viewer.min.js"></script>
    <script>
        let marker = null; // Track the created marker

        // When the modal opens, set the device id and reset the form fields
        const moveLocationModal = document.getElementById('moveLocationModal');
        moveLocationModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget; // Button that triggered the modal
            const deviceId = button.getAttribute('data-device-id'); // Get device id
            document.getElementById('device-id-input').value = deviceId;
            // Reset marker and location field
            marker = null;
            document.getElementById('location').value = '';
            document.getElementById('building-image-container').style.display = 'none';
            document.getElementById('building-image').innerHTML = '';
        });

        // When the building selection changes, display the building image
        document.getElementById('gedung_id').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const buildingImageUrl = selectedOption.getAttribute('data-image');
            const buildingImageContainer = document.getElementById('building-image-container');
            const buildingImage = document.getElementById('building-image');

            if (buildingImageUrl) {
                buildingImageContainer.style.display = 'block';
                buildingImage.innerHTML =
                    `<img src="${buildingImageUrl}" id="building-map" alt="Building Image" style="max-width: 100%; height: auto; cursor: crosshair;" />`;
                document.getElementById('location').value = '';

                const buildingMap = document.getElementById('building-map');
                buildingMap.addEventListener('click', function(e) {
                    const rect = buildingMap.getBoundingClientRect();
                    const clickX = e.clientX - rect.left;
                    const clickY = e.clientY - rect.top;
                    const percentX = (clickX / buildingMap.clientWidth) * 100;
                    const percentY = (clickY / buildingMap.clientHeight) * 100;
                    document.getElementById('location').value =
                        `${percentX.toFixed(2)},${percentY.toFixed(2)}`;

                    if (marker) {
                        marker.remove();
                    }
                    marker = document.createElement('div');
                    marker.style.position = 'absolute';
                    marker.style.left = `${percentX.toFixed(2)}%`;
                    marker.style.top = `${percentY.toFixed(2)}%`;
                    marker.style.width = '16px';
                    marker.style.height = '16px';
                    marker.style.backgroundColor = 'red';
                    marker.style.borderRadius = '50%';
                    marker.style.border = '2px solid white';
                    marker.style.transform = 'translate(-50%, -50%)';
                    marker.style.pointerEvents = 'none';
                    buildingMap.parentElement.appendChild(marker);
                });
            }
        });

        // Initialize Select2 with modal as parent
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof($.fn.select2) !== 'undefined') {
                $('.select2').select2({
                    dropdownParent: $('#moveLocationModal')
                });
            }

            document.getElementById('btnSimpanLocation').addEventListener('click', function() {
                // Implement your save logic here (AJAX or form submission)
                Swal.fire({
                    title: 'Success!',
                    text: 'Device location updated successfully',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
                var modal = bootstrap.Modal.getInstance(document.getElementById('moveLocationModal'));
                modal.hide();
            });
        });
    </script>
@endpush
@endsection
