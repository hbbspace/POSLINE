<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AnggotaKeluargaModel;
use App\Models\UserModel;
use Yajra\DataTables\Facades\DataTables;

class DataUserController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Data User',
            'list' => ['Home', 'Data User']
        ];

        $page = (object) [
            'title' => 'Daftar Data User yang terdaftar dalam sistem'
        ];

        $activeMenu = 'dataUser';

        $user = UserModel::all();
        return view('admin.dataUser.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'user' => $user, 'activeMenu' => $activeMenu]);
    }

    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Data User',
            'list' => ['Home', 'Data User', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah Data User baru'
        ];

        $user = UserModel::all();
                $activeMenu = 'admin.dataUser';

        return view('admin.dataUser.create', ['breadcrumb' => $breadcrumb, 
         'page' => $page, 'user' => $user, 'activeMenu' => $activeMenu]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|string|min:3|unique:user,nik',
            'password' => 'required|min:3',
            'username' => 'required|string|max:50'
        ]);

        UserModel::create([
            'nik' => $request->nik,
            'password' => $request->password,
            'username' => $request->username
        ]);

        return redirect('admin/dataUser')->with('success', 'Data User berhasil disimpan');
    }

    public function show(string $id)
    {
        $user = UserModel::with('user')->find($id);
        $breadcrumb = (object) [
            'title' => 'Detail Data User',
            'list' => ['Home', 'Data User', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail Data User'
        ];

        $activeMenu = 'admin.dataUser';

        return view('admin.dataUser.show', ['breadcrumb' => $breadcrumb,
         'page' => $page, 'user' => $user, 'activeMenu' => $activeMenu]);
    }

    public function edit(string $id)
    {
        $user = UserModel::find($id);
        $anggota_keluarga = AnggotaKeluargaModel::all();

        $breadcrumb = (object) [
            'title' => 'Edit Data User',
            'list' => ['Home', 'Data User', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit Data User'
        ];

        $activeMenu = 'admin.dataUser';

        return view('admin.dataUser.edit', ['breadcrumb' => $breadcrumb, 
         'page' => $page, 'user' => $user, 'anggota_keluarga' => $anggota_keluarga, 'activeMenu' => $activeMenu]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nik' => 'required|string|min:3|unique:user,nik'.$id.',user_id',
            'password' => 'required|min:3',
            'username' => 'required|string|max:50',
        ]);

        $user = UserModel::find($id);
        if (!$user) {
            return redirect('admin/dataUser')->with('error', 'Data User tidak ditemukan');
        }

        $user->update([
            'nik' => $request->nik,
            'password' => $request->password,
            'username' => $request->username
        ]);

        return redirect('admin/dataUser')->with('success', 'Data User berhasil diubah');
    }

    public function destroy(string $id)
    {
        $check = UserModel::find($id);
        if (!$check) {
            return redirect('admin/dataUser')->with('error', 'Data User tidak ditemukan');
        }

        try {
            UserModel::destroy($id);
            return redirect('admin/dataUser')->with('success', 'Data User berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('admin/dataUser')->with('error', 'Data User gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }

    public function list(Request $request)
    {
        $users = UserModel::select('user_id','nik', 'password', 'username')->with('anggota_keluarga'); // Mengambil kolom yang dibutuhkan

        if ($request->nik) {
            $users->where('nik', $request->nik);
        }

        return DataTables::of($users)
            ->addColumn('action', function ($user) { // Menambahkan kolom 'action'
                return '<a href="' . url('admin/dataUser/' .$user->nik) . '" class="btn btn-info btn-sm">Detail</a> ' .
                    '<a href="' . url('admin/dataUser/' .$user->nik . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ' .
                    '<form class="d-inline-block" method="POST" action="' . url('admin/dataUser/' .$user->nik) . '">' .
                    csrf_field() . method_field('DELETE') .
                    '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
            })
            ->make(true);
    }
}
