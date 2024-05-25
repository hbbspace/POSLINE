@extends('admin.layouts.template')

{{-- Customize layout sections --}}

@section('subtitle', 'Keluarga')
@section('content_header_title', 'Keluarga')
@section('content_header_subtitle', 'Edit')

@section('content')
    <div class="container">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Edit Data Anggota Keluarga</h3>
            </div>

            <form method="post" action="{{ url('admin/dataIbu', $anggota_keluarga->nik) }}">
                @csrf
                @method('PUT')

                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nik">NIK</label>
                            <input type="text" class="form-control" id="nik" name="nik" value="{{ $anggota_keluarga->nik }}">
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" value="{{ $anggota_keluarga->nama }}">
                        </div>
                        <div class="form-group">
                            <label for="tanggal_lahir">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="{{ $anggota_keluarga->tanggal_lahir }}">
                        </div>
                        <div class="form-group">
                            <label for="jk">Jenis Kelamin</label>
                            <select class="form-control" id="jk" name="jk">
                                <option value="L" {{ $anggota_keluarga->jk == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="P" {{ $anggota_keluarga->jk == 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status">
                                <option value="ibu" {{ $anggota_keluarga->status == 'ibu' ? 'selected' : '' }}>Ibu</option>
                                <option value="anak" {{ $anggota_keluarga->status == 'anak' ? 'selected' : '' }}>Anak</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="no_kk">Nomor Kartu Keluarga</label>
                            <input type="text" class="form-control" id="no_kk" name="no_kk" value="{{ $anggota_keluarga->no_kk }}">
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
