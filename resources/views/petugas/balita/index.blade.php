@extends('petugas.layouts.template')
@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
            <a href="{{ url('petugas/balita/create') }}" class="btn btn-sm btn-primary mt-1">Tambah</a>
        </div>
    </div>
    <div class="card-body">
        <!-- Tampilkan pesan sukses atau error -->
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>            
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>            
        @endif
        <!-- Tampilkan tabel daftar balita -->
        <table class="table table-bordered table-striped table-hover table-sm" id="table_balita">
            <thead>
                <tr>
                    <th>Balita ID</th>
                    <th>NIK</th>
                    <th>Tinggi Badan</th>
                    <th>Berat Badan</th>
                    <th>Lingkar Kepala</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection

@push('js')
<script>
    $(document).ready(function() {
        var dataBalita = $('#table_balita').DataTable({
            processing: true,
            serverSide : true,
            ajax: {
                "url": "{{ url('petugas/balita/list') }}",
                "dataType": "json",
                "type": "POST",
                "data": function (d) {
                    // Tambahkan kode jika diperlukan
                }
            },
            columns: [
                {
                    data: "balita_id",
                    className: "text-center",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "anggota_keluarga.nik",
                    className: "",
                    orderable: false,
                    searchable: false
                },
                {
                    data: "tinggi_badan",
                    className: "",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "berat_badan",
                    className: "",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "lingkar_kepala",
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
    });
</script>
@endpush
