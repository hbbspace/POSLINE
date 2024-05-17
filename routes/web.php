<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\forgotPassword;
use App\Http\Controllers\Admin\DataUserController;
use App\Http\Controllers\Admin\KeluargaController;
use App\Http\Controllers\Admin\AnggotaKeluargaController;
use App\Http\Controllers\Admin\DataAdminController;
use App\Http\Controllers\Admin\DataAnakController;
use App\Http\Controllers\Admin\JadwalPemeriksaanController;
use App\Http\Controllers\user\jadwalUser;
use App\Http\Controllers\DataUserController as ControllersDataUserController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Admin\PetugasController;
use App\Http\Controllers\User\dataUser;
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
Route::get('/petugas',[PetugasController::class,'index']);
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


Route::group(['prefix' => 'admin'], function () {
    Route::group(['prefix' => 'dataUser'], function () {
        Route::get('/', [DataUserController::class, 'index']); // menampilkan halaman awal user
        Route::post('/list', [DataUserController::class, 'list']); // menampilkan data user dalam bentuk json untuk datatables
        Route::get('/create', [DataUserController::class, 'create']); // menampilkan halaman form tambah user
        Route::post('/', [DataUserController::class, 'store']); // menyimpan data user baru
        Route::get('/{nik}', [DataUserController::class, 'show']); // menampilkan detail user
        Route::get('/{nik}/edit', [DataUserController::class, 'edit']); // menampilkan halaman form edit user
        Route::put('/{nik}', [DataUserController::class, 'update']); // menyimpan perubahan data user
        Route::delete('/{nik}', [DataUserController::class, 'destroy']); // menghapus data user
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

    Route::group(['prefix' => 'dataIbu'], function () {
        Route::get('/', [AnggotaKeluargaController::class, 'index']);
        Route::get('/create', [AnggotaKeluargaController::class, 'create']);
        Route::post('/', [AnggotaKeluargaController::class, 'store']);
        Route::get('/{id}', [AnggotaKeluargaController::class, 'show'])->name('admin.dataAnggotaKeluarga.show');
        Route::get('/{id}/edit', [AnggotaKeluargaController::class, 'edit'])->name('admin.dataAnggotaKeluarga.edit');
        Route::put('/{id}', [AnggotaKeluargaController::class, 'update'])->name('admin.dataAnggotaKeluarga.update');
        Route::delete('/{id}', [AnggotaKeluargaController::class, 'destroy'])->name('admin.dataAnggotaKeluarga.destroy');
        Route::post('/list', [AnggotaKeluargaController::class, 'list']);
    });

    Route::group(['prefix' => 'dataAnak'], function () {
        Route::get('/', [DataAnakController::class, 'index']);
        Route::get('/create', [DataAnakController::class, 'create']);
        Route::post('/', [DataAnakController::class, 'store']);
        Route::get('/{id}', [DataAnakController::class, 'show'])->name('admin.dataAnggotaKeluarga.show');
        Route::get('/{id}/edit', [DataAnakController::class, 'edit'])->name('admin.dataAnggotaKeluarga.edit');
        Route::put('/{id}', [DataAnakController::class, 'update'])->name('admin.dataAnggotaKeluarga.update');
        Route::delete('/{id}', [DataAnakController::class, 'destroy'])->name('admin.dataAnggotaKeluarga.destroy');
        Route::post('/list', [DataAnakController::class, 'list']);
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

    Route::group(['prefix' => 'dataPetugas'], function () {
        Route::get('/', [PetugasController::class, 'index']); // menampilkan halaman awal user
        Route::post('/list', [PetugasController::class, 'list']); // menampilkan data user dalam bentuk json untuk datatables
        Route::get('/create', [PetugasController::class, 'create']); // menampilkan halaman form tambah user
        Route::post('/', [PetugasController::class, 'store']); // menyimpan data user baru
        Route::get('/{id}', [PetugasController::class, 'show'])->name('admin.dataPetugas.show'); // menampilkan detail user
        Route::get('/{id}/edit', [PetugasController::class, 'edit'])->name('admin.dataPetugas.edit'); // menampilkan halaman form edit user
        Route::put('/{id}', [PetugasController::class, 'update'])->name('admin.dataPetugas.update'); // menyimpan perubahan data user
        Route::delete('/{id}', [PetugasController::class, 'destroy'])->name('admin.dataPetugas.destroy'); // menghapus data user
    });

    Route::group(['prefix' => 'jadwal'], function () {
        Route::get('/', [JadwalPemeriksaanController::class, 'index']); // menampilkan halaman awal user
        Route::post('/list', [JadwalPemeriksaanController::class, 'list']); // menampilkan data user dalam bentuk json untuk datatables
        Route::get('/create', [JadwalPemeriksaanController::class, 'create']); // menampilkan halaman form tambah user
        Route::post('/', [JadwalPemeriksaanController::class, 'store']); // menyimpan data user baru
        Route::get('/{id}', [JadwalPemeriksaanController::class, 'show'])->name('admin.jadwal.show'); // menampilkan detail user
        Route::get('/{id}/edit', [JadwalPemeriksaanController::class, 'edit'])->name('admin.jadwal.edit'); // menampilkan halaman form edit user
        Route::put('/{id}', [JadwalPemeriksaanController::class, 'update'])->name('admin.jadwal.update'); // menyimpan perubahan data user
        Route::delete('/{id}', [JadwalPemeriksaanController::class, 'destroy'])->name('admin.jadwal.destroy'); // menghapus data user
    });

});
Route::group(['prefix' => 'user'], function () {
    Route::group(['prefix' => 'jadwal'], function () {
        Route::get('/', [jadwalUser::class, 'index']); // menampilkan halaman awal user
        Route::post('/list', [jadwalUser::class, 'list']); // menampilkan data user dalam bentuk json untuk datatables
        Route::get('/{nik}', [jadwalUser::class, 'show']); // menampilkan detail user
    });
    Route::group(['prefix' => 'dataUser'], function () {
        Route::get('/', [dataUser::class, 'show']); // menampilkan halaman awal user
        Route::post('/list', [dataUser::class, 'list']); // menampilkan data user dalam bentuk json untuk datatables
        Route::get('/create', [dataUser::class, 'create']); // menampilkan halaman form tambah user
        Route::post('/', [dataUser::class, 'store']); // menyimpan data user baru
        // Route::get('/{id}', [dataUser::class, 'show'])->name('admin.dataAdmin.show'); // menampilkan detail user
        Route::get('/{id}/edit', [dataUser::class, 'edit'])->name('admin.dataAdmin.edit'); // menampilkan halaman form edit user
        Route::put('/{id}', [dataUser::class, 'update'])->name('admin.dataAdmin.update'); // menyimpan perubahan data user
    });
});