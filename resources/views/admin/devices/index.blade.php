@extends('layouts.app')
@section('content')
@section('title', 'Master Device')
@push('links')
    <link href="{{ asset('dist/assets/libs/simple-datatables/style.css') }}" rel="stylesheet" type="text/css" />
    <!-- Sweet Alert -->
    <link href="{{ asset('dist/assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('dist/assets/libs/animate.css/animate.min.css') }}" rel="stylesheet" type="text/css">
    <!-- Select2 -->
    <link href="{{ asset('dist/assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css">
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
                                        <form action="{{ route('admin.device.destroy', $device->id) }}" method="POST"
                                            class="d-inline-block" onsubmit="return confirm('Yakin hapus data?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm">Hapus</button>
                                        </form>
                                        <a href="{{ route('admin.device.details', $device->id) }}"
                                            class="btn btn-outline-secondary btn-sm">Lihat Device</a>
                                        <button type="button" class="btn btn-outline-info btn-sm move-location"
                                            data-bs-toggle="modal" data-bs-target="#moveLocationModal"
                                            data-device-id="{{ $device->device_id }}">
                                            <i class="fa fa-map-marker-alt"></i> Move Location
                                        </button>
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

                    <div class="mb-3 row" id="building-image-container" style="display:none; position:relative;">
                        <label for="location" class="col-sm-3 col-form-label text-end">Building Image</label>
                        <div class="col-sm-9" id="building-image-container-inner">
                            <!-- Building image will appear here -->
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
        $('.select2').select2();

        // Show modal and assign device id when clicking "Move Location"
        $('.move-location').click(function() {
            let deviceId = $(this).data('device-id');
            $('#device-id-input').val(deviceId);
            var modal = new bootstrap.Modal(document.getElementById('moveLocationModal'));
            modal.show();
        });

        // Use the Select2 event on gedung_id to update building image
        $('#gedung_id').on('select2:select', function(e) {
            // Instead of using e.params.data.element, query the selected option directly.
            let buildingImageUrl = $('#gedung_id option:selected').data('image');
            const container = $('#building-image-container');
            const imageContainerInner = $('#building-image-container-inner');
            console.log('Selected building image URL:', buildingImageUrl);

            if (buildingImageUrl) {
                container.show();
                imageContainerInner.html(
                    `<img src="${buildingImageUrl}" id="building-map" alt="Building Image" style="max-width: 100%; height: auto; cursor: crosshair;" />`
                );
                $('#location').val('');

                // Attach click event on the building image
                $('#building-map').off('click').on('click', function(e) {
                    const rect = this.getBoundingClientRect();
                    const clickX = e.clientX - rect.left;
                    const clickY = e.clientY - rect.top;
                    const percentX = (clickX / this.clientWidth) * 100;
                    const percentY = (clickY / this.clientHeight) * 100;
                    $('#location').val(`${percentX.toFixed(2)},${percentY.toFixed(2)}`);

                    $('.location-marker').remove();
                    const marker = $('<div class="location-marker"></div>').css({
                        left: `calc(${percentX.toFixed(2)}% - 10px)`,
                        top: `calc(${percentY.toFixed(2)}% - 10px)`
                    });
                    $(this).parent().css('position', 'relative');
                    $(this).parent().append(marker);
                });
            } else {
                container.hide();
            }
        });

        // Submit location via AJAX
        $('#btnSimpanLocation').click(function() {
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
                        var modal = bootstrap.Modal.getInstance(document.getElementById(
                            'moveLocationModal'));
                        modal.hide();
                        location.reload();
                    }
                },
                error: function(xhr) {
                    Swal.fire('Error!', 'Gagal memindahkan lokasi perangkat.', 'error');
                }
            });
        });
    });
</script>

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('dist/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('dist/assets/libs/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('dist/assets/libs/simple-datatables/umd/simple-datatables.js') }}"></script>
    <script src="{{ asset('dist/assets/js/pages/datatable.init.js') }}"></script>
@endpush
@endsection
