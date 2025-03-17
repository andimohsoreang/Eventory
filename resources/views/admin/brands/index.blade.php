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
                                <th>Website</th>
                                <th>Logo</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Cisco</td>
                                <td>cisco</td>
                                <td>https://cisco.com</td>
                                <td><img src="path/to/cisco-logo.png" alt="Cisco Logo" style="height: 30px;"></td>
                                <td>
                                    <a href="javascript:void(0);" class="btn btn-outline-primary"
                                        onclick="openEditModal('1', 'Cisco', 'cisco', 'Provider perangkat jaringan terkemuka', 'https://cisco.com', 'support@cisco.com')">Edit</a>
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
                <h6 class="modal-title m-0" id="myLargeModalLabel">Tambah Brand</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div><!--end modal-header-->
            <div class="modal-body">
                <form id="brandFrm" enctype="multipart/form-data">
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
                            <small class="form-text text-muted">Slug akan otomatis dibuat dari nama brand</small>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="description" class="col-sm-3 col-form-label text-end">Deskripsi</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" id="description" name="description" rows="3"
                                placeholder="Deskripsi brand (opsional)"></textarea>
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

                    <div class="mb-3 row">
                        <label for="website" class="col-sm-3 col-form-label text-end">Website</label>
                        <div class="col-sm-9">
                            <input type="url" name="website" id="website" class="form-control"
                                placeholder="URL website resmi (opsional)">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="contact_info" class="col-sm-3 col-form-label text-end">Kontak Support</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" id="contact_info" name="contact_info" rows="2"
                                placeholder="Informasi kontak support (opsional)"></textarea>
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
                <h6 class="modal-title m-0" id="myEditModalLabel">Edit Brand</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div><!--end modal-header-->
            <div class="modal-body">
                <form id="editBrandFrm" enctype="multipart/form-data">
                    <input type="hidden" id="edit_id_brand" name="uuid">

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
                            <small class="form-text text-muted">Slug akan otomatis dibuat dari nama brand</small>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="edit_description" class="col-sm-3 col-form-label text-end">Deskripsi</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" id="edit_description" name="description" rows="3"
                                placeholder="Deskripsi brand (opsional)"></textarea>
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

                    <div class="mb-3 row">
                        <label for="edit_website" class="col-sm-3 col-form-label text-end">Website</label>
                        <div class="col-sm-9">
                            <input type="url" name="website" id="edit_website" class="form-control"
                                placeholder="URL website resmi (opsional)">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="edit_contact_info" class="col-sm-3 col-form-label text-end">Kontak Support</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" id="edit_contact_info" name="contact_info" rows="2"
                                placeholder="Informasi kontak support (opsional)"></textarea>
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
<script>
    // Function to generate slug from name
    function generateSlug(text) {
        return text.toString().toLowerCase()
            .replace(/\s+/g, '-') // Replace spaces with -
            .replace(/[^\w\-]+/g, '') // Remove all non-word chars
            .replace(/\-\-+/g, '-') // Replace multiple - with single -
            .replace(/^-+/, '') // Trim - from start of text
            .replace(/-+$/, ''); // Trim - from end of text
    }

    // Add event listener for automatically filling the slug field
    document.getElementById('brand_name').addEventListener('keyup', function() {
        document.getElementById('slug').value = generateSlug(this.value);
    });

    document.getElementById('edit_brand_name').addEventListener('keyup', function() {
        document.getElementById('edit_slug').value = generateSlug(this.value);
    });

    // Function to open edit modal with data
    function openEditModal(id, name, slug, description, website, contact_info) {
        document.getElementById('edit_id_brand').value = id;
        document.getElementById('edit_brand_name').value = name;
        document.getElementById('edit_slug').value = slug;
        document.getElementById('edit_description').value = description;
        document.getElementById('edit_website').value = website;
        document.getElementById('edit_contact_info').value = contact_info;

        // Set current logo if applicable (replace with actual logo path)
        document.getElementById('current_logo').src = 'path/to/logos/' + slug + '-logo.png';

        // Open the modal
        var editModal = new bootstrap.Modal(document.getElementById('editModalLarge'));
        editModal.show();
    }

    // Initialize when the add modal opens
    document.getElementById('addModalLarge').addEventListener('shown.bs.modal', function() {
        document.getElementById('brand_name').focus();
    });

    // Initialize when the edit modal opens
    document.getElementById('editModalLarge').addEventListener('shown.bs.modal', function() {
        document.getElementById('edit_brand_name').focus();
    });

    // Add event listener for the save button
    document.getElementById('btnSimpan').addEventListener('click', function() {
        // Add your save logic here
        // For example: document.getElementById('brandFrm').submit();
        alert('Form submitted: Tambah Brand');
    });

    // Add event listener for the update button
    document.getElementById('btnUpdate').addEventListener('click', function() {
        // Add your update logic here
        // For example: document.getElementById('editBrandFrm').submit();
        alert('Form submitted: Update Brand');
    });
</script>

@push('scripts')
    <script src="{{ asset('dist/assets/libs/simple-datatables/umd/simple-datatables.js') }}"></script>
    <script src="{{ asset('dist/assets/js/pages/datatable.init.js') }}"></script>

    <script src="{{ asset('dist/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('dist/assets/js/pages/sweet-alert.init.js') }}"></script>
@endpush
@endsection
