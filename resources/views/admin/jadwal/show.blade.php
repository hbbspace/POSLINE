@extends('admin.layouts.template')

@section('subtitle', 'Detail Jadwal Pemeriksaan')
@section('content_header_title', 'Detail Jadwal Pemeriksaan')
@section('content_header_subtitle', '')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools"></div>
    </div>
    <div class="card-body">
        @empty($jadwal_pemeriksaan)
            <div class="alert alert-danger alert-dismissible">
                <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
                Data yang Anda cari tidak ditemukan.
            </div>
        @else
            <table class="table table-bordered table-striped table-hover table-sm">
                <tr>
                    <th>NIK</th>
                    <td>{{ $jadwal_pemeriksaan->pemeriksaan_id }}</td>
                </tr>
                <tr>
                    <th>Nama</th>
                    <td>{{ $jadwal_pemeriksaan->agenda }}</td>
                </tr>
                <tr>
                    <th>Tanggal Lahir</th>
                    <td>{{ $jadwal_pemeriksaan->tanggal}}</td>
                </tr>
            </table>
        @endempty
        <a href="{{ url('admin/jadwal') }}" class="btn btn-sm btn-default mt-2">Kembali</a>
    </div>
</div>
@endsection

@push('css')
@endpush

@push('js')
@endpush
