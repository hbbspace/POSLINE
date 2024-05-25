@extends('admin.layouts.template')

@section('subtitle', 'Tambah Anggota Keluarga')
@section('content_header_title', 'Tambah Anggota Keluarga')
@section('content_header_subtitle', '')

@section('content')
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
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
