<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class dataUser extends Controller
{
   
    public function index()
    {
        $user_id = (Auth::guard('user')->user()->user_id);
        $user=UserModel::select('user.*','anggota_keluarga.nama','anggota_keluarga.tanggal_lahir', 'anggota_keluarga.jk','anggota_keluarga.status')
        ->join('anggota_keluarga','user.nik','=','anggota_keluarga.nik')
        ->where('user_id',$user_id)->first();
        // $user = UserModel::find($user_id);
        $breadcrumb = (object) [
            'title' => 'Detail Data user',
            'list' => ['Home', 'Detail User']
        ];

        $page = (object) [
            'title' => 'Detail user'
        ];

        $activeMenu = 'dataUser';

        return view('user.dataUser.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'user' => $user, 'activeMenu' => $activeMenu]);
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

        UserModel::find($id)->update([
            'username' => $request->username,
            'password' => $request->password, // Note: It's better to keep the password update optional
            'nama_admin' => $request->nama_admin,
            'jk' => $request->jk,
            'level' => $request->level
        ]);

        return redirect('user/dataUser')->with('success', 'Data Pengguna berhasil diubah');
    }

    public function edit()
    {
        $user_id = (Auth::guard('user')->user()->user_id);
        $user=UserModel::select('user.*','anggota_keluarga.nama')
        ->join('anggota_keluarga','user.nik','=','anggota_keluarga.nik')
        ->where('user_id',$user_id)->first();

        $breadcrumb = (object) [
            'title' => 'Edit Data Profil',
            'list' => ['Home', 'Profil', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit Data Profil'
        ];

        $activeMenu = 'user.dataUser'; // set menu yang sedang aktif

        return view('user.dataUser.edit', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'user' => $user,
            'activeMenu' => $activeMenu
        ]);
    }
    
}