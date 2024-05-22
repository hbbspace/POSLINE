@extends('admin.layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools"></div>
    </div>
    <div class="card-body">
        @if(empty($hasil_pemeriksaan))
            <div class="alert alert-danger alert-dismissible">
                <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
                Data yang Anda cari tidak ditemukan.
            </div>
        @else
            <table class="table table-bordered table-striped table-hover table-sm">
                <tr>
                    <th>ID</th>
                    <td>{{ $hasil_pemeriksaan->hasil_id }}</td>
                </tr>
                <tr>
                    <th>Balita Id</th>
                    <td>{{ $hasil_pemeriksaan->balita_id }}</td>
                </tr>
                <tr>
                    <th>Nama Balita</th>
                    <td>{{ $hasil_pemeriksaan->nama }}</td>
                </tr>
                <tr>
                    <th>Admin ID</th>
                    <td>{{ $hasil_pemeriksaan->admin_id }}</td>
                </tr>
                <tr>
                    <th>Nama Admin</th>
                    <td>{{ $hasil_pemeriksaan->nama_admin }}</td>
                </tr>
                <tr>
                    <th>Pemeriksaan ID</th>
                    <td>{{ $hasil_pemeriksaan->pemeriksaan_id }}</td>
                </tr>
                <tr>
                    <th>Agenda Pemeriksaan</th>
                    <td>{{ $hasil_pemeriksaan->agenda }}</td>
                </tr>
                <tr>
                    <th>Tanggal Pemeriksaan</th>
                    <td>{{ $hasil_pemeriksaan->tanggal }}</td>
                </tr>
                <tr>
                    <th>Tinggi Badan</th>
                    <td>{{ $hasil_pemeriksaan->tinggi_badan }} Cm</td>
                </tr>
                <tr>
                    <th>Berat Badan</th>
                    <td>{{ $hasil_pemeriksaan->berat_badan }} Kg</td>
                </tr>
                <tr>
                    <th>Lingkar Kepala</th>
                    <td>{{ $hasil_pemeriksaan->lingkar_kepala }} Cm</td>
                </tr>
                <tr>
                    <th>Nilai Kesehatan</th>
                    <td>{{ $hasil_pemeriksaan->nilai_kesehatan }}</td>
                </tr>
            </table>
        @endif
        <a href="{{ url('admin/dataPemeriksaan') }}" class="btn btn-sm btn-default mt-2">Kembali</a>
    </div>
</div>
@endsection

@push('css')
@endpush
@push('js')
@endpush
