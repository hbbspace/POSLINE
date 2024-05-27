@extends('user.layouts.template')
@section('content')
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
                        <select class="form-control" id="nama" name="nama" required>
                            <option value="">- Semua -</option>
                            @foreach($dataBalita as $item)
                                <option value="{{ $item->nama }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">Id Hasil Pemeriksaan</small>
                    </div>
                </div>
            </div>
        </div>
        <table class="table table-bordered table-striped table-hover table-sm" id="table_hasil_pemeriksaan">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Balita</th>
                    <th>NIK</th>
                    <th>No KK</th>
                    <th>Jenis Kelamin</th>
                    <th>Tanggal Lahir</th>
                    <th>Umur (Bulan)</th>
                    {{-- <th>Jumlah Imunisasi</th> --}}
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
        var hasilPemeriksaanBalita = $('#table_hasil_pemeriksaan').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ url('user/dataBalitaUser/list') }}",
                dataType: "json",
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: function (d) {
                    d.nama = $('#nama').val();
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
                { data: "nama", orderable: true, searchable: true },
                { data: "nik", orderable: true, searchable: true },
                { data: "no_kk", orderable: true, searchable: true },
                { data: "jk", orderable: true, searchable: true },
                { data: "tanggal_lahir", orderable: true, searchable: true },
                { data: "usia", orderable: true, searchable: true },
                // { data: "jumlah_pemeriksaan", orderable: true, searchable: true },
                {
                    data: "aksi",
                    orderable: false,
                    searchable: false
                }
            ]
        });
        $('#nama').on('change', function() {
            hasilPemeriksaanBalita.ajax.reload();
        });
    });
</script>
@endpush