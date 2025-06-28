<?php

use App\Http\Controllers\BroadcastController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\ParticipantManagementController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Exports\ParticipantExport;
use App\Http\Controllers\AdminCompetitionController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\ParticipantDashboardController;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\ParticipantExportController;


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/registration-not-found/{late}', function ($late) {
   $isLate = $late == 'late' ? 1 : 0;
   return view('not-found.registration', compact('isLate'));
})->name('registration.not-found');
Route::get('/invoice/{no_registration}', [PdfController::class, 'invoice'])->name('invoice.download');

Route::controller(AuthController::class)->group(function () {
   Route::get('/register', 'register')->name('register');
   Route::get('/login', 'index')->name('login');
   Route::post('/login', 'login')->name('login.post');
   Route::post('/logout', 'logout')->name('logout');
});

Route::get('/update-participant', [ParticipantController::class, 'update'])->name('update-participant')->middleware('rejected-participant');

Route::get('/export-participants', function () {
   return Excel::download(new ParticipantExport, 'participants.csv', \Maatwebsite\Excel\Excel::CSV, [
      'Content-Type' => 'text/csv',
   ]);
});

Route::get('/participants/export', [ParticipantExportController::class, 'export'])->name('participants.export');

Route::controller(ParticipantManagementController::class)->group(function () {
   Route::get('/admin/manajemen-user', 'show')->name('admin.manajemen-user.index');
   Route::post('/admin/manajemen-user/accept/{participant_id}', 'accept')->name('admin.manajemen-user.accept');
   Route::post('/admin/manajemen-user/reject/{participant_id}', 'reject')->name('admin.manajemen-user.reject');
});

Route::controller(ParticipantDashboardController::class)->group(function () {
   Route::get('/competitions', 'competitions')->name('kompetisi');
   Route::get('/profil', 'profil')->name('profil');
   Route::get('/informasi', 'informasi')->name('informasi');
});

Route::controller(BroadcastController::class)->group(function () {
   Route::get('/admin/informasi', 'index')->name('broadcast.index');
   Route::post('/admin/informasi', 'store')->name('broadcast.store');
   Route::put('/admin/informasi/update/{id}', 'update')->name('broadcast.update');
   Route::delete('/admin/informasi/{broadcast}', 'destroy')->name('broadcast.delete');
});

Route::controller(AdminCompetitionController::class)->group(function () {
   Route::get('/admin/competitions', 'index')->name('admin.competitions.index');
});

Route::controller(AdminDashboardController::class)->group(function () {
   Route::get('/admin', 'index')->name('admin.dashboard');
});
