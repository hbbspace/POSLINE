<?php

namespace App\Http\Controllers;

use App\DataTables\UserDataTable;
use App\Models\UserModel;
use Illuminate\Http\Request;

class DataUserController extends Controller
{
    public function index()
    {   
        $breadcrumb = (object) [
            'title' => 'Daftar User',
            'list' => ['Home', 'User']
        ];

        $page = (object) [
            'title' => 'Daftar user yang terdaftar dalam sistem'
        ];

        $activeMenu = 'admin.dataUser'; 
        $user = UserModel::all();

        return view('admin.dataUser.index', ['breadcrumb' => $breadcrumb, 'page' => $page,
            'user' => $user, 'activeMenu' => $activeMenu]);
    }
}
