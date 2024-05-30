@extends('petugas.layouts.template')

{{-- Customize layout sections --}}
@section('subtitle', 'Pemeriksaan Balita')
@section('content_header_title', 'Pemeriksaan Balita')
@section('content_header_subtitle', 'Input')

@section('content')
    <div class="container">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Input Pemeriksaan Balita</h3>
            </div>

            <form method="post" action="{{ url('petugas/pemeriksaanBalita', $hasil_pemeriksaan->hasil_id) }}">
                @csrf
                @method('PUT')

                <div class="card-body">
                    <div class="form-group">
                        <label for="tinggi_badan">Tinggi Badan</label>
                        <small style="color: red">Gunakan tanda "." (titik) sebagai nilai koma jika terdapat bilangan desimal</small>
                        <input type="number" class="form-control" id="tinggi_badan" name="tinggi_badan" step="0.01" required>
                    </div>
                    <div class="form-group">
                        <label for="berat_badan">Berat Badan</label>
                        <small style="color: red">Gunakan tanda "." (titik) sebagai nilai koma jika terdapat bilangan desimal</small>
                        <input type="number" class="form-control" id="berat_badan" name="berat_badan" step="0.01" required>
                    </div>
                    <div class="form-group">
                        <label for="lingkar_badan">Lingkar Badan</label>
                        <small style="color: red">Gunakan tanda "." (titik) sebagai nilai koma jika terdapat bilangan desimal</small>
                        <input type="number" class="form-control" id="lingkar_badan" name="lingkar_badan" step="0.01" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="riwayat_penyakit">Nilai Kesehatan</label>
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
                                    <input class="form-check-input" type="radio" name="riwayat_penyakit" id="riwayat_penyakit" value="{{ $value }}" required>
                                    <label class="form-check-label" for="riwayat_penyakit">{{ $label }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="catatan">Catatan</label>
                        <input type="text" class="form-control" id="catatan" name="catatan">
                    </div>
                    <input type="hidden" id="admin_id" name="admin_id" value="{{ Auth::guard('admin')->user()->admin_id }}">                   
                    <input type="hidden" id="usia" name="usia" value="{{ $umur->first()->umur }}">                   
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
