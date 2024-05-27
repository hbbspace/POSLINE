<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\BalitaModel;
use App\Models\HasilPemeriksaanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class pemeriksaanBalita extends Controller
{


public function index()
{   
    $breadcrumb = (object) [
        'title' => 'Daftar Pemeriksaan Balita',
        'list' => ['Home', 'Balita']
    ];

    $page = (object) [
        'title' => 'Daftar Balita yang Terdaftar Pemeriksaan'
    ];

    $activeMenu = 'pemeriksaanBalita'; 
    $hasil_pemeriksaan = HasilPemeriksaanModel::select(
        'hasil_pemeriksaan.hasil_id', 'hasil_pemeriksaan.admin_id', 
        'pemeriksaan.pemeriksaan_id', 'anggota_keluarga.nama', 
        'pemeriksaan.tanggal', 'anggota_keluarga.tanggal_lahir', 'anggota_keluarga.jk',
        DB::raw('TIMESTAMPDIFF(MONTH, anggota_keluarga.tanggal_lahir, CURDATE()) as umur')                
    )
    
    ->join('anggota_keluarga', 'hasil_pemeriksaan.nik', '=', 'anggota_keluarga.nik')
    ->join('pemeriksaan', 'hasil_pemeriksaan.pemeriksaan_id', '=', 'pemeriksaan.pemeriksaan_id')
    ->whereNull('hasil_pemeriksaan.admin_id')->get();
    // dd($hasil_pemeriksaan);
    return view('petugas.pemeriksaanBalita.index', [
        'breadcrumb' => $breadcrumb, 
        'page' => $page,
        'hasil_pemeriksaan' => $hasil_pemeriksaan, 
        'activeMenu' => $activeMenu
    ]);
}

public function list(Request $request)
{
    $hasil_pemeriksaan = HasilPemeriksaanModel::select(
        'hasil_pemeriksaan.hasil_id', 'hasil_pemeriksaan.admin_id', 
        'pemeriksaan.pemeriksaan_id', 'anggota_keluarga.nama', 
        'pemeriksaan.tanggal', 'anggota_keluarga.tanggal_lahir', 'anggota_keluarga.jk',
        DB::raw('TIMESTAMPDIFF(MONTH, anggota_keluarga.tanggal_lahir, CURDATE()) as umur')                
    )
    
    ->join('anggota_keluarga', 'hasil_pemeriksaan.nik', '=', 'anggota_keluarga.nik')
    ->join('pemeriksaan', 'hasil_pemeriksaan.pemeriksaan_id', '=', 'pemeriksaan.pemeriksaan_id')
    ->whereNull('hasil_pemeriksaan.admin_id')->get();


    if ($request->hasil_id) {
        $hasil_pemeriksaan->where('hasil_pemeriksaan.hasil_id', $request->hasil_id);
    }

    return DataTables::of($hasil_pemeriksaan)
        ->addColumn('action', function ($hasil_pemeriksaan) {
            return 
                '<a href="' . url('petugas/pemeriksaanBalita/' . $hasil_pemeriksaan->hasil_id . '/edit') . '" class="btn btn-warning btn-sm">Input</a> ' ;
        })
        ->rawColumns(['action'])
        ->make(true);
}

public function update(Request $request, string $id)
{
    $request->validate([
        'tinggi_badan' => 'required|numeric|min:1', 
        'berat_badan' => 'required|numeric|min:1', 
        'lingkar_kepala' => 'required|numeric|min:1', 
        'riwayat_penyakit' => 'required|in:Tidak ada,Ringan,Berat', // Menyesuaikan dengan opsi yang diberikan sebelumnya
        'catatan' => 'nullable|string', // Mengubah menjadi nullable agar catatan bisa bernilai null atau kosong
        'admin_id' => 'required|min:1',
        // 'status' => 'required|in:Periksa', // Jika status adalah string
        'usia' => 'required|numeric|min:1' 
    ]);

    HasilPemeriksaanModel::find($id)->update([
        'tinggi_badan' => $request->tinggi_badan,
        'berat_badan' => $request->berat_badan,
        'lingkar_kepala' => $request->lingkar_kepala,
        'riwayat_penyakit' => $request->riwayat_penyakit,
        'catatan' => $request->catatan,
        'admin_id' => $request->admin_id,
        'status' => 'Periksa',
        'usia' => $request->usia
    ]);

    return redirect('petugas/pemeriksaanBalita')->with('success', 'Data Pemeriksaan Balita berhasil diubah');
}



    public function edit(String $hasil_id)
    {
        $umur = HasilPemeriksaanModel::select(
            DB::raw('TIMESTAMPDIFF(MONTH, anggota_keluarga.tanggal_lahir, CURDATE()) as umur')                
        )
        
        ->join('anggota_keluarga', 'hasil_pemeriksaan.nik', '=', 'anggota_keluarga.nik')
        ->where('hasil_pemeriksaan.hasil_id',$hasil_id)->get();

        // dd($umur);

        $hasil_pemeriksaan = HasilPemeriksaanModel::find($hasil_id);
        $breadcrumb = (object) [
            'title' => 'Input Data Pemeriksaan Balita',
            'list' => ['Home', 'Balita', 'Input Data']
        ];

        $page = (object) [
            'title' => 'Input Data Pemeriksaan Balita'
        ];

        $activeMenu = 'pemeriksaanBalita'; 

        return view('petugas.pemeriksaanBalita.edit', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'hasil_pemeriksaan' => $hasil_pemeriksaan,
            'umur'=>$umur,
            'activeMenu' => $activeMenu
        ]);
    }
    

}