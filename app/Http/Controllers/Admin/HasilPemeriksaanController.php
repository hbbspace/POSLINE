<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HasilPemeriksaanModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class HasilPemeriksaanController extends Controller
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
    
        $activeMenu = 'dataPemeriksaan';
    
        $hasil_pemeriksaan = HasilPemeriksaanModel::select(
            'hasil_pemeriksaan.hasil_id', 'admin.admin_id', 
            'pemeriksaan.pemeriksaan_id', 'hasil_pemeriksaan.catatan', 'anggota_keluarga.nama', 
            'admin.nama_admin', 'pemeriksaan.tanggal'
        )
        
        ->join('anggota_keluarga', 'anggota_keluarga.nik', '=', 'hasil_pemeriksaan.nik')
        ->join('admin', 'hasil_pemeriksaan.admin_id', '=', 'admin.admin_id')
        ->join('pemeriksaan', 'hasil_pemeriksaan.pemeriksaan_id', '=', 'pemeriksaan.pemeriksaan_id')
        ;
        
        // $hasil_pemeriksaan=HasilPemeriksaanModel::all();
        // dd($hasil_pemeriksaan);
        return view('admin.dataPemeriksaan.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'hasil_pemeriksaan' => $hasil_pemeriksaan,
            'activeMenu' => $activeMenu
        ]);
    }
    
    
    // public function list(Request $request)
    // {
    //     $hasil_pemeriksaan = HasilPemeriksaanModel::select(
    //         'hasil_id', 'balita_id', 'admin_id', 'pemeriksaan_id', 
    //          'catatan'
    //     );
    
    //     if ($request->hasil_id) {
    //         $hasil_pemeriksaan->where('hasil_id', $request->hasil_id);
    //     }
    
    //     return DataTables::of($hasil_pemeriksaan)
    //         ->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
    //         ->addColumn('aksi', function ($hasil_pemeriksaan) { // menambahkan kolom aksi
    //             $btn = '<a href="' . url('admin/dataPemeriksaan/' .$hasil_pemeriksaan->hasil_id) . '" class="btn btn-info btn-sm">Detail</a> ';
    //             $btn .= '<form class="d-inline-block" method="POST" action="' . url('admin/dataPemeriksaan/' .$hasil_pemeriksaan->hasil_id) . '">'
    //                 . csrf_field() . method_field('DELETE') .
    //                 '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
    //             return $btn;
    //         })
    //         ->rawColumns(['aksi'])
    //         ->make(true);
    // }

    public function list(Request $request)
{
    $hasil_pemeriksaan = HasilPemeriksaanModel::select(
        'hasil_pemeriksaan.hasil_id', 'admin.admin_id', 
        'pemeriksaan.pemeriksaan_id', 'hasil_pemeriksaan.catatan', 'anggota_keluarga.nama', 
        'admin.nama_admin', 'pemeriksaan.tanggal'
    )
    
    ->join('anggota_keluarga', 'hasil_pemeriksaan.nik', '=', 'anggota_keluarga.nik')
    ->join('admin', 'hasil_pemeriksaan.admin_id', '=', 'admin.admin_id')
    ->join('pemeriksaan', 'hasil_pemeriksaan.pemeriksaan_id', '=', 'pemeriksaan.pemeriksaan_id')
    ;
    
    if ($request->hasil_id) {
        $hasil_pemeriksaan->where('hasil_pemeriksaan.hasil_id', $request->hasil_id);
    }

    return DataTables::of($hasil_pemeriksaan)
        ->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
        ->addColumn('aksi', function ($hasil_pemeriksaan) { // menambahkan kolom aksi
            $btn = '<a href="' . url('admin/dataPemeriksaan/' . $hasil_pemeriksaan->hasil_id) . '" class="btn btn-info btn-sm">Detail</a> ';
            $btn .= '<form class="d-inline-block" method="POST" action="' . url('admin/dataPemeriksaan/' . $hasil_pemeriksaan->hasil_id) . '">'
                . csrf_field() . method_field('DELETE') .
                '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
            return $btn;
        })
        ->rawColumns(['aksi'])
        ->make(true);
}


    // public function show(String $hasil_id)
    // {
    //     $hasil_pemeriksaan = HasilPemeriksaanModel::find($hasil_id);
    //     $breadcrumb = (object) [
    //         'title' => 'Detail Data Pemeriksaan Balita',
    //         'list' => ['Home', 'Data Pemeriksaan Balita', 'Detail']
    //     ];

    //     $page = (object) [
    //         'title' => 'Detail Data Pemeriksaan Balita'
    //     ];

    //     $activeMenu = 'admin.dataPemeriksaan';

    //     return view('admin.dataPemeriksaan.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'hasil_pemeriksaan' => $hasil_pemeriksaan, 'activeMenu' => $activeMenu]);
    // }

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
        return redirect('admin/dataPemeriksaan')->with('error', 'Data yang Anda cari tidak ditemukan.');
    }

    $breadcrumb = (object) [
        'title' => 'Detail Data Pemeriksaan Balita',
        'list' => ['Home', 'Data Pemeriksaan Balita', 'Detail']
    ];

    $page = (object) [
        'title' => 'Detail Data Pemeriksaan Balita'
    ];

    $activeMenu = 'dataPemeriksaan';

    return view('admin.dataPemeriksaan.show', [
        'breadcrumb' => $breadcrumb,
        'page' => $page,
        'hasil_pemeriksaan' => $hasil_pemeriksaan,
        'activeMenu' => $activeMenu
    ]);
}


    
    public function destroy(String $hasil_id)
    {
        $check = HasilPemeriksaanModel::find($hasil_id);

        // Untuk mengecek apakah data user dengan id yang dimaksud ada atau tidak
        if (!$check) {
            return redirect('admin/hasilPemeriksaan')->with('error', 'Data Admin tidak ditemukan');
        }

        try {
            HasilPemeriksaanModel::destroy($hasil_id);
            return redirect('admin/hasilPemeriksaan')->with('success', 'Data Admin berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            // Jika terjadi error ketika menghapus data, redirect kembali ke halaman dengan membawa pesan error
            return redirect('admin/hasilPemeriksaan')->with('error', 'Data Admin gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
}