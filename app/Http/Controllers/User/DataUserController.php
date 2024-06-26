<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class DataUserController extends Controller
{
   
    public function index()
    {
        if(Auth::guard('user')->check()){

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
        }else{
            return redirect('/login')->with('error', 'Session Anda sudah habis, silahkan login kembali');
    
        }
    }

    public function update(Request $request)
    {
        if(Auth::guard('user')->check()){

            $user_id = (Auth::guard('user')->user()->user_id);
            $user=UserModel::select('user.*','anggota_keluarga.nama')
            ->join('anggota_keluarga','user.nik','=','anggota_keluarga.nik')
            ->where('user_id',$user_id)->first();
            $request->validate([
                'username' => 'required|string|min:3',        ]);
            
            $data = [
                'username' => $request->username,
            ];    
            $existingAdmin = UserModel::where('username', $request->username)->first();
            if ($existingAdmin && Hash::check($request->password, $existingAdmin->password)) {
                return redirect('user/dataUser/edit')->with('error', 'Request Tidak Tersedia, Gunakan Data Lain');
            }
            // Jika password diberikan, perbarui password
            if ($request->filled('password')) {
                $request->validate([
                    'password' => 'string|min:3',
                ]);
                $data['password'] = Hash::make($request->password);
            }
        
            // Simpan perubahan
            $user->update($data);
    
            return redirect('user/dataUser')->with('success', 'Data Pengguna berhasil diubah');
        }else{
            return redirect('/login')->with('error', 'Session Anda sudah habis, silahkan login kembali');
    
        }
    }

    public function edit()
    {
        if(Auth::guard('user')->check()){

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
    
            $activeMenu = 'dataUser';
    
            return view('user.dataUser.edit', [
                'breadcrumb' => $breadcrumb,
                'page' => $page,
                'user' => $user,
                'activeMenu' => $activeMenu
            ]);
        }else{
            return redirect('/login')->with('error', 'Session Anda sudah habis, silahkan login kembali');
    
        }
    }
    
}