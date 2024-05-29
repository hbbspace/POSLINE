<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KeluargaModel;
use App\Models\AnggotaKeluargaModel;
use App\Models\UserModel;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class AnggotaKeluargaController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Data Orang Tua',
            'list' => ['Home', 'Data Orang Tua']
        ];

        $page = (object) [
            'title' => 'Daftar Data Orang Tua yang terdaftar dalam sistem'
        ];

        $activeMenu = 'dataAnggotaKeluarga';

        $anggota_keluarga = AnggotaKeluargaModel::all();
        return view('admin.dataAnggotaKeluarga.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'anggota_keluarga' => $anggota_keluarga, 'activeMenu' => $activeMenu]);
    }

    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Data Orang Tua',
            'list' => ['Home', 'Data Orang Tua', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah Data Orang Tua '
        ];

        $kk=KeluargaModel::all();
        $anggota_keluarga = AnggotaKeluargaModel::all();
                $activeMenu = 'dataAnggotaKeluarga';

        return view('admin.dataAnggotaKeluarga.create', ['breadcrumb' => $breadcrumb, 
         'page' => $page, 'keluarga' => $anggota_keluarga, 'kk'=>$kk, 'activeMenu' => $activeMenu]);
    }

    public function store(Request $request)
    {
        // Validasi inputan
        $request->validate([
            'no_kk' => 'required|string|min:3', // 'exists' memastikan no_kk ada di tabel referensi
            'nik' => 'required|string|min:3|unique:anggota_keluarga,nik', // 'unique' memastikan nik tidak duplikat
            'nama' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'jk' => 'required|in:L,P',
            'status' => 'required|in:Ibu'
        ]);

        if (UserModel::where('nik', $request->nik)->exists()) {
            return redirect('admin/dataUser')->with('error', 'Gagal menambah data user, NIK sudah terdaftar.');
        }else{
            // Menyimpan data ke database
            AnggotaKeluargaModel::create([
                'no_kk' => $request->no_kk,
                'nik' => $request->nik,
                'nama' => $request->nama,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jk' => $request->jk,
                'status' => $request->status
            ]);

            UserModel::create([
                'nik' => $request->nik,
                'password' => Hash::make($request->nik), // Hash password
                'username' => $request->nik
            ]);
        }
        // Redirect dengan pesan sukses
        return redirect('admin/dataIbu')->with('success', 'Data Orang Tua berhasil disimpan');
    }
    

    public function show($no_kk)
    {
        $anggota_keluarga = AnggotaKeluargaModel::with('keluarga')->find($no_kk);
        $breadcrumb = (object) [
            'title' => 'Detail Data Orang Tua',
            'list' => ['Home', 'Data Orang Tua', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail Data Orang Tua'
        ];

        $activeMenu = 'dataAnggotaKeluarga';

        return view('admin.dataAnggotaKeluarga.show', ['breadcrumb' => $breadcrumb,
         'page' => $page, 'anggota_keluarga' => $anggota_keluarga, 'activeMenu' => $activeMenu]);
    }

    public function edit($nik)
    {
        $anggota_keluarga = AnggotaKeluargaModel::find($nik);
        $keluarga = KeluargaModel::all();

        $breadcrumb = (object) [
            'title' => 'Edit Data Orang Tua',
            'list' => ['Home', 'Data Orang Tua', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit Data Orang Tua'
        ];

        $activeMenu = 'dataAnggotaKeluarga';
        return view('admin.dataAnggotaKeluarga.edit', ['breadcrumb' => $breadcrumb, 
         'page' => $page, 'anggota_keluarga' => $anggota_keluarga, 'keluarga' => $keluarga, 'activeMenu' => $activeMenu]);
    }

    public function update(Request $request, String $id)
    {
        $request->validate([
            'nama' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'jk' => 'required|in:L,P',
            'status' => 'required|in:ibu,anak',
            'no_kk' => 'required|string|min:3'
        ]);
    
        $anggota_keluarga = AnggotaKeluargaModel::find($id);
    
        if (!$anggota_keluarga) {
            return redirect('admin/dataIbu')->with('error', 'Data Orang Tua tidak ditemukan');
        }
    
        // Update anggota keluarga
        $anggota_keluarga->update([
            'nama' => $request->nama,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jk' => $request->jk,
            'status' => $request->status,
        ]);
    
        // Cek apakah no_kk ada di KeluargaModel dan update jika ditemukan
        if (KeluargaModel::where('no_kk', $request->no_kk)->exists()) {
            $anggota_keluarga->update([
                'no_kk' => $request->no_kk
            ]);
        } else {
            return redirect('admin/dataIbu')->with('error', 'No KK tidak ditemukan di database Keluarga');
        }
    
        return redirect('admin/dataIbu')->with('success', 'Data Orang Tua berhasil diubah');
    }
    
    

    public function destroy($nik)
    {
        $check = AnggotaKeluargaModel::find($nik);
        if (!$check) {
            return redirect('admin/dataIbu')->with('error', 'Data Data Orang Tua tidak ditemukan');
        }

        try {
            AnggotaKeluargaModel::destroy($nik);
            return redirect('admin/dataIbu')->with('success', 'Data Data Orang Tua berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('admin/dataIbu')->with('error', 'Data Data Orang Tua gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }

    public function list(Request $request)
    {
        $query = AnggotaKeluargaModel::where('status', 'ibu');
    
        if ($request->nama) {
            $query->where('nama', $request->nama);
        }
    
        $anggota_keluargas = $query->get();
    
        return DataTables::of($anggota_keluargas)
            ->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
            ->addColumn('aksi', function ($anggota_keluarga) { // menambahkan kolom aksi
                $btn = '<a href="' . url('admin/dataIbu/' .$anggota_keluarga->nik) . '" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="' . url('admin/dataIbu/' .$anggota_keluarga->nik . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="' . url('admin/dataIbu/' .$anggota_keluarga->nik) . '">'
                    . csrf_field() . method_field('DELETE') .
                    '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
                return $btn;
            })
            ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
            ->make(true);
    }
}    
