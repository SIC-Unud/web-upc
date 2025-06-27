<?php

use App\Http\Controllers\BroadcastController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\ParticipantManagementController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Exports\ParticipantExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\ParticipantExportController;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Request;


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
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


Route::get('/profil', function () {
    return view('profil');
});
Route::post('/profil', function () {
    return redirect('/profil');
});


Route::controller(BroadcastController::class)->group(function () {
    Route::get('/admin/informasi', 'index')->name('broadcast.index');
    Route::post('/admin/informasi', 'store')->name('broadcast.store');
    // Route::put('/')->name
});

Route::get('/competitions', function () {
    return view('competition', [
        'lomba' => [
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
        ]
    ]);
});

// Route::get('/update-participant/{no_registration}', [ParticipantController::class, 'update'])->name('update-participant')->middleware('rejected-participant');
Route::get('/update-participant/{no_registration}', [ParticipantController::class, 'update'])->name('update-participant');