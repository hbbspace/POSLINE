<?php

namespace App\Http\Controllers;

use App\Models\HasilPemeriksaanModel;
use App\Models\PemeriksaanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class PetugasController extends Controller
{
    public function index()
    {   
        $admin_id=Auth::guard('admin')->user()->admin_id;
        $nama=Auth::guard('admin')->user()->nama_admin;
        $total_pemeriksaan = HasilPemeriksaanModel::select(
            'hasil_pemeriksaan.hasil_id', 'hasil_pemeriksaan.admin_id'
        )->where('hasil_pemeriksaan.admin_id',$admin_id)->count();
        ;

        $total_jadwal = PemeriksaanModel::select('pemeriksaan.pemeriksaan_id')
        ->join('hasil_pemeriksaan', 'hasil_pemeriksaan.pemeriksaan_id', '=', 'pemeriksaan.pemeriksaan_id')
        ->where('hasil_pemeriksaan.admin_id', $admin_id)
        ->distinct()
        ->count('pemeriksaan.pemeriksaan_id');
    
        // session()->flush();
        $breadcrumb = (object) [
            'title' => 'Selamat Datang  '. $nama,
            'list' => ['Home', 'Welcome']
        ];

        $activeMenu = 'dashboard';

        return view('petugas', ['breadcrumb' => $breadcrumb, 
        'activeMenu' => $activeMenu,
        'total_pemeriksaan'=> $total_pemeriksaan,
        'total_jadwal'=>$total_jadwal]);
    }


}