@extends('layouts.app')
@section('content')
@section('title', 'Detail Tipe')
@push('links')
    <!-- Model Viewer dari Google -->
    <script src="https://cdn.jsdelivr.net/npm/@google/model-viewer@2.10.0/dist/model-viewer.min.js"></script>
    <!-- OwlCarousel (jika diperlukan) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
        integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- SweetAlert -->
    <link href="{{ asset('dist/assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
@endpush

<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box d-md-flex justify-content-md-between align-items-center">
            <h4 class="page-title">Detail Tipe</h4>
            <div class="">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="#">Master</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('/admin/tipe') }}">Tipe</a></li>
                    <li class="breadcrumb-item active">Detail</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Informasi Tipe -->
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Informasi Tipe</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered mb-0">
                        <tbody>
                            <tr>
                                <th width="35%">Nama Tipe</th>
                                <td>{{ $tipe->name }}</td>
                            </tr>
                            <tr>
                                <th>Slug</th>
                                <td>{{ $tipe->slug }}</td>
                            </tr>
                            <tr>
                                <th>Ruckus</th>
                                <td>{{ $tipe->isRuckus ? 'Yes' : 'No' }}</td>
                            </tr>
                            <tr>
                                <th>Icon</th>
                                <td>
                                    @if ($tipe->icon)
                                        <i class="{{ $tipe->icon }}"></i> ({{ $tipe->icon }})
                                    @else
                                        <span>-</span>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        @if (isset($tipe->description))
            <div class="card mt-3">
                <div class="card-header">
                    <h4 class="card-title">Deskripsi / Spesifikasi</h4>
                </div>
                <div class="card-body">
                    <div class="spec-content">
                        {!! nl2br(e($tipe->description)) !!}
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Model 3D menggunakan model-viewer -->
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Model 3D</h4>
            </div>
            <div class="card-body">
                @if ($tipe->file)
                    <model-viewer class="product-3d-viewer" alt="Model 3D {{ $tipe->name }}"
                        src="{{ $tipe->file_url }}" shadow-intensity="1" camera-controls touch-action="pan-y"
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

<div class="row mt-3">
    <div class="col-12">
        <a href="{{ url('/admin/tipe') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i> Kembali
        </a>
    </div>
</div>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/@google/model-viewer@2.10.0/dist/model-viewer.min.js"></script>
    <script src="{{ asset('dist/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
@endpush
@endsection
