<?php

use App\Models\Participant;
use Spatie\LaravelPdf\Facades\Pdf;
use Spatie\Browsershot\Browsershot;
use Illuminate\Support\Facades\Storage;

if (!function_exists('fileUpload')) {
    function fileUpload($file, $folder) {
        $newName = now()->format('Y-m-d') . '_' . $file->hashName();
        $path = Storage::disk('public')->putFileAs($folder,$file, $newName);
        return $path;
    }
}

if (!function_exists('generateRegistrationCode')) {
    function generateRegistrationCode($length = 10) {
        $uuid = Str::uuid()->getHex();
        $base62 = base_convert($uuid, 16, 36);
        return substr($base62, 0, $length);

    }
}

if (!function_exists('generateInvoice')) {
    function generateInvoice($no_registration) {
        $data = Participant::with('user','competition', 'members')->where('no_registration',$no_registration)->first();
    
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
        
    }
}

