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

                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="tinggi_badan">Tinggi Badan</label>
                            <small style="color: red">Gunakan tanda "." (titik) sebagai nilai koma jika terdapat bilangan desimal</small>
                            <input type="number" class="form-control" id="tinggi_badan" name="tinggi_badan" step="0.01">
                        </div>
                        <div class="form-group">
                            <label for="berat_badan">Berat Badan</label>
                            <small style="color: red">Gunakan tanda "." (titik) sebagai nilai koma jika terdapat bilangan desimal</small>
                            <input type="number" class="form-control" id="berat_badan" name="berat_badan" step="0.01">
                        </div>
                        <div class="form-group">
                            <label for="lingkar_kepala">Lingkar Kepala</label>
                            <small style="color: red">Gunakan tanda "." (titik) sebagai nilai koma jika terdapat bilangan desimal</small>
                            <input type="number" class="form-control" id="lingkar_kepala" name="lingkar_kepala" step="0.01">
                        </div>
                        
                        <div class="form-group">
                            <label for="nilai_kesehatan">Nilai Kesehatan</label>
                            <div>
                                @for ($i = 1; $i <= 5; $i++)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="nilai_kesehatan" id="nilai_kesehatan" value="{{ $i }}">
                                    <label class="form-check-label" for="nilai_kesehatan{{ $i }}">{{ $i }}</label>
                                </div>
                            @endfor
                            
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="catatan">Catatan</label>
                            <input type="text" class="form-control" id="catatan" name="catatan" >
                        </div>
                        <input type="hidden" id="admin_id" name="admin_id" value="{{ Auth::guard('admin')->user()->admin_id }}">                   
                     </div>

                    {{-- <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="tinggi_badan">Tinggi Badan</label>
                                <input type="number" class="form-control" id="tinggi_badan" name="tinggi_badan" value="{{ $hasil_pemeriksaan->tinggi_badan }}">
                            </div>
                            <div class="form-group">
                                <label for="berat_badan">Berat Badan</label>
                                <input type="number" class="form-control" id="berat_badan" name="berat_badan" value="{{ $hasil_pemeriksaan->berat_badan }}">
                            </div>
                            <div class="form-group">
                                <label for="lingkar_kepala">Lingkar Kepala</label>
                                <input type="number" class="form-control" id="lingkar_kepala" name="lingkar_kepala" value="{{ $hasil_pemeriksaan->lingkar_kepala }}">
                            </div>
                            <div class="form-group">
                                <label for="nilai_kesehatan">Nilai Kesehatan</label>
                                <div>
                                    @for ($i = 1; $i <= 5; $i++)
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="nilai_kesehatan" id="nilai_kesehatan{{ $i }}" value="{{ $i }}" {{ $hasil_pemeriksaan->nilai_kesehatan == $i ? 'checked' : '' }}>
                                            <label class="form-check-label" for="nilai_kesehatan{{ $i }}">{{ $i }}</label>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="catatan">Catatan</label>
                                <input type="text" class="form-control" id="catatan" name="catatan" value="{{ $hasil_pemeriksaan->catatan }}">
                            </div>
                        </div> --}}
                        
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                </div>
            </form>
        </div>
    </div>
@endsection
