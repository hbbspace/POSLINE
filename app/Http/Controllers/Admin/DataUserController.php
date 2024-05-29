<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AnggotaKeluargaModel;
use App\Models\UserModel;
use Illuminate\Support\Facades\Hash;
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

    // public function create()
    // {
    //     $breadcrumb = (object) [
    //         'title' => 'Tambah Data User',
    //         'list' => ['Home', 'Data User', 'Tambah']
    //     ];
    
    //     $page = (object) [
    //         'title' => 'Tambah Data User baru'
    //     ];
    
    //     // Mengambil data NIK dari tabel AnggotaKeluargaModel dengan status 'ibu'
    //     $nik = AnggotaKeluargaModel::select('nik')
    //                 ->where('status', 'ibu')
    //                 ->whereNotIn('nik', function($query) {
    //                     $query->select('nik')->from('user');
    //                 })
    //                 ->get();
    
    //     $activeMenu = 'dataUser';
    
    //     return view('admin.dataUser.create', [
    //         'breadcrumb' => $breadcrumb, 
    //         'page' => $page, 
    //         'nik' => $nik, 
    //         'activeMenu' => $activeMenu
    //     ]);
    // }
    
    // public function store(Request $request)
    // {
    //     // Validasi input
    //     $request->validate([
    //         'nik' => 'required|string|min:3',
    //         'password' => 'required|min:3',
    //         'username' => 'required|string|max:50'
    //     ]);
    
    //     // Pengecekan apakah NIK sudah ada di tabel users
    //     if (UserModel::where('nik', $request->nik)->exists()) {
    //         return redirect('admin/dataUser')->with('error', 'Gagal menambah data user, NIK sudah terdaftar.');
    //     }
    
    //     // Membuat user baru jika NIK belum ada
    //     UserModel::create([
    //         'nik' => $request->nik,
    //         'password' => Hash::make($request->password), // Hash password
    //         'username' => $request->username
    //     ]);
    
    //     return redirect('admin/dataUser')->with('success', 'Data User berhasil disimpan');
    // }
    
    

    public function show(string $id)
    {
        $user = UserModel::find($id);
        $breadcrumb = (object) [
            'title' => 'Detail Data User',
            'list' => ['Home', 'Data User', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail Data User'
        ];

        $activeMenu = 'dataUser';

        return view('admin.dataUser.show', ['breadcrumb' => $breadcrumb,
         'page' => $page, 'user' => $user, 'activeMenu' => $activeMenu]);
    }

    public function edit(string $id)
    {
        $user = UserModel::find($id);
        // $nik = AnggotaKeluargaModel::select('nik')
        //             ->where('status', 'ibu')
        //             ->whereNotIn('nik', function($query) {
        //                 $query->select('nik')->from('user');
        //             })
        //             ->get();
        $breadcrumb = (object) [
            'title' => 'Edit Data User',
            'list' => ['Home', 'Data User', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit Data User'
        ];

        $activeMenu = 'dataUser';

        return view('admin.dataUser.edit', ['breadcrumb' => $breadcrumb, 
         'page' => $page, 'user' => $user, 'activeMenu' => $activeMenu]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nik' => 'required|string|min:3',
            'password' => 'nullable|min:3',
            'username' => 'required|string|max:50',
        ]);
    
        $user = UserModel::find($id);
        if (!$user) {
            return redirect('admin/dataUser')->with('error', 'Data User tidak ditemukan');
        }
    
        $user->nik = $request->nik;
        $user->username = $request->username;
    
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
    
        $user->save();
    
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

        if ($request->user_id) {
            $users->where('user_id', $request->user_id);
        }

        return DataTables::of($users)
            ->addColumn('action', function ($users) { // Menambahkan kolom 'action'
                return '<a href="' . url('admin/dataUser/' .$users->user_id) . '" class="btn btn-info btn-sm">Detail</a> ' .
                    '<a href="' . url('admin/dataUser/' .$users->user_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ' .
                    '<form class="d-inline-block" method="POST" action="' . url('admin/dataUser/' .$users->user_id) . '">' .
                    csrf_field() . method_field('DELETE') .
                    '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
            })
            ->rawColumns(['action']) // memberitahu bahwa kolom aksi adalah html
            ->make(true);
    }
}
