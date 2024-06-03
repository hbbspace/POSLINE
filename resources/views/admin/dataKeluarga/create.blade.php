@extends('admin.layouts.template')

@section('subtitle', 'Keluarga')
@section('content_header_title', 'Keluarga')
@section('content_header_subtitle', 'Create')

@section('content')
<div class="table-responsive" style="max-height: 550px; overflow-y: auto;">

    <div class="container">
        <div class="card card-info">
            <div class="card-header">
           <h3 class="card-title">Tambah Data Keluarga</h3>     
            </div>
            <form method="post" action="{{ url('admin/dataKeluarga') }}">
                @csrf <!-- Tambahkan token CSRF di sini -->
                <div class="card-body">
                    <div class="form-group">
                        <label for="no_kk">Nomor Kartu Keluarga</label>
                        <input type="text" class="form-control" id="no_kk" name="no_kk" maxlength="16">
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control" id="alamat" name="alamat">
                    </div>
                    <div class="form-group">
                        <label for="pendapatan">Pendapatan</label>
                        <input type="text" class="form-control" id="pendapatan" name="pendapatan" step="0.01">
                    </div>
                    <div class="form-group">
                        <label for="jam_kerja">Jam Kerja</label>
                        <input type="number" class="form-control" id="jam_kerja" name="jam_kerja" min="0" max="24" oninput="validateInput(this)">
                    </div>
                    
                        <div class="d-flex justify-content-center mt-2">
                            <button type="submit" class="btn btn-primary mx-2" >Simpan Perubahan</button>
                            <a href="{{ url('admin/dataKeluarga') }}" class="btn btn-secondary mx-2" >Kembali</a>
                        </div>  
                </div>
   
            </form>
        </div>
    </div>
</div>
@endsection
<script>
    function validateInput(input) {
        // Ensure the value is between 0 and 24
        if (input.value < 0) input.value = 0;
        if (input.value > 24) input.value = 24;
    }
</script>
