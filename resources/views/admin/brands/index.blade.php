@extends('layouts.app')
@section('content')
@section('title', 'Master Brands')
@push('links')
    <link href="{{ asset('dist/assets/libs/simple-datatables/style.css') }}" rel="stylesheet" type="text/css" />
    <!-- Sweet Alert -->
    <link href="{{ asset('dist/assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('dist/assets/libs/animate.css/animate.min.css') }}" rel="stylesheet" type="text/css">
@endpush

<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box d-md-flex justify-content-md-between align-items-center">
            <h4 class="page-title">Brands</h4>
            <div class="">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="#">Master</a></li>
                    <li class="breadcrumb-item active">Brands</li>
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
                        <h4 class="card-title">Daftar Brands</h4>
                    </div>
                    <div class="col-auto">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#addModalLarge">
                            Tambah Brand
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
                                <th>Nama Brand</th>
                                <th>Slug</th>
                                <th>Logo</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($brands as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->slug }}</td>
                                    <td>
                                        @if ($item->logo)
                                            <img src="{{ asset('storage/' . $item->logo) }}"
                                                alt="{{ $item->name }} Logo" style="height: 30px;">
                                        @else
                                            <span>Tidak ada logo</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-outline-primary edit-btn" 
                                                data-id="{{ $item->id }}"
                                                data-name="{{ $item->name }}" 
                                                data-slug="{{ $item->slug }}"
                                                data-logo="{{ $item->logo ? asset('storage/' . $item->logo) : '' }}">
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
                <h6 class="modal-title m-0" id="myLargeModalLabel">Tambah Brand</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div><!--end modal-header-->
            <div class="modal-body">
                <form id="brandFrm" enctype="multipart/form-data" method="POST"
                    action="{{ route('admin.brand.store') }}">
                    @csrf
                    <div class="mb-3 row">
                        <label for="brand_name" class="col-sm-3 col-form-label text-end">Nama Brand</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" id="brand_name" name="name"
                                placeholder="Masukkan nama brand">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="slug" class="col-sm-3 col-form-label text-end">Slug</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" id="slug" name="slug"
                                placeholder="URL-friendly version (otomatis dari nama)">
                            <small class="form-text text-muted">Slug akan otomatis dibuat dari nama brand, namun bisa
                                diedit.</small>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="logo" class="col-sm-3 col-form-label text-end">Logo</label>
                        <div class="col-sm-9">
                            <input type="file" name="logo" id="logo" class="form-control"
                                accept="image/jpeg,image/png,image/gif,image/svg+xml">
                            <small class="form-text text-muted">Format yang didukung: JPG, PNG, GIF, SVG</small>
                        </div>
                    </div>
                </form>
            </div><!--end modal-body-->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" form="brandFrm" class="btn btn-primary" id="btnSimpan">Simpan</button>
            </div><!--end modal-footer-->
        </div><!--end modal-content-->
    </div><!--end modal-dialog-->
</div><!--end modal-->

<!-- Modal Edit -->
<div class="modal fade bd-example-modal-lg" id="editModalLarge" tabindex="-1" role="dialog"
    aria-labelledby="myEditModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title m-0" id="myEditModalLabel">Edit Brand</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div><!--end modal-header-->
            <div class="modal-body">
                <form id="editBrandFrm" enctype="multipart/form-data" method="POST" action="">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="edit_id_brand" name="id">
                    <div class="mb-3 row">
                        <label for="edit_brand_name" class="col-sm-3 col-form-label text-end">Nama Brand</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" id="edit_brand_name" name="name"
                                placeholder="Masukkan nama brand">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="edit_slug" class="col-sm-3 col-form-label text-end">Slug</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" id="edit_slug" name="slug"
                                placeholder="URL-friendly version (otomatis dari nama)">
                            <small class="form-text text-muted">Slug akan otomatis dibuat dari nama brand, namun bisa
                                diedit.</small>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="edit_logo" class="col-sm-3 col-form-label text-end">Logo</label>
                        <div class="col-sm-9">
                            <input type="file" name="logo" id="edit_logo" class="form-control"
                                accept="image/jpeg,image/png,image/gif,image/svg+xml">
                            <small class="form-text text-muted">Format yang didukung: JPG, PNG, GIF, SVG</small>
                            <div id="current_logo_container" class="mt-2">
                                <p class="mb-1">Logo saat ini:</p>
                                <img id="current_logo" src="" alt="Current Logo"
                                    style="max-height: 60px; max-width: 200px;">
                            </div>
                        </div>
                    </div>
                </form>
            </div><!--end modal-body-->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" form="editBrandFrm" class="btn btn-primary" id="btnUpdate">Update</button>
            </div><!--end modal-footer-->
        </div><!--end modal-content-->
    </div><!--end modal-dialog-->
