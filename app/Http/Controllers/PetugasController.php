<?php

namespace App\Http\Controllers;

use App\Models\HasilPemeriksaanModel;
use App\Models\PemeriksaanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PetugasController extends Controller
{
    public function index()
    {   
        if (Auth::guard('admin')->check()) {
            $admin_id = Auth::guard('admin')->user()->admin_id;
            $nama=Auth::guard('admin')->user()->nama_admin;
            $total_pemeriksaan = HasilPemeriksaanModel::select(
                'hasil_pemeriksaan.hasil_id', 'hasil_pemeriksaan.admin_id'
            )->where('hasil_pemeriksaan.admin_id',$admin_id)->count();
            
    
            $total_jadwal = PemeriksaanModel::select('pemeriksaan.pemeriksaan_id')
            ->join('hasil_pemeriksaan', 'hasil_pemeriksaan.pemeriksaan_id', '=', 'pemeriksaan.pemeriksaan_id')
            ->where('hasil_pemeriksaan.admin_id', $admin_id)
            ->distinct()
            ->count('pemeriksaan.pemeriksaan_id');
    
            $maxPemeriksaanId = HasilPemeriksaanModel::where('status','Selesai')->max('pemeriksaan_id');
    
            
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

            $stuntingRendah = HasilPemeriksaanModel::select(DB::raw('COUNT(hasil_pemeriksaan.stunting) as stunting'))
            ->where('hasil_pemeriksaan.stunting', '=', 'Rendah')
            ->where('hasil_pemeriksaan.pemeriksaan_id', $maxPemeriksaanId)
            ->where('hasil_pemeriksaan.status','=','Selesai')->get();
    
            $stuntingSedang = HasilPemeriksaanModel::select(DB::raw('COUNT(hasil_pemeriksaan.stunting) as stunting'))
            ->where('hasil_pemeriksaan.stunting', '=', 'Sedang')
            ->where('hasil_pemeriksaan.pemeriksaan_id', $maxPemeriksaanId)
            ->where('hasil_pemeriksaan.status','=','Selesai')->get();
    
            $stuntingTinggi =HasilPemeriksaanModel::select(DB::raw('COUNT(hasil_pemeriksaan.stunting) as stunting'))
            ->where('hasil_pemeriksaan.stunting', '=', 'Tinggi')
            ->where('hasil_pemeriksaan.pemeriksaan_id', $maxPemeriksaanId)
            ->where('hasil_pemeriksaan.status','=','Selesai')->get();
            
            $tidakStunting = HasilPemeriksaanModel::select(DB::raw('COUNT(hasil_pemeriksaan.stunting) as stunting'))
            ->where('hasil_pemeriksaan.stunting', '=', 'Tidak')
            ->where('hasil_pemeriksaan.pemeriksaan_id', $maxPemeriksaanId)
            ->where('hasil_pemeriksaan.status','=','Selesai')->get();
        
            // session()->flush();
            $breadcrumb = (object) [
                'title' => 'Selamat Datang  '. $nama,
                'list' => ['Home', 'Welcome']
            ];
    
            $activeMenu = 'dashboard';
    
            return view('petugas', ['breadcrumb' => $breadcrumb, 
            'activeMenu' => $activeMenu,
            'total_pemeriksaan'=> $total_pemeriksaan,
            'beratRataLaki'=>$beratRataLaki,
            'beratRataPerempuan'=>$beratRataPerempuan,
            'tinggiRataLaki'=>$tinggiRataLaki,
            'tinggiRataPerempuan'=>$tinggiRataPerempuan,
            'stuntingRendah'=>$stuntingRendah,
            'stuntingSedang'=>$stuntingSedang,
            'stuntingTinggi'=>$stuntingTinggi,
            'tidakStunting'=>$tidakStunting,
            'total_jadwal'=>$total_jadwal]);
        } else {
            return redirect('/login')->with('error', 'Session Anda sudah habis, silahkan login kembali');
        }

    }


    


}