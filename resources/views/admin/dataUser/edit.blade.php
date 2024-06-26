@extends('admin.layouts.template')

{{-- Customize layout sections --}}

@section('subtitle', 'User')
@section('content_header_title', 'User')
@section('content_header_subtitle', 'Edit User')

@section('content')
<div class="table-responsive" style="max-height: 550px; overflow-y: auto;">

    <div class="container">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Edit Data User</h3>
            </div>
            <form method="post" action="{{ url('admin/dataUser', $user->user_id) }}">
                @csrf
                @method('PUT')

   
                    <div class="card-body">
                        <div class="form-group">
                            {{-- <label for="nik">NIK</label>
                            <select class="form-control" id="nik" name="nik" required>
                                <option value="">- Pilih NIK -</option>
                                @foreach($nik as $item)
                                    <option value="{{ $item->nik }}">{{ $item->nik }}</option>
                                @endforeach
                            </select>    --}}
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" value="{{ $user->username }}">
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                            <small class="text-muted">Kosongkan jika tidak ingin mengubah password</small>
                        </div>
                        
                                            <div class="d-flex justify-content-center mt-2">
                                                <button type="submit" class="btn btn-primary mx-2" >Simpan Perubahan</button>
                                                <a href="{{ url('admin/dataUser') }}" class="btn btn-secondary mx-2" >Kembali</a>
                                            </div>  
                                        </div>
                    </div>
            </form>
        </div>
    </div>
</div>
@endsection
