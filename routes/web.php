<?php

use App\Http\Controllers\ParticipantManagementController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Exports\ParticipantExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\ParticipantExportController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
// Route::get('/registration', [AuthController::class, 'show']);
Route::get('/invoice/{no_registration}', [PdfController::class, 'invoice'])->name('invoice.download');


Route::get('/export-participants', function () {
   return Excel::download(new ParticipantExport, 'participants.csv', \Maatwebsite\Excel\Excel::CSV, [
      'Content-Type' => 'text/csv',
   ]);
});

Route::get('/participants/export', [ParticipantExportController::class, 'export'])->name('participants.export');
Route::get('/admin/manajemen-user', [ParticipantManagementController::class, 'show']);
Route::post('/admin/manajemen-user/accpet/{partisipant_id}', [ParticipantManagementController::class, 'accept'])->name('admin.manajemen-user.accpet');
Route::post('/admin/manajemen-user/reject/{partisipant_id}', [ParticipantManagementController::class, 'reject'])->name('admin.manajemen-user.reject');


Route::get('/competitions', function () {
   return view('competition', ['lomba' => [
      [
         'title' => 'Simulasi Kompetisi',
         'date' => '26 Oktober 2025',
         'status' => 'Terlewati',
         'isMissed' => true
      ],
      [
         'title' => 'Penyisihan Astronomi',
         'date' => '26 Oktober 2025',
         'status' => '1 hari lagi',
         'isMissed' => false
      ],
      [
         'title' => 'Penyisihan SD',
         'date' => '28 Oktober 2025',
         'status' => '3 hari lagi',
         'isMissed' => false
      ],
      [
         'title' => 'Penyisihan SD',
         'date' => '28 Oktober 2025',
         'status' => '3 hari lagi',
         'isMissed' => false
      ],
      [
         'title' => 'Penyisihan SD',
         'date' => '28 Oktober 2025',
         'status' => '3 hari lagi',
         'isMissed' => false
      ],
      [
         'title' => 'Penyisihan SD',
         'date' => '28 Oktober 2025',
         'status' => '3 hari lagi',
         'isMissed' => false
      ],
      [
         'title' => 'Penyisihan SD',
         'date' => '28 Oktober 2025',
         'status' => '3 hari lagi',
         'isMissed' => false
      ],
      [
         'title' => 'Penyisihan SD',
         'date' => '28 Oktober 2025',
         'status' => '3 hari lagi',
         'isMissed' => false
      ],
   ]]);
});