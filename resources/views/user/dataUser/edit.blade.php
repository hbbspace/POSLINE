@extends('user.layouts.template')

@section('content')
    <div class="container">
        <div class="card card-info">
            
            <div class="card-header">
                <h3 class="card-title">Edit Data Profile</h3>
            </div>

            <div class="card-body">
                <form action="{{ url('user/dataUser', Auth::guard('user')->user()->user_id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" value="{{ $user->username }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                        <small class="text-muted">Kosongkan jika tidak ingin mengubah password</small>
                    </div>
                    {{-- <div class="mb-3">
                        <label for="nama" class="form-label">Nama user</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="{{ $user->nama }}" required>
                    </div> --}}
                    <div class="d-flex justify-content-center mt-2">
                        <button type="submit" class="btn btn-primary mx-2" >Simpan Perubahan</button>
                        <a href="{{ url('user/dataUser') }}" class="btn btn-warning mx-2" >Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
