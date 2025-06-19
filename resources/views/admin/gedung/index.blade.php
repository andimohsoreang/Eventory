@extends('layouts.app')
@section('content')
@section('title', 'Master Gedung')

@php
    // Map buildings data for easy access in JavaScript
    $buildingsMap = [];
    if (isset($allBuildings)) {
        foreach ($allBuildings as $zoneId => $buildings) {
            $buildingsMap[$zoneId] = $buildings;
        }
    }
@endphp

@push('links')
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- DataTables -->
    <link href="{{ asset('dist/assets/libs/simple-datatables/style.css') }}" rel="stylesheet" type="text/css" />

    <!-- Sweet Alert -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css" rel="stylesheet">
    <link href="{{ asset('dist/assets/libs/animate.css/animate.min.css') }}" rel="stylesheet" type="text/css">

    <style>
        /* Custom Select2 Styles */
        .select2-container--default .select2-selection--single {
            height: 38px;
            border: 1px solid #e2e5e8;
            border-radius: 4px;
            background-color: #fff;
            box-shadow: none;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 36px;
            padding-left: 12px;
            color: #495057;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 36px;
            right: 6px;
        }

        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: #5156be;
            color: white;
        }

        .select2-container--default .select2-search--dropdown .select2-search__field {
            border: 1px solid #e2e5e8;
            border-radius: 4px;
            padding: 8px;
        }

        .select2-dropdown {
            border: 1px solid #e2e5e8;
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .select2-container--default .select2-results__option[aria-selected=true] {
            background-color: #f8f9fa;
        }

        .select2-container--default .select2-results__option {
            padding: 8px 12px;
        }

        /* Style for disabled options */
        .select2-container--default .select2-results__option[aria-disabled=true] {
            color: #6c757d;
        }

        /* Style for the placeholder */
        .select2-container--default .select2-selection--single .select2-selection__placeholder {
            color: #6c757d;
        }

        /* Modal specific select2 styles */
        .modal .select2-container {
            width: 100% !important;
        }

        /* Focused state */
        .select2-container--default.select2-container--focus .select2-selection--single {
            border-color: #5156be;
            box-shadow: 0 0 0 0.2rem rgba(81, 86, 190, 0.25);
        }
    </style>
@endpush

<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box d-md-flex justify-content-md-between align-items-center">
            <h4 class="page-title">Gedung</h4>
            <div class="">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="#">Master</a></li>
                    <li class="breadcrumb-item active">Gedung</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- Tabel Data Gedung -->
<div class="row justify-content-center">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h4 class="card-title">Daftar Gedung</h4>
                    </div>
                    <div class="col-auto">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#addModalLarge">
                            Tambah Gedung
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body pt-0">
                <div class="table-responsive">
                    <table class="table datatable" id="datatable_1">
                        <thead class="table-light">
                            <tr>
                                <th>No.</th>
                                <th>Nama Gedung</th>
                                <th>Lokasi</th>
                                <th>Parent Gedung</th>
                                <th>Zone</th>
                                <th>Building</th>
                                <th>Foto</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($gedungs as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->lokasi }}</td>
                                    <td>
                                        {{ $item->parent ? $item->parent->name : 'N/A' }}
                                    </td>
                                    <td>
                                        @if (isset($zones['list']))
                                            @foreach ($zones['list'] as $zone)
                                                @if ($zone['id'] == $item->zone_id)
                                                    {{ $zone['name'] }}
                                                @endif
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>

                                        @php
                                            try {
                                                $building_zone = $allBuildings[$item->zone_id];
                                                $gedung = collect($building_zone)->firstWhere('id', $item->gedung_id);
                                                $build_name = $gedung['name'];
                                            } catch (\Throwable $th) {
                                                $build_name = 'N/A';
                                            }
                                        @endphp
                                        {{ $build_name }}
                                    </td>
                                    <td>
                                        @if ($item->photo)
                                            <img src="{{ $item->photo_url }}" alt="{{ $item->name }}"
                                                class="img-fluid rounded" width="100" height="100">
                                        @else
                                            <span>-</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.gedung.show', $item->id) }}"
                                            class="btn btn-outline-info">Detail</a>
                                        <button class="btn btn-outline-primary edit-btn"
                                                data-id="{{ $item->id }}"
                                                data-name="{{ $item->name }}"
                                                data-lokasi="{{ $item->lokasi }}"
                                                data-parent-id="{{ $item->parent_id }}"
                                                data-photo="{{ $item->photo ? basename($item->photo) : '' }}"
                                                data-zone-id="{{ $item->zone_id }}"
                                                data-gedung-id="{{ $item->gedung_id }}">
                                            Edit
                                        </button>
                                        <button type="button" class="btn btn-outline-danger delete-btn"
                                                data-id="{{ $item->id }}"
                                                data-name="{{ $item->name }}">
                                            Hapus
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

