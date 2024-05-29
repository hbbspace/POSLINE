<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class DataAdminController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Admin',
            'list' => ['Home', 'Admin']
        ];

        $page = (object) [
            'title' => 'Daftar Admin yang terdaftar dalam sistem'
        ];

        $activeMenu = 'dataAdmin';
        $admin = AdminModel::all();
        return view('admin.dataAdmin.index', ['breadcrumb' => $breadcrumb, 'page' => $page,
            'admin' => $admin, 'activeMenu' => $activeMenu]);
    }

    public function create()
    {
        $breadcrumb = (object)[
            'title' => 'Tambah Admin',
            'list' => ['Home', 'Admin', 'Tambah']
        ];
        $page = (object)[
            'title' => 'Tambah Admin Baru'
        ];
        $admin = AdminModel::all();
        $activeMenu = 'dataAdmin';
        return view('admin.dataAdmin.create', ['admin' => $admin, 'breadcrumb' => $breadcrumb,
            'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|min:3',
            'password' => 'required|string|max:60',
            'nama_admin' => 'required|string|max:60',
            'jk' => 'required|in:L,P',
            'level' => 'required|in:1'
        ]);

        $existingAdmin = AdminModel::where('username', $request->username)->first();
        if ($existingAdmin && Hash::check($request->password, $existingAdmin->password)) {
            return redirect('admin/dataPetugas/create')->with('error', 'Request Tidak Tersedia, Gunakan Inputan Lain');
        }
    
        // Buat entri baru jika kombinasi tidak terpakai
        AdminModel::create([
            'username' => $request->username,
            'password' => Hash::make($request->password), // Hash password
            'nama_admin' => $request->nama_admin,
            'jk' => $request->jk,
            'level' => $request->level
        ]);

        return redirect('admin/dataAdmin')->with('success', 'Data Admin berhasil disimpan');
    }

    public function list(Request $request)
    {
        $admins = AdminModel::select('admin_id', 'username', 'nama_admin', 'jk', 'level')
        ->where('level',1); // Exclude 'password' field

        // Filter data user berdasarkan level_id
        if ($request->admin_id) {
            $admins->where('admin_id', $request->admin_id);
        }

        return DataTables::of($admins)
            ->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
            ->addColumn('aksi', function ($admin) { // menambahkan kolom aksi
                $btn = '<a href="' . url('admin/dataAdmin/' . $admin->admin_id) . '" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="' . url('admin/dataAdmin/' . $admin->admin_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                // $btn .= '<form class="d-inline-block" method="POST" action="' . url('admin/dataAdmin/' . $admin->admin_id) . '">'
                //     . csrf_field() . method_field('DELETE') .
                //     '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
                return $btn;
            })
            
            ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
            ->make(true);
    }

    public function show(String $admin_id)
    {
        $admin = AdminModel::find($admin_id);
        $breadcrumb = (object) [
            'title' => 'Detail Data Admin',
            'list' => ['Home', 'Admin', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail Admin'
        ];

        $activeMenu = 'dataAdmin';

        return view('admin.dataAdmin.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'admin' => $admin, 'activeMenu' => $activeMenu]);
    }

    public function update(Request $request, String $id)
    {
        $request->validate([
            'username' => 'required|string',
            'nama_admin' => 'required|string',
            'jk' => 'required|in:L,P',
            'level' => 'required|in:1',
        ]);
    
        // Ambil data admin yang akan diperbarui
        $admin = AdminModel::find($id);
    
        // Pengecekan apakah username sudah terpakai
        $existingAdmin = AdminModel::where('username', $request->username)->first();
        if ($existingAdmin && Hash::check($request->password, $existingAdmin->password)) {
            return redirect('admin/dataAdmin/'. $id. '/edit' )->with('error', 'Username sudah digunakan');
        }
    
        // Perbarui data admin
        $admin->username = $request->username;
        $admin->nama_admin = $request->nama_admin;
        $admin->jk = $request->jk;
        $admin->level = $request->level;
    
        // Jika password diberikan, perbarui password
        if ($request->filled('password')) {
            $admin->password = Hash::make($request->password);
        }
    
        // Simpan perubahan
        $admin->save();
    
        return redirect('admin/dataAdmin')->with('success', 'Data Petugas Posyandu berhasil diubah');
    }
    

    public function edit(String $id)
    {
        $admin = AdminModel::find($id);
        // $level = LevelModel::all();

        $breadcrumb = (object) [
            'title' => 'Edit Data Admin',
            'list' => ['Home', 'Admin', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit Data Admin'
        ];

        $activeMenu = 'dataAdmin';

        return view('admin.dataAdmin.edit', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'admin' => $admin,
            'activeMenu' => $activeMenu
        ]);
    }
    
    // public function destroy(String $id)
    // {
    //     $check = AdminModel::find($id);

    //     // Untuk mengecek apakah data user dengan id yang dimaksud ada atau tidak
    //     if (!$check) {
    //         return redirect('admin/dataAdmin')->with('error', 'Data Admin tidak ditemukan');
    //     }

    //     try {
    //         AdminModel::destroy($id);
    //         return redirect('admin/dataAdmin')->with('success', 'Data Admin berhasil dihapus');
    //     } catch (\Illuminate\Database\QueryException $e) {
    //         // Jika terjadi error ketika menghapus data, redirect kembali ke halaman dengan membawa pesan error
    //         return redirect('admin/dataAdmin')->with('error', 'Data Admin gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
    //     }
    // }
}