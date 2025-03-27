@extends('layouts.public-device')
@section('title', 'Device Aktif di ' . $gedung->name)
@push('links')
<style>
    .gedung-header { text-align: center; margin-bottom: 2rem; }
    .gedung-photo { width: 100%; max-width: 400px; height: 200px; object-fit: cover; border-radius: 1rem; margin: 0 auto 1rem; background: #f8f9fa; }
    .device-card { background: #fff; border-radius: 1rem; box-shadow: 0 2px 8px rgba(67,97,238,0.07); padding: 1.2rem; border: 1px solid #e9ecef; transition: box-shadow .2s; }
    .device-card:hover { box-shadow: 0 6px 24px rgba(67,97,238,0.13); border-color: #4361ee; }
    .device-title { font-size: 1.1rem; font-weight: 700; color: #4361ee; margin-bottom: 0.2rem; }
    .device-meta { color: #666; font-size: 0.98rem; margin-bottom: 0.5rem; }
    .device-link { display: inline-block; background: #4361ee; color: #fff; padding: 0.4rem 1.1rem; border-radius: 2rem; font-weight: 600; text-decoration: none; transition: background .2s; font-size: 0.98rem; }
    .device-link:hover { background: #2d3a8c; color: #fff; }
</style>
@endpush
@section('content')
<div class="container py-4">
    <div class="gedung-header">
        @if($gedung->photo_url)
            <img src="{{ $gedung->photo_url }}" class="gedung-photo mb-3" alt="{{ $gedung->name }}">
        @endif
        <h2 style="font-weight:700; color:#4361ee;">{{ $gedung->name }}</h2>
        <div class="mb-2 text-muted">{{ $gedung->lokasi }}</div>
        <div class="mb-4" style="font-size:1.1rem; color:#2ecc71; font-weight:600;">{{ $activeDevices->count() }} Device Aktif</div>
    </div>
    <div class="row g-4 justify-content-center">
        @forelse($activeDevices as $device)
        <div class="col-md-4 col-lg-3">
            <div class="device-card h-100 d-flex flex-column align-items-center text-center">
                <div class="device-title">{{ $device->tipe->name ?? '-' }}</div>
                <div class="device-meta">Brand: {{ $device->brand->name ?? '-' }}</div>
                <div class="device-meta">ID: {{ $device->device_id }}</div>
                <a href="{{ route('public.device.show', $device->device_id) }}" class="device-link mt-auto">Detail / QR</a>
            </div>
        </div>
        @empty
        <div class="col-12 text-center text-muted">Tidak ada device aktif di gedung ini.</div>
        @endforelse
    </div>
    <div class="text-center mt-4">
        <a href="{{ route('landing') }}" class="btn btn-outline-secondary">Kembali ke Pilih Gedung</a>
    </div>
</div>
@endsection 