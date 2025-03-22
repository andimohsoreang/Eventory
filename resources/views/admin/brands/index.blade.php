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
                                        <button class="btn btn-outline-primary edit-btn" data-id="{{ $item->id }}"
                                            data-name="{{ $item->name }}" data-slug="{{ $item->slug }}">
                                            Edit
                                        </button>
                                        <form action="{{ route('admin.brand.destroy', $item->id) }}" method="POST"
                                            style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger">Hapus</button>
                                        </form>
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

    // Update slug otomatis ketika mengetik nama pada form tambah
    document.getElementById('brand_name').addEventListener('keyup', function() {
        document.getElementById('slug').value = generateSlug(this.value);
    });

    // Update slug otomatis ketika mengetik nama pada form edit
    document.getElementById('edit_brand_name').addEventListener('keyup', function() {
        document.getElementById('edit_slug').value = generateSlug(this.value);
    });

    // Fungsi untuk membuka modal edit dengan data yang sudah ada
    function openEditModal(id, name, slug) {
        document.getElementById('edit_id_brand').value = id;
        document.getElementById('edit_brand_name').value = name;
        document.getElementById('edit_slug').value = slug;

        // Set action URL form edit (sesuaikan dengan route update)
        var updateUrl = "{{ route('admin.brand.update', ':id') }}";
        updateUrl = updateUrl.replace(':id', id);
        document.getElementById('editBrandFrm').action = updateUrl;

        // Set current logo (jika ada); sesuaikan path jika diperlukan
        document.getElementById('current_logo').src = "{{ asset('storage/logos/') }}/" + slug + ".png";

        var editModal = new bootstrap.Modal(document.getElementById('editModalLarge'));
        editModal.show();
    }
</script>

@push('scripts')
    <script src="{{ asset('dist/assets/libs/simple-datatables/umd/simple-datatables.js') }}"></script>
    <script src="{{ asset('dist/assets/js/pages/datatable.init.js') }}"></script>
    <script src="{{ asset('dist/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('dist/assets/js/pages/sweet-alert.init.js') }}"></script>
@endpush
@endsection
