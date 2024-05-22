@extends('admin.layouts.template')

@section('subtitle', 'Keluarga')
@section('content_header_title', 'Keluarga')
@section('content_header_subtitle', 'Create')

@section('content')
    <div class="container">
        <div class="card card-primary">
            <div class="card-header">
           <h3 class="card-title">Tambah Data Keluarga</h3>     
            </div>
            <form method="post" action="{{ url('admin/dataKeluarga') }}">
                @csrf <!-- Tambahkan token CSRF di sini -->
                <div class="card-body">
                    <div class="form-group">
                        <label for="no_kk">Nomor Kartu Keluarga</label>
                        <input type="text" class="form-control" id="no_kk" name="no_kk">
                        @error('no_kk')
                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control" id="alamat" name="alamat">
                        @error('no_kk')
                            <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
   
            </form>
        </div>
    </div>
@endsection
