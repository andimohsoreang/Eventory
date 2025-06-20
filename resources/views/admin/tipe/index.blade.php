@extends('layouts.app')
@section('content')
@section('title', 'Master Tipe')
@push('links')
    <link href="{{ asset('dist/assets/libs/simple-datatables/style.css') }}" rel="stylesheet" type="text/css" />
    <!-- Sweet Alert -->
    <link href="{{ asset('dist/assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('dist/assets/libs/animate.css/animate.min.css') }}" rel="stylesheet" type="text/css">
    <!-- Select2 (jika diperlukan) -->
    <link href="{{ asset('dist/assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css">
@endpush

<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box d-md-flex justify-content-md-between align-items-center">
            <h4 class="page-title">Tipe</h4>
            <div class="">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="#">Master</a></li>
                    <li class="breadcrumb-item active">Tipe</li>
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
                        <h4 class="card-title">Daftar Tipe</h4>
                    </div>
                    <div class="col-auto">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#addModalLarge">
                            Tambah Tipe
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
                                <th>Nama Tipe</th>
                                <th>Slug</th>
                                <th>Icon</th>
                                <th>Model 3D</th>
                                <th>Ruckus</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tipe as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->slug }}</td>
                                    <td>
                                        @if ($item->icon)
                                            <i class="{{ $item->icon }}"></i>
                                        @else
                                            <span>-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->file)
                                            <a href="{{ $item->file_url }}"
                                                target="_blank">{{ basename($item->file) }}</a>
                                        @else
                                            <span>-</span>
                                        @endif
                                    </td>
                                    <td>{{ $item->isRuckus ? 'Yes' : 'No' }}</td>
                                    <td>
                                        <a href="{{ route('admin.tipe.show', $item->id) }}"
                                            class="btn btn-outline-info">Detail</a>
                                        <button class="btn btn-outline-primary edit-btn" 
                                                data-id="{{ $item->id }}"
                                                data-name="{{ $item->name }}"
                                                data-icon="{{ $item->icon }}"
                                                data-is-ruckus="{{ $item->isRuckus }}"
                                                data-file="{{ $item->file ? basename($item->file) : '' }}">
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

<!-- Modal Add -->
<div class="modal fade bd-example-modal-lg" id="addModalLarge" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title m-0" id="myLargeModalLabel">Tambah Tipe</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div><!-- end modal-header -->
            <div class="modal-body">
                <form id="tipeFrm" enctype="multipart/form-data" method="POST"
                    action="{{ route('admin.tipe.store') }}">
                    @csrf
                    <div class="mb-3 row">
                        <label for="tipe_name" class="col-sm-3 col-form-label text-end">Nama Tipe</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" id="tipe_name" name="name"
                                placeholder="Masukkan nama tipe" onkeyup="createSlug()">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="slug" class="col-sm-3 col-form-label text-end">Slug</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" id="slug" name="slug"
                                placeholder="slug-tipe" readonly>
                            <small class="form-text text-muted">Slug akan otomatis dibuat dari nama tipe</small>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="file" class="col-sm-3 col-form-label text-end">3D Model (Optional)</label>
                        <div class="col-sm-9">
                            <input type="file" name="file" id="file" class="form-control"
                                accept=".stl,.obj,.fbx,.dae,.glb,.ply">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="icon" class="col-sm-3 col-form-label text-end">Icon (Optional)</label>
                        <div class="col-sm-9">
                            <input type="text" name="icon" id="icon" class="form-control"
                                placeholder="e.g. fa-solid fa-file">
                            <small class="form-text text-muted">
                                Dapatkan icon dari <a href="https://fontawesome.com/icons" target="_blank"
                                    rel="noopener noreferrer">FontAwesome Icons</a>.
                            </small>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="isRuckus" class="col-sm-3 col-form-label text-end">Ruckus?</label>
                        <div class="col-sm-9">
                            <select name="isRuckus" id="isRuckus" class="form-control">
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div><!-- end modal-body -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" form="tipeFrm" class="btn btn-primary" id="btnSimpan">Simpan</button>
            </div><!-- end modal-footer -->
        </div><!-- end modal-content -->
    </div><!-- end modal-dialog -->
</div><!-- end modal -->

