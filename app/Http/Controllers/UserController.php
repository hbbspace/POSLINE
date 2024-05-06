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
        $breadcrumb = (object) [
            'title' => 'Selamat Datang',
            'list' => ['Home', 'User']
        ];

        $page = (object) [
            'title' => 'Daftar User yang terdaftar dalam sistem'
        ];
        $activeMenu = 'user/dataUser';
        $dataUser = UserModel::all();
        // return $dataTable->render('admin.dataUser.index');
        return view('User', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu]);
    }
}
