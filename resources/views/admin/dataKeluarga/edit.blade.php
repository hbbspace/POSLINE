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

                <div class="card">
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
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
