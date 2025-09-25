<?php

use App\Http\Controllers\BroadcastController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\ParticipantManagementController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminCompetitionController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\ParticipantDashboardController;
use App\Http\Controllers\ParticipantExportController;
use App\Http\Controllers\ForbiddenUserController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::controller(AuthController::class)->group(function () {
   Route::get('/login', 'index')->name('login');
   Route::get('/register', 'register')->name('register');
   Route::post('/login', 'login')->name('login.post');
});

Route::middleware('guest')->group(function () {
   Route::get('/registration-not-found/{late}', function ($late) {
      $isLate = $late == 'late' ? 1 : 0;
      return view('not-found.registration', compact('isLate'));
   })->name('registration.not-found');
   Route::get('/invoice/{no_registration}', [PdfController::class, 'invoice'])->name('invoice.download');
});

Route::get('/update-participant', [ParticipantController::class, 'update'])->name('update-participant')->middleware('rejected-participant');

Route::middleware('auth')->group(function () {
   Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware('is-participant-active')->group(function () {
   Route::get('/ban-quiz/{competitionType}/{number?}', [ForbiddenUserController::class, 'showCountdownPage'])->where('competitionType', 'real|simulation')->name('forbidden.countdown');
   Route::controller(ParticipantDashboardController::class)->group(function () {
      Route::get('/competitions', 'competitions')->name('participants.index');
      Route::get('/competitions/{competition}', 'cbt')->name('participants.competition')->middleware('secure-quiz');
      Route::get('/finish-attempt/{competitionType}', 'autoFinishAttempt')->where('competitionType', 'real|simulation')->name('finish-attempt');
      Route::get('/profil', 'profil')->name('participants.profil');
      Route::get('/informasi', 'informasi')->name('participants.informasi');
   });
});

Route::middleware('is-admin')->group(function () {
   Route::get('/participants/export', [ParticipantExportController::class, 'export'])->name('participants.export');

   Route::controller(ParticipantManagementController::class)->group(function () {
      Route::get('/admin/manajemen-user', 'show')->name('admin.manajemen-user.index');
      Route::post('/admin/manajemen-user/accept/{participant_id}', 'accept')->name('admin.manajemen-user.accept');
      Route::post('/admin/manajemen-user/reject/{participant_id}', 'reject')->name('admin.manajemen-user.reject');
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

   Route::controller(AdminCompetitionController::class)->group(function () {
      Route::get("/admin/competition/{competition}/{questionNumber?}", 'manageQuiz')->name('admin.competition.question.edit');
      Route::get("/admin/recap/{competition}", 'recap')->name('admin.competition.recap');
      Route::get("/admin/score-recap/{competition}", 'scoreRecap')->name('admin.competition.score-recap');
   });
});


// Route::get('/kompetisi', function () {
//    $durasi = 90;
//    $start = Carbon::parse('2025-09-20 23:25:00');
//    $end = $start->addMinutes($durasi);

//    // $countdown = $end - $start;
//    return view('cbt', ['durasi' => $durasi, 'end' => $end]);
// });
