@extends('admin.layouts.template')

@section('subtitle', 'Tambah Anggota Keluarga')
@section('content_header_title', 'Tambah Anggota Keluarga')
@section('content_header_subtitle', '')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Tambah Anggota Keluarga</h3>
            </div>
            <form method="post" action="{{ url('/dataAnggotaKeluarga') }}">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="no_kk">Nomor KK:</label>
                        <input type="text" class="form-control" id="no_kk" name="no_kk" required>
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
                            <option value="ibu">Ibu</option>
                            <option value="anak">Anak</option>
                        </select>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
