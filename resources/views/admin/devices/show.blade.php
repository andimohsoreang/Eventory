@extends('layouts.app')
@section('content')
@section('title', 'Device Details')
@push('links')
    <link href="{{ asset('dist/assets/libs/simple-datatables/style.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('dist/assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('dist/assets/libs/animate.css/animate.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('dist/assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css">
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

<!-- Quick Stats -->
<div class="row">
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <div class="media align-items-center">
                    <div class="media-body">
                        <p class="text-muted font-weight-medium mb-1">Status</p>
                        <h4 class="mb-0 text-success">Active</h4>
                        <span class="text-success font-size-12">Since 16 Mar 2025</span>
                    </div>
                    <div class="avatar-md">
                        <div class="avatar-title rounded-circle bg-soft-primary">
                            <i class="fa fa-signal text-primary font-size-24"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <div class="media align-items-center">
                    <div class="media-body">
                        <p class="text-muted font-weight-medium mb-1">Last Maintenance</p>
                        <h4 class="mb-0">15 Mar 2025</h4>
                        <span class="text-muted font-size-12">5 days ago</span>
                    </div>
                    <div class="avatar-md">
                        <div class="avatar-title rounded-circle bg-soft-info">
                            <i class="fa fa-clock text-info font-size-24"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <div class="media align-items-center">
                    <div class="media-body">
                        <p class="text-muted font-weight-medium mb-1">Firmware</p>
                        <h4 class="mb-0">v2.0.3.18</h4>
                        <span class="text-muted font-size-12">Updated 14 Mar 2025</span>
                    </div>
                    <div class="avatar-md">
                        <div class="avatar-title rounded-circle bg-soft-warning">
                            <i class="fa fa-sync text-warning font-size-24"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <div class="media align-items-center">
                    <div class="media-body">
                        <p class="text-muted font-weight-medium mb-1">Location</p>
                        <h4 class="mb-0">Gedung A</h4>
                        <span class="text-muted font-size-12">Server Room 302</span>
                    </div>
                    <div class="avatar-md">
                        <div class="avatar-title rounded-circle bg-soft-danger">
                            <i class="fa fa-map-marker text-danger font-size-24"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Main Device Info Card -->
<div class="card">
    <div class="card-header">
        <div class="row align-items-center">
            <div class="col">
                <h4 class="card-title d-flex align-items-center">
                    <span>Cisco RV340 Router</span>
                    <span class="badge bg-light text-dark ms-2">DEV-001</span>
                </h4>
            </div>
            <div class="col-auto">
                <div class="action-buttons">
                    <a href="#" class="btn btn-outline-warning btn-sm mb-1">
                        <i class="fa fa-pencil"></i> Edit Device
                    </a>
                    <button type="button" class="btn btn-outline-info btn-sm mb-1" data-bs-toggle="modal"
                        data-bs-target="#moveLocationModal" data-device-id="1">
                        <i class="fa fa-map-marker"></i> Move Location
                    </button>
                    <a href="#" class="btn btn-outline-primary btn-sm mb-1">
                        <i class="fa fa-print"></i> Print QR
                    </a>
                    <button type="button" class="btn btn-outline-danger btn-sm mb-1"
                        onclick="return confirm('Are you sure?')">
                        <i class="fa fa-trash"></i> Delete Device
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <!-- Basic Device Info -->
            <div class="col-md-8">
                <div class="row mb-4">
                    <div class="col-md-3 mb-3">
                        <div class="text-muted">Serial Number</div>
                        <div>SN-12345678</div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="text-muted">Model</div>
                        <div>Cisco RV340</div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="text-muted">Installed By</div>
                        <div>John Technician</div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="text-muted">Firmware Version</div>
                        <div>v2.0.3.18</div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="text-muted">Ports</div>
                        <div>4x Gigabit Ethernet, 2x USB</div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="text-muted">VPN Throughput</div>
                        <div>150 Mbps</div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="text-muted">Firewall Throughput</div>
                        <div>900 Mbps</div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="text-muted">Power Supply</div>
                        <div>12V 2A</div>
                    </div>
                </div>

                <!-- Location Details -->
                <div class="specific-location mb-4">
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
            </div>

            <!-- QR Code -->
            <div class="col-md-4">
                <div class="text-center mb-3">
                    <div class="qr-container">
                        <h5>QR Code:</h5>
                        <div style="border: 1px solid #ddd; display: inline-block; padding: 10px;">
                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=DEV-001"
                                alt="QR Code" width="150">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 3D Model Section -->
