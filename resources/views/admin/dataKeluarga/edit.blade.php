@extends('admin.layouts.template')

{{-- Customize layout sections --}}

@section('subtitle', 'Keluarga')
@section('content_header_title', 'Keluarga')
@section('content_header_subtitle', 'Edit')

@section('content')
    <div class="container">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Edit Data Keluarga</h3>
            </div>
            <form method="post" action="{{ url('admin/dataKeluarga', $keluarga->no_kk) }}">
                @csrf
                @method('PUT')

 
                    <div class="card-body">
                        <div class="form-group">
                            <label for="no_kk">Nomor Kartu Keluarga</label>
                            <input type="text" class="form-control" id="no_kk" name="no_kk" value="{{ $keluarga->no_kk }}" disabled>
                            <input type="hidden" name="no_kk" value="{{ $keluarga->no_kk }}">
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $keluarga->alamat }}">
                        </div>
                        <div class="form-group">
                            <label for="pendapatan">Pendapatan</label>
                            <input type="text" class="form-control" id="pendapatan" name="pendapatan" value="{{ $keluarga->pendapatan }}">
                        </div>
                        <div class="form-group">
                            <label for="jam_kerja">Jam Kerja</label>
                            <input type="text" class="form-control" id="jam_kerja" name="jam_kerja" value="{{ $keluarga->jam_kerja }}">
                        </div>
                        <div class="d-flex justify-content-center mt-2">
                            <button type="submit" class="btn btn-primary mx-2" >Simpan Perubahan</button>
                            <a href="{{ url('admin/dataKeluarga') }}" class="btn btn-secondary mx-2" >Kembali</a>
                        </div>  
                    </div>

            </form>
        </div>
    </div>
@endsection
