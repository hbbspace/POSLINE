<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class dataUser extends Controller
{
   
    public function show()
    {
        $user_id = (Auth::guard('user')->user()->user_id);
        $user = UserModel::find($user_id);
        $breadcrumb = (object) [
            'title' => 'Detail Data user',
            'list' => ['Home', 'user', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail user'
        ];

        $activeMenu = 'user.dataUser';

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

    public function edit(String $id)
    {
        $admin = UserModel::find($id);
        // $level = LevelModel::all();

        $breadcrumb = (object) [
            'title' => 'Edit Data user',
            'list' => ['Home', 'user', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit Data user'
        ];

        $activeMenu = 'user.datauser'; // set menu yang sedang aktif

        return view('user.dataUser.edit', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            // 'admin' => $admin,
            'activeMenu' => $activeMenu
        ]);
    }
    
}