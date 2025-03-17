@extends('layouts.app')
@section('content')
@section('title', 'Device Details')
@push('links')
    <link href="{{ asset('dist/assets/libs/simple-datatables/style.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('dist/assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('dist/assets/libs/animate.css/animate.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('dist/assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css">
    <!-- Additional styles for device detail page -->
    <style>
        .device-card {
            margin-bottom: 30px;
        }

        .status-badge {
            padding: 5px 12px;
            border-radius: 50px;
            color: white;
            font-weight: bold;
        }

        .status-active {
            background-color: #28a745;
        }

        .status-inactive {
            background-color: #6c757d;
        }

        .marker {
            position: absolute;
            width: 20px;
            height: 20px;
            background-color: red;
            border-radius: 50%;
            border: 2px solid white;
            transform: translate(-50%, -50%);
        }

        .qr-container {
            margin-top: 20px;
            text-align: center;
        }

        .location-container {
            margin-top: 20px;
            position: relative;
            width: 100%;
            height: auto;
        }

        .location-container img {
            width: 100%;
            height: auto;
            object-fit: contain;
        }

        .location-container h5 {
            position: absolute;
            top: 10px;
            left: 20px;
            background-color: rgba(255, 255, 255, 0.7);
            padding: 5px;
            font-size: 16px;
            font-weight: bold;
        }

        table tr td {
            padding: 8px 15px;
        }

        .action-buttons a,
        .action-buttons button {
            margin-right: 10px;
        }

        .device-photos {
            margin-top: 30px;
        }

        .device-photos .title {
            margin-bottom: 15px;
        }

        .device-photos .photo-gallery {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .device-photos .photo-item {
            width: calc(33.333% - 10px);
            position: relative;
            border-radius: 4px;
            overflow: hidden;
            border: 1px solid #ddd;
        }

        .device-photos .photo-item img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            display: block;
        }

        .device-photos .photo-item .photo-caption {
            padding: 5px;
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            position: absolute;
            bottom: 0;
            width: 100%;
            font-size: 12px;
            text-align: center;
        }

        .specific-location {
            margin-top: 20px;
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 4px;
            border-left: 4px solid #007bff;
        }

        .specific-location h5 {
            color: #495057;
            margin-bottom: 10px;
        }

        .specific-location ul {
            margin-bottom: 0;
            padding-left: 20px;
        }

        .specific-location li {
            margin-bottom: 5px;
        }
    </style>
@endpush

