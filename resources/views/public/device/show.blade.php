@extends('layouts.public-device')
@section('title', 'Informasi Device')
@push('links')
    <link href="{{ asset('dist/assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        .device-title { display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1rem; }
        .device-id { font-size: 0.95rem; color: #fff; background: #4361ee; padding: 0.25rem 0.9rem; border-radius: 1rem; font-weight: 600; letter-spacing: 1px; }
        .status-badge { padding: 0.25rem 0.9rem; border-radius: 2rem; font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; }
        .status-active { background: #e8f8f2; color: #2ecc71; border: 1px solid #2ecc71; }
        .status-inactive { background: #fbeee6; color: #e74c3c; border: 1px solid #e74c3c; }
        .info-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.2rem; }
        .info-item { margin-bottom: 0.5rem; display: flex; align-items: center; gap: 0.5rem; }
        .info-label { font-size: 0.92rem; color: #495057; font-weight: 600; margin-bottom: 0.25rem; }
        .info-value { font-size: 1.05rem; color: #222; font-weight: 500; }
        .device-qr { display: flex; flex-direction: column; align-items: center; margin-top: 1.5rem; }
        .device-qr img { border: 1px solid #e9ecef; padding: 0.5rem; border-radius: 0.5rem; background-color: white; }
        .device-qr-label { margin-top: 0.5rem; font-size: 0.95rem; color: #495057; font-weight: 500; }
        .photo-gallery { display: grid; grid-template-columns: repeat(auto-fill, minmax(140px, 1fr)); gap: 0.75rem; margin-top: 1rem; }
        .photo-item { border-radius: 0.5rem; overflow: hidden; position: relative; aspect-ratio: 1/1; border: 1px solid #e9ecef; }
        .photo-item img { width: 100%; height: 100%; object-fit: cover; }
        .photo-caption { position: absolute; bottom: 0; left: 0; right: 0; background: linear-gradient(to top, rgba(0, 0, 0, 0.7), transparent); color: white; padding: 0.5rem; font-size: 0.85rem; text-align: center; }
        .location-container { position: relative; width: 100%; border-radius: 8px; overflow: hidden; border: 1px solid #ddd; margin-bottom: 1rem; }
        .location-container img { width: 100%; height: auto; display: block; }
        .marker { position: absolute; width: 20px; height: 20px; background-color: red; border-radius: 50%; border: 2px solid white; box-shadow: 0 0 5px rgba(0, 0, 0, 0.5); transform: translate(-50%, -50%); z-index: 10; }
        .section-title { font-size: 1.15rem; font-weight: 700; color: #4361ee; margin-bottom: 0.7rem; display: flex; align-items: center; gap: 0.5rem; }
        .section-title i { color: #4361ee; }
        .alert-info { font-size: 0.98rem; }
        .public-summary { background: #fff; border-radius: 0.7rem; box-shadow: 0 2px 8px rgba(67,97,238,0.07); padding: 1.2rem 1.5rem; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 1.5rem; }
        .public-summary .icon { font-size: 2.2rem; color: #4361ee; background: #e9ecef; border-radius: 50%; padding: 0.7rem; }
        .public-summary .summary-main { flex: 1; }
        .public-summary .summary-main h2 { font-size: 1.3rem; font-weight: 700; margin-bottom: 0.2rem; }
        .public-summary .summary-main p { margin-bottom: 0; color: #666; font-size: 1.02rem; }
    </style>
@endpush
@section('content')
@php
    $latestLocation = $device->location()->with('gedung')->latest()->first();
    $locationCoords = $latestLocation && $latestLocation->location ? explode(',', $latestLocation->location) : null;
    $coordX = $locationCoords && count($locationCoords) >= 2 ? $locationCoords[0] : 50;
    $coordY = $locationCoords && count($locationCoords) >= 2 ? $locationCoords[1] : 50;
@endphp
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="public-summary mb-4">
                <span class="icon"><i class="fa-solid fa-microchip"></i></span>
                <div class="summary-main">
                    <h2>{{ $device->tipe->name ?? 'Unknown Device' }}</h2>
                    <p>ID: <span class="device-id">{{ $device->device_id }}</span></p>
                    <div class="mt-2">
                        <span class="status-badge {{ $device->isActive ? 'status-active' : 'status-inactive' }}">
                            <i class="fa-solid fa-circle me-1"></i> {{ $device->isActive ? 'Aktif' : 'Tidak Aktif' }}
                        </span>
                        @if(!$device->isActive)
                            <span class="text-danger ms-2"><i class="fa-solid fa-triangle-exclamation"></i> Device ini sedang tidak aktif.</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header bg-white border-0">
                    <span class="section-title"><i class="fa-solid fa-circle-info"></i> Informasi Lengkap</span>
                </div>
                <div class="card-body">
                    <div class="info-grid mb-4">
                        @if($device->brand)
                            <div class="info-item"><span class="info-label"><i class="fa-solid fa-industry"></i> Brand</span><span class="info-value">{{ $device->brand->name }}</span></div>
                        @endif
                        @if($device->categoryDana)
                            <div class="info-item"><span class="info-label"><i class="fa-solid fa-layer-group"></i> Kategori</span><span class="info-value">{{ $device->categoryDana->name }}</span></div>
                        @endif
                        @if($device->sticker)
                            <div class="info-item"><span class="info-label"><i class="fa-solid fa-barcode"></i> Serial Key/Sticker</span><span class="info-value">{{ $device->sticker }}</span></div>
                        @endif
                        <div class="info-item"><span class="info-label"><i class="fa-solid fa-calendar-plus"></i> Dibuat</span><span class="info-value">{{ $device->created_at->format('d M Y') }}</span></div>
                        <div class="info-item"><span class="info-label"><i class="fa-solid fa-calendar-check"></i> Update Terakhir</span><span class="info-value">{{ $device->updated_at->format('d M Y') }}</span></div>
                    </div>
                    <div class="device-qr">
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ $device->device_id }}"
                            alt="QR Code for {{ $device->device_id }}" width="150">
                        <div class="device-qr-label"><i class="fa-solid fa-qrcode"></i> Scan untuk melihat detail device ini</div>
                    </div>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header bg-white border-0">
                    <span class="section-title"><i class="fa-solid fa-location-dot"></i> Lokasi Terakhir</span>
                </div>
                <div class="card-body">
                    @if($latestLocation && $latestLocation->gedung && $latestLocation->gedung->photo_url)
                        <div class="location-container mt-2" id="location-container">
                            <img src="{{ $latestLocation->gedung->photo_url }}" alt="{{ $latestLocation->gedung->name }} Map" id="building-map">
                            <div class="marker" style="left: {{ $coordX }}%; top: {{ $coordY }}%;"></div>
                        </div>
                        <p class="mt-2">
                            <span class="info-label"><i class="fa-solid fa-building"></i> Gedung:</span> <span class="info-value">{{ $latestLocation->gedung->name }}</span><br>
                            <span class="info-label"><i class="fa-solid fa-location-crosshairs"></i> Koordinat:</span> <span class="info-value">{{ $latestLocation->location }}</span>
                        </p>
                    @else
                        <div class="alert alert-info">
                            <i class="fa fa-info-circle me-2"></i> Lokasi belum diatur untuk device ini.
                        </div>
                    @endif
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header bg-white border-0">
                    <span class="section-title"><i class="fa-solid fa-clock-rotate-left"></i> History Lokasi</span>
                </div>
                <div class="card-body p-0">
                    @if($device->location && $device->location->count() > 0)
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th><i class="fa-solid fa-building"></i> Gedung</th>
                                    <th><i class="fa-solid fa-calendar"></i> Tanggal</th>
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
                        <div class="alert alert-info m-3">Belum ada history lokasi</div>
                    @endif
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header bg-white border-0">
                    <span class="section-title"><i class="fa-solid fa-images"></i> Foto Device</span>
                </div>
                <div class="card-body">
                    @if($device->foto_depan || $device->foto_belakang || $device->foto_terpasang || $device->foto_serial)
                        <div class="photo-gallery">
                            @if($device->foto_depan)
                                <div class="photo-item">
                                    <img src="{{ asset('storage/' . $device->foto_depan) }}" alt="Device Front View">
                                    <div class="photo-caption">Depan</div>
                                </div>
                            @endif
                            @if($device->foto_belakang)
                                <div class="photo-item">
                                    <img src="{{ asset('storage/' . $device->foto_belakang) }}" alt="Device Back View">
                                    <div class="photo-caption">Belakang</div>
                                </div>
                            @endif
                            @if($device->foto_terpasang)
                                <div class="photo-item">
                                    <img src="{{ asset('storage/' . $device->foto_terpasang) }}" alt="Device Installed">
                                    <div class="photo-caption">Terpasang</div>
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
                            <i class="fa fa-info-circle me-2"></i> Tidak ada foto untuk device ini.
                        </div>
                    @endif
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header bg-white border-0">
                    <span class="section-title"><i class="fa-solid fa-cube"></i> Sticker & 3D Model</span>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <h6 class="mb-2"><i class="fa-solid fa-barcode"></i> Gambar Sticker</h6>
                            @if($device->sticker)
                                <img src="{{ asset('storage/' . $device->sticker) }}" alt="Sticker" class="img-fluid rounded border" style="max-width:200px;">
                            @else
                                <div class="alert alert-info p-2">Tidak ada gambar sticker.</div>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <h6 class="mb-2"><i class="fa-solid fa-cube"></i> Model 3D</h6>
                            @if($device->tipe && !empty($device->tipe->file))
                                <model-viewer class="product-3d-viewer" alt="Model 3D {{ $device->tipe->name }}"
                                    src="{{ asset('storage/' . $device->tipe->file) }}" shadow-intensity="1" camera-controls
                                    touch-action="pan-y"
                                    style="width: 100%; height: 300px; background-color: #f0f0f0; border-radius: 8px;">
                                </model-viewer>
                                <div class="text-muted mt-2" style="font-size:0.9em;">Gunakan mouse untuk rotasi, zoom, dan pan model.</div>
                            @else
                                <div class="alert alert-info p-2">Tidak ada model 3D.</div>
                            @endif
                        </div>
                    </div>
                </div>
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
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script type="module" src="https://ajax.googleapis.com/ajax/libs/model-viewer/4.0.0/model-viewer.min.js"></script>
@endpush 