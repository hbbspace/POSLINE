<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class forgotPassword extends Controller
{
    public function index(){
        return view ('forgot');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nik' => 'required|string|min:3',
            'password' => 'required|min:3',
            'username' => 'required|string|max:50'
        ]);
    
        // Pengecekan apakah NIK sudah ada di tabel users

        $existingUser = UserModel::where('username', $request->username)->first();
        if ($existingUser && UserModel::where('nik', $request->nik)->exists()) {
            UserModel::where('nik', $request->nik)->update([
                'password' => Hash::make($request->password), // Hash password
            ]);
        }else{
            return redirect('/forgotPassword')->with('error', 'NIK dan Username tidak sesuai');
        }
    
        return redirect('/login')->with('success', 'Password Berhasil Dirubah');
    }
}
