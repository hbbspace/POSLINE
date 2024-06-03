@extends('admin.layouts.template')

@section('subtitle', 'Tambah Anggota Keluarga')
@section('content_header_title', 'Tambah Anggota Keluarga')
@section('content_header_subtitle', '')

@section('content')
<div class="table-responsive" style="max-height: 550px; overflow-y: auto;">

<div class="container">
    <div class="card card-warning">
        <div class="card-header">
            <h3 class="card-title">Penting !</h3>
        </div>
        <div class="card-body">
            <p>Penambahan data orang tua secara otomatis akan membuat akun orang tua dengan username dan password yang sama dengan NIK yang ditambahkan.</p>
            <p style="color: red;">Pastikan Anda mengisi data dengan benar</p>
        </div>
    </div>
</div>
<div class="container mt-3">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Tambah Anggota Keluarga</h3>
        </div>
        <form method="POST" action="{{ url('admin/dataIbu') }}">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="no_kk">Nomor KK:</label>
                    <select class="form-control" id="no_kk" name="no_kk" required>
                        <option value="">- Pilih Nomor KK -</option>
                        @foreach($kk as $item)
                            <option value="{{ $item->no_kk }}">{{ $item->no_kk }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="nik">NIK:</label>
                    <input type="text" class="form-control" id="nik" name="nik" maxlength="16"required>
                </div>
                <div class="form-group">
                    <label for="nama">Nama:</label>
                    <input type="text" class="form-control" id="nama" name="nama" required>
                </div>
                <div class="form-group">
                    <label for="tanggal_lahir">Tanggal Lahir:</label>
                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
                </div>
                <div class="form-group">
                    <label for="jk">Jenis Kelamin:</label>
                    <select class="form-control" id="jk" name="jk" required>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="status">Status:</label>
                    <select class="form-control" id="status" name="status" required>
                        <option value="Ibu">Ibu</option>
                    </select>
                </div>
                <div class="d-flex justify-content-center mt-2">
                    <button type="submit" class="btn btn-primary mx-2" >Tambah</button>
                    <a href="{{ url('admin/dataIbu') }}" class="btn btn-secondary mx-2" >Kembali</a>
                </div>  
            </div>
        </form>
    </div>
</div>
</div>
@endsection
