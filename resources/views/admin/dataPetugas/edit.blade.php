@extends('admin.layouts.template')

@section('content')
    <div class="container">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Edit Data Petugas</h3>
            </div>
                    <div class="card-body">
                        <form action="{{ url('admin/dataPetugas', $admin->admin_id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" value="{{ $admin->username }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password">
                                <small class="text-muted">Kosongkan jika tidak ingin mengubah password</small>
                            </div>
                            <div class="mb-3">
                                <label for="nama_admin" class="form-label">Nama Admin</label>
                                <input type="text" class="form-control" id="nama_admin" name="nama_admin" value="{{ $admin->nama_admin }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="jk" class="form-label">Gender</label>
                                <select name="jk" id="jk" class="form-control" required>
                                    <option value="L" {{ $admin->jk == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="P" {{ $admin->jk == 'P' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="level" class="form-label">Level</label>
                                <select name="level" id="level" class="form-control" required>
                                    <option value="1" {{ $admin->level == '1' ? 'selected' : '' }}>Super Admin</option>
                                    <option value="2" {{ $admin->level == '2' ? 'selected' : '' }}>Admin</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </form>
                    </div>
             
           
        </div>
    </div>
@endsection
