<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PetugasController extends Controller
{
    public function index()
    {   
        // session()->flush();
        $breadcrumb = (object) [
            'title' => 'Selamat Datang '  . Auth::guard('admin')->user()->nama_admin,
            'list' => ['Home', 'Welcome']
        ];

        $activeMenu = 'dashboard';

        return view('petugas', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu]);
    }
}