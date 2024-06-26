@extends('admin.layouts.template')

{{-- Customize layout sections --}}

@section('subtitle', 'Keluarga')
@section('content_header_title', 'Keluarga')
@section('content_header_subtitle', 'Edit')

@section('content')
<div class="table-responsive" style="max-height: 550px; overflow-y: auto;">

    <div class="container">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Edit Data Anggota Keluarga</h3>
            </div>

            <form method="post" action="{{ url('admin/jadwal', $jadwal_pemeriksaan->pemeriksaan_id) }}">
                @csrf
                @method('PUT')

                    <div class="card-body">
                        <div class="form-group">
                            <label for="agenda">agenda</label>
                            <input type="text" class="form-control" id="agenda" name="agenda" value="{{  $jadwal_pemeriksaan->agenda }}">
                        </div>
                        <div class="form-group">
                            <label for="tanggal">tanggal</label>
                            <input type="text" class="form-control" id="tanggal" name="tanggal" value="{{  $jadwal_pemeriksaan->tanggal }}">
                        </div>
                        <div class="form-group">
                            <label for="tempat">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="tempat" name="tempat" value="{{  $jadwal_pemeriksaan->tempat }}">
                        </div>
                        <div class="d-flex justify-content-center mt-2">
                            <button type="submit" class="btn btn-primary mx-2" >Simpan Perubahan</button>
                            <a href="{{ url('admin/jadwal') }}" class="btn btn-secondary mx-2" >Kembali</a>
                        </div>  
                    </div>

            </form>
        </div>
    </div>
</div>
@endsection
