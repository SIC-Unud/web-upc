<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
// Route::get('/registration', [AuthController::class, 'show']);
Route::get('/invoice/{no_registration}', [PdfController::class, 'invoice'])->name('invoice.download');
Route::get('/admin/manajemen-peserta', function() {
     $headers = ['No. Reg', 'Nama lengkap', 'NISN/NIM', 'No. Tlp', 'Waktu Registrasi', 'Status', 'Aksi'];
     $users = [
     [
          'no_reg' => '198788099',
          'nama' => 'YUDHISTIRA ARIMBAWA SAPUTRA',
          'nisn' => '2408561072',
          'telepon' => '081977397953',
          'waktu_registrasi' => '2025-05-29 17:30:00',
          'status' => 'Menunggu',
     ],
     [
          'no_reg' => '198788099',
          'nama' => 'YUDHISTIRA ARIMBAWA SAPUTRA',
          'nisn' => '2408561072',
          'telepon' => '081977397953',
          'waktu_registrasi' => '2025-05-29 17:30:00',
          'status' => 'Ditolak',
     ],
     [
          'no_reg' => '198788099',
          'nama' => 'YUDHISTIRA ARIMBAWA SAPUTRA',
          'nisn' => '2408561072',
          'telepon' => '081977397953',
          'waktu_registrasi' => '2025-05-29 17:30:00',
          'status' => 'Diterima',
     ]];
     return view("manajemen-peserta", compact('headers', 'users'));
});