<!-- Modal Edit -->
<div class="modal fade bd-example-modal-lg" id="editModalLarge" tabindex="-1" role="dialog"
    aria-labelledby="myEditModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title m-0" id="myEditModalLabel">Edit Tipe</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div><!-- end modal-header -->
            <div class="modal-body">
                <form id="editTipeFrm" enctype="multipart/form-data" method="POST" action="">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="edit_id_tipe" name="id">
                    <div class="mb-3 row">
                        <label for="edit_tipe_name" class="col-sm-3 col-form-label text-end">Nama Tipe</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" id="edit_tipe_name" name="name"
                                placeholder="Masukkan nama tipe" onkeyup="createEditSlug()">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="edit_slug" class="col-sm-3 col-form-label text-end">Slug</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" id="edit_slug" name="slug"
                                placeholder="slug-tipe" readonly>
                            <small class="form-text text-muted">Slug akan otomatis dibuat dari nama tipe</small>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="edit_file" class="col-sm-3 col-form-label text-end">3D Model (Optional)</label>
                        <div class="col-sm-9">
                            <input type="file" name="file" id="edit_file" class="form-control"
                                accept=".stl,.obj,.fbx,.dae,.glb,.ply">
                            <small class="form-text text-muted" id="current_file_text">Current file: <span
                                    id="current_file">None</span></small>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="edit_icon" class="col-sm-3 col-form-label text-end">Icon (Optional)</label>
                        <div class="col-sm-9">
                            <input type="text" name="icon" id="edit_icon" class="form-control"
                                placeholder="e.g. fa-solid fa-file">
                            <small class="form-text text-muted">
                                Dapatkan icon dari <a href="https://fontawesome.com/icons" target="_blank"
                                    rel="noopener noreferrer">FontAwesome Icons</a>.
                            </small>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="edit_isRuckus" class="col-sm-3 col-form-label text-end">Ruckus?</label>
                        <div class="col-sm-9">
                            <select name="isRuckus" id="edit_isRuckus" class="form-control">
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div><!-- end modal-body -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" form="editTipeFrm" class="btn btn-primary" id="btnUpdate">Update</button>
            </div><!-- end modal-footer -->
        </div><!-- end modal-content -->
    </div><!-- end modal-dialog -->
</div><!-- end modal -->

<!-- JavaScript for Modals and Slug Generation -->
<script>
    // Fungsi untuk menghasilkan slug dari nama
    function generateSlug(text) {
        return text.toString().toLowerCase()
            .replace(/\s+/g, '-') // Ganti spasi dengan -
            .replace(/[^\w\-]+/g, '') // Hapus karakter yang tidak diizinkan
            .replace(/\-\-+/g, '-') // Ganti multiple - dengan single -
            .replace(/^-+/, '') // Hilangkan - dari awal teks
            .replace(/-+$/, ''); // Hilangkan - dari akhir teks
    }

    // Fungsi untuk membuat slug dari input nama pada form tambah
    function createSlug() {
        let tipe_name = document.getElementById('tipe_name').value;
        document.getElementById('slug').value = generateSlug(tipe_name);
    }

    // Fungsi untuk membuat slug dari input nama pada form edit
    function createEditSlug() {
        let tipe_name = document.getElementById('edit_tipe_name').value;
        document.getElementById('edit_slug').value = generateSlug(tipe_name);
    }

    // Fungsi untuk membuka modal edit dan mengisi data form edit
    function openEditModal(id, name, icon, isRuckus, fileName) {
        document.getElementById('edit_id_tipe').value = id;
        document.getElementById('edit_tipe_name').value = name;
        document.getElementById('edit_slug').value = generateSlug(name);
        document.getElementById('edit_icon').value = icon;

        // Set nilai Ruckus (Yes/No)
        const ruckusVal = isRuckus === 'Yes' ? '1' : '0';
        document.getElementById('edit_isRuckus').value = ruckusVal;

        // Tampilkan nama file saat ini jika ada
        document.getElementById('current_file').textContent = fileName ? fileName : 'None';

        // Buka modal edit
        var editModal = new bootstrap.Modal(document.getElementById('editModalLarge'));
        editModal.show();
    }

    // Fokus input saat modal Add terbuka
    document.getElementById('addModalLarge').addEventListener('shown.bs.modal', function() {
        document.getElementById('tipe_name').focus();
    });

    // Fokus input saat modal Edit terbuka
    document.getElementById('editModalLarge').addEventListener('shown.bs.modal', function() {
        document.getElementById('edit_tipe_name').focus();
    });

    // Contoh event listener untuk tombol simpan (gunakan form submission atau AJAX sesuai kebutuhan)
    document.getElementById('btnSimpan').addEventListener('click', function() {
        // Misal: document.getElementById('tipeFrm').submit();
        alert('Form submitted: Tambah Tipe');
    });

    document.getElementById('btnUpdate').addEventListener('click', function() {
        // Misal: document.getElementById('editTipeFrm').submit();
        alert('Form submitted: Update Tipe');
    });
