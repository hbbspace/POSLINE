<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\BalitaModel;
use App\Models\DataAcuanModel;
use App\Models\HasilPemeriksaanModel;
use App\Models\KeluargaModel;
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
    $hasil_pemeriksaan = HasilPemeriksaanModel::select(
        'hasil_pemeriksaan.hasil_id', 'hasil_pemeriksaan.admin_id', 
        'pemeriksaan.pemeriksaan_id', 'anggota_keluarga.nama', 
        'pemeriksaan.tanggal', 'anggota_keluarga.tanggal_lahir', 'anggota_keluarga.jk',
        DB::raw('TIMESTAMPDIFF(MONTH, anggota_keluarga.tanggal_lahir, CURDATE()) as umur')                
    )
    
    ->join('anggota_keluarga', 'hasil_pemeriksaan.nik', '=', 'anggota_keluarga.nik')
    ->join('pemeriksaan', 'hasil_pemeriksaan.pemeriksaan_id', '=', 'pemeriksaan.pemeriksaan_id')
    ->whereNull('hasil_pemeriksaan.admin_id')->get();
    // dd($hasil_pemeriksaan);


    
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
    ->whereNull('hasil_pemeriksaan.admin_id')->get();


    if ($request->hasil_id) {
        $hasil_pemeriksaan->where('hasil_pemeriksaan.hasil_id', $request->hasil_id);
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
        'riwayat_penyakit' => 'required|in:Tidak ada,Ringan,Berat', // Menyesuaikan dengan opsi yang diberikan sebelumnya
        'catatan' => 'nullable|string', // Mengubah menjadi nullable agar catatan bisa bernilai null atau kosong
        'admin_id' => 'required|min:1',
        // 'status' => 'required|in:Periksa', // Jika status adalah string
        'usia' => 'required|numeric|min:1' 
    ]);

    HasilPemeriksaanModel::find($id)->update([
        'tinggi_badan' => $request->tinggi_badan,
        'berat_badan' => $request->berat_badan,
        'lingkar_badan' => $request->lingkar_badan,
        'riwayat_penyakit' => $request->riwayat_penyakit,
        'catatan' => $request->catatan,
        'admin_id' => $request->admin_id,
        'status' => 'Selesai',
        'usia' => $request->usia
    ]);


    

    $hasil_pemeriksaan = HasilPemeriksaanModel::select('keluarga.jam_kerja', 'keluarga.pendapatan', 'anggoa_keluarga.jk', 'hasil_pemeriksaan.berat_badan',
    'hasil_pemeriksaan.tinggi_badan','hasil_pemeriksaan.lingkar_badan','hasil_pemeriksaan.usia', 'hasil_pemeriksaan.berat_badan')
    ->join('anggota_keluarga', 'anggota_keluarga.nik', '=', 'hasil_pemeriksaan.nik')
    ->join('keluarga', 'keluarga.no_kk', '=', 'anggota_keluarga.no_kk')
    ->where('hasil_pemeriksaan.hasil_id', $id)
    ->get(); 

    $jk=$hasil_pemeriksaan->jk;
    $usia=$hasil_pemeriksaan->usia;

    $acuan=DataAcuanModel::all()->where('usia',$usia);
    if($jk=='L'){
        $bbmin=$acuan->BB_L;
        $Malnutrisi=($hasil_pemeriksaan->berat_badan-$bbmin)+($hasil_pemeriksaan->lingkar_badan-$acuan->LB_L);
        if($Malnutrisi >= 0){
            $nilaiMalnutrisi = 1;
        }else if($Malnutrisi<0 && $Malnutrisi<=-3){
            $nilaiMalnutrisi= 2;
        }else{
$nilaiMalnutrisi=3;
        }
        if($hasil_pemeriksaan->tinggi_badan >= $acuan->TB_L){

            $nilaiStunting=='Tidak'
        }else if($hasil_pemeriksaan->tinggi_badan < $acuan->TB_L && $hasil_pemeriksaan->tinggi_badan >= $acuan->TB_L-2){

        }else if($hasil_pemeriksaan->tinggi_badan < $acuan->TB_L && $hasil_pemeriksaan->tinggi_badan >= ($acuan->TB_L-2){

        }else{

        }
    }else if($jk=='P'){
        $bbmin=$acuan->BB_P;
        $Malnutrisi=($hasil_pemeriksaan->berat_badan-$bbmin)+($hasil_pemeriksaan->lingkar_badan-$acuan->LB_P);
        if($Malnutrisi >= 0){
            $nilaiMalnutrisi = 1;
        }else if($Malnutrisi<0 && $Malnutrisi<=-3){
            $nilaiMalnutrisi= 2;
        }else{
            $nilaiMalnutrisi=3;
        }

        
    }






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
    

    public function calculate(string $id){
        // $pemeriksaanId = HasilPemeriksaanModel::where('status', 'Selesai')->where($id);
        $kriteria = [
            'jam_kerja' => 0.1,
            'malnutrisi	' => 0.1,
            'kondisi_stunting' => 0.3,
            'kondisi_ekonomi' => 0.3,
            'riwayat_penyakit' => 0.2,
        ];

        // Mendapatkan seluruh data dengan status "Selesai" dan pemeriksaan_id terbesar
        $pemeriksaan = HasilPemeriksaanModel::select('keluarga.jam_kerja', 'keluarga.pendapatan', 'anggota_keluarga.jk', 'hasil_pemeriksaan.berat_badan',
        'hasil_pemeriksaan.tinggi_badan','hasil_pemeriksaan.lingkar_badan','hasil_pemeriksaan.usia')
        ->join('anggota_keluarga', 'anggota_keluarga.nik', '=', 'hasil_pemeriksaan.nik')
        ->join('keluarga', 'keluarga.no_kk', '=', 'anggota_keluarga.no_kk')->where('hasil_pemeriksaan.status', 'Selesai')
            ->where('hasil_pemeriksaan.pemeriksaan_id', $id)
            ->get();
        $n = count($kriteria);
        $n2=count($pemeriksaan);
        $nilai = array_fill(0, $n2, array_fill(0, $n, 0.0));
        $j=0;
        for($i=0;$i<$n2;$i++){
                $jam_kerja=$pemeriksaan->jam_krja;
                if ($jam_kerja <= 8) {
                    $nilai[$i][$j] = 3;
                } elseif ($jam_kerja > 8 && $jam_kerja <= 12) {
                    $nilai[$i][$j] = 2;
                } else {
                    $nilai[$i][$j] = 1;
                }
            $j++;

                $pendapatan=$pemeriksaan->pendapatan;
                if ($pendapatan >= 10000000) {
                    $nilai[$i][$j] = 5;
                } elseif ($pendapatan >= 7000000 && $pendapatan < 10000000) {
                    $nilai[$i][$j] = 4;
                } elseif ($pendapatan >= 5000000 && $pendapatan < 7000000) {
                    $nilai[$i][$j] = 3;
                } elseif ($pendapatan >= 3000000 && $pendapatan < 5000000) {
                    $nilai[$i][$j] = 2;
                } else {
                    $nilai[$i][$j] = 1;
                }
            $j++;
                $riwayat_penyakit=$pemeriksaan->riwayat_penyakit;
                if($riwayat_penyakit == 'Tidak ada'){
                    $nilai[$i][$j] = 3;
                }else if($riwayat_penyakit == 'Ringan'){
                    $nilai[$i][$j] = 2;
                }else{
                    $nilai[$i][$j] = 3;
                }
            $j++;

            //teus nganti kabeh oleh nilaine

            if($j=$n-1){
                $j=0;
            }
            
        }

        
    //     $nilai = array_fill(0, $n2, array_fill(0, $n, 0.0));
    //     $i=0;
    //     $j=0;

    // foreach ($pemeriksaans as $pemeriksaan){
    //     $jam_kerja=$pemeriksaan->jam_krja;
    //     if ($jam_kerja <= 8) {
    //         $nilai[$i][$j] = 3;
    //     } elseif ($jam_kerja > 8 && $jam_kerja <= 12) {
    //         $nilai[$i][$j] = 2;
    //     } else {
    //         $nilai[$i][$j] = 1;
    //     }
    //     $j++;
    //     $pendapatan=$pemeriksaan->pendapatan;
    //     if ($pendapatan >= 10000000) {
    //         $nilai[$i][$j] = 5;
    //     } elseif ($pendapatan >= 7000000 && $pendapatan < 10000000) {
    //         $nilai[$i][$j] = 4;
    //     } elseif ($pendapatan >= 5000000 && $pendapatan < 7000000) {
    //         $nilai[$i][$j] = 3;
    //     } elseif ($pendapatan >= 3000000 && $pendapatan < 5000000) {
    //         $nilai[$i][$j] = 2;
    //     } else {
    //         $nilai[$i][$j] = 1;
    //     }
    //     $j++;
    //     $riwayat_penyakit=$pemeriksaan->riwayat_penyakit;
    //     if($riwayat_penyakit == 'Tidak ada'){
    //         $nilai[$i][$j] = 3;
    //     }else if($riwayat_penyakit == 'Ringan'){
    //         $nilai[$i][$j] = 2;
    //     }else{
    //         $nilai[$i][$j] = 3;
    //     }


    //     if($j=$n){
    //         $j=0;
    //     }
    // }
    }

}