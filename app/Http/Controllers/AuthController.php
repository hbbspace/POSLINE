<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index()
    {
        $user =Auth::user();

        if($user != null){
          
            if($user->level_id == '1') {
                return redirect()->intended('admin');
            }
           
            else if($user->level_id == '2'){
                return redirect()->intended('petugas');
            }
            else {
                return redirect()->intended('user');
            }
        }
        
        return view('login');
    }

    public function proses_login(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'password' => 'required',
            'username' => 'required',
        ]); 
    
            $credential = $request->only('username', 'password');
    
            if (Auth::guard('admin')->attempt($credential)) {
                $admin = Auth::guard('admin')->user();
                
                if ($admin) {
                    if ($admin->level == '1') {
                        return redirect()->intended('admin');
                    } else if ($admin->level == '2') {
                        return redirect()->intended('petugas');
                    }
                    return redirect()->intended('/');
                }
            }elseif(Auth::guard('user')->attempt($credential)) { // Menggunakan guard 'user' dan 'nik' sebagai username
                return redirect('/user');
            }
    
        // Jika tidak berhasil login
        return redirect('/login')
            ->withInput()
            ->withErrors(['login_gagal' => 'Pastikan kembali Username dan password yang dimasukkan sudah benar']);
    }
    
    


    public function logout(Request $request)
    { 
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        Auth::logout();
        return Redirect('login');
    }
}