</script>

@push('scripts')
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <script src="{{ asset('dist/assets/libs/simple-datatables/umd/simple-datatables.js') }}"></script>
    <script src="{{ asset('dist/assets/js/pages/datatable.init.js') }}"></script>
    <script src="{{ asset('dist/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('dist/assets/js/pages/sweet-alert.init.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('dist/assets/libs/select2/js/select2.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            // Function to format validation errors
            function formatValidationErrors(errors) {
                let errorMessage = '<div class="text-left">';
                for (let field in errors) {
                    errorMessage += `<p class="mb-1">• ${errors[field][0]}</p>`;
                }
                errorMessage += '</div>';
                return errorMessage;
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

            // Update slug automatically when typing name
            $('#tipe_name').on('keyup', function() {
                $('#slug').val(generateSlug($(this).val()));
            });

            $('#edit_tipe_name').on('keyup', function() {
                $('#edit_slug').val(generateSlug($(this).val()));
            });

            // Form Submit Handler - Create
            $('#tipeFrm').on('submit', function(e) {
                e.preventDefault();
                
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
                            text: response.message || 'Tipe berhasil disimpan',
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
                            let errorMessage = 'Terjadi kesalahan';
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
                    }
                });
            });

            // Form Submit Handler - Update
            $('#editTipeFrm').on('submit', function(e) {
                e.preventDefault();
                
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
                            text: response.message || 'Tipe berhasil diupdate',
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
                            let errorMessage = 'Terjadi kesalahan';
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
                    }
                });
            });

            // Edit button click handler
            $(document).on('click', '.edit-btn', function() {
                var id = $(this).data('id');
                var name = $(this).data('name');
                var icon = $(this).data('icon');
                var isRuckus = $(this).data('is-ruckus');
                var file = $(this).data('file');

                $('#edit_id_tipe').val(id);
                $('#edit_tipe_name').val(name);
                $('#edit_slug').val(generateSlug(name));
                $('#edit_icon').val(icon);
                $('#edit_isRuckus').val(isRuckus ? '1' : '0');

                // Update current file text if exists
                if (file) {
                    $('#current_file').text(file);
                    $('#current_file_text').show();
                } else {
                    $('#current_file_text').hide();
                }

                // Update form action
                var updateUrl = "{{ route('admin.tipe.update', ':id') }}";
                updateUrl = updateUrl.replace(':id', id);
                $('#editTipeFrm').attr('action', updateUrl);

                $('#editModalLarge').modal('show');
            });

            // Delete button click handler
            $(document).on('click', '.delete-btn', function() {
                var tipeId = $(this).data('id');
                var tipeName = $(this).data('name');
                
                Swal.fire({
                    title: 'Apakah anda yakin?',
                    html: `Anda akan menghapus tipe: <b>${tipeName}</b>`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('admin.tipe.destroy', ':id') }}".replace(':id', tipeId),
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                _method: 'DELETE'
                            },
                            success: function(response) {
                                Swal.fire({
                                    title: 'Terhapus!',
                                    text: 'Tipe berhasil dihapus.',
                                    icon: 'success',
                                    confirmButtonText: 'OK'
                                }).then((result) => {
                                    location.reload();
                                });
                            },
                            error: function(xhr) {
                                let errorMessage = 'Gagal menghapus tipe.';
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
                $('#tipe_name').focus();
            });

            $('#editModalLarge').on('shown.bs.modal', function() {
                $('#edit_tipe_name').focus();
            });
        });
    </script>
@endpush
@endsection
