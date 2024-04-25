<?php

use App\Http\Controllers\LandingController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingController::class,'index']);
Route::get('/login', [LoginController::class,'index']);

