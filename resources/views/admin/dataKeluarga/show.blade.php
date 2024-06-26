@extends('admin.layouts.template')

@section('content')
<div class="card card-outline card-info">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools"></div>
    </div>
    <div class="card-body">
        @empty($keluarga)
            <div class="alert alert-danger alert-dismissible">
                <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
                Data yang Anda cari tidak ditemukan.
            </div>
        @else
            <table class="table table-bordered table-striped table-hover table-sm">
                <tr>
                    <th>Nomor Kartu Keluarga</th>
                    <td>{{ $keluarga->no_kk }}</td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td>{{ $keluarga->alamat }}</td>
                </tr>
                <tr>
                    <th>Pendapatan</th>
                    <td>Rp.{{ $keluarga->pendapatan }}</td>
                </tr>
                <tr>
                    <th>Jam Kerja</th>
                    <td>{{ $keluarga->jam_kerja }} Jam</td>
                </tr>
            </table>
        @endempty
        <div class="d-flex justify-content-center mt-2">
            <a href="{{ url('admin/dataKeluarga') }}" class="btn btn-sm btn-primary mt-2">Kembali</a>
        </div>  
    </div>
</div>
@endsection

@push('css')
@endpush
@push('js')
@endpush