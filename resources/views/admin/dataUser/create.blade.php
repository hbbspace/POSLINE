@extends('admin.layouts.template')

@section('subtitle', 'Tambah Anggota Keluarga')
@section('content_header_title', 'Tambah Anggota Keluarga')
@section('content_header_subtitle', '')

@section('content')
<div class="table-responsive" style="max-height: 550px; overflow-y: auto;">

    <div class="container">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Tambah User Baru</h3>
            </div>
            <form method="post" action="{{ url('admin/dataUser') }}">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="no_kk">NIK:</label>
                        <select class="form-control" id="nik" name="nik" required>
                            <option value="">- Pilih NIK -</option>
                            @foreach($nik as $item)
                                <option value="{{ $item->nik }}">{{ $item->nik }}</option>
                            @endforeach
                        </select>                    
                    </div>
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" class="form-control" name="username" id="username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="text" class="form-control" id="password" name="password" required>
                    </div>
                </div>
                        
                <div class="d-flex justify-content-center mt-2">
                    <button type="submit" class="btn btn-primary mx-2" >Tambah</button>
                    <a href="{{ url('admin/dataUser') }}" class="btn btn-secondary mx-2" >Kembali</a>
                </div>  
            </form>
        </div>
    </div>
</div>
@endsection
