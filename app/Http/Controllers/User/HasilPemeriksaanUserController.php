<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\HasilPemeriksaanModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class HasilPemeriksaanUserController extends Controller
{
    public function index()
    {
        if (Auth::guard('user')->check()) {
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
                ->where('anggota_keluarga.no_kk', '=', $no_kk)->where('hasil_pemeriksaan.status', '=', 'Selesai')
                ->get();

            return view('user.dataPemeriksaanBalitaUser.index', [
                'breadcrumb' => $breadcrumb,
                'page' => $page,
                'hasil_pemeriksaan' => $hasil_pemeriksaan,
                'activeMenu' => $activeMenu
            ]);
        } else {
            return redirect('/login')->with('error', 'Session Anda sudah habis, silahkan login kembali');
        }
    }

    public function list(Request $request)
    {
        if (Auth::guard('user')->check()) {
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
                ->where('anggota_keluarga.no_kk', '=', $no_kk)->where('hasil_pemeriksaan.status', '=', 'Selesai');

            if ($request->tanggal) {
                $hasil_pemeriksaan->where('pemeriksaan.tanggal', $request->tanggal);
            }

            return DataTables::of($hasil_pemeriksaan)
                ->addIndexColumn()
                ->addColumn('aksi', function ($hasil_pemeriksaan) {
                    $btn = '<a href="' . url('user/dataPemeriksaanBalita/' . $hasil_pemeriksaan->hasil_id) . '" class="btn btn-info btn-sm">Detail</a> ';
                    return $btn;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        } else {
            return redirect('/login')->with('error', 'Session Anda sudah habis, silahkan login kembali');
        }
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

    public function getChartData(Request $request)
    {
        if (Auth::guard('user')->check()) {
            $user_id = Auth::guard('user')->user()->user_id;

            // Mengambil data no_kk dari user
            $nokk_user = UserModel::select('anggota_keluarga.no_kk')
                ->join('anggota_keluarga', 'user.nik', '=', 'anggota_keluarga.nik')
                ->where('user.user_id', $user_id)
                ->first();
            $no_kk = $nokk_user->no_kk;

            // Mengambil data pemeriksaan balita berdasarkan no_kk
            $query = DB::table('hasil_pemeriksaan')
                ->join('anggota_keluarga', 'hasil_pemeriksaan.nik', '=', 'anggota_keluarga.nik')
                ->select('hasil_pemeriksaan.pemeriksaan_id', 'anggota_keluarga.nama', 'hasil_pemeriksaan.tinggi_badan', DB::raw('AVG(hasil_pemeriksaan.berat_badan) as avg_berat'))
                ->where('anggota_keluarga.no_kk', $no_kk)
                ->groupBy('hasil_pemeriksaan.pemeriksaan_id', 'anggota_keluarga.nama', 'hasil_pemeriksaan.tinggi_badan')
                ->orderBy('hasil_pemeriksaan.pemeriksaan_id');

            if ($request->has('nama_balita')) {
                $query->where('anggota_keluarga.nama', $request->nama_balita);
            }

            $data = $query->get();

            // Mengelompokkan data berdasarkan nama balita
            $chartData = [];
            foreach ($data as $item) {
                $chartData[$item->nama]['labels'][] = $item->pemeriksaan_id;
                $chartData[$item->nama]['data'][] = $item->avg_berat;
            }

            // Kirimkan data dalam format JSON
            return response()->json($chartData);
        } else {
            return redirect('/login')->with('error', 'Session Anda sudah habis, silahkan login kembali');
        }
    }
    public function getBalitaNames()
    {
        if (Auth::guard('user')->check()) {
            $user_id = Auth::guard('user')->user()->user_id;

            // Mengambil data no_kk dari user
            $nokk_user = UserModel::select('anggota_keluarga.no_kk')
                ->join('anggota_keluarga', 'user.nik', '=', 'anggota_keluarga.nik')
                ->where('user.user_id', $user_id)
                ->first();
            $no_kk = $nokk_user->no_kk;

            // Mengambil daftar nama balita berdasarkan no_kk
            $balitaNames = DB::table('anggota_keluarga')
                ->where('anggota_keluarga.no_kk', $no_kk)
                ->pluck('nama');

            return response()->json($balitaNames);
        } else {
            return redirect('/login')->with('error', 'Session Anda sudah habis, silahkan login kembali');
        }
    }

}
