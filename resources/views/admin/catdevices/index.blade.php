@extends('layouts.app')
@section('content')
@section('title', 'Master Categories')
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
                                    <a href="javascript:void(0);" class="btn btn-outline-primary"
                                        onclick="openEditModal('1', 'Router', 'router', 'Perangkat untuk menghubungkan jaringan', 'fa-solid fa-network-wired')">Edit</a>
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
                                placeholder="Masukkan nama kategori">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="slug" class="col-sm-3 col-form-label text-end">Slug</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" id="slug" name="slug"
                                placeholder="URL-friendly version (otomatis dari nama)">
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
                                placeholder="Masukkan nama kategori">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="edit_slug" class="col-sm-3 col-form-label text-end">Slug</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" id="edit_slug" name="slug"
                                placeholder="URL-friendly version (otomatis dari nama)">
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

<!-- JavaScript for Modals -->
<!-- JavaScript for Modals -->
<script>
    // Generate slug functions
    function generateSlug(text) {
        // Convert to lowercase
        let slug = text.toLowerCase();
        // Replace spaces with hyphens
        slug = slug.replace(/\s+/g, '-');
        // Remove special characters
        slug = slug.replace(/[^\w\-]+/g, '');
        // Remove duplicate hyphens
        slug = slug.replace(/\-\-+/g, '-');
        // Remove leading and trailing hyphens
        slug = slug.replace(/^-+/, '').replace(/-+$/, '');

        return slug;
    }

    // Function for creating slug from tipe name field
    function createSlug() {
        let tipe_name = document.getElementById('tipe_name').value;
        document.getElementById('slug').value = generateSlug(tipe_name);
    }

    // Function for creating slug from edit tipe name field
    function createEditSlug() {
        let tipe_name = document.getElementById('edit_tipe_name').value;
        document.getElementById('edit_slug').value = generateSlug(tipe_name);
    }

    // Function to open edit modal with data
    function openEditModal(id, name, brand_id, category_id, icon, isRuckus) {
        document.getElementById('edit_id_tipe').value = id;
        document.getElementById('edit_tipe_name').value = name;
        document.getElementById('edit_icon').value = icon;

        // Set dropdown values
        document.getElementById('edit_brand_id').value = brand_id;
        document.getElementById('edit_category_id').value = category_id;

        // Set select dropdown value
        const ruckusValue = isRuckus === 'Yes' ? '1' : '0';
        document.getElementById('edit_isRuckus').value = ruckusValue;

        // Set current file info if applicable
        const currentFileSpan = document.getElementById('current_file');
        if (currentFileSpan) {
            // You would replace this with actual file name from your data
            currentFileSpan.textContent = 'model.stl';
        }

        // Open the modal using Bootstrap's API
        var editModal = new bootstrap.Modal(document.getElementById('editModalLarge'));
        editModal.show();
    }

    // Initialize when the add modal opens
    document.getElementById('addModalLarge').addEventListener('shown.bs.modal', function() {
        document.getElementById('tipe_name').focus();
    });

    // Initialize when the edit modal opens
    document.getElementById('editModalLarge').addEventListener('shown.bs.modal', function() {
        document.getElementById('edit_tipe_name').focus();

        // Initialize Select2 in modal after it's shown
        if ($.fn.select2) {
            $('#edit_brand_id').select2({
                dropdownParent: $('#editModalLarge')
            });
            $('#edit_category_id').select2({
                dropdownParent: $('#editModalLarge')
            });
        }
    });

    // Add event listener for the save button
    document.getElementById('btnSimpan').addEventListener('click', function() {
        // Add your save logic here
        // For example: document.getElementById('tipeFrm').submit();
        alert('Form submitted: Tambah Tipe');
    });

    // Add event listener for the update button
    document.getElementById('btnUpdate').addEventListener('click', function() {
        // Add your update logic here
        // For example: document.getElementById('editTipeFrm').submit();
        alert('Form submitted: Update Tipe');
    });

    // Initialize Select2 for the add modal
    document.addEventListener('DOMContentLoaded', function() {
        if ($.fn.select2) {
            $('#brand_id').select2({
                dropdownParent: $('#addModalLarge')
            });
            $('#category_id').select2({
                dropdownParent: $('#addModalLarge')
            });
        }
    });
</script>

@push('scripts')
    <script src="{{ asset('dist/assets/libs/simple-datatables/umd/simple-datatables.js') }}"></script>
    <script src="{{ asset('dist/assets/js/pages/datatable.init.js') }}"></script>

    <script src="{{ asset('dist/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('dist/assets/js/pages/sweet-alert.init.js') }}"></script>
@endpush
@endsection
