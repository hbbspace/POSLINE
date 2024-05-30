@extends('admin.layouts.template')

@section('subtitle', 'Keluarga')
@section('content_header_title', 'Keluarga')
@section('content_header_subtitle', 'Create')

@section('content')
    <div class="container">
        <div class="card card-info">
            <div class="card-header">
           <h3 class="card-title">Tambah Data Keluarga</h3>     
            </div>
            <form method="post" action="{{ url('admin/dataKeluarga') }}">
                @csrf <!-- Tambahkan token CSRF di sini -->
                <div class="card-body">
                    <div class="form-group">
                        <label for="no_kk">Nomor Kartu Keluarga</label>
                        <input type="text" class="form-control" id="no_kk" name="no_kk">
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control" id="alamat" name="alamat">
                    </div>
                    <div class="form-group">
                        <label for="pendapatan">Pendapatan</label>
                        <input type="text" class="form-control" id="pendapatan" name="pendapatan" step="0.01">
                    </div>
                    <div class="form-group">
                        <label for="jam_kerja">jam_kerja</label>
                        <input type="text" class="form-control" id="jam_kerja" name="jam_kerja">
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
