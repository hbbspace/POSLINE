@extends('user.layouts.template')

@section('content')
<div class="table-responsive" style="max-height: 620px; overflow-y: auto;">
<div class="container">
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
                        <a href="{{ url('user/dataUser') }}" class="btn btn-secondary mx-2" >Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
