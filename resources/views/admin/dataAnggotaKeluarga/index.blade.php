@extends('admin.layouts.template')

@section('subtitle', 'Daftar Anggota Keluarga')
@section('content_header_title', 'Daftar Anggota Keluarga')
@section('content_header_subtitle', '')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">Daftar Anggota Keluarga</h3>
            <div class="card-tools">
                <a href="{{ url('/dataAnggotaKeluarga/create') }}" class="btn btn-sm btn-primary mt-1">Tambah Anggota Keluarga</a>
            </div>
        </div>
        <div class="card-body">
            <!-- Filter -->
            <form action="{{ url('admin.dataAnggotaKeluarga.index') }}" method="GET" class="mb-3">
                <div class="form-row align-items-center">
                    <div class="col-auto">
                        <label class="sr-only" for="filter_no_kk">Nomor KK</label>
                        <input type="text" class="form-control mb-2" id="filter_no_kk" name="no_kk" placeholder="Filter Nomor KK">
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary mb-2">Filter</button>
                    </div>
                </div>
            </form>

            <!-- Tabel untuk menampilkan daftar anggota keluarga -->
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nomor KK</th>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Tanggal Lahir</th>
                        <th>Jenis Kelamin</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Isi tabel dengan data anggota keluarga -->
                    @foreach($anggota_keluarga as $index => $anggota)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $anggota->no_kk }}</td>
                        <td>{{ $anggota->nik }}</td>
                        <td>{{ $anggota->nama }}</td>
                        <td>{{ $anggota->tanggal_lahir }}</td>
                        <td>{{ $anggota->jk }}</td>
                        <td>{{ $anggota->status }}</td>
                        <td>
                            <a href="{{ route('admin.dataAnggotaKeluarga.show', $anggota->nik) }}" class="btn btn-info btn-sm">Detail</a>
                            <a href="{{ route('admin.dataAnggotaKeluarga.edit', $anggota->nik) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form class="d-inline-block" method="POST" action="{{ route('admin.dataAnggotaKeluarga.destroy', $anggota->nik) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin menghapus data ini?');">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
