<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\HasilPemeriksaanModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SPKController extends Controller {

    // Fungsi untuk menghitung nilai utilitas
    private function calculateUtilitas($nilaiNormalisasi, $bobot, $preferensi)
    {
        return $nilaiNormalisasi * $bobot * $preferensi;
    }

    // Fungsi untuk melakukan perhitungan SPK menggunakan metode MAUT
    public function hitungSPK()
    {
        // Data kriteria
        $kriteria = [
            'K1' => ['bobot' => 0.1, 'nilai' => [4, 3, 2, 5]], // Berat Badan
            'K2' => ['bobot' => 0.1, 'nilai' => [3, 4, 5, 2]], // Tinggi Badan
            'K3' => ['bobot' => 0.1, 'nilai' => [3, 4, 5, 2]], // Lingkar Kepala
            'K4' => ['bobot' => 0.4, 'nilai' => [3, 4, 5, 2]], // Kondisi Ekonomi
            'K5' => ['bobot' => 0.3, 'nilai' => [2, 5, 4, 3]] // Riwayat Penyakit	
        ];

        // Normalisasi data kriteria
        foreach ($kriteria as $k => $v) {
            $maxNilai = max($v['nilai']);
            foreach ($v['nilai'] as $key => $value) {
                $kriteria[$k]['nilaiNormalisasi'][$key] = $value / $maxNilai;
            }
        }

        // Bobot preferensi untuk setiap kriteria
        $bobotPreferensi = [
            'K1' => 1, // Sangat Baik
            'K2' => 0.8, // Baik
            'K3' => 0.6 // Cukup Baik
        ];

        // Alternatif
        $alternatif = ['A1', 'A2', 'A3', 'A4'];
        $nilaiTotalUtilitas = [];

        // Hitung nilai utilitas untuk setiap alternatif
        foreach ($alternatif as $key => $a) {
            $totalUtilitas = 0;
            foreach ($kriteria as $k => $v) {
                $totalUtilitas += $this->calculateUtilitas($v['nilaiNormalisasi'][$key], $v['bobot'], $bobotPreferensi[$k]);
            }
            $nilaiTotalUtilitas[$a] = $totalUtilitas;
        }

        // Urutkan alternatif berdasarkan nilai total utilitas
        arsort($nilaiTotalUtilitas);

        // Tampilkan hasil peringkat
        foreach ($nilaiTotalUtilitas as $alternatif => $nilai) {
            echo "Alternatif $alternatif: Nilai Total Utilitas = $nilai <br>";
        }
    }
}