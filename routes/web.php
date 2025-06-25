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
Route::get('admin/informasi', function () {
    $informasi = [
        [
            'title' => '[H–1 BABAK PENYISIHAN UPC 2025]',
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin tempus mauris at lorem accumsan, in semper ex consequat. Donec porttitor sapien non suscipit tempus. Suspendisse eleifend sapien leo, a commodo elit viverra ac. Vestibulum eleifend condimentum placerat. Nam ante libero, varius a mollis non, dapibus non risus. Sed massa mauris, imperdiet nec tristique ac, commodo non urna. Donec laoreet, justo non vulputate vestibulum, eros augue congue lectus, eu maximus lacus sem eget lorem. Duis quis ligula ac massa iaculis egestas ut in nunc. Nunc volutpat ut nulla id pharetra.
            
            Vestibulum eleifend condimentum placerat. Nam ante libero, varius a mollis non, dapibus non risus. Sed massa mauris, imperdiet nec tristique ac, commodo non urna. Donec laoreet, justo non vulputate vestibulum, eros augue congue lectus, eu maximus lacus sem eget lorem. Duis quis ligula ac massa iaculis egestas ut in nunc. Nunc volutpat ut nulla id pharetra.',
        ],
        [
            'title' => '[H–2 BABAK PENYISIHAN UPC 2025]',
            'content' => 'Isi lengkap babak H–2 di sini',
        ],
        [
            'title' => '[H–3 BABAK PENYISIHAN UPC 2025]',
            'content' => 'Isi lengkap babak H–3 di sini',
        ],
    ];

    return view('informasi-admin', compact('informasi'));
    });

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
   ]]);
});