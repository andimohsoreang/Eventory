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
                        <a href="#" class="btn btn-primary d-flex align-items-center mb-2 mb-md-0">
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
                                <th>Serial Key</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Gedung</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>DEV-001</td>
                                <td>SN-12345678</td>
                                <td>Router</td>
                                <td>
                                    <span class="badge bg-success">
                                        Active
                                    </span>
                                </td>
                                <td>Gedung A</td>
                                <td>
                                    <a href="#" class="btn btn-outline-info">Detail</a>
                                    <a href="#" class="btn btn-outline-primary">Edit</a>
                                    <button type="button" class="btn btn-outline-danger">Hapus</button>
                                    <a href="#" class="btn btn-outline-secondary">Lihat Device</a>
                                    <button type="button" class="btn btn-outline-info" data-bs-toggle="modal"
                                        data-bs-target="#moveLocationModal" data-device-id="1">
                                        Move Location
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>DEV-002</td>
                                <td>SN-87654321</td>
                                <td>Switch</td>
                                <td>
                                    <span class="badge bg-danger">
                                        Inactive
                                    </span>
                                </td>
                                <td>Gedung B</td>
                                <td>
                                    <a href="#" class="btn btn-outline-info">Detail</a>
                                    <a href="#" class="btn btn-outline-primary">Edit</a>
                                    <button type="button" class="btn btn-outline-danger">Hapus</button>
                                    <a href="#" class="btn btn-outline-secondary">Lihat Device</a>
                                    <button type="button" class="btn btn-outline-info" data-bs-toggle="modal"
                                        data-bs-target="#moveLocationModal" data-device-id="2">
                                        Move Location
                                    </button>
                                </td>
                            </tr>
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
                    <input type="hidden" name="device_id" id="device-id-input">

                    <div class="mb-3 row">
                        <label for="serial_key" class="col-sm-3 col-form-label text-end">Serial Key</label>
                        <div class="col-sm-9">
                            <input type="text" name="serial_key" id="serial_key" class="form-control"
                                placeholder="Enter device serial key" />
                            <small class="form-text text-muted">Enter the device serial key for verification</small>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="gedung_id" class="col-sm-3 col-form-label text-end">Building</label>
                        <div class="col-sm-9">
                            <select name="gedung_id" id="gedung_id" class="form-control select2" required>
                                <option value="" selected hidden>-- Select Building --</option>
                                <option value="1" data-image="uploads/gedung/photo/building-a.jpg">Gedung A
                                </option>
                                <option value="2" data-image="uploads/gedung/photo/building-b.jpg">Gedung B
                                </option>
                                <option value="3" data-image="uploads/gedung/photo/building-c.jpg">Gedung C
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row" id="building-image-container" style="display:none; position:relative;">
                        <label for="location" class="col-sm-3 col-form-label text-end">Building Image</label>
                        <div class="col-sm-9">
                            <div id="building-image"></div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="location" class="col-sm-3 col-form-label text-end">Location (Click on the image to
                            set location)</label>
                        <div class="col-sm-9">
                            <input type="hidden" name="location" id="location" class="form-control" required />
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

