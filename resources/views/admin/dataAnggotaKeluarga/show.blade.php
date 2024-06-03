@extends('admin.layouts.template')

@section('subtitle', 'Detail Anggota Keluarga')
@section('content_header_title', 'Detail Anggota Keluarga')
@section('content_header_subtitle', '')

@section('content')
<div class="table-responsive" style="max-height: 550px; overflow-y: auto;">

<div class="card card-outline card-info">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools"></div>
    </div>
    <div class="card-body">
        @empty($anggota_keluarga)
            <div class="alert alert-danger alert-dismissible">
                <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
                Data yang Anda cari tidak ditemukan.
            </div>
        @else
            <table class="table table-bordered table-striped table-hover table-sm">
                <tr>
                    <th>NIK</th>
                    <td>{{ $anggota_keluarga->nik }}</td>
                </tr>
                <tr>
                    <th>Nama</th>
                    <td>{{ $anggota_keluarga->nama }}</td>
                </tr>
                <tr>
                    <th>Tanggal Lahir</th>
                    <td>{{ $anggota_keluarga->tanggal_lahir }}</td>
                </tr>
                <tr>
                    <th>Jenis Kelamin</th>
                    <td>{{ $anggota_keluarga->jk }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>{{ $anggota_keluarga->status }}</td>
                </tr>
            </table>
        @endempty
        <a href="{{ url('admin/dataIbu') }}" class="btn btn-sm btn-primary mt-2">Kembali</a>
    </div>
</div>
</div>
@endsection

@push('css')
@endpush

@push('js')
@endpush
