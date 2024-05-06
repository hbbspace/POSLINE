@extends('admin.layouts.template')
@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
            <a href="{{ url('dataAdmin/create') }}" class="btn btn-sm btn-primary mt-1">Tambah</a>
        </div>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>            
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>            
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Filter :</label>
                    <div class="col-3">
                        <select class="form-control" id="admin_id" name="admin_id" required>
                            <option value="">- Semua -</option>
                            @foreach($admin as $item)
                                <option value="{{ $item->admin_id }}">{{ $item->username }}</option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">Admin</small>
                    </div>
                </div>
            </div>
        </div>        
        <table class="table table-bordered table-striped table-hover table-sm" id="table_admin">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Nama Admin</th>
                    <th>Jenis Kelamin</th>
                    <th>Level</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection

@push('css')

@endpush

@push('js')
<script>
    $(document).ready(function() {
        var dataAdmin = $('#table_admin').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                "url": "{{ url('dataAdmin/list') }}",
                "dataType": "json",
                "type": "POST",
                "data": function (d) {
                    d.admin_id = $('#admin_id').val();
                }
            },
            columns: [
                {
                    data: "DT_RowIndex",
                    className: "text-center",
                    orderable: false,
                    searchable: false
                },
                {
                    data: "username",
                    className: "",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "password",
                    className: "",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "nama_admin",
                    className: "",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "jenis_kelamin",
                    className: "",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "level",
                    className: "",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "aksi",
                    className: "",
                    orderable: false,
                    searchable: false
                }
            ]
        });
        $('#admin_id').on('change', function() {
            dataAdmin.ajax.reload();
        });
    });
</script>
@endpush
