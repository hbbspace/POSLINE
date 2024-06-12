@extends('admin.layouts.template')

{{-- Customize layout sections --}}

@section('subtitle', 'Anak')
@section('content_header_title', 'Anak')
@section('content_header_subtitle', 'Edit')

@section('content')
<div class="table-responsive" style="max-height: 550px; overflow-y: auto;">

    <div class="container">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Edit Data Anak</h3>
            </div>

            <form method="post" action="{{ url('admin/dataAnak', $anggota_keluarga->nik) }}">
                @csrf
                @method('PUT')

                    <div class="card-body">
                        <div class="mb-3">
                            <label for="nik">NIK</label>
                            <input type="text" class="form-control" id="nik" name="nik"maxlength="16" value="{{ $anggota_keluarga->nik }}" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" value="{{ $anggota_keluarga->nama }}">
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_lahir">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="{{ $anggota_keluarga->tanggal_lahir }}">
                        </div>
                        <div class="mb-3">
                            <label for="jk">Jenis Kelamin</label>
                            <select class="form-control" id="jk" name="jk">
                                <option value="L" {{ $anggota_keluarga->jk == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="P" {{ $anggota_keluarga->jk == 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status">
                                <option value="anak" {{ $anggota_keluarga->status == 'anak' ? 'selected' : '' }}>Anak</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="no_kk">Nomor KK:</label>
                            <select class="form-control" id="no_kk" name="no_kk" required>
                                <option value="{{ $anggota_keluarga->no_kk }}">{{ $anggota_keluarga->no_kk }}</option>
                                @foreach($kk as $item)
                                    <option value="{{ $item->no_kk }}" {{ $item->no_kk == $anggota_keluarga->no_kk ? 'selected' : '' }}>{{ $item->no_kk }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="d-flex justify-content-center mt-2">
                            <button type="submit" class="btn btn-primary mx-2" >Simpan Perubahan</button>
                            <a href="{{ url('admin/dataAnak') }}" class="btn btn-secondary mx-2" >Kembali</a>
                        </div>  
                    </div>
            </form>
        </div>
    </div>
</div>
@endsection
