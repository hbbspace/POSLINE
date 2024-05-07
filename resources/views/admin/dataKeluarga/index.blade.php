@extends('admin.layouts.template')
@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
            <a href="{{ url('admin/dataKeluarga/create') }}" class="btn btn-sm btn-primary mt-1">Tambah</a>
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
                        <select class="form-control" id="no_kk" name="no_kk" required>
                            <option value="">- Semua -</option>
                            @foreach($keluarga as $item)
                                <option value="{{ $item->no_kk }}">{{ $item->no_kk }}</option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">Nomor KK</small>
                    </div>
                </div>
            </div>
        </div>        
        <table class="table table-bordered table-striped table-hover table-sm" id="table_keluarga">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nomor KK</th>
                    <th>Alamat</th>
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
        var dataKeluarga = $('#table_keluarga').DataTable({
            processing: true,
            serverSide : true,
            ajax: {
                "url": "{{ url('admin/dataKeluarga/list') }}",
                "dataType": "json",
                "type": "POST",
                "data": function (d) {
                    d.no_kk = $('#no_kk').val();
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
                    data: "no_kk",
                    className: "",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "alamat",
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
        $('#no_kk').on('change', function() {
            dataKeluarga.ajax.reload();
        });
    });
</script>
@endpush
