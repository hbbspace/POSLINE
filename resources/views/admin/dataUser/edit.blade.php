@extends('admin.layouts.template')

{{-- Customize layout sections --}}

@section('subtitle', 'User')
@section('content_header_title', 'User')
@section('content_header_subtitle', 'Edit User')

@section('content')
    <div class="container">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Edit Data User</h3>
            </div>
            <form method="post" action="{{ url('admin/dataUser', $user->user_id) }}">
                @csrf
                @method('PUT')

                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nik">NIK</label>
                            <select class="form-control" id="nik" name="nik" required>
                                <option value="">- Pilih NIK -</option>
                                @foreach($nik as $item)
                                    <option value="{{ $item->nik }}">{{ $item->nik }}</option>
                                @endforeach
                            </select>   
                        </div>
                        <div class="form-group">
                            <label for="usename">Username</label>
                            <input type="text" class="form-control" id="usename" name="usename" value="{{ $user->username }}">
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                            <small class="text-muted">Kosongkan jika tidak ingin mengubah password</small>
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