<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box d-md-flex justify-content-md-between align-items-center">
            <h4 class="page-title">Device Details</h4>
            <div class="">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="#">Device Management</a></li>
                    <li class="breadcrumb-item active">Device Details</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="shop-detail">
    <div class="row">
        <!-- Left Section: Device Info -->
        <div class="col-lg-8 device-card">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="card-title">Device Information</h4>
                        </div>
                        <div class="col-auto">
                            <a href="#" class="btn btn-outline-secondary btn-sm">
                                <i class="fa fa-arrow-left"></i> Back to Devices
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="device-content">
                        <h5 class="fw-semibold mb-3">DEV-001</h5>

                        <p><strong>Device Type:</strong> Router</p>
                        <p><strong>Serial Key:</strong> SN-12345678</p>

                        <!-- 3D Model Viewer (placeholder) -->
                        <div class="mb-4 text-center">
                            <div style="border: 1px dashed #ccc; padding: 20px; background-color: #f8f9fa;">
                                <i class="fa fa-cube fa-3x mb-3"></i>
                                <p>3D Model Preview would appear here</p>
                            </div>
                        </div>

                        <!-- Status Section -->
                        <p><strong>Status:</strong>
                            <span class="status-badge status-active">
                                Active
                            </span>
                        </p>

                        <!-- Specific Location Information -->
                        <div class="specific-location">
                            <h5><i class="fa fa-map-marker"></i> Specific Location Details</h5>
                            <ul>
                                <li><strong>Building:</strong> Gedung A - Pusat Data</li>
                                <li><strong>Floor:</strong> 3rd Floor</li>
                                <li><strong>Room:</strong> Server Room 302</li>
                                <li><strong>Rack:</strong> Rack 05-B</li>
                                <li><strong>Position:</strong> Mounted on U24-U25</li>
                                <li><strong>Notes:</strong> Connected to main power supply and backup generator</li>
                            </ul>
                        </div>

                        <!-- QR Code Section -->
                        <div class="qr-container">
                            <h5>QR Code:</h5>
                            <div style="border: 1px solid #ddd; display: inline-block; padding: 10px;">
                                <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=DEV-001"
                                    alt="QR Code" width="150">
                            </div>
                        </div>

                        <!-- Device Location -->
                        <div class="location-container mt-4" id="location-container">
                            <h5>Device Location</h5>
                            <img src="{{ asset('uploads/gedung/photo/building-a.jpg') }}" alt="Building Map"
                                id="building-map">
                            <!-- Marker at 50% from left, 40% from top -->
                            <div class="marker" style="left: 50%; top: 40%;"></div>
                        </div>
                        <p class="mt-2"><strong>Coordinates:</strong> 50.00,40.00</p>

                        <!-- Device Photos -->
                        <div class="device-photos">
                            <h5 class="title">Device Photos</h5>
                            <div class="photo-gallery">
                                <div class="photo-item">
                                    <img src="{{ asset('uploads/devices/device_front.jpg') }}" alt="Device Front View">
                                    <div class="photo-caption">Front View</div>
                                </div>
                                <div class="photo-item">
                                    <img src="{{ asset('uploads/devices/device_back.jpg') }}" alt="Device Back View">
                                    <div class="photo-caption">Back View</div>
                                </div>
                                <div class="photo-item">
                                    <img src="{{ asset('uploads/devices/device_installed.jpg') }}"
                                        alt="Device Installed">
                                    <div class="photo-caption">Installed in Rack</div>
                                </div>
                                <div class="photo-item">
                                    <img src="{{ asset('uploads/devices/device_serial.jpg') }}" alt="Serial Number">
                                    <div class="photo-caption">Serial Number</div>
                                </div>
                                <div class="photo-item">
                                    <img src="{{ asset('uploads/devices/device_connections.jpg') }}"
                                        alt="Device Connections">
                                    <div class="photo-caption">Cable Connections</div>
                                </div>
                                <div class="photo-item">
                                    <img src="{{ asset('uploads/devices/device_label.jpg') }}" alt="Device Label">
                                    <div class="photo-caption">Device Label</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Section: Additional Info -->
        <div class="col-lg-4 device-card">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Additional Information</h4>
                </div>
                <div class="card-body p-0">
                    <table class="table mb-0">
                        <tr>
                            <td><strong>Device ID</strong></td>
                            <td>DEV-001</td>
                        </tr>
                        <tr>
                            <td><strong>Serial Key</strong></td>
                            <td>SN-12345678</td>
                        </tr>
                        <tr>
                            <td><strong>Device Type</strong></td>
                            <td>Router</td>
                        </tr>
                        <tr>
                            <td><strong>Building</strong></td>
                            <td>Gedung A - Pusat Data</td>
                        </tr>
                        <tr>
                            <td><strong>Room</strong></td>
                            <td>Server Room 302</td>
                        </tr>
                        <tr>
                            <td><strong>Rack Position</strong></td>
                            <td>Rack 05-B, U24-U25</td>
                        </tr>
                        <tr>
                            <td><strong>Status</strong></td>
                            <td>Active</td>
                        </tr>
                        <tr>
                            <td><strong>Last Maintained</strong></td>
                            <td>15 Mar 2025</td>
                        </tr>
                        <tr>
                            <td><strong>Installed By</strong></td>
                            <td>John Technician</td>
                        </tr>
                    </table>
                </div>
            </div>

            <!-- History Location Section -->
            <div class="card mt-4">
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
                                <td>Server Room 302, Rack 05-B</td>
                                <td>16 Mar 2025 10:30</td>
                            </tr>
                            <tr>
                                <td>Gedung B</td>
                                <td>Network Center, Rack 12-C</td>
                                <td>10 Mar 2025 14:15</td>
                            </tr>
                            <tr>
                                <td>Gedung A</td>
                                <td>Storage Room 101</td>
                                <td>02 Mar 2025 09:00</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Technical Specifications -->
            <div class="card mt-4">
                <div class="card-header">
                    <h4 class="card-title">Technical Specifications</h4>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2"><strong>Model:</strong> Cisco RV340</li>
                        <li class="mb-2"><strong>Ports:</strong> 4x Gigabit Ethernet, 2x USB</li>
                        <li class="mb-2"><strong>Firewall Throughput:</strong> 900 Mbps</li>
                        <li class="mb-2"><strong>VPN Throughput:</strong> 150 Mbps</li>
                        <li class="mb-2"><strong>Power Supply:</strong> 12V 2A</li>
                        <li class="mb-2"><strong>Firmware:</strong> v2.0.3.18</li>
                        <li><strong>Last Update:</strong> 14 Mar 2025</li>
                    </ul>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="card mt-4">
                <div class="card-header">
                    <h4 class="card-title">Actions</h4>
                </div>
                <div class="card-body">
                    <div class="action-buttons">
                        <a href="#" class="btn btn-outline-warning btn-sm mb-2">
                            <i class="fa fa-pencil"></i> Edit Device
                        </a>
                        <button type="button" class="btn btn-outline-info btn-sm mb-2" data-bs-toggle="modal"
                            data-bs-target="#moveLocationModal" data-device-id="1">
                            <i class="fa fa-map-marker"></i> Move Location
                        </button>
                        <button type="button" class="btn btn-outline-danger btn-sm mb-2"
                            onclick="return confirm('Are you sure?')">
                            <i class="fa fa-trash"></i> Delete Device
                        </button>
                        <a href="#" class="btn btn-outline-primary btn-sm mb-2">
                            <i class="fa fa-print"></i> Print QR Code
                        </a>
                        <a href="#" class="btn btn-outline-success btn-sm mb-2">
                            <i class="fa fa-camera"></i> Add Photos
                        </a>
                    </div>
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
                    <input type="hidden" name="device_id" id="device-id-input" value="1">

                    <div class="mb-3 row">
                        <label for="serial_key" class="col-sm-3 col-form-label text-end">Serial Key</label>
                        <div class="col-sm-9">
                            <input type="text" name="serial_key" id="serial_key" class="form-control"
                                value="SN-12345678" placeholder="Enter device serial key" />
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

                    <div class="mb-3 row">
                        <label for="floor" class="col-sm-3 col-form-label text-end">Floor</label>
                        <div class="col-sm-9">
                            <select name="floor" id="floor" class="form-control select2" required>
                                <option value="" selected hidden>-- Select Floor --</option>
                                <option value="1">1st Floor</option>
                                <option value="2">2nd Floor</option>
                                <option value="3">3rd Floor</option>
                                <option value="4">4th Floor</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="room" class="col-sm-3 col-form-label text-end">Room</label>
                        <div class="col-sm-9">
                            <input type="text" name="room" id="room" class="form-control"
                                placeholder="Enter room number or name" />
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="rack" class="col-sm-3 col-form-label text-end">Rack</label>
                        <div class="col-sm-9">
                            <input type="text" name="rack" id="rack" class="form-control"
                                placeholder="Enter rack identifier (e.g. Rack 05-B)" />
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="position" class="col-sm-3 col-form-label text-end">Position</label>
                        <div class="col-sm-9">
                            <input type="text" name="position" id="position" class="form-control"
                                placeholder="Enter position (e.g. U24-U25)" />
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="notes" class="col-sm-3 col-form-label text-end">Notes</label>
                        <div class="col-sm-9">
                            <textarea name="notes" id="notes" class="form-control" rows="3"
                                placeholder="Add notes about this location"></textarea>
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
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="btnSimpanLocation">Save Location</button>
            </div><!--end modal-footer-->
        </div><!--end modal-content-->
    </div><!--end modal-dialog-->
