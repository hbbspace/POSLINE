<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\forgotPassword;
use App\Http\Controllers\Admin\DataUserController;
use App\Http\Controllers\Admin\KeluargaController;
use App\Http\Controllers\Admin\AnggotaKeluargaController;
use App\Http\Controllers\Admin\DataAdminController;
use App\Http\Controllers\Admin\DataAnakController;
use App\Http\Controllers\Admin\DataPetugasController;
use App\Http\Controllers\Admin\HasilPemeriksaanController;
use App\Http\Controllers\Admin\JadwalPemeriksaanController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Petugas\DataPetugasController as PetugasDataPetugasController;
use App\Http\Controllers\Petugas\HasilPemeriksaanController as PetugasHasilPemeriksaanController;
use App\Http\Controllers\Admin\InputPemeriksaan;
use App\Http\Controllers\Petugas\JadwalPetugasController;
use App\Http\Controllers\Petugas\PemeriksaanBalitaController;
use App\Http\Controllers\User\DataBalitaUserController;
use App\Http\Controllers\User\DataUserController as UserDataUserController;
use App\Http\Controllers\User\HasilPemeriksaanUserController;
use App\Http\Controllers\User\JadwalUserController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
use App\Models\AnggotaKeluargaModel;
use App\Models\HasilPemeriksaanModel;
use App\Models\Keluarga;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingController::class,'index']);

Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('proses_login', [AuthController::class, 'proses_login'])->name('proses_login');
Route::get('logout', [AuthController::class,'logout'])->name('logout');
Route::post('proses_register', [AuthController::class, 'proses_register'])->name('proses_register');

Route::get('/admin',[AdminController::class,'index']);
Route::get('/petugas',[PetugasController::class,'index']);
Route::get('/user',[UserController::class,'index']);

Route::group(['prefix'=>'forgotPassword'], function (){
    Route::get('/', [forgotPassword::class,'index']);
    Route::post('/', [forgotPassword::class, 'store']); // menyimpan data user baru
});



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
        Route::get('/', [DataPetugasController::class, 'index']); // menampilkan halaman awal user
        Route::post('/list', [DataPetugasController::class, 'list']); // menampilkan data user dalam bentuk json untuk datatables
        Route::get('/create', [DataPetugasController::class, 'create']); // menampilkan halaman form tambah user
        Route::post('/', [DataPetugasController::class, 'store']); // menyimpan data user baru
        Route::get('/{id}', [DataPetugasController::class, 'show'])->name('admin.dataPetugas.show'); // menampilkan detail user
        Route::get('/{id}/edit', [DataPetugasController::class, 'edit'])->name('admin.dataPetugas.edit'); // menampilkan halaman form edit user
        Route::put('/{id}', [DataPetugasController::class, 'update'])->name('admin.dataPetugas.update'); // menyimpan perubahan data user
        Route::delete('/{id}', [DataPetugasController::class, 'destroy'])->name('admin.dataPetugas.destroy'); // menghapus data user
    });

    Route::group(['prefix' => 'pemeriksaan'], function () {
        Route::get('/', [InputPemeriksaan::class, 'index']); // menampilkan halaman awal user
        Route::post('/list', [InputPemeriksaan::class, 'list']); // menampilkan halaman awal user
        Route::get('{id}/edit', [InputPemeriksaan::class, 'edit']); // menampilkan halaman awal user
        Route::put('/{id}', [InputPemeriksaan::class, 'update']); // menyimpan perubahan data user
    });

    Route::group(['prefix' => 'jadwal'], function () {
        Route::get('/', [JadwalPemeriksaanController::class, 'index']); // menampilkan halaman awal user
        Route::post('/list', [JadwalPemeriksaanController::class, 'list']); // menampilkan data user dalam bentuk json untuk datatables
        Route::get('/create', [JadwalPemeriksaanController::class, 'create']); // menampilkan halaman form tambah user
        Route::post('/', [JadwalPemeriksaanController::class, 'store']); // menyimpan data user baru
        Route::get('/{id}', [JadwalPemeriksaanController::class, 'show'])->name('admin.jadwal.show'); // menampilkan detail user
        Route::get('/{id}/edit', [JadwalPemeriksaanController::class, 'edit'])->name('admin.jadwal.edit'); // menampilkan halaman form edit user
        Route::put('/{id}', [JadwalPemeriksaanController::class, 'update'])->name('admin.jadwal.update'); // menyimpan perubahan data user
        Route::delete('/{id}', [JadwalPemeriksaanController::class, 'destroy'])->name('admin.jadwal.destroy');
        Route::get('/prosesSPK/{id}', [InputPemeriksaan::class, 'calculate']); // menampilkan data user dalam bentuk json untuk datatables
        // menghapus data user
    });
    
    Route::group(['prefix' => 'dataPemeriksaan'], function () {
        Route::get('/', [HasilPemeriksaanController::class, 'index']); // menampilkan halaman awal user
        Route::post('/list', [HasilPemeriksaanController::class, 'list']); // menampilkan data user dalam bentuk json untuk datatables
        Route::get('/{id}', [HasilPemeriksaanController::class, 'show']); // menampilkan detail user
        Route::delete('/{id}', [HasilPemeriksaanController::class, 'destroy']); // menghapus data user
        Route::get('/{id}/edit', [HasilPemeriksaanController::class, 'edit']); // menampilkan halaman form edit user
        Route::put('/{id}', [HasilPemeriksaanController::class, 'update']); // menyimpan perubahan data user
    });

});
Route::group(['prefix' => 'user'], function () {
    Route::group(['prefix' => 'jadwal'], function () {
        Route::get('/', [JadwalUserController::class, 'index']); // menampilkan halaman awal user
        Route::post('/list', [JadwalUserController::class, 'list']); // menampilkan data user dalam bentuk json untuk datatables
        Route::post('/listDashboard', [JadwalUserController::class, 'listDashboard']); // menampilkan data user dalam bentuk json untuk datatables
    });

    // Tambahkan rute untuk grafik tinggi badan di sini
    Route::get('/user/chart/data', [HasilPemeriksaanUserController::class, 'getChartData'])->name('user.chart.data');
    Route::get('/user/balita/names', [HasilPemeriksaanUserController::class, 'getBalitaNames'])->name('user.balita.names');
    Route::get('/admin/chart/data', [AdminController::class, 'getChartData'])->name('admin.chart.data');

    Route::group(['prefix' => 'dataUser'], function () {
        Route::get('/', [UserDataUserController::class, 'index']); // menampilkan halaman awal user
        Route::post('/list', [UserDataUserController::class, 'list']); // menampilkan data user dalam bentuk json untuk datatables
        Route::get('/create', [UserDataUserController::class, 'create']); // menampilkan halaman form tambah user
        // Route::post('/', [UserDataUserController::class, 'store']); // menyimpan data user baru
        // Route::get('/{id}', [UserDataUserController::class, 'show'])->name('admin.dataAdmin.show'); // menampilkan detail user
        Route::get('/edit', [UserDataUserController::class, 'edit']);// menampilkan halaman form edit user
        Route::put('/{id}', [UserDataUserController::class, 'update']); // menyimpan perubahan data user
    });

    Route::group(['prefix' => 'dataPemeriksaanBalita'], function () {
        Route::get('/', [HasilPemeriksaanUserController::class, 'index']); // menampilkan halaman awal user
        Route::post('/list', [HasilPemeriksaanUserController::class, 'list']); // menampilkan data user dalam bentuk json untuk datatables
        Route::get('/{id}', [HasilPemeriksaanUserController::class, 'show']); // menampilkan detail user
    });
    
    Route::group(['prefix' => 'dataBalitaUser'], function () {
        Route::get('/', [DataBalitaUserController::class, 'index']); // menampilkan halaman awal user
        Route::post('/list', [DataBalitaUserController::class, 'list']); // menampilkan data user dalam bentuk json untuk datatables
        Route::get('/{id}', [DataBalitaUserController::class, 'show']); // menampilkan detail user
    });
});

