@extends('admin.layouts.template')

@section('subtitle', 'Tambah Anggota Keluarga')
@section('content_header_title', 'Tambah Anggota Keluarga')
@section('content_header_subtitle', '')

@section('content')
    <div class="container">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Tambah Jadwal Baru</h3>
            </div>
            <form method="post" action="{{ url('/admin/jadwal') }}">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="nama">Agenda:</label>
                        <input type="text" class="form-control" id="agenda" name="agenda" required>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_lahir">Tanggal:</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                    </div>
                    <div class="form-group">
                        <label for="status">Tempat:</label>
                        <select class="form-control" id="tempat" name="tempat" required>
                            <option value="Puskesmas RW 4 Lowokwaru">Puskesmas RW 4 Lowokwaru</option>
                        </select>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
