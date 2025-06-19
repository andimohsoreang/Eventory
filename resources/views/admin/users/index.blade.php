@extends('layouts.app')
@section('content')
@section('title', 'User Management')
@push('links')
    <link href="{{ asset('dist/assets/libs/simple-datatables/style.css') }}" rel="stylesheet" type="text/css" />
    <!-- Sweet Alert -->
    <link href="{{ asset('dist/assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('dist/assets/libs/animate.css/animate.min.css') }}" rel="stylesheet" type="text/css">
@endpush

<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box d-md-flex justify-content-md-between align-items-center">
            <h4 class="page-title">User Management</h4>
            <div class="">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="#">Admin</a></li>
                    <li class="breadcrumb-item active">Users</li>
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
                        <h4 class="card-title">User List</h4>
                    </div>
                    <div class="col-auto">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#addModalLarge">
                            Add User
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
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role->name }}</td>
                                    <td>
                                        <button class="btn btn-outline-primary edit-btn" 
                                                data-id="{{ $user->id }}"
                                                data-name="{{ $user->name }}"
                                                data-email="{{ $user->email }}"
                                                data-role="{{ $user->role_id }}">
                                            Edit
                                        </button>
                                        <button type="button" class="btn btn-outline-danger delete-btn"
                                                data-id="{{ $user->id }}"
                                                data-name="{{ $user->name }}">
                                            Delete
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
                <h6 class="modal-title m-0" id="myLargeModalLabel">Add New User</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="userFrm" enctype="multipart/form-data">
                    <div class="mb-3 row">
                        <label for="user_name" class="col-sm-3 col-form-label text-end">Name</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" id="user_name" name="name" placeholder="Enter user name">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="user_email" class="col-sm-3 col-form-label text-end">Email</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="email" id="user_email" name="email" placeholder="Enter email address">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="user_password" class="col-sm-3 col-form-label text-end">Password</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="password" id="user_password" name="password" placeholder="Enter password">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="user_role" class="col-sm-3 col-form-label text-end">Role</label>
                        <div class="col-sm-9">
                            <select class="form-select" id="user_role" name="role_id">
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="btnSimpan">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade bd-example-modal-lg" id="editModalLarge" tabindex="-1" role="dialog"
    aria-labelledby="myEditModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title m-0" id="myEditModalLabel">Edit User</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editUserFrm" enctype="multipart/form-data">
                    <input type="hidden" id="edit_id_user" name="id">
                    <div class="mb-3 row">
                        <label for="edit_user_name" class="col-sm-3 col-form-label text-end">Name</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" id="edit_user_name" name="name" placeholder="Enter user name">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="edit_user_email" class="col-sm-3 col-form-label text-end">Email</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="email" id="edit_user_email" name="email" placeholder="Enter email address">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="edit_user_password" class="col-sm-3 col-form-label text-end">Password</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="password" id="edit_user_password" name="password" placeholder="Leave blank to keep current password">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="edit_user_role" class="col-sm-3 col-form-label text-end">Role</label>
                        <div class="col-sm-9">
                            <select class="form-select" id="edit_user_role" name="role_id">
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="btnUpdate">Update</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <!-- jQuery -->
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

            // Save Button (Store)
            $('#btnSimpan').on('click', function() {
                var data = {
                    name: $('#user_name').val(),
                    email: $('#user_email').val(),
                    password: $('#user_password').val(),
                    role_id: $('#user_role').val(),
                    _token: '{{ csrf_token() }}'
                };

                $.ajax({
                    url: "{{ route('admin.users.store') }}",
                    method: "POST",
                    data: data,
                    success: function(response) {
                        Swal.fire({
                            title: 'Success!',
                            text: response.message || 'User has been created successfully',
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
                                title: 'Validation Error!',
                                html: formatValidationErrors(errors),
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        } else {
                            // Other errors
                            Swal.fire({
                                title: 'Error!',
                                text: xhr.responseJSON.message || 'An error occurred',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        }
                    }
                });
            });

            // Update Button
            $('#btnUpdate').on('click', function() {
                var id = $('#edit_id_user').val();
                var data = {
                    name: $('#edit_user_name').val(),
                    email: $('#edit_user_email').val(),
                    role_id: $('#edit_user_role').val(),
                    _token: '{{ csrf_token() }}',
                    _method: 'PUT'
                };

                // Only include password if it's not empty
                if ($('#edit_user_password').val()) {
                    data.password = $('#edit_user_password').val();
                }

                var updateUrl = "{{ route('admin.users.update', ':id') }}";
                updateUrl = updateUrl.replace(':id', id);

                $.ajax({
                    url: updateUrl,
                    method: "POST",
                    data: data,
                    success: function(response) {
                        Swal.fire({
                            title: 'Success!',
                            text: response.message || 'User has been updated successfully',
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
                                title: 'Validation Error!',
                                html: formatValidationErrors(errors),
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        } else {
                            // Other errors
                            Swal.fire({
                                title: 'Error!',
                                text: xhr.responseJSON.message || 'An error occurred',
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
                var email = $(this).data('email');
                var role = $(this).data('role');

                $('#edit_id_user').val(id);
                $('#edit_user_name').val(name);
                $('#edit_user_email').val(email);
                $('#edit_user_role').val(role);
                $('#editModalLarge').modal('show');
            });

            // Focus input on modal show
            $('#addModalLarge').on('shown.bs.modal', function() {
                $('#user_name').focus();
            });

            $('#editModalLarge').on('shown.bs.modal', function() {
                $('#edit_user_name').focus();
            });

            // Delete button click handler
            $(document).on('click', '.delete-btn', function() {
                var userId = $(this).data('id');
                var userName = $(this).data('name');
                
                Swal.fire({
                    title: 'Are you sure?',
                    html: `You are about to delete user: <b>${userName}</b>`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('admin.users.destroy', ':id') }}".replace(':id', userId),
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                _method: 'DELETE'
                            },
                            success: function(response) {
                                Swal.fire({
                                    title: 'Deleted!',
                                    text: 'User has been deleted successfully.',
                                    icon: 'success',
                                    confirmButtonText: 'OK'
                                }).then((result) => {
                                    location.reload();
                                });
                            },
                            error: function(xhr) {
                                let errorMessage = 'Failed to delete user.';
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
        });
    </script>
@endpush
@endsection 