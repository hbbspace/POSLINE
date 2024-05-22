@extends('admin.layouts.template')
@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
            <a href="{{ url('admin/jadwal/create') }}" class="btn btn-sm btn-primary mt-1">Tambah</a>
        </div>
    </div>
    <div class="card-body">
        @if(session('succes'))
            <div class="alert alert-succes">{{ session('succes') }}</div>            
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>            
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Filter :</label>
                    <div class="col-3">
                        <select class="form-control" id="pemeriksaan_id" name="pemeriksaan_id" required>
                            <option value="">- Semua -</option>
                            @foreach($jadwal_pemeriksaan as $item)
                                <option value="{{ $item->pemeriksaan_id }}">{{ $item->pemeriksaan_id }}</option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">Pemeriksaan ID</small>
                    </div>
                </div>
            </div>
        </div>        
        <table class="table table-bordered table-striped table-hover table-sm" id="table_jadwal">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Pemeriksaan ID</th>
                    <th>agenda</th>
                    <th>Tanggal</th>
                    <th>Tempat</th>
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
        var jadwal = $('#table_jadwal').DataTable({
            processing: true,
            serverSide : true,
            ajax: {
                "url": "{{ url('admin/jadwal/list') }}",
                "dataType": "json",
                "type": "POST",
                "data": function (d) {
                    d.pemeriksaan_id = $('#pemeriksaan_id').val();
                }
            },
            columns: [
                {
                    data: null,
                    className: "text-center",
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row, meta) {
                        return meta.row + 1; // Nomor indeks baris dimulai dari 0, jadi tambahkan 1
                    }
                },
                {
                    data: "pemeriksaan_id",
                    className: "",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "agenda",
                    className: "",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "tanggal",
                    className: "",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "tempat",
                    className: "",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "aksi",
                    className: "",
                    orderable: true,
                    searchable: true
                }
            ]
        });
        $('#pemeriksaan_id').on('change', function() {
            jadwal.ajax.reload();
        });
    });
</script>
@endpush