<div class="card">
    <div class="card-header">
        <h4 class="card-title">3D Model View</h4>
    </div>
    <div class="card-body">
        <div class="row">


            <div class="col-md-12">
                <div
                    style="border: 1px solid #ddd; border-radius: 4px; height: 400px; width: 100%; position: relative; overflow: hidden;">
                    <!-- Placeholder for 3D model viewer -->
                    <div
                        style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; display: flex; flex-direction: column; align-items: center; justify-content: center; background-color: #f8f9fa;">
                        <i class="fa fa-cube fa-4x mb-3 text-muted"></i>
                        <h5 class="text-muted">3D Model Preview</h5>
                        <p class="text-center text-muted">Interactive 3D model of Cisco RV340 Router would appear here
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Network Information Card -->
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Network Information</h4>
    </div>
    <div class="card-body">
        <ul class="nav nav-tabs nav-bordered" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="tab" href="#wifi-device-tab" role="tab">WIFI
                    Devices</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#wifi-client-tab" role="tab">WIFI Client</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#switch-tab" role="tab">Switch</a>
            </li>
        </ul>

        <div class="tab-content">
            <!-- WIFI Devices Tab -->
            <div class="tab-pane active" id="wifi-device-tab" role="tabpanel">
                <div class="p-2">
                    <table class="table table-borderless mb-0">
                        <tbody>
                            <tr>
                                <td style="width: 30%;"><strong>Model Name</strong></td>
                                <td>R550</td>
                            </tr>
                            <tr>
                                <td><strong>AP Name</strong></td>
                                <td>AP-LT-1</td>
                            </tr>
                            <tr>
                                <td><strong>Channel 2.4 GHz</strong></td>
                                <td>11</td>
                            </tr>
                            <tr>
                                <td><strong>Channel 5.0 GHz</strong></td>
                                <td>153</td>
                            </tr>
                            <tr>
                                <td><strong>Client Connected</strong></td>
                                <td>17</td>
                            </tr>
                            <tr>
                                <td><strong>Status Connected</strong></td>
                                <td><span class="badge bg-success">Connected</span></td>
                            </tr>
                            <tr>
                                <td><strong>Uptime</strong></td>
                                <td>1 Hari 4 Jam 46 Menit 27 Detik</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- WIFI Client Tab -->
            <div class="tab-pane" id="wifi-client-tab" role="tabpanel">
                <div class="p-2">
                    <table class="table table-borderless mb-0">
                        <tbody>
                            <tr>
                                <td style="width: 30%;"><strong>SSID</strong></td>
                                <td>eduroam</td>
                            </tr>
                            <tr>
                                <td><strong>Username</strong></td>
                                <td>...@....</td>
                            </tr>
                            <tr>
                                <td><strong>IP</strong></td>
                                <td>10.103.8.73</td>
                            </tr>
                            <tr>
                                <td><strong>OS Type</strong></td>
                                <td>Android</td>
                            </tr>
                            <tr>
                                <td><strong>Model Name</strong></td>
                                <td>Generic Smartphone</td>
                            </tr>
                            <tr>
                                <td><strong>Device Type</strong></td>
                                <td>Device Type</td>
                            </tr>
                            <tr>
                                <td><strong>Client MAC</strong></td>
                                <td>D2:17:......</td>
                            </tr>
                            <tr>
                                <td><strong>AP Name</strong></td>
                                <td>AP-1-LT1</td>
                            </tr>
                            <tr>
                                <td><strong>Channel</strong></td>
                                <td>153</td>
                            </tr>
                            <tr>
                                <td><strong>RSSI</strong></td>
                                <td>-65 dBm</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Switch Tab -->
            <div class="tab-pane" id="switch-tab" role="tabpanel">
                <div class="p-2">
                    <table class="table table-borderless mb-0">
                        <tbody>
                            <tr>
                                <td style="width: 30%;"><strong>Switch Name</strong></td>
                                <td>DSW_G-KANTOR/KULIAH/L</td>
                            </tr>
                            <tr>
                                <td><strong>Model</strong></td>
                                <td>ICX7450-48G</td>
                            </tr>
                            <tr>
                                <td><strong>Serial Number</strong></td>
                                <td>xcsxc</td>
                            </tr>
                            <tr>
                                <td><strong>MAC Address</strong></td>
                                <td>C0:C5:20:62:68:38</td>
                            </tr>
                            <tr>
                                <td><strong>IP Address</strong></td>
                                <td>10.53.1.1</td>
                            </tr>
                            <tr>
                                <td><strong>Status</strong></td>
                                <td><span class="badge bg-success">Online</span></td>
                            </tr>
                            <tr>
                                <td><strong>Ports</strong></td>
                                <td>54</td>
                            </tr>
                            <tr>
                                <td><strong>Firmware</strong></td>
                                <td>SPR08095r</td>
                            </tr>
                            <tr>
                                <td><strong>Uptime</strong></td>
                                <td>1 Hari 4 Jam 46 Menit 27 Detik</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
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
                    <img src="{{ asset('uploads/gedung/photo/building-a.jpg') }}" alt="Building Map"
                        id="building-map">
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

