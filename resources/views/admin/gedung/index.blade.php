@extends('layouts.app')
@section('content')
@section('title', 'Master Gedung')
@push('links')
    <link href="{{ asset('dist/assets/libs/simple-datatables/style.css') }}" rel="stylesheet" type="text/css" />
    <!-- Sweet Alert -->
    <link href="{{ asset('dist/assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('dist/assets/libs/animate.css/animate.min.css') }}" rel="stylesheet" type="text/css">
    <!-- Select2 -->
    <link href="{{ asset('dist/assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css">
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
                                <th>Foto</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Gedung Example</td>
                                <td>Jakarta Pusat</td>
                                <td>N/A</td>
                                <td><img src="{{ asset('dist/assets/images/small/img-1.jpg') }}" alt="Gedung"
                                        class="img-fluid rounded" width="100" height="100"></td>
                                <td>
                                    <a href="/admin/gedung/show" class="btn btn-outline-info">Detail</a>
                                    <a href="javascript:void(0);" class="btn btn-outline-primary"
                                        onclick="openEditModal('1', 'Gedung Example', 'Jakarta Pusat', '', 'img-1.jpg')">Edit</a>
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
                <h6 class="modal-title m-0" id="myLargeModalLabel">Tambah Gedung</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div><!--end modal-header-->
            <div class="modal-body">
                <form id="gedungFrm" enctype="multipart/form-data">
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
                            <textarea class="form-control" id="lokasi" name="lokasi" rows="4" placeholder="Masukkan lokasi gedung"></textarea>
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
                                <option value="1">Gedung A</option>
                                <option value="2">Gedung B</option>
                                <option value="3">Gedung C</option>
                                <!-- Parent Gedung akan dirender secara dinamis di sini -->
                            </select>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="photo" class="col-sm-3 col-form-label text-end">Denah Gedung</label>
                        <div class="col-sm-9">
                            <input type="file" name="photo" id="photo" class="form-control"
                                accept="image/*">
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
                <h6 class="modal-title m-0" id="myEditModalLabel">Edit Gedung</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div><!--end modal-header-->
            <div class="modal-body">
                <form id="editGedungFrm" enctype="multipart/form-data">
                    <input type="hidden" id="edit_id_gedung" name="id_gedung">

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
                            <textarea class="form-control" id="edit_lokasi" name="lokasi" rows="4" placeholder="Masukkan lokasi gedung"></textarea>
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
                            <select class="form-control" id="edit_parent_id" name="parent_id">
                                <option value="">Pilih Parent Gedung</option>
                                <option value="1">Gedung A</option>
                                <option value="2">Gedung B</option>
                                <option value="3">Gedung C</option>
                                <!-- Parent Gedung akan dirender secara dinamis di sini -->
                            </select>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="edit_photo" class="col-sm-3 col-form-label text-end">Denah Gedung</label>
                        <div class="col-sm-9">
                            <input type="file" name="photo" id="edit_photo" class="form-control"
                                accept="image/*">
                            <small class="form-text text-muted" id="current_photo_text">Current photo: <span
                                    id="current_photo">None</span></small>
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

    // Function for creating slug from gedung name field
    function createSlug() {
        let name = document.getElementById('name').value;
        document.getElementById('slug').value = generateSlug(name);
    }

    // Function for creating slug from edit gedung name field
    function createEditSlug() {
        let name = document.getElementById('edit_name').value;
        document.getElementById('edit_slug').value = generateSlug(name);
    }

    function openEditModal(id, name, lokasi, parent_id, photo) {
        document.getElementById('edit_id_gedung').value = id;
        document.getElementById('edit_name').value = name;
        document.getElementById('edit_slug').value = generateSlug(name);
        document.getElementById('edit_lokasi').value = lokasi;

        // Set dropdown value
        document.getElementById('edit_parent_id').value = parent_id;

        // Set current photo info if applicable
        const currentPhotoSpan = document.getElementById('current_photo');
        if (currentPhotoSpan) {
            // You would replace this with actual file name from your data
            currentPhotoSpan.textContent = photo || 'None';
        }

        // Open the modal
        var editModal = new bootstrap.Modal(document.getElementById('editModalLarge'));
        editModal.show();
    }

    // Initialize when the add modal opens
    document.getElementById('addModalLarge').addEventListener('shown.bs.modal', function() {
        document.getElementById('name').focus();
    });

    // Initialize when the edit modal opens
    document.getElementById('editModalLarge').addEventListener('shown.bs.modal', function() {
        document.getElementById('edit_name').focus();
    });

    // Add event listener for the save button
    document.getElementById('btnSimpan').addEventListener('click', function() {
        // Add your save logic here
        // For example: document.getElementById('gedungFrm').submit();
        alert('Form submitted: Tambah Gedung');
    });

    // Add event listener for the update button
    document.getElementById('btnUpdate').addEventListener('click', function() {
        // Add your update logic here
        // For example: document.getElementById('editGedungFrm').submit();
        alert('Form submitted: Update Gedung');
    });

    // Initialize Select2 after DOM is fully loaded
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof($.fn.select2) !== 'undefined') {
            $('#parent_id').select2({
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

    <!-- Select2 -->
    <script src="{{ asset('dist/assets/libs/select2/js/select2.min.js') }}"></script>
@endpush
@endsection
