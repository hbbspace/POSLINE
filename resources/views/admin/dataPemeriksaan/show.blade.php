@extends('admin.layouts.template')

@section('content')
<div class="table-responsive" style="max-height: 550px; overflow-y: auto;">

<div class="card card-outline card-info">
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
                    <th>Pemeriksaan ID</th>
                    <td>{{ $hasil_pemeriksaan->pemeriksaan_id }}</td>
                </tr>
                <tr>
                    <th>NIK</th>
                    <td>{{ $hasil_pemeriksaan->nik }}</td>
                </tr>
                <tr>
                    <th>Nama Balita</th>
                    <td>{{ $hasil_pemeriksaan->nama }}</td>
                </tr>
                <tr>
                    <th>Usia</th>
                    <td>{{ $hasil_pemeriksaan->usia }} Bulan</td>
                </tr>
                <tr>
                    <th>Nama Admin</th>
                    <td>{{ $hasil_pemeriksaan->nama_admin }}</td>
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
                    <th>Gangguan Kesehatan</th>
                    <td>{{ $hasil_pemeriksaan->gangguan_kesehatan }}</td>
                </tr>

                <tr>
                    <th>Stunting</th>
                    <td>{{ $hasil_pemeriksaan->stunting }}</td>
                </tr>
                <tr>
                    <th>Nafsu Makan</th>
                    <td>{{ $hasil_pemeriksaan->nafsu_makan }}</td>
                </tr>                
                <tr>
                    <th>Catatan</th>
                    <td>{{ $hasil_pemeriksaan->catatan }}</td>
                </tr>
            </table>
        @endif
        <div class="d-flex justify-content-center mt-2">
            <a href="{{ url('admin/dataPemeriksaan') }}" class="btn btn-sm btn-primary mt-2">Kembali</a>
        </div>  
    </div>
</div>
</div>
@endsection

@push('css')
@endpush
@push('js')
@endpush
