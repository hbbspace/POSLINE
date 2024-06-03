<?php

namespace App\Http\Controllers;

use App\Models\AnggotaKeluargaModel;
use App\Models\HasilPemeriksaanModel;
use App\Models\KeluargaModel;
use App\Models\PemeriksaanModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {   
        if (Auth::guard('admin')->check()) {
            $jumlahUser=UserModel::all()->count();
        $anakTerdaftar=AnggotaKeluargaModel::where('status','anak')->count();
        $ortuTerdaftar=AnggotaKeluargaModel::where('status','ibu')->count();
        $jumlahKK=KeluargaModel::all()->count();
        $jumlahPemeriksaan=HasilPemeriksaanModel::all()->count();
        $jadwalTerlaksana = PemeriksaanModel::select('tanggal')
        ->where('tanggal', '<=', now())
        ->count();

        $maxPemeriksaanId = HasilPemeriksaanModel::where('status','Selesai')->max('pemeriksaan_id');

        // dd($maxPemeriksaanId);
        
        $beratRataLaki = HasilPemeriksaanModel::select(DB::raw('AVG(hasil_pemeriksaan.berat_badan) as berat_rata_laki'))
            ->join('anggota_keluarga', 'anggota_keluarga.nik', '=', 'hasil_pemeriksaan.nik')
            ->where('anggota_keluarga.jk', 'L')
            ->where('hasil_pemeriksaan.pemeriksaan_id', $maxPemeriksaanId)
            ->value('berat_rata_laki');

        $beratRataPerempuan = HasilPemeriksaanModel::select(DB::raw('AVG(hasil_pemeriksaan.berat_badan) as berat_rata_perempuan'))
            ->join('anggota_keluarga', 'anggota_keluarga.nik', '=', 'hasil_pemeriksaan.nik')
            ->where('anggota_keluarga.jk', 'P')
            ->where('hasil_pemeriksaan.pemeriksaan_id', $maxPemeriksaanId)
            ->value('berat_rata_perempuan');
            
        $tinggiRataLaki = HasilPemeriksaanModel::select(DB::raw('AVG(hasil_pemeriksaan.tinggi_badan) as tinggi_rata_laki'))
            ->join('anggota_keluarga', 'anggota_keluarga.nik', '=', 'hasil_pemeriksaan.nik')
            ->where('anggota_keluarga.jk', 'L')
            ->where('hasil_pemeriksaan.pemeriksaan_id', $maxPemeriksaanId)
            ->value('tinggi_rata_laki');

        $tinggiRataPerempuan = HasilPemeriksaanModel::select(DB::raw('AVG(hasil_pemeriksaan.tinggi_badan) as tinggi_rata_perempuan'))
            ->join('anggota_keluarga', 'anggota_keluarga.nik', '=', 'hasil_pemeriksaan.nik')
            ->where('anggota_keluarga.jk', 'P')
            ->where('hasil_pemeriksaan.pemeriksaan_id', $maxPemeriksaanId)
            ->value('tinggi_rata_perempuan');

                // session()->flush();
        $breadcrumb = (object) [
            'title' => 'Selamat Datang ' . Auth::guard('admin')->user()->nama_admin,
            'list' => ['Home', 'Welcome']
        ];

        $activeMenu = 'dashboard';

        return view('admin', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu,
        'jumlahUser'=> $jumlahUser,
        'anakTerdaftar'=>$anakTerdaftar,
        'ortuTerdaftar'=>$ortuTerdaftar,
        'jumlahKK'=>$jumlahKK,
        'jumlahPemeriksaan'=>$jumlahPemeriksaan,
        'beratRataLaki'=>$beratRataLaki,
        'beratRataPerempuan'=>$beratRataPerempuan,
        'tinggiRataLaki'=>$tinggiRataLaki,
        'tinggiRataPerempuan'=>$tinggiRataPerempuan,
        'jadwalTerlaksana'=>$jadwalTerlaksana]);
        }else{
            return redirect('/login')->with('error', 'Session Anda sudah habis, silahkan login kembali');
        }
        
    }

    public function getChartData()
    {
        $data = HasilPemeriksaanModel::select(
            'hasil_pemeriksaan.pemeriksaan_id',
            DB::raw('AVG(hasil_pemeriksaan.berat_badan) as berat_rata_laki')
        )
        ->join('anggota_keluarga', 'anggota_keluarga.nik', '=', 'hasil_pemeriksaan.nik')
        ->where('anggota_keluarga.jk', 'L')
        ->groupBy('hasil_pemeriksaan.pemeriksaan_id')
        ->get();

        $data2 = HasilPemeriksaanModel::select(
            'hasil_pemeriksaan.pemeriksaan_id',
            DB::raw('AVG(hasil_pemeriksaan.berat_badan) as berat_rata_perempuan')
        )
        ->join('anggota_keluarga', 'anggota_keluarga.nik', '=', 'hasil_pemeriksaan.nik')
        ->where('anggota_keluarga.jk', 'P')
        ->groupBy('hasil_pemeriksaan.pemeriksaan_id')
        ->get();


    // $data = DB::table('hasil_pemeriksaan')
    // ->select('pemeriksaan_id', 'tinggi_badan')
    // //->orderBy('pemeriksaan_id')
    // ->get();

    // Pisahkan hasil_id dan tinggi_badan ke dalam dua array terpisah
    $labels = $data->pluck('pemeriksaan_id');
    $heightData = $data->pluck('berat_rata_laki');
    
    $labels2 = $data2->pluck('pemeriksaan_id');
    $heightData2 = $data2->pluck('berat_rata_perempuan');
    // Kirimkan data dalam format JSON
    return response()->json([
    'labels' => $labels,
    'data' => $heightData,
    'labels2' => $labels2,
    'data2' => $heightData2,
    ]);
    }
}