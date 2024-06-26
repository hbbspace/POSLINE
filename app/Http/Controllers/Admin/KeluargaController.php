<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AnggotaKeluargaModel;
use App\Models\HasilPemeriksaanModel;
use App\Models\KeluargaModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class KeluargaController extends Controller
{
    public function index()
    {   
        $breadcrumb = (object) [
            'title' => 'Daftar Keluarga',
            'list' => ['Home', 'Keluarga']
        ];

        $page = (object) [
            'title' => 'Daftar Keluarga yang terdaftar dalam sistem'
        ];

        $activeMenu = 'dataKeluarga'; 
        $keluarga = KeluargaModel::all();

        return view('admin.dataKeluarga.index', [
            'breadcrumb' => $breadcrumb, 
            'page' => $page,
            'keluarga' => $keluarga, 
            'activeMenu' => $activeMenu
        ]);
    }

    public function create()
    {
        $breadcrumb = (object)[
            'title' => 'Tambah Data Keluarga',
            'list' => ['Home', 'Keluarga', 'Tambah']
        ];
        $page = (object)[
            'title' => 'Tambah Data Keluarga Baru'
        ];
        $keluarga = KeluargaModel::all();
        $activeMenu = 'dataKeluarga'; 
        return view('admin.dataKeluarga.create', [
            'keluarga' => $keluarga, 
            'breadcrumb' => $breadcrumb, 
            'page' => $page, 
            'activeMenu' => $activeMenu
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_kk' => 'required|string|min:3|unique:keluarga,no_kk',
            'alamat' => 'required|string|max:100',
            'pendapatan' => 'required|numeric|min:5',
            'jam_kerja' => 'required|numeric|min:1'

        ]);

        $existingMember = KeluargaModel::where('no_kk', $request->no_kk)->first();
        if ($existingMember) {
            return redirect('admin/dataKeluarga/')->with('error', 'Tidak dapat menambahkan Nomor KK, karena Nomor KK sudah dipakai');
        }

            KeluargaModel::create([
                'no_kk' => $request->no_kk,
                'alamat' => $request->alamat,
                'pendapatan'=>$request->pendapatan,
                'jam_kerja'=>$request->jam_kerja
            ]);
        


        return redirect('admin/dataKeluarga')->with('success', 'Data keluarga berhasil disimpan');
    }

    public function list(Request $request) 
    {
        $keluargas = KeluargaModel::select('no_kk', 'alamat');

        // Filter data user berdasarkan level_id
        if ($request->no_kk) {
            $keluargas->where('no_kk', $request->no_kk);
        }

        return DataTables::of($keluargas)
            ->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
            ->addColumn('aksi', function ($keluarga) { // menambahkan kolom aksi
                $btn = '<a href="'.route('admin.dataKeluarga.show', $keluarga->no_kk).'" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="'.route('admin.dataKeluarga.edit', $keluarga->no_kk).'" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="'. route('admin.dataKeluarga.destroy', $keluarga->no_kk).'">'. csrf_field() . method_field('DELETE') .
                    '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
                return $btn;
            })
            ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
            ->make(true);
    }

    public function show($no_kk)
    {
        $keluarga = KeluargaModel::where('no_kk', $no_kk)->first();
        if (!$keluarga) {
            return redirect('admin/dataKeluarga')->with('error', 'Data keluarga tidak ditemukan');
        }

        $breadcrumb = (object) [
            'title' => 'Detail Data Keluarga',
            'list' => ['Home', 'Keluarga', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail Keluarga'
        ];

        $activeMenu = 'dataKeluarga'; 

        return view('admin.dataKeluarga.show', [
            'breadcrumb' => $breadcrumb, 
            'page' => $page, 
            'keluarga' => $keluarga, 
            'activeMenu' => $activeMenu
        ]);
    }

    public function update(Request $request, String $no_kk)
    {
        $request->validate([
            'no_kk' => 'required|string|min:3',
            'alamat' => 'required|string|max:100',
            'pendapatan' => 'required|numeric|min:5',
            'jam_kerja' => 'required|numeric|min:1'

        ]);

        $keluarga = KeluargaModel::find( $no_kk);

        $anggota_keluarga=AnggotaKeluargaModel::where('no_kk',$no_kk)->get();

        if (!$keluarga) {
            return redirect('admin/dataKeluarga')->with('error', 'Data keluarga tidak ditemukan');
        }
        $existingMember = KeluargaModel::where('no_kk', $request->no_kk)->first();
        if ($existingMember && $no_kk != $request->no_kk) {
            return redirect('admin/dataKeluarga/')->with('error', 'Tidak dapat mengubah Nomor KK, karena Nomor KK sudah dipakai');
        }

        $keluarga->update([
            'no_kk' => $request->no_kk,
            'alamat' => $request->alamat,
            'pendapatan' => $request->pendapatan,
            // 'nik'=>$request->nik,
            'jam_kerja' => $request->jam_kerja,
        ]);
            // foreach ($anggota_keluarga as $anggota_keluargas){
            //     $anggota_keluargas->update([
            //         'no_kk' => $request->no_kk
            //     ]);
            // }
        


        return redirect('admin/dataKeluarga')->with('success', 'Data keluarga berhasil diubah');
    }

    public function edit($no_kk)
    {
        $keluarga = KeluargaModel::where('no_kk', $no_kk)->first();

        if (!$keluarga) {
            return redirect('admin/dataKeluarga')->with('error', 'Data keluarga tidak ditemukan');
        }

        $breadcrumb = (object) [
            'title' => 'Edit Data Keluarga',
            'list' => ['Home', 'Keluarga', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit Data Keluarga'
        ];

        $activeMenu = 'dataKeluarga'; 

        return view('admin.dataKeluarga.edit', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'keluarga' => $keluarga,
            'activeMenu' => $activeMenu
        ]);
    }

    public function destroy($no_kk)
    {
        $keluarga = KeluargaModel::where('no_kk', $no_kk)->first();

        // Jika keluarga tidak ditemukan, kembalikan pesan error
        if (!$keluarga) {
            return redirect('admin/dataKeluarga')->with('error', 'Data Keluarga tidak ditemukan');
        }
    
        $anggota_keluarga = AnggotaKeluargaModel::where('no_kk', $no_kk)->where('status', 'anak')
            ->pluck('nik')->toArray();
        $ibu = AnggotaKeluargaModel::where('no_kk', $no_kk)->where('status', 'ibu')
            ->pluck('nik')->toArray();
    
        if (!empty($ibu)) {
            HasilPemeriksaanModel::whereIn('nik', $anggota_keluarga)->delete();
            AnggotaKeluargaModel::whereIn('nik', $anggota_keluarga)->delete();
            UserModel::whereIn('nik', $ibu)->delete(); // Jika ibu juga ada di UserModel
            AnggotaKeluargaModel::whereIn('nik', $ibu)->delete();
            $keluarga->delete();
            return redirect('admin/dataKeluarga')->with('success', 'Data Keluarga, anggota keluarga, dan hasil pemeriksaan terkait berhasil dihapus');
        } else {
            $keluarga->delete();

            return redirect('admin/dataKeluarga')->with('success', 'Data Keluarga, anggota keluarga, dan hasil pemeriksaan terkait berhasil dihapus');
        }
    

        

        // try {

        //     return redirect('admin/dataKeluarga')->with('success', 'Data Keluarga, anggota keluarga, dan hasil pemeriksaan terkait berhasil dihapus');
        // } catch (\Illuminate\Database\QueryException $e) {
        //     // Jika terjadi error ketika menghapus data, redirect kembali ke halaman dengan membawa pesan error
        //     return redirect('admin/dataKeluarga')->with('error', 'Data keluarga gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        // }
    }
}