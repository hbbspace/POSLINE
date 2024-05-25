<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use App\Models\KeluargaModel;
use App\Models\AnggotaKeluargaModel;
use App\Models\BalitaModel;
use App\Models\KeluargaModel;
use Yajra\DataTables\Facades\DataTables;

class DataAnakController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Anak',
            'list' => ['Home', 'Anak']
        ];

        $page = (object) [
            'title' => 'Daftar Anak yang terdaftar dalam sistem'
        ];

        $activeMenu = 'dataAnak';

        $anggota_keluarga = AnggotaKeluargaModel::all();
        return view('admin.dataAnak.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'anggota_keluarga' => $anggota_keluarga, 'activeMenu' => $activeMenu]);
    }

    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Anak',
            'list' => ['Home', 'Anak', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah Anak baru'
        ];

        $kk=KeluargaModel::all();
        $anggota_keluarga = AnggotaKeluargaModel::all();
        $activeMenu = 'dataAnak';

        return view('admin.dataAnak.create', ['breadcrumb' => $breadcrumb, 
         'page' => $page, 'keluarga' => $anggota_keluarga, 'kk'=>$kk, 'activeMenu' => $activeMenu]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'no_kk' => 'required|string|min:3', // 'exists' memastikan no_kk ada di tabel referensi
            'nik' => 'required|string|min:3|unique:anggota_keluarga,nik', // 'unique' memastikan nik tidak duplikat
            'nama' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'jk' => 'required|in:L,P',
            'status' => 'required|in:Anak'
        ]);
    
        // Tambahkan data anak baru ke tabel anggota_keluarga
        $newAnak = AnggotaKeluargaModel::create([
            'no_kk' => $request->no_kk,
            'nik' => $request->nik,
            'nama' => $request->nama,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jk' => $request->jk,
            'status' => $request->status
        ]);
    
        // Buat entri baru di tabel balita menggunakan nik anak yang baru saja dibuat
        BalitaModel::create([
            'nik' => $request->nik,
            // Tambahkan atribut lain yang diperlukan di sini
        ]);
    
        return redirect('admin/dataAnak')->with('success', 'Data Anak berhasil disimpan');
    }
    

    public function show($no_kk)
    {
        $anggota_keluarga = AnggotaKeluargaModel::with('keluarga')->find($no_kk);
        $breadcrumb = (object) [
            'title' => 'Detail Anak',
            'list' => ['Home', 'Anak', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail Anak'
        ];

        $activeMenu = 'dataAnak';

        return view('admin.dataAnak.show', ['breadcrumb' => $breadcrumb,
         'page' => $page, 'anggota_keluarga' => $anggota_keluarga, 'activeMenu' => $activeMenu]);
    }

    public function edit($nik)
    {
        $anggota_keluarga = AnggotaKeluargaModel::find($nik);

        $breadcrumb = (object) [
            'title' => 'Edit Anak',
            'list' => ['Home', 'Anak', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit Anak'
        ];

        $activeMenu = 'dataAnak';

        return view('admin.dataAnak.edit', ['breadcrumb' => $breadcrumb, 
         'page' => $page, 'anggota_keluarga' => $anggota_keluarga, 'activeMenu' => $activeMenu]);
    }

    public function update(Request $request, String $id)
    {
        $request->validate([
            'nama' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'jk' => 'required|in:L,P',
            'status' => 'required|in:anak',
            'no_kk' => 'required|string|min:3'
        ]);
    
        $anggota_keluarga = AnggotaKeluargaModel::find( $id);
    
        if (!$anggota_keluarga) {
            return redirect('admin/dataAnak')->with('error', 'Data Anak tidak ditemukan');
        }
        $anggota_keluarga->tanggal_lahir = $request->tanggal_lahir;
        $anggota_keluarga->no_kk = $request->no_kk;
        $anggota_keluarga->jk = $request->jk;
        $anggota_keluarga->nama = $request->nama;
        $anggota_keluarga->status = $request->status;

        $anggota_keluarga->save();

        // $anggota_keluarga->update([
        //     'nama' => $request->nama,
        //     'tanggal_lahir' => $request->tanggal_lahir,
        //     'jk' => $request->jk,
        //     'status' => $request->status,
        //     'no_kk' => $request->no_kk
        // ]);
    
        return redirect('admin/dataAnak')->with('success', 'Data Ibu berhasil diubah');
    }

    public function destroy($nik)
    {
        $check = AnggotaKeluargaModel::find($nik);
        if (!$check) {
            return redirect('admin/dataAnak')->with('error', 'Data Anak tidak ditemukan');
        }

        try {
            AnggotaKeluargaModel::destroy($nik);
            return redirect('admin/dataAnak')->with('success', 'Data Anak berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('admin/dataAnak')->with('error', 'Data Anak gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }

    public function list(Request $request)
    {
        $anggota_keluargas = AnggotaKeluargaModel::select('nik', 'no_kk', 'nama', 'tanggal_lahir', 'jk', 'status')
                                ->where('status', 'anak'); // Menambahkan kondisi status 'ibu'
        if ($request->no_kk) {
            $anggota_keluargas->where('no_kk', $request->no_kk);
        }
    
        return DataTables::of($anggota_keluargas)
            ->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
            ->addColumn('aksi', function ($anggota_keluarga) { // menambahkan kolom aksi
                $btn = '<a href="' . url('admin/dataAnak/' .$anggota_keluarga->nik) . '" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="' . url('admin/dataAnak/' .$anggota_keluarga->nik . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="' . url('admin/dataAnak/' .$anggota_keluarga->nik) . '">'
                    . csrf_field() . method_field('DELETE') .
                    '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
                return $btn;
                // $btn = '<a href="'.route('admin.dataAnak.show', $anggota_keluarga->nik).'" class="btn btn-info btn-sm">Detail</a> ';
                // $btn .= '<a href="'.route('admin.dataAnak.edit', $anggota_keluarga->nik).'" class="btn btn-warning btn-sm">Edit</a> ';
                // $btn .= '<form class="d-inline-block" method="POST" action="'. route('admin.dataAnak.destroy', $anggota_keluarga->nik).'">'. csrf_field() . method_field('DELETE') .
                //     '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
                // return $btn;
            })
            ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
            ->make(true);
    }
}    
