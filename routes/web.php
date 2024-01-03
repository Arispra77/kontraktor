<?php

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
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EditController;
use Illuminate\Support\Facades\Route;

Route::get('realisasi', [EditController::class,'realisasi'])->name('realisasi');

Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('home', [AuthController::class, 'home'])->name('home');
Route::post('login/sesi', [AuthController::class, 'login']);
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('profil', [AuthController::class,'index'])->name('profil');

Route::put('/edit-password', [EditController::class, 'editp'])->middleware('auth')->name('passwordd');
Route::post('update',[EditController::class, 'editp'])->name('passwordd');


Route::get('item/{Id_Job_SPK}', [EditController::class,'up'])->name('update');
//Route::get('/modal/{Id_Job_SPK}', [EditController::class,'viewModal'])->name('viewModal');

Route::post('tambah-data-real/{Id_Job_SPK}', [EditController::class,'tambahDataReal'])->name('tambah-data');



Route::get('laporan/{Id_Job_SPK}',[EditController::class,'laporan'])->name('laporan');

Route::get('/generate-pdf', [EditController::class,'generatePDF'])->name('generate-pdf');

Route::get('/search', [EditController::class,'realisasi'])->name('search');

