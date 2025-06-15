@extends('layouts.app')
@section('content')
@section('title', 'Edit Gedung')
@push('links')
    <link href="{{ asset('dist/assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css">
@endpush

<div class="row justify-content-center">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit Gedung</h4>
            </div>
            <div class="card-body">
                <form enctype="multipart/form-data" method="POST" action="{{ route('admin.gedung.update', $gedung->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-3 row">
                        <label for="name" class="col-sm-3 col-form-label text-end">Nama Gedung</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" id="name" name="name" value="{{ old('name', $gedung->name) }}" placeholder="Masukkan nama gedung" onkeyup="createSlug()">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="lokasi" class="col-sm-3 col-form-label text-end">Lokasi</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" id="lokasi" name="lokasi" rows="4" placeholder="Masukkan lokasi gedung">{{ old('lokasi', $gedung->lokasi) }}</textarea>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="slug" class="col-sm-3 col-form-label text-end">Slug</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" id="slug" name="slug" value="{{ old('slug', $gedung->slug) }}" placeholder="slug-gedung" readonly>
                            <small class="form-text text-muted">Slug akan otomatis dibuat dari nama gedung</small>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="parent_id" class="col-sm-3 col-form-label text-end">Parent Gedung</label>
                        <div class="col-sm-9">
                            <select class="form-control select2" id="parent_id" name="parent_id">
                                <option value="">Pilih Parent Gedung</option>
                                @foreach ($parent as $item)
                                    <option value="{{ $item->id }}" {{ $gedung->parent_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="zone_id" class="col-sm-3 col-form-label text-end">Zone Ruckus</label>
                        <div class="col-sm-9">
                            <select class="form-control select2" id="zone_id" name="zone_id">
                                <option value="">Pilih Zone Ruckus</option>
                                @if(isset($zones['list']))
                                    @foreach ($zones['list'] as $zone)
                                        <option value="{{ $zone['id'] }}" {{ $gedung->zone_id == $zone['id'] ? 'selected' : '' }}>{{ $zone['name'] }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="gedung_id" class="col-sm-3 col-form-label text-end">Gedung Ruckus</label>
                        <div class="col-sm-9">
                            <select class="form-control select2" id="gedung_id" name="gedung_id">
                                <option value="">Pilih Gedung Ruckus</option>
                                @if(isset($buildings['list']))
                                    @foreach ($buildings['list'] as $building)
                                        <option value="{{ $building['id'] }}" {{ $gedung->gedung_id == $building['id'] ? 'selected' : '' }}>{{ $building['name'] }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="photo" class="col-sm-3 col-form-label text-end">Foto / Denah</label>
                        <div class="col-sm-9">
                            @if ($gedung->photo)
                                <img src="{{ $gedung->photo_url }}" alt="{{ $gedung->name }}" class="img-fluid rounded mb-2" width="100" height="100">
                            @endif
                            <input type="file" name="photo" id="photo" class="form-control" accept="image/*">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-sm-9 offset-sm-3">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ route('admin.gedung') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="{{ asset('dist/assets/libs/select2/js/select2.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2();
        
        // When zone_id changes, load buildings
        $('#zone_id').on('change', function() {
            var zoneId = $(this).val();
            if (zoneId) {
                $.ajax({
                    url: '/admin/zone/' + zoneId + '/buildings',
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#gedung_id').empty();
                        $('#gedung_id').append('<option value="">Pilih Gedung Ruckus</option>');
                        if (data && data.list) {
                            $.each(data.list, function(key, value) {
                                $('#gedung_id').append('<option value="' + value.id + '">' + value.name + '</option>');
                            });
                        }
                    }
                });
            } else {
                $('#gedung_id').empty();
                $('#gedung_id').append('<option value="">Pilih Gedung Ruckus</option>');
            }
        });
    });
    
    function createSlug() {
        var name = document.getElementById('name').value;
        var slug = name.toLowerCase().replace(/ /g,'-').replace(/[^a-z0-9\-]/g,'');
        document.getElementById('slug').value = slug;
    }
</script>
@endpush
@endsection 