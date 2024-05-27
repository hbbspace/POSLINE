@extends('admin.layouts.template')

@section('subtitle', 'Tambah Anggota Keluarga')
@section('content_header_title', 'Tambah Anggota Keluarga')
@section('content_header_subtitle', '')

@section('content')
<div class="container">
    <div class="card card-warning">
        <div class="card-header">
            <h3 class="card-title">Penting !</h3>
        </div>
        <div class="card-body">
            <p>Penambahan data ibu secara otomatis akan membuat akun orang tua dengan username dan password yang sama dengan NIK yang ditambahkan.</p>
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
                    <input type="text" class="form-control" id="nik" name="nik" required>
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
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
