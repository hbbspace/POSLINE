<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\HasilPemeriksaanModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class hasilPemeriksaan extends Controller
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
    
        $hasil_pemeriksaan = HasilPemeriksaanModel::select(
            'hasil_pemeriksaan.hasil_id', 'balita.balita_id', 'admin.admin_id', 
            'pemeriksaan.pemeriksaan_id', 'hasil_pemeriksaan.catatan', 'anggota_keluarga.nama', 
            'admin.nama_admin', 'pemeriksaan.tanggal'
        )
        ->join('balita', 'hasil_pemeriksaan.balita_id', '=', 'balita.balita_id')
        ->join('anggota_keluarga', 'balita.nik', '=', 'anggota_keluarga.nik')
        ->join('admin', 'hasil_pemeriksaan.admin_id', '=', 'admin.admin_id')
        ->join('pemeriksaan', 'hasil_pemeriksaan.pemeriksaan_id', '=', 'pemeriksaan.pemeriksaan_id')
        ;
        
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
        'hasil_pemeriksaan.hasil_id', 'balita.balita_id', 'admin.admin_id', 
        'pemeriksaan.pemeriksaan_id', 'hasil_pemeriksaan.catatan', 'anggota_keluarga.nama', 
        'admin.nama_admin', 'pemeriksaan.tanggal'
    )
    ->join('balita', 'hasil_pemeriksaan.balita_id', '=', 'balita.balita_id')
    ->join('anggota_keluarga', 'balita.nik', '=', 'anggota_keluarga.nik')
    ->join('admin', 'hasil_pemeriksaan.admin_id', '=', 'admin.admin_id')
    ->join('pemeriksaan', 'hasil_pemeriksaan.pemeriksaan_id', '=', 'pemeriksaan.pemeriksaan_id')
    ;
    
    if ($request->hasil_id) {
        $hasil_pemeriksaan->where('hasil_pemeriksaan.hasil_id', $request->hasil_id);
    }

    return DataTables::of($hasil_pemeriksaan)
        ->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
        ->addColumn('aksi', function ($hasil_pemeriksaan) { // menambahkan kolom aksi
            $btn = '<a href="' . url('petugas/historyPemeriksaan/' . $hasil_pemeriksaan->hasil_id) . '" class="btn btn-info btn-sm">Detail</a> ';
            $btn .= '<a href="' . url('petugas/historyPemeriksaan/' . $hasil_pemeriksaan->hasil_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
            $btn .= '<form class="d-inline-block" method="POST" action="' . url('petugas/historyPemeriksaan/' . $hasil_pemeriksaan->hasil_id) . '">'
                . csrf_field() . method_field('DELETE') .
                '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
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
            'nilai_kesehatan' => 'required|in:1,2,3,4,5',
            'catatan' => 'required|string|min:3', 
        ]);

        HasilPemeriksaanModel::find($id)->update([
            'tinggi_badan' => $request->tinggi_badan,
            'berat_badan' => $request->berat_badan,
            'lingkar_kepala' => $request->lingkar_kepala,
            'nilai_kesehatan' => $request->nilai_kesehatan,
            'catatan' => $request->catatan,
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