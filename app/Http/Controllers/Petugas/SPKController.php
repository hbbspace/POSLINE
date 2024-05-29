<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\HasilPemeriksaanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class SPKController extends Controller {

    // Fungsi untuk menghitung nilai utilitas
    private function calculateUtilitas($nilaiNormalisasi, $bobot)
    {
        return $nilaiNormalisasi * $bobot;
    }

    // Fungsi untuk mengambil data dan melakukan perhitungan
    public function calculateSPK($pemeriksaan_id)
    {
        // Ambil data dari tabel `hasil_pemeriksaan` dengan status 'stunting'
        $dataPemeriksaan = DB::table('hasil_pemeriksaan')
            ->where('status', 'stunting')
            ->get();

        // Kriteria dan bobot
        $kriteria = [
            'jam_kerja' => 0.1,
            'malnutrisi	' => 0.1,
            'kondisi_stunting' => 0.3,
            'kondisi_ekonomi' => 0.3,
            'riwayat_penyakit' => 0.2,
        ];

        // Normalisasi data dan hitung nilai utilitas
        $nilaiTotalUtilitas = [];

        foreach ($dataPemeriksaan as $data) {
            $totalUtilitas = 0;
            foreach ($kriteria as $k => $bobot) {
                $nilai = $data->$k;
                $maxNilai = DB::table('hasil_pemeriksaan')->max($k);
                $nilaiNormalisasi = $nilai / $maxNilai;
                $totalUtilitas += $this->calculateUtilitas($nilaiNormalisasi, $bobot);
            }
            $nilaiTotalUtilitas[$data->id] = $totalUtilitas;
        }

        // Urutkan alternatif berdasarkan nilai total utilitas
        arsort($nilaiTotalUtilitas);

        // Tampilkan hasil peringkat
        foreach ($nilaiTotalUtilitas as $id => $nilai) {
            echo "ID Pemeriksaan $id: Nilai Total Utilitas = $nilai <br>";
        }
    }
}