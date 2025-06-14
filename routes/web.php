<?php


use App\Models\Participant;
use Spatie\LaravelPdf\Facades\Pdf;
use Spatie\Browsershot\Browsershot;
use Spatie\LaravelPdf\Enums\Format;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\AuthController;

Route::get('/login', function () {
    return view('login.login');
})->name('loginform');

Route::post('/login', [AuthController::class, 'login'])->name('loginpost');

Route::get('/registration', [AuthController::class, 'show']);

Route::get('/', function () {
    return view('landingpage');
});