</div><!--end modal-->

@push('scripts')
    <script src="{{ asset('dist/assets/libs/simple-datatables/umd/simple-datatables.js') }}"></script>
    <script src="{{ asset('dist/assets/js/pages/datatable.init.js') }}"></script>
    <script src="{{ asset('dist/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('dist/assets/js/pages/sweet-alert.init.js') }}"></script>

    <script>
        // Fungsi untuk menghasilkan slug dari nama
        function generateSlug(text) {
            return text.toString().toLowerCase()
                .replace(/\s+/g, '-')
                .replace(/[^\w\-]+/g, '')
                .replace(/\-\-+/g, '-')
                .replace(/^-+/, '')
                .replace(/-+$/, '');
        }

        // Function to format validation errors
        function formatValidationErrors(errors) {
            let errorMessage = '<div class="text-left">';
            for (let field in errors) {
                errorMessage += `<p class="mb-1">• ${errors[field][0]}</p>`;
            }
            errorMessage += '</div>';
            return errorMessage;
        }

        $(document).ready(function() {
            // Update slug otomatis ketika mengetik nama
            $('#brand_name').on('keyup', function() {
                $('#slug').val(generateSlug($(this).val()));
            });

            $('#edit_brand_name').on('keyup', function() {
                $('#edit_slug').val(generateSlug($(this).val()));
            });

            // Form Submit Handler - Create
            $('#brandFrm').on('submit', function(e) {
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
                            text: response.message || 'Brand berhasil disimpan',
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
            $('#editBrandFrm').on('submit', function(e) {
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
                            text: response.message || 'Brand berhasil diupdate',
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

            // Delete button click handler
            $(document).on('click', '.delete-btn', function() {
                var brandId = $(this).data('id');
                var brandName = $(this).data('name');
                
                Swal.fire({
                    title: 'Apakah anda yakin?',
                    html: `Anda akan menghapus brand: <b>${brandName}</b>`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('admin.brand.destroy', ':id') }}".replace(':id', brandId),
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                _method: 'DELETE'
                            },
                            success: function(response) {
                                Swal.fire({
                                    title: 'Terhapus!',
                                    text: 'Brand berhasil dihapus.',
                                    icon: 'success',
                                    confirmButtonText: 'OK'
                                }).then((result) => {
                                    location.reload();
                                });
                            },
                            error: function(xhr) {
                                let errorMessage = 'Gagal menghapus brand.';
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

            // Edit button click handler
            $(document).on('click', '.edit-btn', function() {
                var id = $(this).data('id');
                var name = $(this).data('name');
                var slug = $(this).data('slug');
                var logo = $(this).data('logo');

                $('#edit_id_brand').val(id);
                $('#edit_brand_name').val(name);
                $('#edit_slug').val(slug);

                // Update form action
                var updateUrl = "{{ route('admin.brand.update', ':id') }}";
                updateUrl = updateUrl.replace(':id', id);
                $('#editBrandFrm').attr('action', updateUrl);

                // Update current logo preview if exists
                if (logo) {
                    $('#current_logo').attr('src', logo);
                    $('#current_logo_container').show();
                } else {
                    $('#current_logo_container').hide();
                }

                $('#editModalLarge').modal('show');
            });

            // Focus input on modal show
            $('#addModalLarge').on('shown.bs.modal', function() {
                $('#brand_name').focus();
            });

            $('#editModalLarge').on('shown.bs.modal', function() {
                $('#edit_brand_name').focus();
            });
        });
    </script>
@endpush
@endsection
