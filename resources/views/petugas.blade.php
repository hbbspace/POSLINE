@extends('petugas.layouts.template')

@section('subtitle', 'Admin')
@section('content_header_title', 'Home')
@section('content_header_subtitle', 'Admin')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                Tampilan Petugas Posyandu
            </div>

            <div class="card-body">
                <h1>Login Sebagai Petugas Posyandu</h1>
                <a href="{{ route('logout') }}">Logout</a>
            </div>
        </div>
    </div>
@endsection
