<?php

use App\Models\Participant;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

if (!function_exists('fileUpload')) {
    function fileUpload($file, $folder) {
        $newName = now()->format('Y-m-d') . '_' . $file->hashName();
        $path = Storage::disk('public')->putFileAs($folder,$file, $newName);
        return $path;
    }
}

if (!function_exists('fileDelete')) {
    function fileDelete($path) {
        if (Storage::disk('public')->exists($path)) {
            return Storage::disk('public')->delete($path);
        }
        return false;
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

        // if ($data->leader_gender === 'L') {
        //     $data->leader_gender = "Laki-laki";
        // } else {
        //     $data->leader_gender = "Perempuan";
        // }

        return Pdf::loadView($view, ['data' => $data])
                ->setPaper('a4', 'portrait')
                ->setWarnings(false)
                ->download('invoice-' . $data->no_registration . '.pdf');
    }
}

if (!function_exists('rupiah')) {
    function rupiah($angka, $prefix = 'Rp. ') {
        $angka = is_numeric($angka) ? (float) $angka : 0;
        return $prefix . number_format($angka, 0, ',', '.');
    }
}

if (!function_exists('diffInDaysHuman')) {
    function diffInDaysHuman($targetDate) {
        $nowDate    = Carbon::now()->copy()->startOfDay();
        $targetDate = Carbon::parse($targetDate)->copy()->startOfDay();

        $diff = $nowDate->diffInDays($targetDate, false);

        if ($diff < 0) {
            return abs($diff) . ' hari yang lalu';
        } elseif ($diff === 0) {
            return 'Hari ini';
        } else {
            return $diff . ' hari lagi';
        }
    }
}