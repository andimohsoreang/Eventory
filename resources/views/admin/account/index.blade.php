@extends('layouts.app')
@section('content')
@section('title', 'Manajemen Akun')
@push('links')
    <link href="{{ asset('dist/assets/libs/simple-datatables/style.css') }}" rel="stylesheet" type="text/css" />
    <!-- Sweet Alert -->
    <link href="{{ asset('dist/assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('dist/assets/libs/animate.css/animate.min.css') }}" rel="stylesheet" type="text/css">
@endpush

<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box d-md-flex justify-content-md-between align-items-center">
            <h4 class="page-title">Manajemen Akun</h4>
            <div class="">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="#">Admin</a></li>
                    <li class="breadcrumb-item active">Akun</li>
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
                        <h4 class="card-title">Daftar Akun Pengguna</h4>
                    </div>
                    <div class="col-auto">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModalLarge">
                            Tambah Akun
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
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($accounts as $account)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $account->name }}</td>
                                    <td>{{ $account->email }}</td>
                                    <td>{{ $account->role->name }}</td>
                                    <td>
                                        <button class="btn btn-outline-primary edit-btn" 
                                                data-id="{{ $account->id }}"
                                                data-name="{{ $account->name }}"
                                                data-email="{{ $account->email }}"
                                                data-role="{{ $account->role_id }}">
                                            Edit
                                        </button>
                                        <form action="{{ route('admin.account.destroy', $account->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger delete-btn">Hapus</button>
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
                <h6 class="modal-title m-0" id="myLargeModalLabel">Tambah Akun</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div><!--end modal-header-->
            <div class="modal-body">
                <form id="accountFrm" enctype="multipart/form-data">
                    <div class="mb-3 row">
                        <label for="name" class="col-sm-3 col-form-label text-end">Nama</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" id="name" name="name" placeholder="Masukkan nama">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="email" class="col-sm-3 col-form-label text-end">Email</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="email" id="email" name="email" placeholder="Masukkan email">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="password" class="col-sm-3 col-form-label text-end">Password</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="password" id="password" name="password" placeholder="Masukkan password">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="role_id" class="col-sm-3 col-form-label text-end">Role</label>
                        <div class="col-sm-9">
                            <select class="form-select" id="role_id" name="role_id">
                                <option value="">Pilih Role</option>
                                @foreach($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
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
                <h6 class="modal-title m-0" id="myEditModalLabel">Edit Akun</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div><!--end modal-header-->
            <div class="modal-body">
                <form id="editAccountFrm" enctype="multipart/form-data">
                    <input type="hidden" id="edit_id_account" name="id">
                    <div class="mb-3 row">
                        <label for="edit_name" class="col-sm-3 col-form-label text-end">Nama</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" id="edit_name" name="name" placeholder="Masukkan nama">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="edit_email" class="col-sm-3 col-form-label text-end">Email</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="email" id="edit_email" name="email" placeholder="Masukkan email">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="edit_password" class="col-sm-3 col-form-label text-end">Password <small>(Biarkan kosong jika tidak ingin mengubah)</small></label>
                        <div class="col-sm-9">
                            <input class="form-control" type="password" id="edit_password" name="password" placeholder="Masukkan password baru">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="edit_role_id" class="col-sm-3 col-form-label text-end">Role</label>
                        <div class="col-sm-9">
                            <select class="form-select" id="edit_role_id" name="role_id">
                                <option value="">Pilih Role</option>
                                @foreach($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
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

@push('scripts')
    <!-- Pastikan jQuery ter-load -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <script src="{{ asset('dist/assets/libs/simple-datatables/umd/simple-datatables.js') }}"></script>
    <script src="{{ asset('dist/assets/js/pages/datatable.init.js') }}"></script>

    <script src="{{ asset('dist/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('dist/assets/js/pages/sweet-alert.init.js') }}"></script>

    <script>
        $(document).ready(function() {
            // Tombol Simpan (Store)
            $('#btnSimpan').on('click', function() {
                var data = {
                    name: $('#name').val(),
                    email: $('#email').val(),
                    password: $('#password').val(),
                    role_id: $('#role_id').val(),
                    _token: '{{ csrf_token() }}'
                };

                $.ajax({
                    url: "{{ route('admin.account.store') }}",
                    method: "POST",
                    data: data,
                    success: function(response) {
                        Swal.fire({
                            title: 'Berhasil!',
                            text: 'Akun berhasil ditambahkan',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(function() {
                            location.reload();
                        });
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                        Swal.fire({
                            title: 'Error!',
                            text: xhr.responseJSON.message || 'Terjadi kesalahan',
                            icon: 'error'
                        });
                    }
                });
            });

            // Tombol Update (Update)
            $('#btnUpdate').on('click', function() {
                var id = $('#edit_id_account').val();
                var data = {
                    name: $('#edit_name').val(),
                    email: $('#edit_email').val(),
                    role_id: $('#edit_role_id').val(),
                    _token: '{{ csrf_token() }}',
                    _method: 'PUT'
                };

                // Tambahkan password hanya jika diisi
                if ($('#edit_password').val()) {
                    data.password = $('#edit_password').val();
                }

                // Membuat URL update dari route dengan placeholder
                var updateUrl = "{{ route('admin.account.update', ':id') }}";
                updateUrl = updateUrl.replace(':id', id);

                $.ajax({
                    url: updateUrl,
                    method: "POST", // Menggunakan POST dengan _method override
                    data: data,
                    success: function(response) {
                        Swal.fire({
                            title: 'Berhasil!',
                            text: 'Akun berhasil diupdate',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(function() {
                            location.reload();
                        });
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                        Swal.fire({
                            title: 'Error!',
                            text: xhr.responseJSON.message || 'Terjadi kesalahan',
                            icon: 'error'
                        });
                    }
                });
            });

            // Event tombol Edit: isi data form edit dari data attribute
            $(document).on('click', '.edit-btn', function() {
                var id = $(this).data('id');
                var name = $(this).data('name');
                var email = $(this).data('email');
                var role = $(this).data('role');

                $('#edit_id_account').val(id);
                $('#edit_name').val(name);
                $('#edit_email').val(email);
                $('#edit_role_id').val(role);
                $('#edit_password').val(''); // Reset password field
                $('#editModalLarge').modal('show');
            });

            // Konfirmasi delete
            $(document).on('click', '.delete-btn', function(e) {
                e.preventDefault();
                var form = $(this).closest('form');
                
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Akun akan dihapus permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });

            // Fokus pada input saat modal terbuka
            $('#addModalLarge').on('shown.bs.modal', function() {
                $('#name').focus();
            });

            $('#editModalLarge').on('shown.bs.modal', function() {
                $('#edit_name').focus();
            });
        });
    </script>
@endpush
@endsection
