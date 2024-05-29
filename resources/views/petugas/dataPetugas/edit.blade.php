@extends('petugas.layouts.template')

@section('content')
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <span>{{ session('success') }}</span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <span>{{ session('error') }}</span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
    <div class="container">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Edit Data Profile</h3>
            </div>            
            <div class="card-body">
                <form action="{{ url('petugas/dataPetugas', Auth::guard('admin')->user()->admin_id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" value="{{ old('username', $admin->username) }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                        <small class="text-muted">Kosongkan jika tidak ingin mengubah password</small>
                    </div>
                    <div class="mb-3">
                        <label for="nama_admin" class="form-label">Nama Admin</label>
                        <input type="text" class="form-control" id="nama_admin" name="nama_admin" value="{{ old('nama_admin', $admin->nama_admin) }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="jk" class="form-label">Gender</label>
                        <select name="jk" id="jk" class="form-control" required>
                            <option value="L" {{ old('jk', $admin->jk) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ old('jk', $admin->jk) == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        <a href="{{url('petugas/dataPetugas')}}">
                            <button type="button" class="btn btn-secondary">Kembali</button>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