</div><!--end modal-->

@push('scripts')
    <script src="{{ asset('dist/assets/libs/simple-datatables/umd/simple-datatables.js') }}"></script>
    <script src="{{ asset('dist/assets/js/pages/datatable.init.js') }}"></script>
    <script src="{{ asset('dist/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('dist/assets/js/pages/sweet-alert.init.js') }}"></script>
    <script src="{{ asset('dist/assets/libs/select2/js/select2.min.js') }}"></script>
    <script type="module" src="https://ajax.googleapis.com/ajax/libs/model-viewer/4.0.0/model-viewer.min.js"></script>

    <script>
        let marker = null; // Untuk melacak marker yang telah dibuat

        // Handle modal opening dan set device id pada form
        const moveLocationModal = document.getElementById('moveLocationModal');
        moveLocationModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget; // Button yang memicu modal
            const deviceId = button.getAttribute('data-device-id'); // Ambil device id

            // Set device id di input tersembunyi
            document.getElementById('device-id-input').value = deviceId;

            // Set default serial key
            document.getElementById('serial_key').value = "SN-12345678";

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

                    // Tempel marker ke dalam container gambar
                    buildingMap.parentElement.appendChild(marker);
                });
            }
        });

        // Initialize the page
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof($.fn.select2) !== 'undefined') {
                $('.select2').select2();
            }

            // Save location button handler
            document.getElementById('btnSimpanLocation').addEventListener('click', function() {
                const serialKey = document.getElementById('serial_key').value;

                if (!serialKey) {
                    alert('Please enter a serial key');
                    return;
                }

                // Implement your save logic here
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