<!-- JavaScript for Modals -->
<script>
    let marker = null; // Untuk melacak marker yang telah dibuat

    // Handle modal opening dan set device id pada form
    const moveLocationModal = document.getElementById('moveLocationModal');
    moveLocationModal.addEventListener('show.bs.modal', function(event) {
        const button = event.relatedTarget; // Button yang memicu modal
        const deviceId = button.getAttribute('data-device-id'); // Ambil device id

        // Set device id di input tersembunyi
        document.getElementById('device-id-input').value = deviceId;

        // Set default serial key based on device ID (sample logic - in real app you would fetch this)
        if (deviceId === "1") {
            document.getElementById('serial_key').value = "SN-12345678";
        } else if (deviceId === "2") {
            document.getElementById('serial_key').value = "SN-87654321";
        } else {
            document.getElementById('serial_key').value = "";
        }

        // Pastikan marker dihapus saat modal dibuka kembali
        marker = null;
        document.getElementById('location').value = '';
        document.getElementById('building-image-container').style.display = 'none';
        document.getElementById('building-image').innerHTML = '';
    });

    // Handle perubahan pada select gedung dan tampilkan gambar gedung
    document.getElementById('gedung_id').addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const buildingImageUrl = selectedOption.getAttribute('data-image');
        const buildingImageContainer = document.getElementById('building-image-container');
        const buildingImage = document.getElementById('building-image');

        if (buildingImageUrl) {
            buildingImageContainer.style.display = 'block';
            buildingImage.innerHTML =
                `<img src="${buildingImageUrl}" id="building-map" alt="Building Image" style="max-width: 100%; height: auto; cursor: crosshair;" />`;

            // Reset input lokasi
            document.getElementById('location').value = '';

            const buildingMap = document.getElementById('building-map');

            // Tambahkan event listener klik pada gambar
            buildingMap.addEventListener('click', function(e) {
                const rect = buildingMap.getBoundingClientRect();
                // Hitung posisi klik relatif terhadap gambar
                const clickX = e.clientX - rect.left;
                const clickY = e.clientY - rect.top;

                // Hitung persentase posisi klik
                const percentX = (clickX / buildingMap.clientWidth) * 100;
                const percentY = (clickY / buildingMap.clientHeight) * 100;

                // Simpan lokasi dalam format persentase (misal: "50.00,25.00")
                document.getElementById('location').value =
                    `${percentX.toFixed(2)},${percentY.toFixed(2)}`;

                // Hapus marker sebelumnya jika ada
                if (marker) {
                    marker.remove();
                }

                // Buat marker baru dengan posisi relative menggunakan persentase
                marker = document.createElement('div');
                marker.style.position = 'absolute';
                marker.style.left =
                    `calc(${percentX.toFixed(2)}% - 10px)`; // offset agar marker terpusat
                marker.style.top = `calc(${percentY.toFixed(2)}% - 10px)`;
                marker.style.width = '20px';
                marker.style.height = '20px';
                marker.style.backgroundColor = 'red';
                marker.style.borderRadius = '50%';
                marker.style.border = '2px solid white';
                marker.style.pointerEvents = 'none'; // biarkan klik diteruskan ke gambar

                // Tempel marker ke dalam container gambar (pastikan container memiliki posisi relative)
                buildingMap.parentElement.appendChild(marker);
            });
        }
    });

    // Initialize DataTable
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof($.fn.datatable) !== 'undefined') {
            $('#datatable_1').datatable();
        }

        if (typeof($.fn.select2) !== 'undefined') {
            $('.select2').select2();
        }

        // Simulasi button untuk demo
        document.getElementById('btnSimpanLocation').addEventListener('click', function() {
            // Get the serial key for validation
            const serialKey = document.getElementById('serial_key').value;

            if (!serialKey) {
                alert('Please enter a serial key');
                return;
            }

            alert('Location has been saved!');
            var modal = bootstrap.Modal.getInstance(document.getElementById('moveLocationModal'));
            modal.hide();

            // Tampilkan pesan success
            var successAlert = document.getElementById('success-alert');
            if (successAlert) {
                successAlert.style.display = 'block';

                // Hide alert after 5 seconds
                setTimeout(function() {
                    successAlert.style.display = 'none';
                }, 5000);
            }
        });
    });
</script>

@push('scripts')
    <script src="{{ asset('dist/assets/libs/simple-datatables/umd/simple-datatables.js') }}"></script>
    <script src="{{ asset('dist/assets/js/pages/datatable.init.js') }}"></script>

    <script src="{{ asset('dist/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('dist/assets/js/pages/sweet-alert.init.js') }}"></script>

    <!-- Select2 -->
    <script src="{{ asset('dist/assets/libs/select2/js/select2.min.js') }}"></script>
@endpush
@endsection
