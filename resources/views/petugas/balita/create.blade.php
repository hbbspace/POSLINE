@extends('petugas.layouts.template')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Tambah Balita Baru</div>

                <div class="card-body">
                    <form method="POST" action="{{ url('petugas.balita.store') }}">
                        @csrf

                        <div class="form-group">
                            <label for="nik">NIK</label>
                            <input id="nik" type="text" class="form-control" name="nik" required autofocus>
                        </div>

                        <div class="form-group">
                            <label for="tinggi_badan">Tinggi Badan</label>
                            <input id="tinggi_badan" type="text" class="form-control" name="tinggi_badan">
                        </div>

                        <div class="form-group">
                            <label for="berat_badan">Berat Badan</label>
                            <input id="berat_badan" type="text" class="form-control" name="berat_badan">
                        </div>

                        <div class="form-group">
                            <label for="lingkar_kepala">Lingkar Kepala</label>
                            <input id="lingkar_kepala" type="text" class="form-control" name="lingkar_kepala">
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