<!-- Device Photos -->
<div class="card">
    <div class="card-header">
        <div class="row align-items-center">
            <div class="col">
                <h4 class="card-title">Device Photos</h4>
            </div>
            <div class="col-auto">
                <a href="#" class="btn btn-outline-success btn-sm">
                    <i class="fa fa-camera"></i> Add Photos
                </a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="device-photos">
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
                    <img src="{{ asset('uploads/devices/device_installed.jpg') }}" alt="Device Installed">
                    <div class="photo-caption">Installed in Rack</div>
                </div>
                <div class="photo-item">
                    <img src="{{ asset('uploads/devices/device_serial.jpg') }}" alt="Serial Number">
                    <div class="photo-caption">Serial Number</div>
                </div>
                <div class="photo-item">
                    <img src="{{ asset('uploads/devices/device_connections.jpg') }}" alt="Device Connections">
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
                $('.select2').select2({
                    dropdownParent: $('#moveLocationModal')
                });
            }

            // 3D Model controls functionality
            document.getElementById('rotate-left').addEventListener('click', function() {
                console.log('Rotate Left clicked');
                // Implementasi kontrol rotasi ke kiri
            });

            document.getElementById('rotate-right').addEventListener('click', function() {
                console.log('Rotate Right clicked');
                // Implementasi kontrol rotasi ke kanan
            });

            document.getElementById('zoom-in').addEventListener('click', function() {
                console.log('Zoom In clicked');
                // Implementasi kontrol zoom in
            });

            document.getElementById('zoom-out').addEventListener('click', function() {
                console.log('Zoom Out clicked');
                // Implementasi kontrol zoom out
            });

            document.getElementById('model-view').addEventListener('change', function() {
                const view = this.value;
                console.log('View changed to:', view);
                // Implementasi perubahan tampilan model
            });

            document.getElementById('animation-play').addEventListener('click', function() {
                console.log('Animation Play clicked');
                // Implementasi memulai animasi
            });

            document.getElementById('animation-pause').addEventListener('click', function() {
                console.log('Animation Pause clicked');
                // Implementasi pause animasi
            });

            document.getElementById('auto-rotate').addEventListener('change', function() {
                console.log('Auto Rotate changed:', this.checked);
                // Implementasi kontrol auto-rotate
            });

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
