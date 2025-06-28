<?php

use App\Http\Controllers\BroadcastController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\ParticipantManagementController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Exports\ParticipantExport;
use App\Http\Controllers\ParticipantDashboardController;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\ParticipantExportController;
use App\Models\Competition;
use App\Models\Participant;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
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


Route::middleware(['auth'])->name('dashboard.')->group(function () {
    Route::get('/competitions', [ParticipantDashboardController::class, 'competitions'])->name('kompetisi');
    Route::get('/profil', [ParticipantDashboardController::class, 'profil'])->name('profil');
    Route::get('/informasi', [ParticipantDashboardController::class, 'informasi'])->name('informasi');
});

Route::get('/registration-not-found/{late}', function ($late) {
   $isLate = $late == 'late' ? 1 : 0;
   return view('not-found.registration', compact('isLate'));
})->name('registration.not-found');

Route::controller(BroadcastController::class)->group(function () {
    Route::get('/admin/informasi', 'index')->name('broadcast.index');
    Route::post('/admin/informasi', 'store')->name('broadcast.store');
    Route::put('/admin/informasi/update/{id}', 'update')->name('broadcast.update');
    Route::delete('/admin/informasi/{broadcast}', 'destroy')->name('broadcast.delete');
});

// Route::get('/competitions', function () {
//     return view('competition', [
//         'lomba' => [
//             [
//                 'title' => 'Simulasi Kompetisi',
//                 'date' => '26 Oktober 2025',
//                 'status' => 'Terlewati',
//                 'isMissed' => true
//             ],
//             [
//                 'title' => 'Penyisihan Astronomi',
//                 'date' => '26 Oktober 2025',
//                 'status' => '1 hari lagi',
//                 'isMissed' => false
//             ],
//             [
//                 'title' => 'Penyisihan SD',
//                 'date' => '28 Oktober 2025',
//                 'status' => '3 hari lagi',
//                 'isMissed' => false
//             ],
//             [
//                 'title' => 'Penyisihan SD',
//                 'date' => '28 Oktober 2025',
//                 'status' => '3 hari lagi',
//                 'isMissed' => false
//             ],
//             [
//                 'title' => 'Penyisihan SD',
//                 'date' => '28 Oktober 2025',
//                 'status' => '3 hari lagi',
//                 'isMissed' => false
//             ],
//         ]
//     ]);
// });

Route::get('/admin/competitions', function () {
    $all = Competition::with('questions')->get();

    $competitions = [];

    foreach ($all as $competition) {
        if ($competition->is_cbt) {
            $countNormalQuestions = $competition->questions->where('is_simulation', false)->count();

            $start = Carbon::parse($competition->start_competition)->translatedFormat('d F Y, H:i');
            $end = Carbon::parse($competition->end_competition)->translatedFormat('d F Y, H:i') . ' WITA';
            $dateRange = $start . ' - ' . $end;

            $competitions[] = [
                'title' => $competition->name,
                'date' => $dateRange,
                'countQestion' => $countNormalQuestions
            ];

            $countSimulationQuestions = $competition->questions->where('is_simulation', true)->count();
            $simulasiStart = Carbon::parse(config('const.simulation.start_at'));
            $simulasiEnd = Carbon::parse(config('const.simulation.end_at'));

            $simulasiStartFormatted = $simulasiStart->translatedFormat('d F Y, H:i');
            $simulasiEndFormatted = $simulasiEnd->translatedFormat('d F Y, H:i') . ' WITA';
            $simulationDateRange = $simulasiStartFormatted . ' - ' . $simulasiEndFormatted;

            $competitions[] = [
                'title' => 'Simulasi ' . $competition->name,
                'date' => $simulationDateRange,
                'countQestion' => $countSimulationQuestions
            ];
        }
    }

    return view('admin.competition', ['competitions' => $competitions]);
});

Route::get('/update-participant', [ParticipantController::class, 'update'])->name('update-participant')->middleware('rejected-participant');
// Route::get('/update-participant/{no_registration}', [ParticipantController::class, 'update'])->name('update-participant');
Route::get('/admin', function () {
   $countPartisipan = Participant::count();
   $countWaiting = Participant::where('is_accepted', 0)->where('is_rejected', 0)->count();
   $countFailed = Participant::where('is_accepted', 0)->where('is_rejected', 1)->count();
   $countSuccess = Participant::where('is_accepted', 1)->count();

   $competitionStats = DB::table('competitions')
      ->leftJoin('participants', 'competitions.id', '=', 'participants.competition_id')
      ->select('competitions.name', DB::raw('COUNT(participants.id) as total'))
      ->groupBy('competitions.name')
      ->orderBy('competitions.name')
      ->get();

   $labels = $competitionStats->pluck('name');
   $totals = $competitionStats->pluck('total');

   return view('admin.dashboard', compact('countPartisipan', 'countWaiting', 'countFailed', 'countSuccess', 'labels', 'totals'));
});
