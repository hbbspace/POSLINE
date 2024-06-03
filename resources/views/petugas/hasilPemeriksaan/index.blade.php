@extends('petugas.layouts.template')
@section('content')
<div class="table-responsive" style="max-height: 550px; overflow-y: auto;">

<div class="card card-outline card-info">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        {{-- <div class="card-tools">
            <a href="{{ url('admin/jadwal/create') }}" class="btn btn-sm btn-primary mt-1">Tambah</a>
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
                        <select class="form-control" id="tanggal" name="tanggal" required>
                            <option value="">- Semua -</option>
                            @foreach($hasil_pemeriksaan as $item)
                                <option value="{{ $item->tanggal }}">{{ $item->tanggal }}</option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">Tanggal</small>
                    </div>
                </div>
            </div>
        </div>
        <table class="table table-bordered table-striped table-hover table-sm" id="table_hasil_pemeriksaan">
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID Pemeriksaan</th>
                    <th>Nama Balita</th>
                    <th>Nama Admin</th>
                    <th>Tanggal Pemeriksaan</th>
                    <th>Catatan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
</div>
@endsection

@push('css')

@endpush

@push('js')
<script>
    $(document).ready(function() {
        var hasilPemeriksaanBalita = $('#table_hasil_pemeriksaan').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ url('petugas/historyPemeriksaan/list') }}",
                dataType: "json",
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: function (d) {
                    d.tanggal = $('#tanggal').val();
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
                { data: "pemeriksaan_id", orderable: true, searchable: true },
                { data: "nama", orderable: true, searchable: true },
                { data: "nama_admin", orderable: true, searchable: true },
                { data: "tanggal", orderable: true, searchable: true },
                { data: "catatan", orderable: true, searchable: true },
                {
                    data: "aksi",
                    orderable: false,
                    searchable: false
                }
            ]
        });
        $('#tanggal').on('change', function() {
            hasilPemeriksaanBalita.ajax.reload();
        });
    });
</script>
@endpush