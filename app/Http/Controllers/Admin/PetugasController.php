<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PetugasController extends Controller
{

    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Petugas Posyandu',
            'list' => ['Home', 'Petugas Posyandu']
        ];

        $page = (object) [
            'title' => 'Daftar Admin yang terdaftar dalam sistem'
        ];

        $activeMenu = 'admin.dataPetugas';
        $admin = AdminModel::all();
        return view('admin.dataPetugas.index', ['breadcrumb' => $breadcrumb, 'page' => $page,
            'admin' => $admin, 'activeMenu' => $activeMenu]);
    }

    public function create()
    {
        $breadcrumb = (object)[
            'title' => 'Tambah Petugas Posyandu',
            'list' => ['Home', 'Petugas Posyandu', 'Tambah']
        ];
        $page = (object)[
            'title' => 'Tambah Kategori Barang Baru'
        ];
        $admin = AdminModel::all();
        $activeMenu = 'admin.dataPetugas';
        return view('admin.dataPetugas.create', ['admin' => $admin, 'breadcrumb' => $breadcrumb,
            'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|min:3|unique:admin,username',
            'password' => 'required|string|max:60',
            'nama_admin' => 'required|string|max:60',
            'jk' => 'required|in:L,P',
            'level' => 'required|in:1,2'
        ]);

        AdminModel::create([
            'username' => $request->username,
            'password' => $request->password,
            'nama_admin' => $request->nama_admin,
            'jk' => $request->jk,
            'level' => $request->level
        ]);

        return redirect('admin/dataPetugas')->with('success', 'Data Petugas Posyandu berhasil disimpan');
    }

    public function list(Request $request)
    {
        $admin = AdminModel::select('admin_id', 'username', 'nama_admin', 'jk', 'level')
        ->where('level',2); // Exclude 'password' field

        // Filter data user berdasarkan level_id
        if ($request->admin_id) {
            $admin->where('admin_id', $request->admin_id);
        }

        return DataTables::of($admin)
            ->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
            ->addColumn('aksi', function ($admin) { // menambahkan kolom aksi
                $btn = '<a href="' . url('admin/dataPetugas/' . $admin->admin_id) . '" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="' . url('admin/dataPetugas/' . $admin->admin_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="' . url('admin/dataPetugas/' . $admin->admin_id) . '">'
                    . csrf_field() . method_field('DELETE') .
                    '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
                return $btn;
            })
            
            ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
            ->make(true);
    }

    public function show(String $admin_id)
    {
        $admin = AdminModel::find($admin_id);
        $breadcrumb = (object) [
            'title' => 'Detail Data Petugas Posyandu',
            'list' => ['Home', 'Petugas Posyandu', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail Petugas Posyandu'
        ];

        $activeMenu = 'admin.dataPetugas';

        return view('admin.dataPetugas.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'admin' => $admin, 'activeMenu' => $activeMenu]);
    }

    public function update(Request $request, String $id)
    {
        $request->validate([
            'username' => 'required|string|min:3|unique:admin,username,'.$id,
            'password' => 'required|string|max:60',
            'nama_admin' => 'required|string|max:60',
            'jk' => 'required|in:L,P',
            'level' => 'required|in:1,2',
        ]);

        AdminModel::find($id)->update([
            'username' => $request->username,
            'password' => $request->password, // Note: It's better to keep the password update optional
            'nama_admin' => $request->nama_admin,
            'jk' => $request->jk,
            'level' => $request->level
        ]);

        return redirect('admin/dataPetugas')->with('success', 'Data Petugas Posyandu berhasil diubah');
    }

    public function edit(String $id)
    {
        $admin = AdminModel::find($id);
        // $level = LevelModel::all();

        $breadcrumb = (object) [
            'title' => 'Edit Data Petugas Posyandu',
            'list' => ['Home', 'Admin', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit Data Admin'
        ];

        $activeMenu = 'admin.dataPetugas'; // set menu yang sedang aktif

        return view('admin.dataPetugas.edit', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'admin' => $admin,
            'activeMenu' => $activeMenu
        ]);
    }
    
    public function destroy(String $id)
    {
        $check = AdminModel::find($id);

        // Untuk mengecek apakah data user dengan id yang dimaksud ada atau tidak
        if (!$check) {
            return redirect('admin/dataPetugas')->with('error', 'Data  Petugas Posyandu tidak ditemukan');
        }

        try {
            AdminModel::destroy($id);
            return redirect('admin/dataPetugas')->with('success', 'Data Petugas Posyandu berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            // Jika terjadi error ketika menghapus data, redirect kembali ke halaman dengan membawa pesan error
            return redirect('admin/dataPetugas')->with('error', 'Data Petugas Posyandu gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
}