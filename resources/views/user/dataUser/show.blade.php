@extends('user.layouts.template')

@section('content')
<div class="card card-outline card-info">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools"></div>
    </div>
    <div class="card-body">
        @empty($user)
            <div class="alert alert-danger alert-dismissible">
                <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
                Data yang Anda cari tidak ditemukan.
            </div>
        @else

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
            <table class="table table-bordered table-striped table-hover table-sm">
                <tr>
                    <th>Username</th>
                    <td>{{ $user->username }}</td>
                </tr>
                <tr>
                    <th>Password</th>
                    <td>************</td>
                </tr>
                <tr>
                    <th>Nama user</th>
                    <td>{{ $user->nama }}</td>
                </tr>
                <tr>
                    <th>Jenis Kelamin</th>
                    <td>{{ $user->jk }}</td>
                </tr>
                <tr>
                    <th>Tanggal Lahir</th>
                    <td>{{ $user->tanggal_lahir}}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>{{ $user->status}}</td>
                </tr>
            </table>
        @endempty
        
        <div class="d-flex justify-content-center mt-3">
            <a href="{{ url('user/') }}" class="btn btn-primary btn-sm mx-2">Kembali</a>
            <a href="{{ url('user/dataUser/edit') }}" class="btn btn-warning btn-sm mx-2">Edit Profile</a>
        </div>
    </div>
</div>
@endsection

@push('css')
@endpush
@push('js')
@endpush
