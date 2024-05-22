<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {   
        // session()->flush();
        $user_id = (Auth::guard('user')->user()->user_id);
        $user=UserModel::select('anggota_keluarga.nama',)
        ->join('anggota_keluarga','user.nik','=','anggota_keluarga.nik')
        ->where('user_id',$user_id)->first();
        $nama=$user->nama;
        $breadcrumb = (object) [
            'title' => 'Selamat Datang ' . $nama,
            'list' => ['Home', 'Dashboard']
        ];

        $activeMenu = 'dashboard';
        // return $dataTable->render('admin.dataUser.index');
        return view('user', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu]);
    }


}
