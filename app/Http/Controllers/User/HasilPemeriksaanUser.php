<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\HasilPemeriksaanModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;


class HasilPemeriksaanUser extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Hasil Pemeriksaan',
            'list' => ['Home', 'Hasil Pemeriksaan']
        ];
    
        $page = (object) [
            'title' => 'Daftar Hasil Pemeriksaan'
        ];
    
        $activeMenu = 'dataPemeriksaanBalita';
    
        $user_id = Auth::guard('user')->user()->user_id;

        // Mengambil data no_kk dari user
        $nokk_user = UserModel::select('anggota_keluarga.no_kk')
            ->join('anggota_keluarga', 'user.nik', '=', 'anggota_keluarga.nik')
            ->where('user.user_id', $user_id)
            ->first(); 
            $no_kk = $nokk_user->no_kk;
    
            $hasil_pemeriksaan = HasilPemeriksaanModel::select(
                'hasil_pemeriksaan.hasil_id', 'balita.balita_id', 'admin.admin_id', 
                'pemeriksaan.pemeriksaan_id', 'hasil_pemeriksaan.catatan', 'anggota_keluarga.nama', 
                'admin.nama_admin', 'pemeriksaan.tanggal', 'anggota_keluarga.no_kk'
            )
            ->join('balita', 'hasil_pemeriksaan.balita_id', '=', 'balita.balita_id')
            ->join('anggota_keluarga', 'balita.nik', '=', 'anggota_keluarga.nik')
            ->join('admin', 'hasil_pemeriksaan.admin_id', '=', 'admin.admin_id')
            ->join('pemeriksaan', 'hasil_pemeriksaan.pemeriksaan_id', '=', 'pemeriksaan.pemeriksaan_id')
            ->where('anggota_keluarga.no_kk', '=', $no_kk)
            ->get();

        return view('user.dataPemeriksaanBalitaUser.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'hasil_pemeriksaan' => $hasil_pemeriksaan,
            'activeMenu' => $activeMenu
        ]);
    }
    

    public function list()
{
    $user_id = Auth::guard('user')->user()->user_id;

    // Mengambil data no_kk dari user
    $nokk_user = UserModel::select('anggota_keluarga.no_kk')
        ->join('anggota_keluarga', 'user.nik', '=', 'anggota_keluarga.nik')
        ->where('user.user_id', $user_id)
        ->first();
    

        $no_kk = $nokk_user->no_kk;
    
        $hasil_pemeriksaan = HasilPemeriksaanModel::select(
            'hasil_pemeriksaan.hasil_id', 'balita.balita_id', 'admin.admin_id', 
            'pemeriksaan.pemeriksaan_id', 'hasil_pemeriksaan.catatan', 'anggota_keluarga.nama', 
            'admin.nama_admin', 'pemeriksaan.tanggal', 'anggota_keluarga.no_kk'
        )
        ->join('balita', 'hasil_pemeriksaan.balita_id', '=', 'balita.balita_id')
        ->join('anggota_keluarga', 'balita.nik', '=', 'anggota_keluarga.nik')
        ->join('admin', 'hasil_pemeriksaan.admin_id', '=', 'admin.admin_id')
        ->join('pemeriksaan', 'hasil_pemeriksaan.pemeriksaan_id', '=', 'pemeriksaan.pemeriksaan_id')
        ->where('anggota_keluarga.no_kk', '=', $no_kk)
        ->get(); // Menggunakan get() untuk mengambil hasil
    
    
    
    return DataTables::of($hasil_pemeriksaan)
        ->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
        ->addColumn('aksi', function ($hasil_pemeriksaan) { // menambahkan kolom aksi
            $btn = '<a href="' . url('user/dataPemeriksaanBalita/' . $hasil_pemeriksaan->hasil_id) . '" class="btn btn-info btn-sm">Detail</a> ';
            return $btn;
        })
        ->rawColumns(['aksi'])
        ->make(true);
}

    public function show(String $hasil_id)
{
    $hasil_pemeriksaan = HasilPemeriksaanModel::select(
        'hasil_pemeriksaan.*', 'anggota_keluarga.nama', 'admin.nama_admin', 'pemeriksaan.agenda', 'pemeriksaan.tanggal'
    )
    ->join('balita', 'hasil_pemeriksaan.balita_id', '=', 'balita.balita_id')
    ->join('anggota_keluarga', 'balita.nik', '=', 'anggota_keluarga.nik')
    ->join('admin', 'hasil_pemeriksaan.admin_id', '=', 'admin.admin_id')
    ->join('pemeriksaan', 'hasil_pemeriksaan.pemeriksaan_id', '=', 'pemeriksaan.pemeriksaan_id')
    ->where('hasil_pemeriksaan.hasil_id', $hasil_id)
    ->first();

    if (!$hasil_pemeriksaan) {
        return redirect('user/dataPemeriksaanBalita')->with('error', 'Data yang Anda cari tidak ditemukan.');
    }

    $breadcrumb = (object) [
        'title' => 'Detail Data Pemeriksaan Balita',
        'list' => ['Home', 'Data Pemeriksaan Balita', 'Detail']
    ];

    $page = (object) [
        'title' => 'Detail Data Pemeriksaan Balita'
    ];

    $activeMenu = 'dataPemeriksaanBalita';

    return view('user.dataPemeriksaanBalitaUser.show', [
        'breadcrumb' => $breadcrumb,
        'page' => $page,
        'hasil_pemeriksaan' => $hasil_pemeriksaan,
        'activeMenu' => $activeMenu
    ]);
}

}