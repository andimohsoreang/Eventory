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

        .location-container {
            position: relative;
            width: 100%;
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid #ddd;
        }

        .location-container img {
            width: 100%;
            height: auto;
            display: block;
        }

        .marker {
            position: absolute;
            width: 20px;
            height: 20px;
            background-color: red;
            border-radius: 50%;
            border: 2px solid white;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.5);
            transform: translate(-50%, -50%);
            z-index: 10;
        }

        .action-buttons {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .action-button {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
        }

        .btn-icon {
            font-size: 1rem;
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
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.device') }}">Device Management</a></li>
                        <li class="breadcrumb-item active">Device Details</li>
                    </ol>
                </nav>
            </div>
            <a href="{{ route('admin.device') }}" class="btn btn-outline-secondary btn-sm">
                <i class="fa fa-arrow-left me-1"></i> Back to Devices
            </a>
        </div>
    </div>
</div>

@php
    // Get the latest location record for this device
    $latestLocation = $device->location()->with('gedung')->latest()->first();
    $locationCoords = $latestLocation && $latestLocation->location ? explode(',', $latestLocation->location) : null;
    $coordX = $locationCoords && count($locationCoords) >= 2 ? $locationCoords[0] : 50;
    $coordY = $locationCoords && count($locationCoords) >= 2 ? $locationCoords[1] : 50;
@endphp

<!-- Location and History -->
<div class="row">
    <!-- Map Location -->
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Device Location</h4>
            </div>
            <div class="card-body">
                @if($latestLocation && $latestLocation->gedung && $latestLocation->gedung->photo_url)
                    <div class="location-container mt-2" id="location-container">
                        <img src="{{ $latestLocation->gedung->photo_url }}" alt="{{ $latestLocation->gedung->name }} Map" id="building-map">
                        <!-- Marker positioned according to stored coordinates -->
                        <div class="marker" style="left: {{ $coordX }}%; top: {{ $coordY }}%;"></div>
                    </div>
                    <p class="mt-2">
                        <strong>Building:</strong> {{ $latestLocation->gedung->name }}<br>
                        <strong>Coordinates:</strong> {{ $latestLocation->location }}
                    </p>
                @else
                    <div class="alert alert-info">
                        <i class="fa fa-info-circle me-2"></i> No location has been set for this device yet.
                        <div class="mt-2">
                            <a href="{{ route('admin.device.move-location-page', $device->device_id) }}" class="btn btn-sm btn-primary">
                                <i class="fa fa-map-marker me-1"></i> Set Device Location
                            </a>
                        </div>
                    </div>
                @endif
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
                @if($device->location && $device->location->count() > 0)
                    <table class="table table-striped mb-0">
                        <thead>
                            <tr>
                                <th>Building</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($device->location()->with('gedung')->latest()->take(5)->get() as $location)
                                <tr>
                                    <td>{{ $location->gedung ? $location->gedung->name : '-' }}</td>
                                    <td>{{ $location->created_at->format('d M Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="alert alert-info m-3">No location history available</div>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Main Content - Left Column -->
    <div class="col-lg-8">
        <!-- Device Information Card -->
        <div class="card section-card">
            <div class="card-header">
                <h6 class="card-title">Device Information</h6>
            </div>
            <div class="card-body">
                <div class="device-title">
                    <h5 class="mb-0 fw-bold">{{ $device->tipe ? $device->tipe->name : 'Unknown Device' }}</h5>
                    <span class="device-id">{{ $device->device_id }}</span>
                    <span class="status-badge {{ $device->isActive ? 'status-active' : 'status-inactive' }}">
                        {{ $device->isActive ? 'Active' : 'Inactive' }}
                    </span>
                </div>

                @if(isset($apSummary) && is_array($apSummary))
                <div class="card mb-4">
                    <div class="card-header bg-white border-0">
                        <span class="section-title"><i class="fa-solid fa-wifi"></i> Info AP Ruckus</span>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="info-item"><span class="info-label"><i class="fa-solid fa-tag"></i> Nama AP</span><span class="info-value">{{ $apSummary['name'] ?? '-' }}</span></div>
                                <div class="info-item"><span class="info-label"><i class="fa-solid fa-barcode"></i> Serial</span><span class="info-value">{{ $apSummary['serial'] ?? '-' }}</span></div>
                                <div class="info-item"><span class="info-label"><i class="fa-solid fa-microchip"></i> Model</span><span class="info-value">{{ $apSummary['model'] ?? '-' }}</span></div>
                                <div class="info-item"><span class="info-label"><i class="fa-solid fa-network-wired"></i> IP</span><span class="info-value">{{ $apSummary['ip'] ?? '-' }}</span></div>
                                <div class="info-item"><span class="info-label"><i class="fa-solid fa-code-branch"></i> Version</span><span class="info-value">{{ $apSummary['version'] ?? '-' }}</span></div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-item"><span class="info-label"><i class="fa-solid fa-wifi"></i> Channel 2.4Ghz</span><span class="info-value">{{ $apSummary['wifi24Channel'] ?? '-' }}</span></div>
                                <div class="info-item"><span class="info-label"><i class="fa-solid fa-wifi"></i> Channel 5Ghz</span><span class="info-value">{{ $apSummary['wifi50Channel'] ?? '-' }}</span></div>
                                <div class="info-item"><span class="info-label"><i class="fa-solid fa-link"></i> Connection</span><span class="info-value">{{ $apSummary['connectionState'] ?? '-' }}</span></div>
                                <div class="info-item"><span class="info-label"><i class="fa-solid fa-user-check"></i> Registration</span><span class="info-value">{{ $apSummary['registrationState'] ?? '-' }}</span></div>
                                <div class="info-item"><span class="info-label"><i class="fa-solid fa-clock"></i> Uptime</span><span class="info-value">{{ isset($apSummary['uptime']) ? gmdate('H:i:s', $apSummary['uptime']) : '-' }}</span></div>
                                <div class="info-item"><span class="info-label"><i class="fa-solid fa-users"></i> Client Count</span><span class="info-value">{{ $apSummary['clientCount'] ?? '-' }}</span></div>
                                <div class="info-item"><span class="info-label"><i class="fa-solid fa-clock-rotate-left"></i> Last Seen</span><span class="info-value">{{ isset($apSummary['lastSeenTime']) ? \Carbon\Carbon::createFromTimestampMs($apSummary['lastSeenTime'])->format('d M Y H:i') : '-' }}</span></div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <div class="info-grid mb-4">
                    @if($device->brand)
                        <div class="info-item">
                            <div class="info-label">Brand</div>
                            <div class="info-value">{{ $device->brand->name }}</div>
                        </div>
                    @endif
                    
                    @if($device->categoryDana)
                        <div class="info-item">
                            <div class="info-label">Category</div>
                            <div class="info-value">{{ $device->categoryDana->name }}</div>
                        </div>
                    @endif
                    
                    @if($device->sticker)
                        <div class="info-item">
                            <div class="info-label">Serial Key/Sticker</div>
                            <div class="info-value">{{ $device->sticker }}</div>
                        </div>
                    @endif
                    
                    <div class="info-item">
                        <div class="info-label">Created At</div>
                        <div class="info-value">{{ $device->created_at->format('d M Y') }}</div>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-label">Last Updated</div>
                        <div class="info-value">{{ $device->updated_at->format('d M Y') }}</div>
                    </div>
                </div>

                <!-- QR Code Display -->
                <div class="device-qr">
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ $device->device_id }}"
                        alt="QR Code for {{ $device->device_id }}" width="150">
                    <div class="device-qr-label">Scan to view device details</div>
                </div>
            </div>
        </div>

        <!-- Device Photos Card -->
        <div class="card section-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="card-title">Device Photos</h6>
            </div>
            <div class="card-body">
                @if($device->foto_depan || $device->foto_belakang || $device->foto_terpasang || $device->foto_serial)
                    <div class="photo-gallery">
                        @if($device->foto_depan)
                            <div class="photo-item">
                                <img src="{{ asset('storage/' . $device->foto_depan) }}" alt="Device Front View">
                                <div class="photo-caption">Front View</div>
                            </div>
                        @endif
                        @if($device->foto_belakang)
                            <div class="photo-item">
                                <img src="{{ asset('storage/' . $device->foto_belakang) }}" alt="Device Back View">
                                <div class="photo-caption">Back View</div>
                            </div>
                        @endif
                        @if($device->foto_terpasang)
                            <div class="photo-item">
                                <img src="{{ asset('storage/' . $device->foto_terpasang) }}" alt="Device Installed">
                                <div class="photo-caption">Installed</div>
                            </div>
                        @endif
                        @if($device->foto_serial)
                            <div class="photo-item">
                                <img src="{{ asset('storage/' . $device->foto_serial) }}" alt="Device Serial">
                                <div class="photo-caption">Serial/ID</div>
                            </div>
                        @endif
                    </div>
                @else
                    <div class="alert alert-info">
                        <i class="fa fa-info-circle me-2"></i> No photos available for this device.
                    </div>
                @endif
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
                    <a href="{{ route('admin.device.edit', $device->id) }}" class="btn btn-outline-warning action-button">
                        <i class="fa fa-pencil btn-icon"></i> Edit Device
                    </a>
                    <a href="{{ route('admin.device.move-location-page', $device->device_id) }}" class="btn btn-outline-info action-button">
                        <i class="fa fa-map-marker btn-icon"></i> Move Location
                    </a>
                    <button class="btn btn-outline-primary action-button" onclick="printQR()">
                        <i class="fa fa-print btn-icon"></i> Print QR Code
                    </button>
                    <form action="{{ route('admin.device.destroy', $device->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this device?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger action-button w-100 text-start">
                            <i class="fa fa-trash btn-icon"></i> Delete Device
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- 3D Model if available -->
        @if($device->tipe && !empty($device->tipe->file))
            <div class="card section-card">
                <div class="card-header">
                    <h6 class="card-title">3D Model</h6>
                </div>
                <div class="card-body">
                    <model-viewer class="product-3d-viewer" alt="Model 3D {{ $device->tipe->name }}"
                        src="{{ asset('storage/' . $device->tipe->file) }}" shadow-intensity="1" camera-controls
                        touch-action="pan-y"
                        style="width: 100%; height: 300px; background-color: #f0f0f0; border-radius: 8px;">
                    </model-viewer>
                    <div class="text-center mt-3">
                        <p class="text-muted">Use mouse to rotate, zoom, and pan the model.</p>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

@push('scripts')
    <script src="{{ asset('dist/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script type="module" src="https://ajax.googleapis.com/ajax/libs/model-viewer/4.0.0/model-viewer.min.js"></script>
    <script>
        function printQR() {
            // Create a new window with just the QR code
            const qrCode = document.querySelector('.device-qr img').src;
            const deviceId = '{{ $device->device_id }}';
            const deviceName = '{{ $device->tipe ? $device->tipe->name : "Device" }}';
            
            const printWindow = window.open('', '_blank');
            printWindow.document.write(`
                <html>
                <head>
                    <title>QR Code for ${deviceId}</title>
                    <style>
                        body { font-family: Arial, sans-serif; text-align: center; }
                        .qr-container { margin: 20px auto; max-width: 300px; }
                        .qr-code { width: 200px; height: 200px; margin: 0 auto; }
                        .device-info { margin-top: 10px; }
                    </style>
                </head>
                <body>
                    <div class="qr-container">
                        <img src="${qrCode}" class="qr-code" alt="QR Code">
                        <div class="device-info">
                            <h3>${deviceName}</h3>
                            <p>ID: ${deviceId}</p>
                        </div>
                    </div>
                </body>
                </html>
            `);
            
            printWindow.document.close();
            printWindow.focus();
            
            // Print after a small delay to ensure content is loaded
            setTimeout(() => {
                printWindow.print();
                printWindow.close();
            }, 500);
        }
    </script>
@endpush
@endsection
