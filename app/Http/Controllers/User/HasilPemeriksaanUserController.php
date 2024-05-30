<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\AnggotaKeluargaModel;
use App\Models\HasilPemeriksaanModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HasilPemeriksaanUserController extends Controller
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
                'hasil_pemeriksaan.hasil_id', 'admin.admin_id', 
                'pemeriksaan.pemeriksaan_id', 'hasil_pemeriksaan.catatan', 'anggota_keluarga.nama', 
                'admin.nama_admin', 'pemeriksaan.tanggal', 'anggota_keluarga.no_kk'
            )
            ->join('anggota_keluarga', 'hasil_pemeriksaan.nik', '=', 'anggota_keluarga.nik')
            ->join('admin', 'hasil_pemeriksaan.admin_id', '=', 'admin.admin_id')
            ->join('pemeriksaan', 'hasil_pemeriksaan.pemeriksaan_id', '=', 'pemeriksaan.pemeriksaan_id')
            ->where('anggota_keluarga.no_kk', '=', $no_kk)->where('hasil_pemeriksaan.status','=','Selesai')
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
                'hasil_pemeriksaan.hasil_id', 'admin.admin_id', 
                'pemeriksaan.pemeriksaan_id', 'hasil_pemeriksaan.catatan', 'anggota_keluarga.nama', 
                'admin.nama_admin', 'pemeriksaan.tanggal', 'anggota_keluarga.no_kk'
            )
            ->join('anggota_keluarga', 'hasil_pemeriksaan.nik', '=', 'anggota_keluarga.nik')
            ->join('admin', 'hasil_pemeriksaan.admin_id', '=', 'admin.admin_id')
            ->join('pemeriksaan', 'hasil_pemeriksaan.pemeriksaan_id', '=', 'pemeriksaan.pemeriksaan_id')
            ->where('anggota_keluarga.no_kk', '=', $no_kk)->where('hasil_pemeriksaan.status','=','Selesai')
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
        ->join('anggota_keluarga', 'hasil_pemeriksaan.nik', '=', 'anggota_keluarga.nik')
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
    public function getChartData()
    {
    //     $user_id = Auth::guard('user')->user()->user_id;

    // // Mengambil data no_kk dari user
    // $nokk_user = UserModel::select('anggota_keluarga.no_kk')
    //     ->join('anggota_keluarga', 'user.nik', '=', 'anggota_keluarga.nik')
    //     ->where('user.user_id', $user_id)
    //     ->first(); 
    // $no_kk = $nokk_user->no_kk;

    //     $query = AnggotaKeluargaModel::select(
    //         'anggota_keluarga.nama', 
    //         'anggota_keluarga.nik',
    //         'anggota_keluarga.no_kk',
    //         'anggota_keluarga.jk',
    //         'anggota_keluarga.tanggal_lahir',
    //         DB::raw('TIMESTAMPDIFF(MONTH, anggota_keluarga.tanggal_lahir, CURDATE()) as usia')
    //     )->where('anggota_keluarga.no_kk', $no_kk)
    //     ->where('anggota_keluarga.status', '=', 'anak')
    //     ->get();


        
    //     $id = $query->first();

        // Ambil data tinggi badan dari database
        $data = DB::table('hasil_pemeriksaan')
                    ->select('pemeriksaan_id', 'tinggi_badan')
                    ->where('nik', '3501011111800011')
                    //->orderBy('pemeriksaan_id')
                    ->get();

        // Pisahkan hasil_id dan tinggi_badan ke dalam dua array terpisah
        $labels = $data->pluck('pemeriksaan_id');
        $heightData = $data->pluck('tinggi_badan');

        // Kirimkan data dalam format JSON
        return response()->json([
            'labels' => $labels,
            'data' => $heightData
        ]);
    }
}