@extends('petugas.layouts.template')

<div class="table-responsive" style="max-height: 100%; overflow-y: auto;">
@section('content')

<div class="card card-outline card-info">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }} {{ $hasil_pemeriksaan->first()->nama ?? '' }}</h3>
        <div class="card-tools">        
            <a href="{{ url('petugas/historyPemeriksaan') }}" class="btn btn-sm btn-primary">Kembali</a>
        </div>
    </div>
    <div class="table-responsive" style="max-height: 550px; overflow-y: auto;">

            <div class="card-body">
                    @foreach($hasil_pemeriksaan as $pemeriksaan)
                        <table class="table table-bordered table-striped table-hover table-sm mb-4">
                            <tr>
                                <th>ID Pemeriksaan</th>
                                <td>{{ $pemeriksaan->pemeriksaan_id }}</td>
                            </tr>
                            {{-- <tr>
                                <th>Nama Balita</th>
                                <td>{{ $pemeriksaan->nama }}</td>
                            </tr> --}}
                            <tr>
                                <th>Nama Admin</th>
                                <td>{{ $pemeriksaan->nama_admin }}</td>
                            </tr>
                            <tr>
                                <th>Agenda Pemeriksaan</th>
                                <td>{{ $pemeriksaan->agenda }}</td>
                            </tr>
                            <tr>
                                <th>Usia</th>
                                <td>{{ $pemeriksaan->usia }} Bulan</td>
                            </tr>
                            <tr>
                                <th>Tanggal Pemeriksaan</th>
                                <td>{{ $pemeriksaan->tanggal }}</td>
                            </tr>
                            <tr>
                                <th>Tinggi Badan</th>
                                <td>{{ $pemeriksaan->tinggi_badan }} Cm</td>
                            </tr>
                            <tr>
                                <th>Berat Badan</th>
                                <td>{{ $pemeriksaan->berat_badan }} Kg</td>
                            </tr>
                            <tr>
                                <th>Lingkar Kepala</th>
                                <td>{{ $pemeriksaan->lingkar_kepala }} Cm</td>
                            </tr>
                            <tr>
                                <th>Gangguan Kesehatan</th>
                                <td>{{ $pemeriksaan->gangguan_kesehatan }}</td>
                            </tr>
                            <tr>
                                <th>Nafsu Makan</th>
                                <td>{{ $pemeriksaan->nafsu_makan }}</td>
                            </tr>
                            <tr>
                                <th>Catatan</th>
                                <td>{{ $pemeriksaan->catatan }}</td>
                            </tr>
                        </table>
                        <a href="{{ url('petugas/historyPemeriksaan/' . $pemeriksaan->hasil_id . '/edit') }}" class="btn btn-warning btn-sm mx-2">Edit Pemeriksaan</a>
                        <hr> <!-- Pembatas antara hasil pemeriksaan -->
                    @endforeach
        
            
            </div>    </div>
</div>
</div>
@endsection
</div>

@push('css')
@endpush
@push('js')
@endpush
