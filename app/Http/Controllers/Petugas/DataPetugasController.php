<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\AdminModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class DataPetugasController extends Controller
{
   
    public function index()
    {
        if (Auth::guard('admin')->check()) {
            $admin_id = (Auth::guard('admin')->user()->admin_id);
            $admin = AdminModel::find($admin_id);
            // $user = UserModel::find($user_id);
            $breadcrumb = (object) [
                'title' => 'Profile Petugas',
                'list' => ['Home', 'Data Petugas']
            ];
    
            $page = (object) [
                'title' => 'Profile Petugas'
            ];
    
            $activeMenu = 'dataPetugas';
    
            return view('petugas.dataPetugas.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'admin' => $admin, 'activeMenu' => $activeMenu]);
        } else {
            return redirect('/login')->with('error', 'Session Anda sudah habis, silahkan login kembali');
        }
      
    }

    public function update(Request $request)
    {
        if(Auth::guard('admin')->check()){
            $admin_id = Auth::guard('admin')->user()->admin_id;
    
            $admin = AdminModel::find($admin_id);
            $request->validate([
                'username' => 'required|string|min:3',
                'nama_admin' => 'required|string|min:3',
                'jk' => 'required|in:L,P',
            ]);
    
            $existingAdmin = AdminModel::where('username', $request->username)->first();
            if ($existingAdmin && Hash::check($request->password, $existingAdmin->password)) {
                return redirect('petugas/dataPetugas/edit')->with('error', 'Request Tidak Tersedia, Gunakan Inputan Lain');
            }
        
            $data = [
                'username' => $request->username,
                'nama_admin' => $request->nama_admin,
                'jk' => $request->jk,
            ];
        
            if ($request->filled('password')) {
                $request->validate([
                    'password' => 'string|min:3',
                ]);
                $data['password'] = Hash::make($request->password);
            }
        
            $admin->update($data);
        
            return redirect('petugas/dataPetugas')->with('success', 'Data Pengguna berhasil diubah');
        }else{
            return redirect('/login')->with('error', 'Session Anda sudah habis, silahkan login kembali');

        }

    }

    public function edit()
    {
        if(Auth::guard('admin')->check()){

            $admin_id = (Auth::guard('admin')->user()->admin_id);
    
            $admin = AdminModel::find($admin_id);
            // $level = LevelModel::all();
    
            $breadcrumb = (object) [
                'title' => 'Edit Data Profile',
                'list' => ['Home', 'Profile', 'Edit']
            ];
    
            $page = (object) [
                'title' => 'Edit Profile'
            ];
    
            $activeMenu = 'dataPetugas';
    
            return view('petugas.dataPetugas.edit', [
                'breadcrumb' => $breadcrumb,
                'page' => $page,
                'admin' => $admin,
                'activeMenu' => $activeMenu
            ]);
        }else{
            return redirect('/login')->with('error', 'Session Anda sudah habis, silahkan login kembali');

        }
    }
    
}