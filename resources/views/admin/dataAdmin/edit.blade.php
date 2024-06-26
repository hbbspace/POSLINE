@extends('admin.layouts.template')

@section('content')
<div class="table-responsive" style="max-height: 550px; overflow-y: auto;">
    <div class="container">
        
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <span class="">{{ session('success') }}</span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <span class="">{{ session('error') }}</span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Edit Data Admin</h3>
            </div>            
                    <div class="card-body">
                        <form action="{{ url('admin/dataAdmin', $admin->admin_id) }}" method="POST">
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
                                    <option value="1" {{ $admin->level == '1' ? 'selected' : '' }}>Admin</option>
                                    <option value="2" {{ $admin->level == '2' ? 'selected' : '' }}>Super Admin</option>
                                </select>
                            </div>
                            <div class="d-flex justify-content-center mt-2">
                                <button type="submit" class="btn btn-primary mx-2" >Simpan Perubahan</button>
                                <a href="{{ url('admin/dataAdmin') }}" class="btn btn-secondary mx-2" >Kembali</a>
                            </div>                        
                        </form>
                    </div>
             
           
        </div>
    </div>
</div>
@endsection
