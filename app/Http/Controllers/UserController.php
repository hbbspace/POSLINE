<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\AnggotaKeluargaModel;
use App\Models\BalitaModel;
use App\Models\HasilPemeriksaanModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {   
        // session()->flush();
        $user_id = (Auth::guard('user')->user()->user_id);
        $user=UserModel::select('anggota_keluarga.nama','anggota_keluarga.no_kk')
        ->join('anggota_keluarga','user.nik','=','anggota_keluarga.nik')
        ->where('user_id',$user_id)->first();
        $nama=$user->nama;
        $no_kk = $user->no_kk;
        $jumlahAnak = AnggotaKeluargaModel::where('no_kk', $no_kk)
        ->where('status', 'anak')
        ->count();

        $hasil_pemeriksaan = HasilPemeriksaanModel::select(
            'hasil_pemeriksaan.hasil_id',  'anggota_keluarga.nik'
        )
        ->join('anggota_keluarga', 'anggota_keluarga.nik', '=', 'hasil_pemeriksaan.nik')
        ->where('anggota_keluarga.no_kk', '=', $no_kk)
        ->count();

        $breadcrumb = (object) [
            'title' => 'Selamat Datang ' . $nama,
            'list' => ['Home', 'Dashboard']
        ];

        $activeMenu = 'dashboard';
        
        // return $dataTable->render('admin.dataUser.index');
        return view('user', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu, 'jumlahAnak'=>$jumlahAnak, 'hasil_pemeriksaan'=>$hasil_pemeriksaan]);
    }


}
