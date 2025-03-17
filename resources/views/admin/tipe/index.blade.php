@extends('layouts.app')
@section('content')
@section('title', 'Master Tipe')
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
                                <th>Brand</th>
                                <th>Kategori</th>
                                <th>Icon</th>
                                <th>Model 3D</th>
                                <th>Ruckus</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Type Example</td>
                                <td>Cisco</td>
                                <td>Router</td>
                                <td><i class="fa-solid fa-file"></i></td>
                                <td>model.stl</td>
                                <td>Yes</td>
                                <td>
                                    <a href="/admin/tipe/show" class="btn btn-outline-info">Detail</a>
                                    <a href="javascript:void(0);" class="btn btn-outline-primary"
                                        onclick="openEditModal('1', 'Type Example', '1', '1', 'fa-solid fa-file', 'Yes', 'Router WiFi Dual-Band dengan port Gigabit')">Edit</a>
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
                <h6 class="modal-title m-0" id="myLargeModalLabel">Tambah Tipe</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div><!--end modal-header-->
            <div class="modal-body">
                <form id="tipeFrm" enctype="multipart/form-data">
                    <div class="mb-3 row">
                        <label for="tipe_name" class="col-sm-3 col-form-label text-end">Nama Tipe</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" id="tipe_name" name="tipe_name"
                                placeholder="Masukkan nama tipe" onkeyup="createSlug()">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="description" class="col-sm-3 col-form-label text-end">Deskripsi /
                            Spesifikasi</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" id="description" name="description" rows="4"
                                placeholder="Masukkan deskripsi atau spesifikasi tipe"></textarea>
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
                        <label for="brand_id" class="col-sm-3 col-form-label text-end">Brand</label>
                        <div class="col-sm-9">
                            <select class="form-control select2" id="brand_id" name="brand_id">
                                <option value="">Pilih Brand</option>
                                <option value="1">Cisco</option>
                                <option value="2">Mikrotik</option>
                                <option value="3">HP</option>
                                <option value="4">Huawei</option>
                                <!-- Brands akan dirender secara dinamis di sini -->
                            </select>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="category_id" class="col-sm-3 col-form-label text-end">Kategori Device</label>
                        <div class="col-sm-9">
                            <select class="form-control select2" id="category_id" name="category_id">
                                <option value="">Pilih Kategori</option>
                                <option value="1">Router</option>
                                <option value="2">Switch</option>
                                <option value="3">Access Point</option>
                                <option value="4">Firewall</option>
                                <!-- Kategori akan dirender secara dinamis di sini -->
                            </select>
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
                                placeholder="Paste FontAwesome Icon Class (e.g. fa-solid fa-file)">
                            <small class="form-text text-muted">
                                You can get the icon classes from <a href="https://fontawesome.com/icons"
                                    target="_blank" rel="noopener noreferrer">FontAwesome Icons</a>.
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
                <h6 class="modal-title m-0" id="myEditModalLabel">Edit Tipe</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div><!--end modal-header-->
            <div class="modal-body">
                <form id="editTipeFrm" enctype="multipart/form-data">
                    <input type="hidden" id="edit_id_tipe" name="id_tipe">

                    <div class="mb-3 row">
                        <label for="edit_tipe_name" class="col-sm-3 col-form-label text-end">Nama Tipe</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" id="edit_tipe_name" name="tipe_name"
                                placeholder="Masukkan nama tipe" onkeyup="createEditSlug()">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="edit_description" class="col-sm-3 col-form-label text-end">Deskripsi /
                            Spesifikasi</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" id="edit_description" name="description" rows="4"
                                placeholder="Masukkan deskripsi atau spesifikasi tipe"></textarea>
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
                        <label for="edit_brand_id" class="col-sm-3 col-form-label text-end">Brand</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="edit_brand_id" name="brand_id">
                                <option value="">Pilih Brand</option>
                                <option value="1">Cisco</option>
                                <option value="2">Mikrotik</option>
                                <option value="3">HP</option>
                                <option value="4">Huawei</option>
                                <!-- Brands akan dirender secara dinamis di sini -->
                            </select>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="edit_category_id" class="col-sm-3 col-form-label text-end">Kategori Device</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="edit_category_id" name="category_id">
                                <option value="">Pilih Kategori</option>
                                <option value="1">Router</option>
                                <option value="2">Switch</option>
                                <option value="3">Access Point</option>
                                <option value="4">Firewall</option>
                                <!-- Kategori akan dirender secara dinamis di sini -->
                            </select>
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
                                placeholder="Paste FontAwesome Icon Class (e.g. fa-solid fa-file)">
                            <small class="form-text text-muted">
                                You can get the icon classes from <a href="https://fontawesome.com/icons"
                                    target="_blank" rel="noopener noreferrer">FontAwesome Icons</a>.
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

    function openEditModal(id, name, brand_id, category_id, icon, isRuckus, description) {
        document.getElementById('edit_id_tipe').value = id;
        document.getElementById('edit_tipe_name').value = name;
        document.getElementById('edit_slug').value = generateSlug(name);
        document.getElementById('edit_icon').value = icon;
        document.getElementById('edit_description').value = description;

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

        // Open the modal
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

    // Initialize Select2 after DOM is fully loaded
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof($.fn.select2) !== 'undefined') {
            $('#brand_id, #category_id').select2({
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
