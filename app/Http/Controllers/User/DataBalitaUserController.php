<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\AnggotaKeluargaModel;
use App\Models\BalitaModel;
use App\Models\HasilPemeriksaanModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class DataBalitaUserController extends Controller
{
   
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Balita',
            'list' => ['Home', 'Data Balita']
        ];
    
        $page = (object) [
            'title' => 'Daftar Hasil Pemeriksaan'
        ];
    
        $activeMenu = 'dataBalitaUser';
    
        $user_id = Auth::guard('user')->user()->user_id;
        
        // Mengambil data no_kk dari user
        $nokk_user = UserModel::select('anggota_keluarga.no_kk')
            ->join('anggota_keluarga', 'user.nik', '=', 'anggota_keluarga.nik')
            ->where('user.user_id', $user_id)
            ->first(); 
        $no_kk = $nokk_user->no_kk;
    
        $dataBalita = AnggotaKeluargaModel::select(
            'anggota_keluarga.nama', 
            'anggota_keluarga.nik'
            ,'anggota_keluarga.no_kk','anggota_keluarga.jk','anggota_keluarga.tanggal_lahir',
            DB::raw('TIMESTAMPDIFF(MONTH, anggota_keluarga.tanggal_lahir, CURDATE()) as usia')
        )                ->where('anggota_keluarga.no_kk', '=', $no_kk)
                         ->where('anggota_keluarga.status', '=', 'anak')
            ->get();


        return view('user.dataBalitaUser.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'dataBalita' => $dataBalita,
            'activeMenu' => $activeMenu
        ]);}


        public function list(Request $request)
{
    $user_id = Auth::guard('user')->user()->user_id;

    // Mengambil data no_kk dari user
    $nokk_user = UserModel::select('anggota_keluarga.no_kk')
        ->join('anggota_keluarga', 'user.nik', '=', 'anggota_keluarga.nik')
        ->where('user.user_id', $user_id)
        ->first(); 
    $no_kk = $nokk_user->no_kk;

    $query = AnggotaKeluargaModel::select(
        'anggota_keluarga.nama', 
        'anggota_keluarga.nik',
        'anggota_keluarga.no_kk',
        'anggota_keluarga.jk',
        'anggota_keluarga.tanggal_lahir',
        DB::raw('TIMESTAMPDIFF(MONTH, anggota_keluarga.tanggal_lahir, CURDATE()) as usia')
    )->where('anggota_keluarga.no_kk', $no_kk)
    ->where('anggota_keluarga.status', '=', 'anak');

    if ($request->nama) {
        $query->where('anggota_keluarga.nama', $request->nama );
    }

    $dataBalita = $query->get();

    return DataTables::of($dataBalita)
        ->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
        ->addColumn('aksi', function ($row) { // menambahkan kolom aksi
            $btn = '<a href="' . url('user/dataPemeriksaanBalita') . '" class="btn btn-info btn-sm">Detail Imunisasi</a>';
            return $btn;
        })
        ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
        ->make(true);
}

        
        
        
        //     public function show(String $hasil_id)
        // {
        //     $user_id = Auth::guard('user')->user()->user_id;
        
        //     // Mengambil data no_kk dari user
        //     $nokk_user = UserModel::select('anggota_keluarga.no_kk')
        //         ->join('anggota_keluarga', 'user.nik', '=', 'anggota_keluarga.nik')
        //         ->where('user.user_id', $user_id)
        //         ->first(); 
        //     $no_kk = $nokk_user->no_kk;
        //     $balita = HasilPemeriksaanModel::select(
        //         'hasil_pemeriksaan.hasil_id', 'admin.admin_id', 
        //         'pemeriksaan.pemeriksaan_id', 'hasil_pemeriksaan.catatan', 'anggota_keluarga.nama', 
        //         'admin.nama_admin', 'pemeriksaan.tanggal', 'anggota_keluarga.nik', 'pemeriksaan.agenda', 
        //         'hasil_pemeriksaan.riwayat_penyakit','hasil_pemeriksaan.berat_badan','hasil_pemeriksaan.tinggi_badan'
        //         ,'hasil_pemeriksaan.riwayat_penyakit'
        //     )
            
        //     ->join('anggota_keluarga', 'hasil_pemeriksaan.nik', '=', 'anggota_keluarga.nik')
        //     ->join('admin', 'hasil_pemeriksaan.admin_id', '=', 'admin.admin_id')
        //     ->join('pemeriksaan', 'hasil_pemeriksaan.pemeriksaan_id', '=', 'pemeriksaan.pemeriksaan_id')
        //         ->where('anggota_keluarga.no_kk', '=', $no_kk)
        //         ->where('hasil_pemeriksaan.hasil_id', $hasil_id)
        //         ->get();
        
        //     if (!$balita) {
        //         return redirect('user/dataBalitaUser')->with('error', 'Data yang Anda cari tidak ditemukan.');
        //     }
        
        //     $breadcrumb = (object) [
        //         'title' => 'Detail Data Pemeriksaan Balita',
        //         'list' => ['Home', 'Data Pemeriksaan Balita', 'Detail']
        //     ];
        
        //     $page = (object) [
        //         'title' => 'Detail Data Pemeriksaan Balita'
        //     ];
        
        //     $activeMenu = 'dataBalitaUser';
        
        //     return view('user.dataPemeriksaanBalitaUser.show', [
        //         'breadcrumb' => $breadcrumb,
        //         'page' => $page,
        //         'balita' => $balita,
        //         'activeMenu' => $activeMenu
        //     ]);
        // }
        
        }
    
