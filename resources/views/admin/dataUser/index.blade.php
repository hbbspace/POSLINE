@extends('admin.layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
            <a href="{{ url('admin/dataUser/create') }}" class="btn btn-sm btn-primary mt-1">Tambah</a>
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
                        <select class="form-control" id="user_id" name="user_id" required>
                            <option value="">- Semua -</option>
                            @foreach($user as $item)
                                <option value="{{ $item->user_id }}">{{ $item->user_id }}</option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">user ID</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover table-sm" id="table_user">
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>NIK</th>
                        <th>Username</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    $(document).ready(function() {
        var dataTable = $('#table_user').DataTable({
            processing: true,
            serverSide : true,
            ajax: {
                "url": "{{ url('admin/dataUser/list') }}",
                "dataType": "json",
                "type": "POST",
                "data": function (d) {
                    d.nik = $('#nik').val();
                }
            },
            columns: [
                {
                    data: "user_id",
                    className: "",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "nik",
                    className: "",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "username",
                    className: "",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "action",
                    className: "",
                    orderable: false,
                    searchable: false
                }
            ]
        });
        $('#nik').on('change', function() {
            dataTable.ajax.reload();
        });
    });
</script>
@endpush