<!-- Modal Add Gedung -->
<div class="modal fade bd-example-modal-lg" id="addModalLarge" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title m-0" id="myLargeModalLabel">Tambah Gedung</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div><!-- end modal-header -->
            <div class="modal-body">
                <form id="gedungFrm" enctype="multipart/form-data" method="POST"
                    action="{{ route('admin.gedung.store') }}">
                    @csrf
                    <div class="mb-3 row">
                        <label for="name" class="col-sm-3 col-form-label text-end">Nama Gedung</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" id="name" name="name"
                                placeholder="Masukkan nama gedung" onkeyup="createSlug()">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="lokasi" class="col-sm-3 col-form-label text-end">Lokasi</label>
                        <div class="col-sm-9">
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="latitude" name="latitude" 
                                           placeholder="Latitude (e.g. -6.123456)">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="longitude" name="longitude" 
                                           placeholder="Longitude (e.g. 106.123456)">
                                </div>
                            </div>
                            <input type="hidden" id="lokasi" name="lokasi">
                            <small class="form-text text-muted">Format: Latitude dan Longitude akan otomatis digabung</small>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="slug" class="col-sm-3 col-form-label text-end">Slug</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" id="slug" name="slug"
                                placeholder="slug-gedung" readonly>
                            <small class="form-text text-muted">Slug akan otomatis dibuat dari nama gedung</small>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="parent_id" class="col-sm-3 col-form-label text-end">Parent Gedung</label>
                        <div class="col-sm-9">
                            <select class="form-control select2" id="parent_id" name="parent_id">
                                <option value="">Pilih Parent Gedung</option>
                                @foreach ($parent as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="zone_id" class="col-sm-3 col-form-label text-end">Zone Ruckus</label>
                        <div class="col-sm-9">
                            <select class="form-control select2" id="zone_id" name="zone_id">
                                <option value="">Pilih Zone Ruckus</option>
                                @if (isset($zones['list']))
                                    @foreach ($zones['list'] as $zone)
                                        <option value="{{ $zone['id'] }}">{{ $zone['name'] }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="gedung_id" class="col-sm-3 col-form-label text-end">Gedung Ruckus</label>
                        <div class="col-sm-9">
                            <select class="form-control select2" id="gedung_id" name="gedung_id">
                                <option value="">Pilih Gedung Ruckus</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="photo" class="col-sm-3 col-form-label text-end">Foto / Denah</label>
                        <div class="col-sm-9">
                            <input type="file" name="photo" id="photo" class="form-control"
                                accept="image/*">
                        </div>
                    </div>
                </form>
            </div><!-- end modal-body -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" form="gedungFrm" class="btn btn-primary" id="btnSimpan">Simpan</button>
            </div><!-- end modal-footer -->
        </div><!-- end modal-content -->
    </div><!-- end modal-dialog -->
</div><!-- end modal -->

<!-- Modal Edit Gedung -->
<div class="modal fade bd-example-modal-lg" id="editModalLarge" tabindex="-1" role="dialog"
    aria-labelledby="myEditModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title m-0" id="myEditModalLabel">Edit Gedung</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div><!-- end modal-header -->
            <div class="modal-body">
                <form id="editGedungFrm" enctype="multipart/form-data" method="POST" action="">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="edit_id_gedung" name="id">
                    <div class="mb-3 row">
                        <label for="edit_name" class="col-sm-3 col-form-label text-end">Nama Gedung</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" id="edit_name" name="name"
                                placeholder="Masukkan nama gedung" onkeyup="createEditSlug()">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="edit_lokasi" class="col-sm-3 col-form-label text-end">Lokasi</label>
                        <div class="col-sm-9">
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="edit_latitude" name="latitude" 
                                           placeholder="Latitude (e.g. -6.123456)">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="edit_longitude" name="longitude" 
                                           placeholder="Longitude (e.g. 106.123456)">
                                </div>
                            </div>
                            <input type="hidden" id="edit_lokasi" name="lokasi">
                            <small class="form-text text-muted">Format: Latitude dan Longitude akan otomatis digabung</small>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="edit_slug" class="col-sm-3 col-form-label text-end">Slug</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" id="edit_slug" name="slug"
                                placeholder="slug-gedung" readonly>
                            <small class="form-text text-muted">Slug akan otomatis dibuat dari nama gedung</small>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="edit_parent_id" class="col-sm-3 col-form-label text-end">Parent Gedung</label>
                        <div class="col-sm-9">
                            <select class="form-control select2" id="edit_parent_id" name="parent_id">
                                <option value="">Pilih Parent Gedung</option>
                                @foreach ($parent as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="edit_zone_id" class="col-sm-3 col-form-label text-end">Zone Ruckus</label>
                        <div class="col-sm-9">
                            <select class="form-control select2" id="edit_zone_id" name="zone_id">
                                <option value="">Pilih Zone Ruckus</option>
                                @if (isset($zones['list']))
                                    @foreach ($zones['list'] as $zone)
                                        <option value="{{ $zone['id'] }}">{{ $zone['name'] }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="edit_gedung_id" class="col-sm-3 col-form-label text-end">Gedung Ruckus</label>
                        <div class="col-sm-9">
                            <select class="form-control select2" id="edit_gedung_id" name="gedung_id">
                                <option value="">Pilih Gedung Ruckus</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="edit_photo" class="col-sm-3 col-form-label text-end">Foto / Denah</label>
                        <div class="col-sm-9">
                            <input type="file" name="photo" id="edit_photo" class="form-control"
                                accept="image/*">
                            <small class="form-text text-muted" id="current_photo_text">Current photo: <span
                                    id="current_photo">None</span></small>
                        </div>
                    </div>
                </form>
            </div><!-- end modal-body -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" form="editGedungFrm" class="btn btn-primary" id="btnUpdate">Update</button>
            </div><!-- end modal-footer -->
        </div><!-- end modal-content -->
    </div><!-- end modal-dialog -->
</div><!-- end modal -->

<!-- JavaScript for Modals and Slug Generation -->
<script>
    // Store buildings data from PHP
    var buildingsData = @json($buildingsMap);

    // Function to format validation errors
    function formatValidationErrors(errors) {
        let errorMessage = '<div class="text-left">';
        for (let field in errors) {
            errorMessage += `<p class="mb-1">• ${errors[field][0]}</p>`;
        }
        errorMessage += '</div>';
        return errorMessage;
    }

    // Function to populate building select based on zone
    function populateBuildings(zoneId, targetSelect, selectedValue = '') {
        console.log('Populating buildings for zone:', zoneId);
        console.log('Available buildings:', buildingsData);

        const buildings = buildingsData[zoneId] || [];
        let options = '<option value="">Pilih Gedung</option>';

        buildings.forEach(function(building) {
            const selected = building.id === selectedValue ? 'selected' : '';
            options += `<option value="${building.id}" ${selected}>${building.name}</option>`;
        });

        targetSelect.html(options);
        targetSelect.trigger('change');
    }

    // Function to generate slug
    function generateSlug(text) {
        return text.toString().toLowerCase()
            .replace(/\s+/g, '-')
            .replace(/[^\w\-]+/g, '')
            .replace(/\-\-+/g, '-')
            .replace(/^-+/, '')
            .replace(/-+$/, '');
    }

    $(document).ready(function() {
        // Initialize Select2
        $('.select2').select2({
            width: '100%',
            placeholder: 'Pilih opsi',
            allowClear: true,
            theme: 'default',
            minimumResultsForSearch: 5,
            dropdownParent: $(this).closest('.modal-body'),
            language: {
                noResults: function() {
                    return "Data tidak ditemukan";
                },
                searching: function() {
                    return "Mencari...";
                }
            }
        });

        // Initialize modal specific Select2
        $('#parent_id, #zone_id, #gedung_id').select2({
            dropdownParent: $('#addModalLarge'),
            width: '100%'
        });

        $('#edit_parent_id, #edit_zone_id, #edit_gedung_id').select2({
            dropdownParent: $('#editModalLarge'),
            width: '100%'
        });

        // Update slug automatically
        $('#name').on('keyup', function() {
            $('#slug').val(generateSlug($(this).val()));
        });

        $('#edit_name').on('keyup', function() {
            $('#edit_slug').val(generateSlug($(this).val()));
        });

        // Function to combine lat/long into location string
        function combineLocation(lat, long) {
            if (lat && long) {
                return `${lat},${long}`;
            }
            return '';
        }

        // Handle lat/long changes in add form
        $('#latitude, #longitude').on('input', function() {
            const lat = $('#latitude').val().trim();
            const long = $('#longitude').val().trim();
            $('#lokasi').val(combineLocation(lat, long));
        });

        // Handle lat/long changes in edit form
        $('#edit_latitude, #edit_longitude').on('input', function() {
            const lat = $('#edit_latitude').val().trim();
            const long = $('#edit_longitude').val().trim();
            $('#edit_lokasi').val(combineLocation(lat, long));
        });

        // Form Submit Handler - Create
        $('#gedungFrm').on('submit', function(e) {
            e.preventDefault();
            
            // Combine lat/long before submit
            const lat = $('#latitude').val().trim();
            const long = $('#longitude').val().trim();
            $('#lokasi').val(combineLocation(lat, long));
            
            let formData = new FormData(this);

            $.ajax({
                url: $(this).attr('action'),
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    Swal.fire({
                        title: 'Berhasil!',
                        text: response.message || 'Gedung berhasil disimpan',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        location.reload();
                    });
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        // Validation errors
                        let errors = xhr.responseJSON.errors;
                        Swal.fire({
                            title: 'Validasi Error!',
                            html: formatValidationErrors(errors),
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    } else {
                        // Other errors
                        Swal.fire({
                            title: 'Error!',
                            text: xhr.responseJSON.message || 'Terjadi kesalahan',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                }
            });
        });

        // Form Submit Handler - Update
        $('#editGedungFrm').on('submit', function(e) {
            e.preventDefault();
            
            // Combine lat/long before submit
            const lat = $('#edit_latitude').val().trim();
            const long = $('#edit_longitude').val().trim();
            $('#edit_lokasi').val(combineLocation(lat, long));
            
            let formData = new FormData(this);

            $.ajax({
                url: $(this).attr('action'),
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    Swal.fire({
                        title: 'Berhasil!',
                        text: response.message || 'Gedung berhasil diupdate',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        location.reload();
                    });
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        // Validation errors
                        let errors = xhr.responseJSON.errors;
                        Swal.fire({
                            title: 'Validasi Error!',
                            html: formatValidationErrors(errors),
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    } else {
                        // Other errors
                        Swal.fire({
                            title: 'Error!',
                            text: xhr.responseJSON.message || 'Terjadi kesalahan',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                }
            });
        });

        // Edit button click handler
        $(document).on('click', '.edit-btn', function() {
            var id = $(this).data('id');
            var name = $(this).data('name');
            var lokasi = $(this).data('lokasi');
            var parentId = $(this).data('parent-id');
            var photo = $(this).data('photo');
            var zoneId = $(this).data('zone-id');
            var gedungId = $(this).data('gedung-id');

            $('#edit_id_gedung').val(id);
            $('#edit_name').val(name);
            $('#edit_slug').val(generateSlug(name));
            
            // Split location into lat/long
            const { latitude, longitude } = splitLocation(lokasi);
            $('#edit_latitude').val(latitude);
            $('#edit_longitude').val(longitude);
            $('#edit_lokasi').val(lokasi);

            $('#edit_parent_id').val(parentId).trigger('change');
            $('#edit_zone_id').val(zoneId).trigger('change');

            // Update current photo text if exists
            if (photo) {
                $('#current_photo').text(photo);
                $('#current_photo_text').show();
            } else {
                $('#current_photo_text').hide();
            }

            // Load buildings for zone
            if (zoneId) {
                populateBuildings(zoneId, $('#edit_gedung_id'), gedungId);
            }

            // Update form action
            var updateUrl = "{{ route('admin.gedung.update', ':id') }}";
            updateUrl = updateUrl.replace(':id', id);
            $('#editGedungFrm').attr('action', updateUrl);

            $('#editModalLarge').modal('show');
        });

        // Delete button click handler
        $(document).on('click', '.delete-btn', function() {
            var gedungId = $(this).data('id');
            var gedungName = $(this).data('name');
            
            Swal.fire({
                title: 'Apakah anda yakin?',
                html: `Anda akan menghapus gedung: <b>${gedungName}</b>`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('admin.gedung.destroy', ':id') }}".replace(':id', gedungId),
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            _method: 'DELETE'
                        },
                        success: function(response) {
                            Swal.fire({
                                title: 'Terhapus!',
                                text: 'Gedung berhasil dihapus.',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                location.reload();
                            });
                        },
                        error: function(xhr) {
                            let errorMessage = 'Gagal menghapus gedung.';
                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                errorMessage = xhr.responseJSON.message;
                            }
                            Swal.fire({
                                title: 'Error!',
                                text: errorMessage,
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        }
                    });
                }
            });
        });

        // Focus input on modal show
        $('#addModalLarge').on('shown.bs.modal', function() {
            $('#name').focus();
        });

        $('#editModalLarge').on('shown.bs.modal', function() {
            $('#edit_name').focus();
        });

        // Zone change handlers
        $('#zone_id').on('change', function() {
            const zoneId = $(this).val();
            populateBuildings(zoneId, $('#gedung_id'));
        });

        $('#edit_zone_id').on('change', function() {
            const zoneId = $(this).val();
            populateBuildings(zoneId, $('#edit_gedung_id'));
        });
    });
</script>

@push('scripts')
    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- DataTables -->
    <script src="{{ asset('dist/assets/libs/simple-datatables/umd/simple-datatables.js') }}"></script>
    <script src="{{ asset('dist/assets/js/pages/datatable.init.js') }}"></script>

    <!-- Sweet Alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>
    <script src="{{ asset('dist/assets/js/pages/sweet-alert.init.js') }}"></script>
@endpush
@endsection
