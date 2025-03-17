@extends('layouts.app')
@section('content')
@section('title', 'Tambah Device')
@push('links')
    <!-- Sweet Alert -->
    <link href="{{ asset('dist/assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('dist/assets/libs/animate.css/animate.min.css') }}" rel="stylesheet" type="text/css">
    <!-- Select2 -->
    <link href="{{ asset('dist/assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css">
@endpush
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box d-md-flex justify-content-md-between align-items-center">
            <h4 class="page-title">Device</h4>
            <div class="">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="#">Device</a></li>
                    <li class="breadcrumb-item active">Tambah Device</li>
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
                        <h4 class="card-title">Form Tambah Device</h4>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="#" method="post" enctype="multipart/form-data" id="deviceForm">
                    <!-- @csrf -->
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Informasi Dasar Device -->
                            <h5 class="mb-3">Informasi Dasar</h5>

                            <!-- Nama Alat (pengganti Device ID) -->
                            <div class="mb-3 row">
                                <label for="device_name" class="col-sm-3 col-form-label text-end">Nama Alat <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" id="device_name" name="device_name"
                                        placeholder="Contoh: AP-01-GED.A" value="">
                                </div>
                            </div>

                            <!-- Serial Number (field baru) -->
                            <div class="mb-3 row">
                                <label for="serial_number" class="col-sm-3 col-form-label text-end">Serial Number <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" id="serial_number" name="serial_number"
                                        placeholder="Masukkan serial number perangkat" value="">
                                </div>
                            </div>

                            <!-- Category Dana -->
                            <div class="mb-3 row">
                                <label for="category_dana_id" class="col-sm-3 col-form-label text-end">Category Dana
                                    <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <select class="form-control select2" id="category_dana_id" name="category_dana_id">
                                        <option value="">-- Pilih Category Dana --</option>
                                        <option value="1">Anggaran APBN</option>
                                        <option value="2">Hibah</option>
                                        <option value="3">Donasi</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Device Type -->
                            <div class="mb-3 row">
                                <label for="tipe_id" class="col-sm-3 col-form-label text-end">Tipe Device <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <select class="form-control select2" id="tipe_id" name="tipe_id">
                                        <option value="">-- Pilih Tipe Device --</option>
                                        <option value="1">Router Cisco</option>
                                        <option value="2">Switch Mikrotik</option>
                                        <option value="3">Access Point Ubiquiti</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Status -->
                            <div class="mb-3 row">
                                <label for="isActive" class="col-sm-3 col-form-label text-end">Status <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="isActive" name="isActive">
                                        <option value="">-- Pilih Status --</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Spesifikasi Teknis -->
                            <h5 class="mb-3 mt-4">Spesifikasi Teknis</h5>

                            <!-- Model -->
                            <div class="mb-3 row">
                                <label for="model" class="col-sm-3 col-form-label text-end">Model</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" id="model" name="model"
                                        placeholder="Contoh: Cisco RV340" value="">
                                </div>
                            </div>

                            <!-- Ports -->
                            <div class="mb-3 row">
                                <label for="ports" class="col-sm-3 col-form-label text-end">Ports</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" id="ports" name="ports"
                                        placeholder="Contoh: 4x Gigabit Ethernet, 2x USB" value="">
                                </div>
                            </div>

                            <!-- Throughput -->
                            <div class="mb-3 row">
                                <label for="throughput" class="col-sm-3 col-form-label text-end">Throughput</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" id="throughput" name="throughput"
                                        placeholder="Contoh: 900 Mbps" value="">
                                </div>
                            </div>

                            <!-- Power Supply -->
                            <div class="mb-3 row">
                                <label for="power_supply" class="col-sm-3 col-form-label text-end">Power
                                    Supply</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" id="power_supply" name="power_supply"
                                        placeholder="Contoh: 12V 2A" value="">
                                </div>
                            </div>

                            <!-- Firmware -->
                            <div class="mb-3 row">
                                <label for="firmware" class="col-sm-3 col-form-label text-end">Firmware</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" id="firmware" name="firmware"
                                        placeholder="Contoh: v2.0.3.18" value="">
                                </div>
                            </div>

                            <!-- BMN Sticker -->
                            <div class="mb-3 row">
                                <label for="sticker" class="col-sm-3 col-form-label text-end">BMN Sticker <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="file" id="sticker" name="sticker"
                                        accept="image/*">
                                    <small class="form-text text-muted">Format: PNG/JPG (max: 2MB)</small>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <!-- Informasi Lokasi -->
                            <h5 class="mb-3">Informasi Lokasi</h5>

                            <!-- Building -->
                            <div class="mb-3 row">
                                <label for="gedung_id" class="col-sm-3 col-form-label text-end">Gedung <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <select class="form-control select2" id="building-select" name="gedung_id">
                                        <option value="">-- Pilih Gedung --</option>
                                        <option value="1"
                                            data-image="{{ asset('dist/assets/images/small/img-1.jpg') }}">Gedung A
                                        </option>
                                        <option value="2"
                                            data-image="{{ asset('dist/assets/images/small/img-2.jpg') }}">Gedung B
                                        </option>
                                        <option value="3"
                                            data-image="{{ asset('dist/assets/images/small/img-3.jpg') }}">Gedung C
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <!-- Floor -->
                            <div class="mb-3 row">
                                <label for="floor" class="col-sm-3 col-form-label text-end">Lantai <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <select class="form-control select2" id="floor" name="floor">
                                        <option value="">-- Pilih Lantai --</option>
                                        <option value="1">1st Floor</option>
                                        <option value="2">2nd Floor</option>
                                        <option value="3">3rd Floor</option>
                                        <option value="4">4th Floor</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Room -->
                            <div class="mb-3 row">
                                <label for="room" class="col-sm-3 col-form-label text-end">Ruangan <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" id="room" name="room"
                                        placeholder="Contoh: Server Room 302" value="">
                                </div>
                            </div>

                            <!-- Rack -->
                            <div class="mb-3 row">
                                <label for="rack" class="col-sm-3 col-form-label text-end">Rack <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" id="rack" name="rack"
                                        placeholder="Contoh: Rack 05-B" value="">
                                </div>
                            </div>

                            <!-- Position -->
                            <div class="mb-3 row">
                                <label for="position" class="col-sm-3 col-form-label text-end">Posisi</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" id="position" name="position"
                                        placeholder="Contoh: U24-U25" value="">
                                </div>
                            </div>

                            <!-- Notes -->
                            <div class="mb-3 row">
                                <label for="notes" class="col-sm-3 col-form-label text-end">Catatan</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" id="notes" name="notes" rows="3"
                                        placeholder="Contoh: Connected to main power supply and backup generator"></textarea>
                                </div>
                            </div>

                            <!-- Installation Info -->
                            <div class="mb-3 row">
                                <label for="installed_by" class="col-sm-3 col-form-label text-end">Dipasang
                                    Oleh</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" id="installed_by" name="installed_by"
                                        placeholder="Contoh: John Technician" value="">
                                </div>
                            </div>

                            <!-- Building Image Container -->
                            <div class="mb-3" id="building-image-container"
                                style="display:none; position:relative;">
                                <label class="form-label">Gedung Image (Klik untuk menentukan lokasi)</label>
                                <div id="building-image" class="border rounded p-2"></div>
                                <div class="mt-2">
                                    <span class="badge bg-info">Posisi saat ini: <span id="position-text">Belum
                                            dipilih</span></span>
                                </div>
                            </div>

                            <!-- Location Hidden Input -->
                            <input type="hidden" name="location" id="location" value="">

                            <!-- Device Photos -->
                            <h5 class="mb-3 mt-4">Foto Device</h5>
                            <div class="mb-3 row">
                                <label for="front_photo" class="col-sm-3 col-form-label text-end">Foto Depan</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="file" id="front_photo" name="photos[]"
                                        accept="image/*">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="back_photo" class="col-sm-3 col-form-label text-end">Foto Belakang</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="file" id="back_photo" name="photos[]"
                                        accept="image/*">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="installed_photo" class="col-sm-3 col-form-label text-end">Foto
                                    Terpasang</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="file" id="installed_photo" name="photos[]"
                                        accept="image/*">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="serial_photo" class="col-sm-3 col-form-label text-end">Foto Serial</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="file" id="serial_photo" name="photos[]"
                                        accept="image/*">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-12 text-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-save me-1"></i> Simpan
                            </button>
                            <a href="#" class="btn btn-secondary ms-2">
                                <i class="fa fa-arrow-left me-1"></i> Kembali
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <!-- Sweet Alert -->
    <script src="{{ asset('dist/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('dist/assets/libs/select2/js/select2.min.js') }}"></script>

    <script>
        // Initialize Select2
        $(document).ready(function() {
            $('.select2').select2();
        });

        // Variabel global untuk marker
        let marker = null;

        document.getElementById('building-select').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const buildingImageUrl = selectedOption.getAttribute('data-image');
            const buildingImageContainer = document.getElementById('building-image-container');
            const buildingImageDiv = document.getElementById('building-image');

            if (buildingImageUrl) {
                buildingImageContainer.style.display = 'block';
                buildingImageDiv.innerHTML =
                    `<img src="${buildingImageUrl}" id="building-map" alt="Building Image" style="max-width: 100%; height: auto; cursor: crosshair;" />`;

                // Reset lokasi tersembunyi
                document.getElementById('location').value = '';
                document.getElementById('position-text').textContent = 'Belum dipilih';

                // Dapatkan element gambar dan tambahkan event listener
                const buildingMap = document.getElementById('building-map');

                buildingMap.addEventListener('click', function(e) {
                    const rect = buildingMap.getBoundingClientRect();
                    // Hitung koordinat klik relatif terhadap gambar yang ditampilkan
                    const clickX = e.clientX - rect.left;
                    const clickY = e.clientY - rect.top;
                    // Hitung persentase dari koordinat tersebut
                    const percentX = (clickX / buildingMap.clientWidth) * 100;
                    const percentY = (clickY / buildingMap.clientHeight) * 100;

                    // Simpan koordinat sebagai persentase (misalnya: "50.00,25.00")
                    const locationValue = `${percentX.toFixed(2)},${percentY.toFixed(2)}`;
                    document.getElementById('location').value = locationValue;
                    document.getElementById('position-text').textContent = locationValue;

                    // Hapus marker sebelumnya jika ada
                    if (marker) {
                        marker.remove();
                    }

                    // Buat marker baru dengan posisi relatif menggunakan persentase
                    marker = document.createElement('div');
                    marker.style.position = 'absolute';
                    marker.style.left =
                        `calc(${percentX.toFixed(2)}% - 10px)`; // 10px untuk menyesuaikan agar marker terpusat
                    marker.style.top = `calc(${percentY.toFixed(2)}% - 10px)`;
                    marker.style.width = '20px';
                    marker.style.height = '20px';
                    marker.style.backgroundColor = 'red';
                    marker.style.borderRadius = '50%';
                    marker.style.border = '2px solid white';
                    marker.style.pointerEvents = 'none'; // Agar marker tidak mengganggu klik selanjutnya

                    // Tambahkan marker ke dalam container gambar
                    buildingMap.parentElement.appendChild(marker);
                });
            } else {
                buildingImageContainer.style.display = 'none';
            }
        });

        // Form Validation with SweetAlert
        document.getElementById('deviceForm').addEventListener('submit', function(e) {
            const requiredFields = [
                'device_name',
                'serial_number',
                'category_dana_id',
                'tipe_id',
                'gedung_id',
                'floor',
                'room',
                'rack',
                'isActive'
            ];
            let hasError = false;

            requiredFields.forEach(field => {
                const input = document.getElementById(field);
                if (!input.value) {
                    hasError = true;
                    input.classList.add('is-invalid');
                } else {
                    input.classList.remove('is-invalid');
                }
            });

            // Check if location is selected
            if (!document.getElementById('location').value && document.getElementById('building-image-container')
                .style.display !== 'none') {
                hasError = true;
                Swal.fire({
                    title: 'Error!',
                    text: 'Silakan tentukan lokasi perangkat pada gambar gedung',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
                e.preventDefault();
                return;
            }

            if (hasError) {
                Swal.fire({
                    title: 'Error!',
                    text: 'Harap isi semua field yang wajib diisi',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
                e.preventDefault();
            } else {
                // Demo purpose only - menampilkan pesan sukses
                Swal.fire({
                    title: 'Success!',
                    text: 'Data berhasil disimpan (demo)',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
                e.preventDefault();
            }
        });
    </script>
@endpush
@endsection
