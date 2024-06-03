@extends('admin.layouts.template')

@section('content')
<div class="table-responsive" style="max-height: 550px; overflow-y: auto;">

<div class="card card-outline card-info">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools"></div>
    </div>
    <div class="card-body">
        @empty($admin)
            <div class="alert alert-danger alert-dismissible">
                <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
                Data yang Anda cari tidak ditemukan.
            </div>
        @else
            <table class="table table-bordered table-striped table-hover table-sm">
                <tr>
                    <th>ID</th>
                    <td>{{ $admin->admin_id }}</td>
                </tr>
                <tr>
                    <th>Username</th>
                    <td>{{ $admin->username }}</td>
                </tr>
                <tr>
                    <th>Password</th>
                    {{-- <td>{{ $admin->password }}</td> --}}
                    <td>****************</td>
                </tr>
                <tr>
                    <th>Nama Admin</th>
                    <td>{{ $admin->nama_admin }}</td>
                </tr>
                <tr>
                    <th>Jenis Kelamin</th>
                    <td>{{ $admin->jk }}</td>
                </tr>
                <tr>
                    <th>Level</th>
                    <td>{{ $admin->level }}</td>
                </tr>
            </table>
        @endempty
        <div class="d-flex justify-content-center mt-3">
            <a href="{{ url('admin/dataAdmin') }}" class="btn btn-primary btn-sm mx-2">Kembali</a>
            @php
                if (Auth::guard('admin')->user()->admin_id == $admin->admin_id) {
            @endphp
                    <a href="{{ url('admin/dataAdmin/' . $admin->admin_id . '/edit') }}" class="btn btn-warning btn-sm mx-2">Edit Profile</a>
            @php
                }
            @endphp
        </div>
        
    </div>
</div>
</div>
@endsection