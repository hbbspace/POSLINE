<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\BalitaModel;
use App\Models\DataAcuanModel;
use App\Models\HasilPemeriksaanModel;
use App\Models\KeluargaModel;
use App\Models\PemeriksaanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PemeriksaanBalitaController extends Controller
{


public function index()
{   
    $breadcrumb = (object) [
        'title' => 'Daftar Pemeriksaan Balita',
        'list' => ['Home', 'Balita']
    ];

    $page = (object) [
        'title' => 'Daftar Balita yang Terdaftar Pemeriksaan'
    ];

    $activeMenu = 'pemeriksaanBalita'; 
    $hasil_pemeriksaan=HasilPemeriksaanModel::select('tanggal')
    ->join('pemeriksaan', 'hasil_pemeriksaan.pemeriksaan_id', '=', 'pemeriksaan.pemeriksaan_id')
    ->whereNull('hasil_pemeriksaan.admin_id')
    ->distinct()
    ->get();



    
    return view('petugas.pemeriksaanBalita.index', [
        'breadcrumb' => $breadcrumb, 
        'page' => $page,
        'hasil_pemeriksaan' => $hasil_pemeriksaan, 
        'activeMenu' => $activeMenu
    ]);
}

public function list(Request $request)
{
    $hasil_pemeriksaan = HasilPemeriksaanModel::select(
        'hasil_pemeriksaan.hasil_id', 'hasil_pemeriksaan.admin_id', 
        'pemeriksaan.pemeriksaan_id', 'anggota_keluarga.nama', 
        'pemeriksaan.tanggal', 'anggota_keluarga.tanggal_lahir', 'anggota_keluarga.jk',
        DB::raw('TIMESTAMPDIFF(MONTH, anggota_keluarga.tanggal_lahir, CURDATE()) as umur')                
    )
    
    ->join('anggota_keluarga', 'hasil_pemeriksaan.nik', '=', 'anggota_keluarga.nik')
    ->join('pemeriksaan', 'hasil_pemeriksaan.pemeriksaan_id', '=', 'pemeriksaan.pemeriksaan_id')
    ->whereNull('hasil_pemeriksaan.admin_id');


    if ($request->tanggal) {
        $hasil_pemeriksaan->where('pemeriksaan.tanggal', $request->tanggal);
    }

    return DataTables::of($hasil_pemeriksaan)
        ->addColumn('action', function ($hasil_pemeriksaan) {
            return 
                '<a href="' . url('petugas/pemeriksaanBalita/' . $hasil_pemeriksaan->hasil_id . '/edit') . '" class="btn btn-warning btn-sm">Input</a> ' ;
        })
        ->rawColumns(['action'])
        ->make(true);
}

public function update(Request $request, string $id)
{
    $request->validate([
        'tinggi_badan' => 'required|numeric|min:1', 
        'berat_badan' => 'required|numeric|min:1', 
        'lingkar_badan' => 'required|numeric|min:1', 
        'gangguan_kesehatan' => 'required|in:Tidak ada,Ringan,Sedang,Berat', // Menyesuaikan dengan opsi yang diberikan sebelumnya
        'catatan' => 'nullable|string', // Mengubah menjadi nullable agar catatan bisa bernilai null atau kosong
        'admin_id' => 'required|min:1',
        // 'status' => 'required|in:Periksa', // Jika status adalah string
        'usia' => 'required|numeric|min:1' 
    ]);

    HasilPemeriksaanModel::find($id)->update([
        'tinggi_badan' => $request->tinggi_badan,
        'berat_badan' => $request->berat_badan,
        'lingkar_badan' => $request->lingkar_badan,
        'gangguan_kesehatan' => $request->gangguan_kesehatan,
        'catatan' => $request->catatan,
        'admin_id' => $request->admin_id,
        'status' => 'Selesai',
        'usia' => $request->usia
    ]);


    $hasil_pemeriksaan = HasilPemeriksaanModel::select('keluarga.jam_kerja', 'keluarga.pendapatan', 'anggota_keluarga.jk', 'hasil_pemeriksaan.berat_badan',
        'hasil_pemeriksaan.tinggi_badan','hasil_pemeriksaan.lingkar_badan','hasil_pemeriksaan.usia', 'hasil_pemeriksaan.berat_badan')
        ->join('anggota_keluarga', 'anggota_keluarga.nik', '=', 'hasil_pemeriksaan.nik')
        ->join('keluarga', 'keluarga.no_kk', '=', 'anggota_keluarga.no_kk')
        ->where('hasil_pemeriksaan.hasil_id', $id)
        ->get(); 

        $firstResult = $hasil_pemeriksaan->first();

        $jk=$firstResult->jk;
        $usia=$firstResult->usia;

        $acuan=DataAcuanModel::all()->where('usia',$usia);
        $acuanFirst = $acuan->first();
        if($jk=='L'){
            $Malnutrisi=($firstResult->berat_badan-$acuanFirst->BB_L)+($firstResult->lingkar_badan-$acuanFirst->LB_L);

            if($Malnutrisi >= 0){
                $nilaiMalnutrisi = 'Rendah';
            }else if($Malnutrisi >= -3){
                $nilaiMalnutrisi = 'Sedang';
            }else{
                $nilaiMalnutrisi = 'Tinggi';
            }

            if($firstResult->tinggi_badan >= $acuanFirst->TB_L){
                $nilaiStunting = 'Tidak';
            }else if($firstResult->tinggi_badan >= $acuanFirst->TB_L - 2){
                $nilaiStunting = 'Rendah';
            }else if($firstResult->tinggi_badan >= $acuanFirst->TB_L - 5){
                $nilaiStunting = 'Sedang';
            }else{
                $nilaiStunting = 'Tinggi';
            }

        }else if($jk=='P'){
            $Malnutrisi=($firstResult->berat_badan-$acuanFirst->BB_P)+($firstResult->lingkar_badan-$acuanFirst->LB_P);

            if($Malnutrisi >= 0){
                $nilaiMalnutrisi = 'Rendah';
            }else if($Malnutrisi >= -3){
                $nilaiMalnutrisi = 'Sedang';
            }else{
                $nilaiMalnutrisi = 'Tinggi';
            }

            if($firstResult->tinggi_badan >= $acuanFirst->TB_P){
                $nilaiStunting = 'Tidak';
            }else if($firstResult->tinggi_badan >= $acuanFirst->TB_P - 2){
                $nilaiStunting = 'Rendah';
            }else if($firstResult->tinggi_badan >= $acuanFirst->TB_P - 5){
                $nilaiStunting = 'Sedang';
            }else{
                $nilaiStunting = 'Tinggi';
            }
        }

        HasilPemeriksaanModel::find($id)->update([
            'malnutrisi' => $nilaiMalnutrisi,
            'stunting' => $nilaiStunting,
        ]);

    return redirect('petugas/pemeriksaanBalita')->with('success', 'Data Pemeriksaan Balita berhasil diubah');
}



    public function edit(String $hasil_id)
    {
        $umur = HasilPemeriksaanModel::select(
            DB::raw('TIMESTAMPDIFF(MONTH, anggota_keluarga.tanggal_lahir, CURDATE()) as umur')                
        )
        
        ->join('anggota_keluarga', 'hasil_pemeriksaan.nik', '=', 'anggota_keluarga.nik')
        ->where('hasil_pemeriksaan.hasil_id',$hasil_id)->get();


        $hasil_pemeriksaan = HasilPemeriksaanModel::find($hasil_id);
        $breadcrumb = (object) [
            'title' => 'Input Data Pemeriksaan Balita',
            'list' => ['Home', 'Balita', 'Input Data']
        ];

        $page = (object) [
            'title' => 'Input Data Pemeriksaan Balita'
        ];

        $activeMenu = 'pemeriksaanBalita'; 

        return view('petugas.pemeriksaanBalita.edit', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'hasil_pemeriksaan' => $hasil_pemeriksaan,
            'umur'=>$umur,
            'activeMenu' => $activeMenu
        ]);
    }
    

    public function calculate(string $id)
    {
        // Mendefinisikan bobot kriteria
        $kriteria = [
            'jam_kerja' => 0.1,
            'malnutrisi' => 0.1,
            'kondisi_stunting' => 0.3,
            'kondisi_ekonomi' => 0.3,
            'gangguan_kesehatan' => 0.2,
        ];

        // Mendapatkan seluruh data dengan status "Selesai" dan pemeriksaan_id tertentu
        $pemeriksaan = HasilPemeriksaanModel::select(
            'hasil_pemeriksaan.hasil_id',
            'keluarga.jam_kerja',
            'keluarga.pendapatan',
            'hasil_pemeriksaan.gangguan_kesehatan',
            'hasil_pemeriksaan.malnutrisi',
            'hasil_pemeriksaan.stunting'
        )
        ->join('anggota_keluarga', 'anggota_keluarga.nik', '=', 'hasil_pemeriksaan.nik')
        ->join('keluarga', 'keluarga.no_kk', '=', 'anggota_keluarga.no_kk')
        ->where('hasil_pemeriksaan.status', 'Selesai')
        ->where('hasil_pemeriksaan.stunting', '!=', 'Tidak')
        ->where('hasil_pemeriksaan.pemeriksaan_id', $id)
        ->get();

        $n = count($kriteria);
        $n2 = count($pemeriksaan);
        $nilai = array_fill(0, $n2, array_fill(0, $n, 0.0));
        $normalisasi = array_fill(0, $n2, array_fill(0, $n, 0.0));
        $utility = array_fill(0, $n2, array_fill(0, $n, 0.0));
        $total_nilai = array_fill(0, $n2, 0.0);

        for ($i = 0; $i < $n2; $i++) {
            $j = 0;

            $jam_kerja = $pemeriksaan[$i]->jam_kerja;
            if ($jam_kerja <= 8) {
                $nilai[$i][$j] = 1;
            } elseif ($jam_kerja <= 12) {
                $nilai[$i][$j] = 2;
            } else {
                $nilai[$i][$j] = 3;
            }
            $j++;

            $malnutrisi = $pemeriksaan[$i]->malnutrisi;
            if ($malnutrisi == 'Rendah') {
                $nilai[$i][$j] = 1;
            } elseif ($malnutrisi == 'Sedang') {
                $nilai[$i][$j] = 2;
            } else {
                $nilai[$i][$j] = 3;
            }
            $j++;

            $stunting = $pemeriksaan[$i]->stunting;
            if ($stunting == 'Rendah') {
                $nilai[$i][$j] = 1;
            } elseif ($stunting == 'Sedang') {
                $nilai[$i][$j] = 2;
            } else {
                $nilai[$i][$j] = 3;
            }
            $j++;

            $pendapatan = $pemeriksaan[$i]->pendapatan;
            if ($pendapatan >= 10000000) {
                $nilai[$i][$j] = 1;
            } elseif ($pendapatan >= 7000000) {
                $nilai[$i][$j] = 2;
            } elseif ($pendapatan >= 5000000) {
                $nilai[$i][$j] = 3;
            } elseif ($pendapatan >= 3000000) {
                $nilai[$i][$j] = 4;
            } else {
                $nilai[$i][$j] = 5;
            }
            $j++;

            $gangguan_kesehatan = $pemeriksaan[$i]->gangguan_kesehatan;
            if ($gangguan_kesehatan == 'Tidak ada') {
                $nilai[$i][$j] = 1;
            } elseif ($gangguan_kesehatan == 'Ringan') {
                $nilai[$i][$j] = 2;
            } elseif ($gangguan_kesehatan == 'Sedang') {
                $nilai[$i][$j] = 3;
            } else {
                $nilai[$i][$j] = 4;
            }
        }

        foreach ($nilai as $row) {
            $nilaiC1[] = $row[0];
            $nilaiC2[] = $row[1];
            $nilaiC3[] = $row[2];
            $nilaiC4[] = $row[3];
            $nilaiC5[] = $row[4];
        }

        for ($i = 0; $i < $n2; $i++) {
            for ($j = 0; $j < $n; $j++) {
                switch ($j) {
                    case 0:
                        $normalisasi[$i][$j] = $this->safeDivide(($nilai[$i][$j] - min($nilaiC1)),(max($nilaiC1) - min($nilaiC1)));
                      break;
                    case 1:
                        $normalisasi[$i][$j] = $this->safeDivide(($nilai[$i][$j] - min($nilaiC2)),(max($nilaiC2) - min($nilaiC2)));
                      break;
                    case 2:
                        $normalisasi[$i][$j] = $this->safeDivide(($nilai[$i][$j] - min($nilaiC3)),(max($nilaiC3) - min($nilaiC3)));
                      break;
                    case 3:
                        $normalisasi[$i][$j] = $this->safeDivide(($nilai[$i][$j] - min($nilaiC4)),(max($nilaiC4) - min($nilaiC4)));
                      break;
                    case 4:
                        $normalisasi[$i][$j] = $this->safeDivide(($nilai[$i][$j] - min($nilaiC5)),(max($nilaiC5) - min($nilaiC5)));
                      break;
                  }
            }
        }

        for ($i = 0; $i < $n2; $i++) {
            for ($j = 0; $j < $n; $j++) {
                switch ($j) {
                    case 0:
                        $utility[$i][$j] = ($normalisasi[$i][$j] * $kriteria['jam_kerja']);
                      break;
                    case 1:
                        $utility[$i][$j] = ($normalisasi[$i][$j] * $kriteria['malnutrisi']);
                      break;
                    case 2:
                        $utility[$i][$j] = ($normalisasi[$i][$j] * $kriteria['kondisi_stunting']);
                      break;
                    case 3:
                        $utility[$i][$j] = ($normalisasi[$i][$j] * $kriteria['kondisi_ekonomi']);
                      break;
                    case 4:
                        $utility[$i][$j] = ($normalisasi[$i][$j] * $kriteria['gangguan_kesehatan']);
                      break;
                  }
            }
        }

        
        for ($i = 0; $i < $n2; $i++) {
            for ($j = 0; $j < $n; $j++) {
                $total_nilai[$i] += $utility[$i][$j];
            }
        }

        $nilai_dan_id = [];
        for ($i = 0; $i < $n2; $i++) {
            $nilai_dan_id[] = ['hasil_id' => $pemeriksaan[$i]->hasil_id, 'nilai' => $total_nilai[$i]];
        }

        usort($nilai_dan_id, function ($a, $b) {
            return $b['nilai'] <=> $a['nilai'];
        });

        foreach ($nilai_dan_id as $rank => $item) {
            HasilPemeriksaanModel::where('hasil_id', $item['hasil_id'])
                ->update(['ranking' => $rank + 1]);
        }

        $rankingBalita = HasilPemeriksaanModel::select(
            'anggota_keluarga.nama',
            //'anggota_keluarga.nama as nama_orang_tua',
            'hasil_pemeriksaan.usia',
            'hasil_pemeriksaan.gangguan_kesehatan',
            'hasil_pemeriksaan.malnutrisi',
            'hasil_pemeriksaan.stunting',
            'keluarga.jam_kerja',
            'keluarga.pendapatan',
            'hasil_pemeriksaan.ranking',
        )
        ->join('anggota_keluarga', 'anggota_keluarga.nik', '=', 'hasil_pemeriksaan.nik')
        ->join('keluarga', 'keluarga.no_kk', '=', 'anggota_keluarga.no_kk')
        ->where('hasil_pemeriksaan.pemeriksaan_id', $id)
        ->where('anggota_keluarga.status', 'anak')
        ->where('hasil_pemeriksaan.ranking','!=','null')
        ->orderBy('hasil_pemeriksaan.ranking', 'asc')
        ->get();

        $breadcrumb = (object) [
            'title' => 'Prioritas Balita Penerima Tambahan Gizi ',
            'list' => ['Home', 'Jadwal']
        ];

        $page = (object) [
            'title' => 'Daftar Agenda Pemeriksaan'
        ];

        $activeMenu = 'jadwal';
        // dd($nilai);

        return view('petugas.jadwal.ranking', [
            'breadcrumb' => $breadcrumb, 
            'page' => $page, 
            'rankingBalita' => $rankingBalita,
            'kriteria' => $kriteria,
            'nilai' => $nilai, 
            'normalisasi' => $normalisasi, 
            'utility' => $utility, 
            'totalNilai' => $total_nilai,
            'activeMenu' => $activeMenu
        ]);
    }

    public function safeDivide($numerator, $denominator)
    {
    return $denominator != 0 ? $numerator / $denominator : 0;
    }
}