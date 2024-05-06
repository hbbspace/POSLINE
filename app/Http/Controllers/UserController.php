<?php

namespace App\Http\Controllers;

use App\DataTables\UserDataTable;
use App\Models\UserModel;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(UserDataTable $dataTable)
    {   
        // session()->flush();
        // $breadcrumb = (object) [
        //     'title' => 'Daftar User',
        //     'list' => ['Home', 'User']
        // ];

        // $page = (object) [
        //     'title' => 'Daftar User yang terdaftar dalam sistem'
        // ];
        // $activeMenu = 'admin/dataUser';
        // $dataUser = UserModel::all();
        return $dataTable->render('admin.dataUser.index');
        //return view('User', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu]);
    }
}
