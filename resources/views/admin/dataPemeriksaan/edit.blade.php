@extends('admin.layouts.template')

{{-- Customize layout sections --}}
@section('subtitle', 'Pemeriksaan Balita')
@section('content_header_title', 'Pemeriksaan Balita')
@section('content_header_subtitle', 'Input')

@section('content')
<div class="table-responsive" style="max-height: 550px; overflow-y: auto;">

    <div class="container">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Edit Pemeriksaan Balita</h3>
            </div>

            <form method="post" action="{{ url('admin/dataPemeriksaan', $hasil_pemeriksaan->hasil_id) }}">
                @csrf
                @method('PUT')

                    <div class="card-body">
                        <div class="form-group">
                            <label for="tinggi_badan">Tinggi Badan</label>
                            <input type="number" class="form-control" id="tinggi_badan" name="tinggi_badan" step="0.01" value="{{ $hasil_pemeriksaan->tinggi_badan }}">
                        </div>
                        <div class="form-group">
                            <label for="berat_badan">Berat Badan</label>
                            <input type="number" class="form-control" id="berat_badan" name="berat_badan" step="0.01" value="{{ $hasil_pemeriksaan->berat_badan }}">
                        </div>
                        <div class="form-group">
                            <label for="lingkar_badan">Lingkar Badan</label>
                            <input type="number" class="form-control" id="lingkar_badan" name="lingkar_badan" step="0.01" value="{{ $hasil_pemeriksaan->lingkar_badan }}">
                        </div>
                        <div class="form-group">
                            <label for="riwayat_penyakit">Riwayat Penyakit</label>
                            <div>
                                @php
                                    $options = [
                                        'Tidak ada' => 'Tidak ada',
                                        'Ringan' => 'Ringan',
                                        'Berat' => 'Berat'
                                    ];
                                @endphp

                                @foreach ($options as $value => $label)
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="riwayat_penyakit" id="riwayat_penyakit_{{ $value }}" value="{{ $value }}" {{ $hasil_pemeriksaan->riwayat_penyakit == $value ? 'checked' : '' }}>
                                        <label class="form-check-label" for="riwayat_penyakit_{{ $value }}">{{ $label }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="catatan">Catatan</label>
                            <input type="text" class="form-control" id="catatan" name="catatan" value="{{ $hasil_pemeriksaan->catatan }}">
                        </div>
                        <input type="hidden" id="admin_id" name="admin_id" value="{{ Auth::guard('admin')->user()->admin_id }}">
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ url('admin/dataPemeriksaan') }}" class="btn btn-secondary ml-2">Kembali</a>
                        </div> 
                    </div>
                
            </form>
        </div>
    </div>
</div>
@endsection
