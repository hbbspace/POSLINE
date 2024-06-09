@extends('admin.layouts.template')

@section('content')
<div class="table-responsive" style="max-height: 550px; overflow-y: auto;">

<div class="card card-outline card-info">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        {{-- <div class="card-tools">
            <a href="{{ url('admin/dataUser/create') }}" class="btn btn-sm btn-primary mt-1">Tambah</a>
        </div> --}}
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
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Filter :</label>
                    <div class="col-3">
                        <select class="form-control" id="nama" name="nama" required>
                            <option value="">- Semua -</option>
                            @foreach($user as $item)
                                <option value="{{ $item->nama }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">Nama</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover table-sm" id="table_user">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>NIK</th>
                        <th>Username</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
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
                    d.nama = $('#nama').val();
                }
            },
            columns: [
                {
                    data: "nama",
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
        $('#nama').on('change', function() {
            dataTable.ajax.reload();
        });
    });
</script>
@endpush
