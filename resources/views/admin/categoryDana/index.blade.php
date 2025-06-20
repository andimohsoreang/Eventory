@extends('layouts.app')
@section('content')
@section('title', 'Master Category Dana')
@push('links')
    <link href="{{ asset('dist/assets/libs/simple-datatables/style.css') }}" rel="stylesheet" type="text/css" />
    <!-- Sweet Alert -->
    <link href="{{ asset('dist/assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('dist/assets/libs/animate.css/animate.min.css') }}" rel="stylesheet" type="text/css">
@endpush

<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box d-md-flex justify-content-md-between align-items-center">
            <h4 class="page-title">Kategori Dana</h4>
            <div class="">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="#">Master</a></li>
                    <li class="breadcrumb-item active">Kategori Dana</li>
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
                        <h4 class="card-title">Daftar Kategori Dana</h4>
                    </div>
                    <div class="col-auto">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#addModalLarge">
                            Tambah Kategori
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
                                <th>Nama Kategori</th>
                                <th>Slug</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->slug }}</td>
                                    <td>
                                        <button class="btn btn-outline-primary edit-btn" 
                                                data-id="{{ $item->id }}"
                                                data-name="{{ $item->name }}">
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
                <h6 class="modal-title m-0" id="myLargeModalLabel">Tambah Kategori Dana</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div><!--end modal-header-->
            <div class="modal-body">
                <form id="categoryFrm" enctype="multipart/form-data">
                    <div class="mb-3 row">
                        <label for="category_name" class="col-sm-3 col-form-label text-end">Nama Kategori</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" id="category_name" name="name" placeholder="Masukkan nama kategori">
                        </div>
                    </div>
                    <!-- Input slug dihilangkan karena di-handle di controller -->
                </form>
            </div><!--end modal-body-->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="btnSimpan">Simpan</button>
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
                <h6 class="modal-title m-0" id="myEditModalLabel">Edit Kategori Dana</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div><!--end modal-header-->
            <div class="modal-body">
                <form id="editCategoryFrm" enctype="multipart/form-data">
                    <input type="hidden" id="edit_id_category" name="id">
                    <div class="mb-3 row">
                        <label for="edit_category_name" class="col-sm-3 col-form-label text-end">Nama Kategori</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" id="edit_category_name" name="name" placeholder="Masukkan nama kategori">
                        </div>
                    </div>
                    <!-- Input slug dihilangkan karena di-handle di controller -->
                </form>
            </div><!--end modal-body-->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="btnUpdate">Update</button>
            </div><!--end modal-footer-->
        </div><!--end modal-content-->
    </div><!--end modal-dialog-->
</div><!--end modal-->

@push('scripts')
    <!-- Pastikan jQuery ter-load -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <script src="{{ asset('dist/assets/libs/simple-datatables/umd/simple-datatables.js') }}"></script>
    <script src="{{ asset('dist/assets/js/pages/datatable.init.js') }}"></script>

    <script src="{{ asset('dist/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('dist/assets/js/pages/sweet-alert.init.js') }}"></script>

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

            // Tombol Simpan (Store)
            $('#btnSimpan').on('click', function() {
                var data = {
                    name: $('#category_name').val(),
                    _token: '{{ csrf_token() }}'
                };

                $.ajax({
                    url: "{{ route('admin.category.store') }}",
                    method: "POST",
                    data: data,
                    success: function(response) {
                        Swal.fire({
                            title: 'Berhasil!',
                            text: response.message || 'Kategori Dana berhasil disimpan',
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

            // Tombol Update (Update)
            $('#btnUpdate').on('click', function() {
                var id = $('#edit_id_category').val();
                var data = {
                    name: $('#edit_category_name').val(),
                    _token: '{{ csrf_token() }}',
                    _method: 'PUT'
                };

                var updateUrl = "{{ route('admin.category.update', ':id') }}";
                updateUrl = updateUrl.replace(':id', id);

                $.ajax({
                    url: updateUrl,
                    method: "POST",
                    data: data,
                    success: function(response) {
                        Swal.fire({
                            title: 'Berhasil!',
                            text: response.message || 'Kategori Dana berhasil diupdate',
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
                var categoryId = $(this).data('id');
                var categoryName = $(this).data('name');
                
                Swal.fire({
                    title: 'Apakah anda yakin?',
                    html: `Anda akan menghapus kategori: <b>${categoryName}</b>`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('admin.category.destroy', ':id') }}".replace(':id', categoryId),
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                _method: 'DELETE'
                            },
                            success: function(response) {
                                Swal.fire({
                                    title: 'Terhapus!',
                                    text: 'Kategori Dana berhasil dihapus.',
                                    icon: 'success',
                                    confirmButtonText: 'OK'
                                }).then((result) => {
                                    location.reload();
                                });
                            },
                            error: function(xhr) {
                                let errorMessage = 'Gagal menghapus kategori.';
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

            // Event tombol Edit: isi data form edit dari data attribute
            $(document).on('click', '.edit-btn', function() {
                var id = $(this).data('id');
                var name = $(this).data('name');

                $('#edit_id_category').val(id);
                $('#edit_category_name').val(name);
                $('#editModalLarge').modal('show');
            });

            // Fokus pada input saat modal terbuka
            $('#addModalLarge').on('shown.bs.modal', function() {
                $('#category_name').focus();
            });

            $('#editModalLarge').on('shown.bs.modal', function() {
                $('#edit_category_name').focus();
            });
        });
    </script>
@endpush
@endsection
