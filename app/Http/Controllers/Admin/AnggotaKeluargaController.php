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
            'title' => 'Daftar Data Ibu',
            'list' => ['Home', 'Data Ibu']
        ];

        $page = (object) [
            'title' => 'Daftar Data Ibu yang terdaftar dalam sistem'
        ];

        $activeMenu = 'admin.dataAnggotaKeluarga';

        $anggota_keluarga = AnggotaKeluargaModel::all();
        return view('admin.dataAnggotaKeluarga.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'anggota_keluarga' => $anggota_keluarga, 'activeMenu' => $activeMenu]);
    }

    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Data Ibu',
            'list' => ['Home', 'Data Ibu', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah Data Ibu baru'
        ];

        $anggota_keluarga = AnggotaKeluargaModel::all();
                $activeMenu = 'admin.dataAnggotaKeluarga';

        return view('admin.dataAnggotaKeluarga.create', ['breadcrumb' => $breadcrumb, 
         'page' => $page, 'keluarga' => $anggota_keluarga, 'activeMenu' => $activeMenu]);
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

        return redirect('admin/dataIbu')->with('success', 'Data Data Ibu berhasil disimpan');
    }

    public function show($no_kk)
    {
        $anggota_keluarga = AnggotaKeluargaModel::with('keluarga')->find($no_kk);
        $breadcrumb = (object) [
            'title' => 'Detail Data Ibu',
            'list' => ['Home', 'Data Ibu', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail Data Ibu'
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
            'title' => 'Edit Data Ibu',
            'list' => ['Home', 'Data Ibu', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit Data Ibu'
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

        return redirect('admin/dataIbu')->with('success', 'Data Data Ibu berhasil diubah');
    }

    public function destroy($nik)
    {
        $check = AnggotaKeluargaModel::find($nik);
        if (!$check) {
            return redirect('admin/dataIbu')->with('error', 'Data Data Ibu tidak ditemukan');
        }

        try {
            AnggotaKeluargaModel::destroy($nik);
            return redirect('admin/dataIbu')->with('success', 'Data Data Ibu berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('admin/dataIbu')->with('error', 'Data Data Ibu gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }

    public function list(Request $request)
    {
        $anggota_keluargas = AnggotaKeluargaModel::select('nik', 'no_kk', 'nama', 'tanggal_lahir', 'jk', 'status')
                                ->where('status', 'ibu'); // Menambahkan kondisi status 'ibu'
    
        if ($request->no_kk) {
            $anggota_keluargas->where('no_kk', $request->no_kk);
        }
    
        return DataTables::of($anggota_keluargas)
            ->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
            ->addColumn('aksi', function ($anggota_keluarga) { // menambahkan kolom aksi
                $btn = '<a href="' . url('admin/dataIbu/' .$anggota_keluarga->nik) . '" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="' . url('admin/dataIbu/' .$anggota_keluarga->nik . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="' . url('admin/dataAnggotaKeluarga/' .$anggota_keluarga->nik) . '">'
                    . csrf_field() . method_field('DELETE') .
                    '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
                return $btn;
            })
            ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
            ->make(true);
    }
}    
