<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Admin\JadwalPemeriksaanController;
use App\Http\Controllers\Controller;
use App\Models\AnggotaKeluargaModel;
use App\Models\DataAcuanModel;
use App\Models\HasilPemeriksaanModel;
use App\Models\PemeriksaanModel;
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
    
        $activeMenu = 'hasilPemeriksaanBalita';
    
        // $hasil_pemeriksaan = HasilPemeriksaanModel::select(
        //     'hasil_pemeriksaan.hasil_id',
        //     'admin.admin_id',
        //     'anggota_keluarga.nik',
        //     'pemeriksaan.pemeriksaan_id',
        //     'hasil_pemeriksaan.catatan',
        //     'anggota_keluarga.nama',
        //     'admin.nama_admin',
        //     'pemeriksaan.tanggal'
        // )
        // ->join('anggota_keluarga', 'hasil_pemeriksaan.nik', '=', 'anggota_keluarga.nik')
        // ->join('admin', 'hasil_pemeriksaan.admin_id', '=', 'admin.admin_id')
        // ->join('pemeriksaan', 'hasil_pemeriksaan.pemeriksaan_id', '=', 'pemeriksaan.pemeriksaan_id')
        // ->distinct()
        // ->get();

        $hasil_pemeriksaan=PemeriksaanModel::select('tanggal')->get();
        
        
        
        // dd($hasil_pemeriksaan);
        return view('petugas.hasilPemeriksaan.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'hasil_pemeriksaan' => $hasil_pemeriksaan,
            'activeMenu' => $activeMenu
        ]);
    }
    

    public function list(Request $request)
{
    $hasil_pemeriksaan = HasilPemeriksaanModel::select(
        'hasil_pemeriksaan.hasil_id', 'admin.admin_id', 'anggota_keluarga.nik'
,         'pemeriksaan.pemeriksaan_id', 'hasil_pemeriksaan.catatan', 'anggota_keluarga.nama', 
        'admin.nama_admin', 'pemeriksaan.tanggal'
    )
    ->join('anggota_keluarga', 'hasil_pemeriksaan.nik', '=', 'anggota_keluarga.nik')
    ->join('admin', 'hasil_pemeriksaan.admin_id', '=', 'admin.admin_id')
    ->join('pemeriksaan', 'hasil_pemeriksaan.pemeriksaan_id', '=', 'pemeriksaan.pemeriksaan_id')
    ;
    
    if ($request->tanggal) {
        $hasil_pemeriksaan->where('pemeriksaan.tanggal', $request->tanggal);
    }

    return DataTables::of($hasil_pemeriksaan)
        ->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
        ->addColumn('aksi', function ($hasil_pemeriksaan) { // menambahkan kolom aksi
            $btn = '<a href="' . url('petugas/historyPemeriksaan/' . $hasil_pemeriksaan->nik) . '" class="btn btn-info btn-sm">Detail</a> ';
            // $btn .= '<a href="' . url('petugas/historyPemeriksaan/' . $hasil_pemeriksaan->hasil_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
            // $btn .= '<form class="d-inline-block" method="POST" action="' . url('petugas/historyPemeriksaan/' . $hasil_pemeriksaan->hasil_id) . '">'
            //     . csrf_field() . method_field('DELETE') .
            //     '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
            return $btn;
        })
        ->rawColumns(['aksi'])
        ->make(true);
}

    public function show(String $nik)
{
    $hasil_pemeriksaan = HasilPemeriksaanModel::select(
        'hasil_pemeriksaan.*', 'anggota_keluarga.nama', 'admin.nama_admin', 'pemeriksaan.agenda', 'pemeriksaan.tanggal'
        ,'anggota_keluarga.no_kk'
    )
    ->join('anggota_keluarga', 'hasil_pemeriksaan.nik', '=', 'anggota_keluarga.nik')
    ->join('admin', 'hasil_pemeriksaan.admin_id', '=', 'admin.admin_id')
    ->join('pemeriksaan', 'hasil_pemeriksaan.pemeriksaan_id', '=', 'pemeriksaan.pemeriksaan_id')
    ->where('hasil_pemeriksaan.nik', $nik)
    ->get();


    // $nama_ibu=AnggotaKeluargaModel::select(
    //     'anggota_keluarga.nama'
    // )
    // ->where('no_kk',$hasil_pemeriksaan->no_kk)
    // ->where('status', 'ibu')->first();
    // $namaIbu=$nama_ibu->nama;
    if (!$hasil_pemeriksaan) {
        return redirect('petugas/historyPemeriksaan')->with('error', 'Data yang Anda cari tidak ditemukan.');
    }

    $breadcrumb = (object) [
        'title' => 'Detail Data Pemeriksaan Balita',
        'list' => ['Home', 'Data Pemeriksaan Balita', 'Detail']
    ];

    $page = (object) [
        'title' => 'Detail Data Pemeriksaan Balita'
    ];
    $activeMenu = 'hasilPemeriksaanBalita';

    return view('petugas.hasilPemeriksaan.show', [
        'breadcrumb' => $breadcrumb,
        'page' => $page,
        'hasil_pemeriksaan' => $hasil_pemeriksaan,
        // 'namaIbu'=>$namaIbu,
        'activeMenu' => $activeMenu
    ]);
}

    
    public function destroy(String $hasil_id)
    {
        $check = HasilPemeriksaanModel::find($hasil_id);

        // Untuk mengecek apakah data user dengan id yang dimaksud ada atau tidak
        if (!$check) {
            return redirect('petugas/historyPemeriksaan')->with('error', 'Data tidak ditemukan');
        }

        try {
            HasilPemeriksaanModel::destroy($hasil_id);
            return redirect('petugas/historyPemeriksaan')->with('success', 'Data berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            // Jika terjadi error ketika menghapus data, redirect kembali ke halaman dengan membawa pesan error
            return redirect('petugas/historyPemeriksaan')->with('error', 'Data gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }

    public function update(Request $request, String $id)
    {

        $request->validate([
            'tinggi_badan' => 'required|numeric|min:1', 
            'berat_badan' => 'required|numeric|min:1', 
            'lingkar_kepala' => 'required|numeric|min:1', 
            'gangguan_kesehatan' => 'required|in:Tidak ada,Ringan,Sedang,Berat', // Menyesuaikan dengan opsi yang diberikan sebelumnya
            'catatan' => 'nullable|string',
            'nafsu_makan'=>'required|in:Baik,Kurang' 

        ]);

        HasilPemeriksaanModel::find($id)->update([
            'tinggi_badan' => $request->tinggi_badan,
            'berat_badan' => $request->berat_badan,
            'lingkar_kepala' => $request->lingkar_kepala,
            'gangguan_kesehatan' => $request->gangguan_kesehatan,
            'catatan' => $request->catatan,
            'nafsu_makan'=>$request->nafsu_makan

            
        ]);


        $hasil_pemeriksaan = HasilPemeriksaanModel::select('keluarga.jam_kerja', 'keluarga.pendapatan', 'anggota_keluarga.jk', 'hasil_pemeriksaan.berat_badan',
        'hasil_pemeriksaan.tinggi_badan','hasil_pemeriksaan.lingkar_kepala','hasil_pemeriksaan.usia', 'hasil_pemeriksaan.berat_badan')
        ->join('anggota_keluarga', 'anggota_keluarga.nik', '=', 'hasil_pemeriksaan.nik')
        ->join('keluarga', 'keluarga.no_kk', '=', 'anggota_keluarga.no_kk')
        ->where('hasil_pemeriksaan.hasil_id', $id)
        ->get(); 

        $firstResult = $hasil_pemeriksaan->first();

        $jk=$firstResult->jk;
        $usia=$firstResult->usia;

        $acuan=DataAcuanModel::all()->where('usia',$usia);
        $acuanFirst = $acuan->first();
        if($jk=='L'){
            $Malnutrisi=($firstResult->berat_badan-$acuanFirst->BB_L)+($firstResult->lingkar_badan-$acuanFirst->LB_L);

            if($Malnutrisi >= 0){
                $nilaiMalnutrisi = 'Rendah';
            }else if($Malnutrisi >= -3){
                $nilaiMalnutrisi = 'Sedang';
            }else{
                $nilaiMalnutrisi = 'Tinggi';
            }

            if($firstResult->tinggi_badan >= $acuanFirst->TB_L){
                $nilaiStunting = 'Tidak';
            }else if($firstResult->tinggi_badan >= $acuanFirst->TB_L - 2){
                $nilaiStunting = 'Rendah';
            }else if($firstResult->tinggi_badan >= $acuanFirst->TB_L - 5){
                $nilaiStunting = 'Sedang';
            }else{
                $nilaiStunting = 'Tinggi';
            }

        }else if($jk=='P'){
            $Malnutrisi=($firstResult->berat_badan-$acuanFirst->BB_P)+($firstResult->lingkar_badan-$acuanFirst->LB_P);

            if($Malnutrisi >= 0){
                $nilaiMalnutrisi = 'Rendah';
            }else if($Malnutrisi >= -3){
                $nilaiMalnutrisi = 'Sedang';
            }else{
                $nilaiMalnutrisi = 'Tinggi';
            }

            if($firstResult->tinggi_badan >= $acuanFirst->TB_P){
                $nilaiStunting = 'Tidak';
            }else if($firstResult->tinggi_badan >= $acuanFirst->TB_P - 2){
                $nilaiStunting = 'Rendah';
            }else if($firstResult->tinggi_badan >= $acuanFirst->TB_P - 5){
                $nilaiStunting = 'Sedang';
            }else{
                $nilaiStunting = 'Tinggi';
            }
        }

        HasilPemeriksaanModel::find($id)->update([
            'malnutrisi' => $nilaiMalnutrisi,
            'stunting' => $nilaiStunting,
        ]);

        return redirect('petugas/historyPemeriksaan')->with('success', 'Data Pemeriksaan Balita berhasil diubah');
    }

    public function edit(String $hasil_id)
    {
        $hasil_pemeriksaan = HasilPemeriksaanModel::find($hasil_id);

        $breadcrumb = (object) [
            'title' => 'Edit Data Pemeriksaan Balita',
            'list' => ['Home', 'Balita', 'Input Data']
        ];

        $page = (object) [
            'title' => 'Edit Data Pemeriksaan Balita'
        ];

        $activeMenu = 'hasilPemeriksaanBalita';

        return view('petugas.hasilPemeriksaan.edit', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'hasil_pemeriksaan' => $hasil_pemeriksaan,
            'activeMenu' => $activeMenu
        ]);
    }
}