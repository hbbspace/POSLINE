@extends('user.layouts.template')

@section('content')
<div class="table-responsive" style="max-height: 620px; overflow-y: auto;">

<div class="card card-outline card-info">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#infoPenyakitModal">
                <h5>Info Penyakit</h5>
              
            </button>
        </div> 
    </div>
    <div class="card-body">
        @if(empty($hasil_pemeriksaan))
            <div class="alert alert-danger alert-dismissible">
                <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
                Data yang Anda cari tidak ditemukan.
            </div>
        @else
            <table class="table table-bordered table-striped table-hover table-sm">
                <tr>
                    <th>NIK</th>
                    <td>{{ $hasil_pemeriksaan->nik }}</td>
                </tr>
                <tr>
                    <th>Nama Balita</th>
                    <td>{{ $hasil_pemeriksaan->nama }}</td>
                </tr>
                <tr>
                    <th>Usia</th>
                    <td>{{ $hasil_pemeriksaan->usia }} Bulan</td>
                </tr>
                <tr>
                    <th>Nama Petugas</th>
                    <td>{{ $hasil_pemeriksaan->nama_admin }}</td>
                </tr>
                <tr>
                    <th>Agenda Pemeriksaan</th>
                    <td>{{ $hasil_pemeriksaan->agenda }}</td>
                </tr>
                <tr>
                    <th>Tanggal Pemeriksaan</th>
                    <td>{{ $hasil_pemeriksaan->tanggal }}</td>
                </tr>
                <tr>
                    <th>Tinggi Badan</th>
                    <td>{{ $hasil_pemeriksaan->tinggi_badan }} Cm</td>
                </tr>
                <tr>
                    <th>Berat Badan</th>
                    <td>{{ $hasil_pemeriksaan->berat_badan }} Kg</td>
                </tr>
                <tr>
                    <th>Lingkar Kepala</th>
                    <td>{{ $hasil_pemeriksaan->lingkar_kepala }} Cm</td>
                </tr>
                <tr>
                    <th>Nafsu Makan</th>
                    <td>{{ $hasil_pemeriksaan->nafsu_makan }}</td>
                </tr>
                <tr>
                    <th>Gangguan Keehatan</th>
                    <td>{{ $hasil_pemeriksaan->gangguan_kesehatan }}</td>
                </tr>
                <tr>
                    <th>Catatan</th>
                    <td>{{ $hasil_pemeriksaan->catatan }}</td>
                </tr>
            </table>
        @endif
        <div class="d-flex justify-content-center mt-2">
            <a href="{{ url('user/dataPemeriksaanBalita') }}" class="btn btn-sm btn-primary mt-2">Kembali</a>
        </div>  
    </div>
</div>
</div>
<!-- Modal -->
<div class="modal fade" id="infoPenyakitModal" tabindex="-1" role="dialog" aria-labelledby="infoPenyakitModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="infoPenyakitModalLabel">Informasi Penyakit Umum pada Balita</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <ul>
            <li><strong style="color: green;">Penyakit Ringan:</strong></li>
            <ul>
              <li>Batuk dan Pilek</li>
              <li>Diare Ringan</li>
              <li>Demam Ringan</li>
              <li>Ruam Kulit</li>
              <li>Cacingan</li>
            </ul>
            <li><strong style="color: orange;">Penyakit Sedang:</strong></li>
            <ul>
              <li>Asma Sedang</li>
              <li>Diare dengan Dehidrasi Ringan</li>
              <li>Demam Tinggi </li>
              <li>Batuk atau Pilek Berkepanjangan </li>
              <li>Bronkitis</li>
              <li>Infeksi Saluran Kemih (ISK)</li>
            </ul>
            <li><strong style="color: red;">Penyakit Berat:</strong></li>
            <ul>
              <li>Pneumonia</li>
              <li>Diare Berat dengan Dehidrasi</li>
              <li>Demam Berdarah Dengue</li>
              <li>Meningitis</li>
              <li>Sinusitis</li>
              <li>Malaria Berat</li>
              <li>Tuberkulosis (TB)</li>
              <li>Kekurangan Gizi Berat</li>
             </ul>
          </ul>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>
  @endsection

@push('css')
@endpush
@push('js')
@endpush
