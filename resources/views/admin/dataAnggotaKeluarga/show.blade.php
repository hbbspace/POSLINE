@extends('admin.layouts.template')

@section('subtitle', 'Detail Anggota Keluarga')
@section('content_header_title', 'Detail Anggota Keluarga')
@section('content_header_subtitle', '')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Detail Anggota Keluarga</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <strong>NIK:</strong> {{ $anggota_keluarga->nik }}<br>
                        <strong>Nama:</strong> {{ $anggota_keluarga->nama }}<br>
                        <strong>Tanggal Lahir:</strong> {{ $anggota_keluarga->tanggal_lahir }}<br>
                        <strong>Jenis Kelamin:</strong> {{ $anggota_keluarga->jk }}<br>
                        <strong>Status:</strong> {{ $anggota_keluarga->status }}<br>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
