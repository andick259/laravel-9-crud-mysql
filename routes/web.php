<?php

use App\Http\Controllers\SiswaController;
use App\Http\Controllers\PenggunaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
  //return view('welcome');
  return view('/auth/login');
});

Route::get('/siswa', [SiswaController::class, 'index']);
Route::get('/siswa/{id}', [SiswaController::class, 'detail'])->where('id','[0-9]+');
Route::get('/siswa/create', [SiswaController::class, 'create']);
Route::post('/siswa/store', [SiswaController::class, 'store']);
Route::get('/siswa/{id}/edit', [SiswaController::class, 'edit'])->where('id','[0-9]+');
Route::put('/siswa/{id}', [SiswaController::class, 'update']);
Route::delete('/siswa/{id}', [SiswaController::class, 'destroy']);

//
Route::get('/auth/login', [PenggunaController::class, 'login'])->middleware('alreadyLoggedIn');
//Route::get('/auth/login', [PenggunaController::class, 'login']);
Route::get('/auth/register', [PenggunaController::class, 'registration']);
Route::post('/auth/store', [PenggunaController::class, 'create_register']);
Route::post('/auth/sign-in', [PenggunaController::class, 'sign_in']);
Route::get('/dashboard', [PenggunaController::class,'dashboard'])->middleware('isLoggedIn');
//Route::get('/dashboard', [PenggunaController::class,'dashboard']);
Route::get('/logout', [PenggunaController::class, 'logout']);
//Route::post('login-user', [PenggunaController::class,'loginUser'])->name('login-user');
