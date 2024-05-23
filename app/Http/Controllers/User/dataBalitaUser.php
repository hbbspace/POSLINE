<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\BalitaModel;
use App\Models\HasilPemeriksaanModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class dataBalitaUser extends Controller
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
    
        // Mengambil data balita dengan count pemeriksaan
        $dataBalita = BalitaModel::select(
                'balita_id', 
                'balita.nik',
                'anggota_keluarga.nama', 
                'anggota_keluarga.no_kk',
                'anggota_keluarga.tanggal_lahir',
                // DB::raw('COUNT(hasil_pemeriksaan.pemeriksaan_id) as jumlah_pemeriksaan')
            )
            ->join('anggota_keluarga', 'balita.nik', '=', 'anggota_keluarga.nik')
            ->where('anggota_keluarga.no_kk', '=', $no_kk)
            // ->groupBy(
            //     'hasil_pemeriksaan.hasil_id', 
            //     'balita.balita_id', 
            //     'pemeriksaan.pemeriksaan_id',  
            //     'anggota_keluarga.nama', 
            //     'anggota_keluarga.no_kk'
            // )
            ->get();


        return view('user.dataBalitaUser.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'dataBalita' => $dataBalita,
            'activeMenu' => $activeMenu
        ]);}


        public function list()
        {
            $user_id = Auth::guard('user')->user()->user_id;
        
            // Mengambil data no_kk dari user
            $nokk_user = UserModel::select('anggota_keluarga.no_kk')
                ->join('anggota_keluarga', 'user.nik', '=', 'anggota_keluarga.nik')
                ->where('user.user_id', $user_id)
                ->first(); 
            $no_kk = $nokk_user->no_kk;
        
            // Mengambil data balita dengan umur
            $dataBalita = BalitaModel::select(
                    'balita.balita_id', 
                    'balita.nik',
                    'anggota_keluarga.nama', 
                    'anggota_keluarga.no_kk',
                    'anggota_keluarga.jk',
                    'anggota_keluarga.tanggal_lahir',
                    DB::raw('TIMESTAMPDIFF(MONTH, anggota_keluarga.tanggal_lahir, CURDATE()) as umur')                )
                ->join('anggota_keluarga', 'balita.nik', '=', 'anggota_keluarga.nik')
                ->where('anggota_keluarga.no_kk', '=', $no_kk)
                ->get();
        
            return DataTables::of($dataBalita)
                ->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
                ->addColumn('aksi', function ($row) { // menambahkan kolom aksi
                    $btn = '<a href="' . url('user/dataPemeriksaanBalita/' . $row->balita_id) . '" class="btn btn-info btn-sm">Detail Imunisasi</a>';
                    return $btn;
                })
                ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
                ->make(true);
        }
        
        
        
            public function show(String $balita_id)
        {
            $balita = BalitaModel::select(
                'balita.*', 'anggota_keluarga.nama', 'admin.nama_admin', 'pemeriksaan.agenda', 'pemeriksaan.tanggal'
            )
            ->join('anggota_keluarga', 'balita.nik', '=', 'anggota_keluarga.nik')
            ->join('admin', 'hasil_pemeriksaan.admin_id', '=', 'admin.admin_id')
            ->join('pemeriksaan', 'hasil_pemeriksaan.pemeriksaan_id', '=', 'pemeriksaan.pemeriksaan_id')
            ->where('balita.balita_id', $balita_id)
            ->first();
        
            if (!$balita) {
                return redirect('user/dataBalitaUser')->with('error', 'Data yang Anda cari tidak ditemukan.');
            }
        
            $breadcrumb = (object) [
                'title' => 'Detail Data Pemeriksaan Balita',
                'list' => ['Home', 'Data Pemeriksaan Balita', 'Detail']
            ];
        
            $page = (object) [
                'title' => 'Detail Data Pemeriksaan Balita'
            ];
        
            $activeMenu = 'user.dataPemeriksaan';
        
            return view('user.dataPemeriksaanBalitaUser.show', [
                'breadcrumb' => $breadcrumb,
                'page' => $page,
                'balita' => $balita,
                'activeMenu' => $activeMenu
            ]);
        }
        
        }
    
