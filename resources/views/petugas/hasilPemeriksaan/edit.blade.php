@extends('petugas.layouts.template')

{{-- Customize layout sections --}}
@section('subtitle', 'Pemeriksaan Balita')
@section('content_header_title', 'Pemeriksaan Balita')
@section('content_header_subtitle', 'Input')

@section('content')
<div class="table-responsive" style="max-height: 550px; overflow-y: auto;">

    <div class="container">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Edit Pemeriksaan Balita</h3>
            </div>

            <form method="post" action="{{ url('petugas/historyPemeriksaan', $hasil_pemeriksaan->hasil_id) }}">
                @csrf
                @method('PUT')

                <div class="card-body">
                    <div class="form-group">
                        <label for="tinggi_badan">Tinggi Badan</label>
                        <input type="number" class="form-control" id="tinggi_badan" name="tinggi_badan" step="0.01" value="{{ $hasil_pemeriksaan->tinggi_badan }}">
                    </div>
                    <div class="form-group">
                        <label for="berat_badan">Berat Badan</label>
                        <input type="number" class="form-control" id="berat_badan" name="berat_badan" step="0.01" value="{{ $hasil_pemeriksaan->berat_badan }}">
                    </div>
                    <div class="form-group">
                        <label for="lingkar_kepala">Lingkar Kepala</label>
                        <input type="number" class="form-control" id="lingkar_kepala" name="lingkar_kepala" step="0.01" value="{{ $hasil_pemeriksaan->lingkar_kepala }}">
                    </div>
                    <div class="form-group">
                        <label for="gangguan_kesehatan">Riwayat Penyakit</label>
                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#infoPenyakitModal">
                            ?
                        </button>
                        <div>
                            @php
                                $options = [
                                    'Tidak ada' => 'Tidak ada',
                                    'Ringan' => 'Ringan',
                                    'Sedang' => 'Sedang',
                                    'Berat' => 'Berat'
                                ];
                            @endphp

                            @foreach ($options as $value => $label)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gangguan_kesehatan" id="gangguan_kesehatan_{{ $value }}" value="{{ $value }}" {{ $hasil_pemeriksaan->gangguan_kesehatan == $value ? 'checked' : '' }}>
                                    <label class="form-check-label" for="gangguan_kesehatan_{{ $value }}">{{ $label }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Nafsu Makan Balita</label>
                        <div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="nafsu_makan" id="nafsu_makan_baik" value="Baik" {{ $hasil_pemeriksaan->nafsu_makan == 'Baik' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="nafsu_makan_baik">Baik</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="nafsu_makan" id="nafsu_makan_kurang" value="Kurang" {{ $hasil_pemeriksaan->nafsu_makan == 'Kurang' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="nafsu_makan_kurang">Kurang</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="catatan">Catatan</label>
                        <input type="text" class="form-control" id="catatan" name="catatan" value="{{ $hasil_pemeriksaan->catatan }}">
                    </div>
                    {{-- <input type="hidden" id="admin_id" name="admin_id" value="{{ Auth::guard('admin')->user()->admin_id }}"> --}}
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ url('admin/dataPemeriksaan') }}" class="btn btn-secondary ml-2">Kembali</a>
                    </div> 
                </div>
                
            </form>
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
                        <li>Infeksi Telinga Ringan</li>
                        <li>Konjungtivitis (Mata Merah)</li>
                        <li>Stomatitis</li>
                        <li>Cacingan</li>
                    </ul>
                    <li><strong style="color: orange;">Penyakit Sedang:</strong></li>
                    <ul>
                        <li>Asma Sedang</li>
                        <li>Diare dengan Dehidrasi Ringan</li>
                        <li>Demam Tinggi tanpa Komplikasi</li>
                        <li>Infeksi Telinga Sedang</li>
                        <li>Bronkitis</li>
                        <li>Infeksi Saluran Kemih (ISK)</li>
                        <li>Gastroenteritis Sedang</li>
                    </ul>
                    <li><strong style="color: red;">Penyakit Berat:</strong></li>
                    <ul>
                        <li>Pneumonia</li>
                        <li>Diare Berat dengan Dehidrasi</li>
                        <li>Demam Berdarah Dengue</li>
                        <li>Meningitis</li>
                        <li>Sepsis</li>
                        <li>Malaria Berat</li>
                        <li>Tuberkulosis (TB)</li>
                        <li>Kekurangan Gizi Berat</li>
                        <li>Leukemia</li>
                        <li>Congenital Heart Disease</li>
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
