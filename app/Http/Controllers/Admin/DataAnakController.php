<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use App\Models\KeluargaModel;
use App\Models\AnggotaKeluargaModel;
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

        $activeMenu = 'admin.dataAnggotaKeluarga';

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

        $activeMenu = 'admin.dataAnak';

        return view('admin.dataAnak.create', ['breadcrumb' => $breadcrumb, 
         'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_kk' => 'required|string|min:3|unique:anggota_keluarga,no_kk',
            'nik' => 'required|string|min:3|unique:anggota_keluarga,nik',
            'nama' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'jk' => 'required|in:L,P',
            'status' => 'required|in: Ibu, Anak'
        ]);

        AnggotaKeluargaModel::create([
            'no_kk' => $request->no_kk,
            'nik' => $request->nik,
            'nama' => $request->nama,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jk' => $request->jk,
            'status' => $request->status
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

        $activeMenu = 'admin.dataAnak';

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

        $activeMenu = 'admin.dataAnak';

        return view('admin.dataAnak.edit', ['breadcrumb' => $breadcrumb, 
         'page' => $page, 'anggota_keluarga' => $anggota_keluarga, 'activeMenu' => $activeMenu]);
    }

    public function update(Request $request, $nik)
    {
        $request->validate([
            'nik' => 'required|string|min:3|unique:anggota_keluarga,nik',
            'nama' => 'required|string|max:50',
            'tanggal_lahir' => 'required|date',
            'jk' => 'required|in:L,P',
            'status' => 'required|in:ibu,anak',
            'no_kk' => 'required|string|min:3'
        ]);

        AnggotaKeluargaModel::where('nik', $nik)->update([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jk' => $request->jk,
            'status' => $request->status,
            'no_kk' => $request->no_kk
        ]);

        return redirect('admin/dataAnak')->with('success', 'Data Anak berhasil diubah');
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
