<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KeluargaModel;
use App\Models\AnggotaKeluargaModel;
use Yajra\DataTables\Facades\DataTables;

class AnggotaKeluargaController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Anggota Keluarga',
            'list' => ['Home', 'Anggota Keluarga']
        ];

        $page = (object) [
            'title' => 'Daftar Anggota Keluarga yang terdaftar dalam sistem'
        ];

        $activeMenu = 'admin.dataAnggotaKeluarga';

        $anggota_keluarga = AnggotaKeluargaModel::all();
        return view('admin.dataAnggotaKeluarga.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'anggota_keluarga' => $anggota_keluarga, 'activeMenu' => $activeMenu]);
    }

    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Anggota Keluarga',
            'list' => ['Home', 'Anggota Keluarga', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah Anggota Keluarga baru'
        ];

        $keluarga = KeluargaModel::all();
        $activeMenu = 'admin.dataAnggotaKeluarga';

        return view('admin.dataAnggotaKeluarga.create', ['breadcrumb' => $breadcrumb, 
         'page' => $page, 'keluarga' => $keluarga, 'activeMenu' => $activeMenu]);
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

        return redirect('/dataAnggotaKeluarga')->with('success', 'Data anggota keluarga berhasil disimpan');
    }

    public function show($no_kk)
    {
        $anggota_keluarga = AnggotaKeluargaModel::with('keluarga')->find($no_kk);
        $breadcrumb = (object) [
            'title' => 'Detail Anggota Keluarga',
            'list' => ['Home', 'Anggota Keluarga', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail Anggota Keluarga'
        ];

        $activeMenu = 'admin.dataAnggotaKeluarga';

        return view('admin.dataAnggotaKeluarga.show', ['breadcrumb' => $breadcrumb,
         'page' => $page, 'anggota_keluarga' => $anggota_keluarga, 'activeMenu' => $activeMenu]);
    }

    public function edit($nik)
    {
        $anggota_keluarga = AnggotaKeluargaModel::find($nik);
        $keluarga = KeluargaModel::all();

        $breadcrumb = (object) [
            'title' => 'Edit Anggota Keluarga',
            'list' => ['Home', 'Anggota Keluarga', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit Anggota Keluarga'
        ];

        $activeMenu = 'admin.dataAnggotaKeluarga';

        return view('admin.dataAnggotaKeluarga.edit', ['breadcrumb' => $breadcrumb, 
         'page' => $page, 'anggota_keluarga' => $anggota_keluarga, 'keluarga' => $keluarga, 'activeMenu' => $activeMenu]);
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

        return redirect('/dataAnggotaKeluarga')->with('success', 'Data Anggota Keluarga berhasil diubah');
    }

    public function destroy($nik)
    {
        $check = AnggotaKeluargaModel::find($nik);
        if (!$check) {
            return redirect('/dataAnggotaKeluarga')->with('error', 'Data Anggota Keluarga tidak ditemukan');
        }

        try {
            AnggotaKeluargaModel::destroy($nik);
            return redirect('/dataAnggotaKeluarga')->with('success', 'Data Anggota Keluarga berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/dataAnggotaKeluarga')->with('error', 'Data Anggota Keluarga gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }

    public function list(Request $request)
    {
        $anggota_keluargas = AnggotaKeluargaModel::select('nik', 'no_kk', 'nama', 'tanggal_lahir', 'jk', 'status')->with('keluarga');

        if ($request->no_kk) {
            $anggota_keluargas->where('no_kk', $request->no_kk);
        }

        return DataTables::of($anggota_keluargas)
            ->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
            ->addColumn('aksi', function ($anggota_keluarga) { // menambahkan kolom aksi
                $btn = '<a href="'.route('admin.dataAnggotaKeluarga.show', $anggota_keluarga->nik).'" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="'.route('admin.dataAnggotaKeluarga.edit', $anggota_keluarga->nik).'" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="'. route('admin.dataAnggotaKeluarga.destroy', $anggota_keluarga->nik).'">'. csrf_field() . method_field('DELETE') .
                    '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
                return $btn;
            })
            ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
            ->make(true);
    }
}
