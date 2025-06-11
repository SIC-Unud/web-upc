<?php

use Illuminate\Support\Facades\Route;

Route::get('/register', function () {
    return view('register.register');
});
Route::get('/individu', function () {
    return view('individu.register-individu');
});
Route::get('/kelompok', function () {
    return view('kelompok.register-kelompok');
});
Route::get('/pembayaran', function () {
    return view('pembayaran.register-pembayaran');
});
Route::get('/accepted', function () {
    return view('accepted.register-accepted');
});