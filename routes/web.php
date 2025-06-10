<?php


use App\Models\Participant;
use Spatie\LaravelPdf\Facades\Pdf;
use Spatie\Browsershot\Browsershot;
use Spatie\LaravelPdf\Enums\Format;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/registration', [AuthController::class, 'show']);


Route::get('/coba', function () {

    $data = Participant::with('user','competition', 'members')->findOrFail(2);
    
    $view = '';

    if ($data->competition->is_team_competition) {
        $view = 'pdf.invoice.team';
    } else {
        $view = 'pdf.invoice.individual';
    }

    if ($data->leader_gender === 'L') {
        $data->leader_gender = "Laki-laki";
    } else {
        $data->leader_gender = "Perempuan";
    }

    return Pdf::view($view, ['data' => $data])
        ->withBrowserShot(function (Browsershot $browsershot) {
                $browsershot->transparentBackground();
        })
        ->margins(0, 0, 0, 0)
        ->download('invoice-' . $data->no_registration . '.pdf');
});

Route::get('/invoice/{no_registration}', function ($no_registration) {
    return generateInvoice($no_registration);
})->name('invoice.download');

Route::get('/coba2', function() {
    return view('pdf.invoice.individual');
});

Route::get('/coba3', function() {
    return view('pdf.invoice.footer');
});