@extends('user.layouts.template')

@section('content')
<div class="table-responsive" style="max-height: 620px; overflow-y: auto;">

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
                    <th>NIK</th>
                    <td>{{ $hasil_pemeriksaan->nik }}</td>
                </tr>
                <tr>
                    <th>Nama Balita</th>
                    <td>{{ $hasil_pemeriksaan->nama }}</td>
                </tr>
                <tr>
                    <th>Nama Petugas</th>
                    <td>{{ $hasil_pemeriksaan->nama_admin }}</td>
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
                    <th>Lingkar Badan</th>
                    <td>{{ $hasil_pemeriksaan->lingkar_badan }} Cm</td>
                </tr>
                <tr>
                    <th>Riwayat Penyakit</th>
                    <td>{{ $hasil_pemeriksaan->riwayat_penyakit }}</td>
                </tr>
            </table>
        @endif
        <div class="d-flex justify-content-center mt-2">
            <a href="{{ url('user/dataPemeriksaanBalita') }}" class="btn btn-sm btn-primary mt-2">Kembali</a>
        </div>  
    </div>
</div>
</div>
@endsection

@push('css')
@endpush
@push('js')
@endpush
