<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\forgotPassword;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingController::class,'index']);
Route::get('/login', [LoginController::class,'index']);
Route::get('/forgotPassword', [forgotPassword::class,'index']);
Route::get('/home',[WelcomeController::class,'index']);
