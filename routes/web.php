<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DataUserController;
use App\Http\Controllers\forgotPassword;
use App\Http\Controllers\KeluargaController;
use App\Http\Controllers\AnggotaKeluargaController;
use App\Http\Controllers\DataAdminController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
use App\Models\AnggotaKeluargaModel;
use App\Models\Keluarga;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingController::class,'index']);
Route::get('/forgotPassword', [forgotPassword::class,'index']);

Route::get('login', [AuthController::class, 'index'])->name('login');
Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('proses_login', [AuthController::class, 'proses_login'])->name('proses_login');
Route::get('logout', [AuthController::class,'logout'])->name('logout');
Route::post('proses_register', [AuthController::class, 'proses_register'])->name('proses_register');

Route::get('/admin',[AdminController::class,'index']);
Route::get('/user',[UserController::class,'index']);



// kita atur juga untuk middleware menggunakan group pada routing
// didalamnya terdapat group untuk mengecek kondisi login
// jika user yang login merupakan admin maka akan diarahkan ke AdminController
// jika user yang login merupakan manager maka akan diarahkan ke UserController

// Route::group(['middleware' => ['auth','cek_login:1']], function() {
//     Route::resource('admin', AdminController::class);
//     Route::get('admin',[AdminController::class,'index']);
//     Route::get('/user/{id}', [AdminController::class, 'show']);
// });
// Route::group(['middleware' => ['auth','cek_login:2']], function() {
//         Route::resource('petugas', PetugasController::class);
// });
// Route::get('/user',[UserController::class,'index']);


Route::group(['prefix' => 'dataUser'], function () {
    Route::get('/', [DataUserController::class, 'index']); // menampilkan halaman awal user
    Route::post('/list', [DataUserController::class, 'list']); // menampilkan data user dalam bentuk json untuk datatables
    Route::get('/create', [DataUserController::class, 'create']); // menampilkan halaman form tambah user
    Route::post('/', [DataUserController::class, 'store']); // menyimpan data user baru
    Route::get('/{id}', [DataUserController::class, 'show']); // menampilkan detail user
    Route::get('/{id}/edit', [DataUserController::class, 'edit']); // menampilkan halaman form edit user
    Route::put('/{id}', [DataUserController::class, 'update']); // menyimpan perubahan data user
    Route::delete('/{id}', [DataUserController::class, 'destroy']); // menghapus data user
});

Route::group(['prefix' => 'dataKeluarga'], function () {
    Route::get('/', [KeluargaController::class, 'index']); // menampilkan halaman awal user
    Route::post('/list', [KeluargaController::class, 'list']); // menampilkan data user dalam bentuk json untuk datatables
    Route::get('/create', [KeluargaController::class, 'create']); // menampilkan halaman form tambah user
    Route::post('/', [KeluargaController::class, 'store']); // menyimpan data user baru
    Route::get('/{no_kk}', [KeluargaController::class, 'show'])->name('admin.dataKeluarga.show'); // menampilkan detail user
    Route::get('/{no_kk}/edit', [KeluargaController::class, 'edit'])->name('admin.dataKeluarga.edit'); // menampilkan halaman form edit user
    Route::put('/{no_kk}', [KeluargaController::class, 'update'])->name('admin.dataKeluarga.update'); // menyimpan perubahan data user
    Route::delete('/{no_kk}', [KeluargaController::class, 'destroy'])->name('admin.dataKeluarga.destroy'); // menghapus data user
});

Route::group(['prefix' => 'dataAnggotaKeluarga'], function () {
    Route::get('/', [AnggotaKeluargaController::class, 'index']);
    Route::get('/create', [AnggotaKeluargaController::class, 'create']);
    Route::post('/', [AnggotaKeluargaController::class, 'store']);
    Route::get('/{id}', [AnggotaKeluargaController::class, 'show'])->name('admin.dataAnggotaKeluarga.show');
    Route::get('/{id}/edit', [AnggotaKeluargaController::class, 'edit'])->name('admin.dataAnggotaKeluarga.edit');
    Route::put('/{id}', [AnggotaKeluargaController::class, 'update'])->name('admin.dataAnggotaKeluarga.update');
    Route::delete('/{id}', [AnggotaKeluargaController::class, 'destroy'])->name('admin.dataAnggotaKeluarga.destroy');
    Route::post('/list', [AnggotaKeluargaController::class, 'list']);
});

Route::group(['prefix' => 'dataAdmin'], function () {
    Route::get('/', [DataAdminController::class, 'index']); // menampilkan halaman awal user
    Route::post('/list', [DataAdminController::class, 'list']); // menampilkan data user dalam bentuk json untuk datatables
    Route::get('/create', [DataAdminController::class, 'create']); // menampilkan halaman form tambah user
    Route::post('/', [DataAdminController::class, 'store']); // menyimpan data user baru
    Route::get('/{id}', [DataAdminController::class, 'show'])->name('admin.dataAdmin.show'); // menampilkan detail user
    Route::get('/{id}/edit', [DataAdminController::class, 'edit'])->name('admin.dataAdmin.edit'); // menampilkan halaman form edit user
    Route::put('/{id}', [DataAdminController::class, 'update'])->name('admin.dataAdmin.update'); // menyimpan perubahan data user
    Route::delete('/{id}', [DataAdminController::class, 'destroy'])->name('admin.dataAdmin.destroy'); // menghapus data user
});

