@extends('petugas.layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $breadcrumb->title }}</h3>
        <div class="card-tools"></div>
    </div>
    <div class="card-body">
        @empty($user)
            <div class="alert alert-danger alert-dismissible">
                <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
                Data yang Anda cari tidak ditemukan.
            </div>
        @else
            <table class="table table-bordered table-striped table-hover">
                <tr>
                    <th>Balita ID</th>
                    <td>{{ $balita->balita_id }}</td>
                </tr>
                <tr>
                    <th>NIK</th>
                    <td>{{ $balita->nik }}</td>
                </tr>
                <tr>
                    <th>Tinggi Badan</th>
                    <td>{{ $balita->tinggi_badan }}</td>
                </tr>
                <tr>
                    <th>Berat Badan</th>
                    <td>{{ $balita->berat_badan }}</td>
                </tr>
                <tr>
                    <th>Lingkar Kepala</th>
                    <td>{{ $balita->lingkar_kepala }}</td>
                </tr>
                
            </table>
        @endempty
        <a href="{{ url('petugas/balita') }}" class="btn btn-sm btn-default mt-2">Kembali</a>
    </div>
</div>
@endsection

@push('css')
@endpush

@push('js')
@endpush
