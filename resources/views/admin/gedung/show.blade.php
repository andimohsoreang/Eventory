@extends('layouts.app')
@section('content')
@section('title', $gedung->name)
@push('links')
    <link href="{{ asset('dist/assets/libs/simple-datatables/style.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('dist/assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
    <style>
        .building-header {
            background-color: #f8f9fa;
            padding: 1.5rem;
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
            position: relative;
            overflow: hidden;
        }
        
        .building-header-image {
            position: absolute;
            top: 0;
            right: 0;
            width: 30%;
            height: 100%;
            background-size: cover;
            background-position: center;
            opacity: 0.15;
        }
        
        .device-count {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1rem;
            background-color: #fff;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            transition: all 0.3s ease;
        }
        
        .device-count:hover {
            transform: translateY(-3px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }
        
        .device-count .count {
            font-size: 2rem;
            font-weight: 700;
            margin-right: 1rem;
        }
        
        .device-count .text {
            flex: 1;
        }
        
        .device-count .text h5 {
            margin-bottom: 0.25rem;
        }
        
        .device-count .text p {
            margin-bottom: 0;
            color: #6c757d;
        }
        
        .device-map {
            position: relative;
            border-radius: 0.5rem;
            overflow: hidden;
            margin-bottom: 1.5rem;
        }
        
        .device-map img {
            width: 100%;
            height: auto;
            display: block;
        }
        
        .map-marker {
            position: absolute;
            width: 16px;
            height: 16px;
            background-color: red;
            border-radius: 50%;
            border: 2px solid white;
            box-shadow: 0 0 0 2px rgba(0, 0, 0, 0.1);
            transform: translate(-50%, -50%);
            z-index: 2;
        }
        
        .map-marker:hover::after {
            content: attr(data-device);
            position: absolute;
            bottom: 100%;
            left: 50%;
            transform: translateX(-50%);
            background-color: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 0.25rem 0.5rem;
            border-radius: 0.25rem;
            font-size: 0.75rem;
            white-space: nowrap;
            margin-bottom: 0.25rem;
        }
        
        .device-type-chart {
            height: 250px;
        }
        
        .device-badge {
            display: inline-block;
            padding: 0.25rem 0.5rem;
            border-radius: 1rem;
            font-size: 0.75rem;
            font-weight: 600;
            margin-right: 0.5rem;
        }
        
        .badge-router {
            background-color: rgba(46, 204, 113, 0.15);
            color: #2ecc71;
        }
        
        .badge-switch {
            background-color: rgba(52, 152, 219, 0.15);
            color: #3498db;
        }
        
        .badge-ap {
            background-color: rgba(243, 156, 18, 0.15);
            color: #f39c12;
        }
        
        .badge-firewall {
            background-color: rgba(231, 76, 60, 0.15);
            color: #e74c3c;
        }
        
        .table td, .table th {
            vertical-align: middle;
        }
        
        .devices-timeline {
            position: relative;
            padding-left: 2rem;
        }
        
        .timeline-item {
            position: relative;
            padding-bottom: 1.5rem;
        }
        
        .timeline-line {
            position: absolute;
            left: -1.5rem;
            top: 0;
            bottom: 0;
            width: 2px;
            background-color: #e9ecef;
        }
        
        .timeline-dot {
            position: absolute;
            left: -1.65rem;
            top: 0.375rem;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background-color: #4361ee;
            border: 2px solid white;
        }
        
        .timeline-date {
            font-size: 0.875rem;
            color: #6c757d;
            margin-bottom: 0.25rem;
        }
        
        .timeline-content {
            background-color: #f8f9fa;
            padding: 1rem;
            border-radius: 0.5rem;
        }
    </style>
@endpush

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-md-flex justify-content-between align-items-center">
            <h4 class="page-title">{{ $gedung->name }}</h4>
            <div>
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.gedung') }}">Buildings</a></li>
                    <li class="breadcrumb-item active">{{ $gedung->name }}</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- Building Header -->
<div class="row">
    <div class="col-12">
        <div class="building-header">
            @if($gedung->photo)
                <div class="building-header-image" style="background-image: url('{{ $gedung->photo_url }}');"></div>
            @endif
            <div class="row">
                <div class="col-md-8">
                    <h2 class="mb-4">{{ $gedung->name }}</h2>
                    <div class="d-flex mb-3">
                        <div class="me-4">
                            <h6 class="text-muted mb-1">Location</h6>
                            <p class="mb-0 fw-medium">{{ $gedung->lokasi ?? 'Not specified' }}</p>
                        </div>
                        <div class="me-4">
                            <h6 class="text-muted mb-1">Parent Building</h6>
                            <p class="mb-0 fw-medium">{{ $gedung->parent ? $gedung->parent->name : 'None' }}</p>
                        </div>
                        <div>
                            <h6 class="text-muted mb-1">Child Buildings</h6>
                            <p class="mb-0 fw-medium">{{ $gedung->children->count() }}</p>
                        </div>
                    </div>
                    <div class="d-flex mb-0">
                        <a href="{{ route('admin.gedung.edit', $gedung->id) }}" class="btn btn-primary me-2">
                            <i class="fa fa-edit me-1"></i> Edit Building
                        </a>
                        <form action="{{ route('admin.gedung.destroy', $gedung->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure? This will delete the building and all associated data.')">
                                <i class="fa fa-trash me-1"></i> Delete Building
                            </button>
                        </form>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-end">
                        <p class="mb-1 text-muted">Total Devices</p>
                        <h3 class="mb-3">{{ $currentDevices->count() }}</h3>
                        <div class="device-type-distribution">
                            @foreach($devicesByType as $type)
                                <span class="device-badge 
                                    @if(strtolower($type->type_name) == 'router') badge-router 
                                    @elseif(strtolower($type->type_name) == 'switch') badge-switch 
                                    @elseif(strtolower($type->type_name) == 'access point') badge-ap 
                                    @elseif(strtolower($type->type_name) == 'firewall') badge-firewall 
                                    @endif">
                                    {{ $type->type_name }}: {{ $type->count }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Building Floor Plan with Devices -->
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Building Floor Plan</h5>
            </div>
            <div class="card-body">
                @if($gedung->photo)
                    <div class="device-map">
                        <img src="{{ $gedung->photo_url }}" alt="{{ $gedung->name }} Floor Plan">
                        @foreach($currentDevices as $device)
                            @php
                                $lastLocation = $device->location->first();
                                if($lastLocation && $lastLocation->location) {
                                    $coords = explode(',', $lastLocation->location);
                                    if(count($coords) >= 2) {
                                        $x = $coords[0];
                                        $y = $coords[1];
                                    }
                                }
                            @endphp
                            
                            @if(isset($x) && isset($y))
                                <div class="map-marker" 
                                     style="left: {{ $x }}%; top: {{ $y }}%;" 
                                     data-device="{{ $device->device_id }} ({{ $device->tipe ? $device->tipe->name : 'Unknown' }})"></div>
                            @endif
                        @endforeach
                    </div>
                    <div class="text-center mt-2 text-muted small">
                        <i class="fa fa-info-circle me-1"></i> Hover over markers to see device details
                    </div>
                @else
                    <div class="alert alert-info">
                        <i class="fa fa-info-circle me-1"></i> No floor plan image available for this building.
                        <a href="{{ route('admin.gedung.edit', $gedung->id) }}" class="alert-link">Upload a floor plan</a> to visualize device locations.
                    </div>
                @endif
            </div>
        </div>
        
        <!-- Current Devices in Building -->
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title">Current Devices in Building</h5>
                <div>
                    <a href="{{ route('admin.device.create') }}" class="btn btn-sm btn-primary">
                        <i class="fa fa-plus me-1"></i> Add Device
                    </a>
                </div>
            </div>
            <div class="card-body">
                @if($currentDevices->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-centered table-striped">
                            <thead>
                                <tr>
                                    <th>Device ID</th>
                                    <th>Type</th>
                                    <th>Brand</th>
                                    <th>Status</th>
                                    <th>Since</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($currentDevices as $device)
                                    @php
                                        $lastLocation = $device->location->first();
                                    @endphp
                                    <tr>
                                        <td>{{ $device->device_id }}</td>
                                        <td>{{ $device->tipe ? $device->tipe->name : '-' }}</td>
                                        <td>{{ $device->brand ? $device->brand->name : '-' }}</td>
                                        <td>
                                            @if($device->isActive)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>{{ $lastLocation ? $lastLocation->created_at->format('d M Y') : '-' }}</td>
                                        <td>
                                            <a href="{{ route('admin.device.show', $device->id) }}" class="btn btn-sm btn-info">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.device.move-location-page', $device->device_id) }}" class="btn btn-sm btn-warning">
                                                <i class="fa fa-map-marker"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="alert alert-info mb-0">
                        <i class="fa fa-info-circle me-1"></i> No devices are currently in this building.
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <!-- Device History and Stats -->
    <div class="col-lg-4">
        <!-- Device Type Distribution -->
        <div class="card mb-3">
            <div class="card-header">
                <h5 class="card-title">Device Type Distribution</h5>
            </div>
            <div class="card-body">
                @if($devicesByType->count() > 0)
                    <div class="device-type-chart" id="deviceTypeChart">
                        <!-- Chart will be rendered here -->
                    </div>
                @else
                    <div class="alert alert-info mb-0">
                        <i class="fa fa-info-circle me-1"></i> No device type data available.
                    </div>
                @endif
            </div>
        </div>
        
        <!-- Building Children -->
        @if($gedung->children->count() > 0)
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title">Child Buildings</h5>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        @foreach($gedung->children as $child)
                            <a href="{{ route('admin.gedung.show', $child->id) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                {{ $child->name }}
                                <span class="badge bg-primary rounded-pill">
                                    <i class="fa fa-arrow-right"></i>
                                </span>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
        
        <!-- Device History Timeline -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Device History</h5>
            </div>
            <div class="card-body">
                @if($deviceHistory->count() > 0)
                    <div class="devices-timeline">
                        @foreach($deviceHistory->take(10) as $deviceId => $locations)
                            @php
                                $device = $locations->first()->device;
                                $firstEntry = $locations->last(); // First chronologically
                                $lastEntry = $locations->first(); // Most recent
                            @endphp
                            <div class="timeline-item">
                                <div class="timeline-line"></div>
                                <div class="timeline-dot"></div>
                                <div class="timeline-date">{{ $lastEntry->created_at->format('d M Y, H:i') }}</div>
                                <div class="timeline-content">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="mb-1">{{ $device->device_id }}</h6>
                                        <span class="text-muted">{{ $device->tipe ? $device->tipe->name : 'Unknown Type' }}</span>
                                    </div>
                                    <p class="mb-1 small">
                                        @if($locations->count() > 1)
                                            First placed: {{ $firstEntry->created_at->format('d M Y') }}<br>
                                            Moved {{ $locations->count() - 1 }} times
                                        @else
                                            Added on {{ $firstEntry->created_at->format('d M Y') }}
                                        @endif
                                    </p>
                                    <div class="mt-2">
                                        <a href="{{ route('admin.device.show', $device->id) }}" class="btn btn-sm btn-outline-primary">View Device</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="alert alert-info mb-0">
                        <i class="fa fa-info-circle me-1"></i> No device history available for this building.
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script src="{{ asset('dist/assets/libs/simple-datatables/umd/simple-datatables.js') }}"></script>
    <script src="{{ asset('dist/assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize datatable
            const datatable = new simpleDatatables.DataTable("table", {
                perPage: 10,
                perPageSelect: [5, 10, 15, 20, 25],
                columns: [
                    { select: [5], sortable: false } // Disable sorting for actions column
                ]
            });
            
            // Initialize device type chart if there's data and the element exists
            if (document.getElementById('deviceTypeChart')) {
                const types = @json($devicesByType->pluck('type_name'));
                const counts = @json($devicesByType->pluck('count'));
                
                if (types.length > 0) {
                    const options = {
                        series: counts,
                        chart: {
                            type: 'donut',
                            height: 240
                        },
                        labels: types,
                        colors: ['#2ecc71', '#3498db', '#f39c12', '#e74c3c', '#9b59b6'],
                        legend: {
                            position: 'bottom'
                        },
                        responsive: [{
                            breakpoint: 480,
                            options: {
                                chart: {
                                    height: 200
                                },
                                legend: {
                                    position: 'bottom'
                                }
                            }
                        }]
                    };
                    
                    const chart = new ApexCharts(document.getElementById('deviceTypeChart'), options);
                    chart.render();
                }
            }
        });
    </script>
@endpush
@endsection 