Route::group(['prefix'=>'petugas'], function(){
    Route::group(['prefix'=>'pemeriksaanBalita'], function(){
        Route::get('/', [PemeriksaanBalitaController::class, 'index']); // menampilkan halaman awal user
        Route::post('/list', [PemeriksaanBalitaController::class, 'list']); // menampilkan halaman awal user
        Route::get('{id}/edit', [PemeriksaanBalitaController::class, 'edit']); // menampilkan halaman awal user
        Route::put('/{id}', [PemeriksaanBalitaController::class, 'update']); // menyimpan perubahan data user
        // Route::get('/', [jadwalUser::class, 'index']); 

    });

    Route::group(['prefix' => 'historyPemeriksaan'], function () {
        Route::get('/', [PetugasHasilPemeriksaanController::class, 'index']); // menampilkan halaman awal user
        Route::post('/list', [PetugasHasilPemeriksaanController::class, 'list']); // menampilkan data user dalam bentuk json untuk datatables
        // Route::get('/create', [PetugasHasilPemeriksaanController::class, 'create']); // menampilkan halaman form tambah user
        // Route::post('/', [PetugasHasilPemeriksaanController::class, 'store']); // menyimpan data user baru
        Route::get('/{id}', [PetugasHasilPemeriksaanController::class, 'show']); // menampilkan detail user
        Route::get('/{id}/edit', [PetugasHasilPemeriksaanController::class, 'edit']); // menampilkan halaman form edit user
        Route::put('/{id}', [PetugasHasilPemeriksaanController::class, 'update']); // menyimpan perubahan data user
        Route::delete('/{id}', [PetugasHasilPemeriksaanController::class, 'destroy']);// menghapus data user
    });

    Route::group(['prefix' => 'dataPetugas'], function () {
        Route::get('/', [PetugasDataPetugasController::class, 'index']); // menampilkan halaman awal user
        // Route::post('/', [PetugasDataPetugasController::class, 'store']); // menyimpan data user baru
        // Route::get('/{id}', [PetugasDataPetugasController::class, 'show'])->name('admin.dataAdmin.show'); // menampilkan detail user
        Route::get('/edit', [PetugasDataPetugasController::class, 'edit']);// menampilkan halaman form edit user
        Route::put('/{id}', [PetugasDataPetugasController::class, 'update']); // menyimpan perubahan data user
    });

    Route::group(['prefix' => 'jadwal'], function () {
        Route::get('/', [JadwalPetugasController::class, 'index']); // menampilkan halaman awal user
        Route::post('/list', [JadwalPetugasController::class, 'list']); // menampilkan data user dalam bentuk json untuk datatables
        Route::get('/prosesSPK/{id}', [PemeriksaanBalitaController::class, 'calculate']); // menampilkan data user dalam bentuk json untuk datatables
    });
});




