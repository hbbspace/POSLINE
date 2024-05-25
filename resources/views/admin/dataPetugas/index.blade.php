@extends('admin.layouts.template')
@section('content')
<div class="card card-outline card-info">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
            <a href="{{ url('admin/dataPetugas/create') }}" class="btn btn-sm btn-primary mt-1">Tambah</a>
        </div>
    </div>
    <div class="card-body">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <span class="">{{ session('success') }}</span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <span class="">{{ session('error') }}</span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
        <div class="row">
            <div class="col-md-12">
                {{-- <div class="form-group row">
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
                </div> --}}
            </div>
        </div>
        <table class="table table-bordered table-striped table-hover table-sm" id="table_petugas">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
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
        var tableAdmin = $('#table_petugas').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                "url": "{{ url('admin/dataPetugas/list') }}", // Menggunakan route dengan nama
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
                    data: "nama_admin",
                    className: "",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "jk",
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
            tableAdmin.ajax.reload();
        });
    });
</script>
@endpush
