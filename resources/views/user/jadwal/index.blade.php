@extends('user.layouts.template')
@section('content')
<div class="card card-outline card-info">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>

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
                    <th>agenda</th>
                    <th>Tanggal</th>
                    <th>Tempat</th>
                    <th>Keterangan</th>
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
                "url": "{{ url('user/jadwal/list') }}",
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
                    data: "Keterangan",
                    className: "",
                    orderable: false,
                    searchable: false
                }
            ]
        });
        $('#pemeriksaan_id').on('change', function() {
            jadwal.ajax.reload();
        });
    });
</script>
@endpush
