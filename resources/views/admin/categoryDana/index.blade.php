@extends('layouts.app')
@section('content')
@section('title', 'Master Category')
@push('links')
    <link href="{{ asset('dist/assets/libs/simple-datatables/style.css') }}" rel="stylesheet" type="text/css" />
    <!-- Sweet Alert -->
    <link href="{{ asset('dist/assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('dist/assets/libs/animate.css/animate.min.css') }}" rel="stylesheet" type="text/css">
@endpush
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box d-md-flex justify-content-md-between align-items-center">
            <h4 class="page-title">Device Categories</h4>
            <div class="">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="#">Master</a></li>
                    <li class="breadcrumb-item active">Device Categories</li>
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
                        <h4 class="card-title">Daftar Kategori Device</h4>
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
                                <th>Icon</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Router</td>
                                <td>router</td>
                                <td><i class="fa-solid fa-network-wired"></i></td>
                                <td>
                                    <button class="btn btn-outline-primary edit-btn" data-id="1" data-name="Router"
                                        data-slug="router" data-description="Perangkat untuk menghubungkan jaringan"
                                        data-icon="fa-solid fa-network-wired">
                                        Edit
                                    </button>
                                    <a href="#" class="btn btn-outline-danger">Hapus</a>
                                </td>
                            </tr>
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
                <h6 class="modal-title m-0" id="myLargeModalLabel">Tambah Kategori Device</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div><!--end modal-header-->
            <div class="modal-body">
                <form id="categoryFrm" enctype="multipart/form-data">
                    <div class="mb-3 row">
                        <label for="category_name" class="col-sm-3 col-form-label text-end">Nama Kategori</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" id="category_name" name="name"
                                placeholder="Masukkan nama kategori" onkeyup="createSlug()">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="slug" class="col-sm-3 col-form-label text-end">Slug</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" id="slug" name="slug"
                                placeholder="slug-kategori" readonly>
                            <small class="form-text text-muted">Slug akan otomatis dibuat dari nama kategori</small>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="description" class="col-sm-3 col-form-label text-end">Deskripsi</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" id="description" name="description" rows="3"
                                placeholder="Deskripsi kategori (opsional)"></textarea>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="icon" class="col-sm-3 col-form-label text-end">Icon</label>
                        <div class="col-sm-9">
                            <input type="text" name="icon" id="icon" class="form-control"
                                placeholder="Paste FontAwesome Icon Class (e.g. fa-solid fa-network-wired)">
                            <small class="form-text text-muted">
                                You can get the icon classes from <a href="https://fontawesome.com/icons"
                                    target="_blank" rel="noopener noreferrer">FontAwesome Icons</a>.
                            </small>
                        </div>
                    </div>
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
                <h6 class="modal-title m-0" id="myEditModalLabel">Edit Kategori Device</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div><!--end modal-header-->
            <div class="modal-body">
                <form id="editCategoryFrm" enctype="multipart/form-data">
                    <input type="hidden" id="edit_id_category" name="uuid">

                    <div class="mb-3 row">
                        <label for="edit_category_name" class="col-sm-3 col-form-label text-end">Nama Kategori</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" id="edit_category_name" name="name"
                                placeholder="Masukkan nama kategori" onkeyup="createEditSlug()">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="edit_slug" class="col-sm-3 col-form-label text-end">Slug</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" id="edit_slug" name="slug"
                                placeholder="slug-kategori" readonly>
                            <small class="form-text text-muted">Slug akan otomatis dibuat dari nama kategori</small>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="edit_description" class="col-sm-3 col-form-label text-end">Deskripsi</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" id="edit_description" name="description" rows="3"
                                placeholder="Deskripsi kategori (opsional)"></textarea>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="edit_icon" class="col-sm-3 col-form-label text-end">Icon</label>
                        <div class="col-sm-9">
                            <input type="text" name="icon" id="edit_icon" class="form-control"
                                placeholder="Paste FontAwesome Icon Class (e.g. fa-solid fa-network-wired)">
                            <small class="form-text text-muted">
                                You can get the icon classes from <a href="https://fontawesome.com/icons"
                                    target="_blank" rel="noopener noreferrer">FontAwesome Icons</a>.
                            </small>
                            <div id="current_icon_preview" class="mt-2 mb-2">
                                <span>Current Icon: </span>
                                <i id="current_icon" class=""></i>
                            </div>
                        </div>
                    </div>
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
    <script src="{{ asset('dist/assets/libs/simple-datatables/umd/simple-datatables.js') }}"></script>
    <script src="{{ asset('dist/assets/js/pages/datatable.init.js') }}"></script>

    <script src="{{ asset('dist/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('dist/assets/js/pages/sweet-alert.init.js') }}"></script>

    <script>
        // Menggunakan jQuery untuk memastikan semua elemen DOM sudah tersedia
        $(document).ready(function() {
            // Function untuk membuat slug dari teks
            function generateSlug(text) {
                return text.toString().toLowerCase()
                    .replace(/\s+/g, '-') // Replace spaces with -
                    .replace(/[^\w\-]+/g, '') // Remove all non-word chars
                    .replace(/\-\-+/g, '-') // Replace multiple - with single -
                    .replace(/^-+/, '') // Trim - from start of text
                    .replace(/-+$/, ''); // Trim - from end of text
            }

            // Function untuk membuat slug dari nama kategori
            window.createSlug = function() {
                var name = $('#category_name').val();
                $('#slug').val(generateSlug(name));
            };

            // Function untuk membuat slug dari nama kategori (form edit)
            window.createEditSlug = function() {
                var name = $('#edit_category_name').val();
                $('#edit_slug').val(generateSlug(name));
            };

            // Event handler untuk tombol simpan
            $('#btnSimpan').on('click', function() {
                alert('Form submitted: Tambah Kategori');
            });

            // Event handler untuk tombol update
            $('#btnUpdate').on('click', function() {
                alert('Form submitted: Update Kategori');
            });

            // Event handler untuk tombol edit
            $(document).on('click', '.edit-btn', function() {
                var id = $(this).data('id');
                var name = $(this).data('name');
                var slug = $(this).data('slug');
                var description = $(this).data('description');
                var icon = $(this).data('icon');

                // Set nilai pada form edit
                $('#edit_id_category').val(id);
                $('#edit_category_name').val(name);
                $('#edit_slug').val(slug);
                $('#edit_description').val(description);
                $('#edit_icon').val(icon);

                // Set icon preview
                $('#current_icon').attr('class', icon);

                // Buka modal edit
                $('#editModalLarge').modal('show');
            });

            // Fokus pada input nama saat modal tambah dibuka
            $('#addModalLarge').on('shown.bs.modal', function() {
                $('#category_name').focus();
            });

            // Fokus pada input nama saat modal edit dibuka
            $('#editModalLarge').on('shown.bs.modal', function() {
                $('#edit_category_name').focus();
            });
        });
    </script>
@endpush
@endsection
