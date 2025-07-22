<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::call(function () {
    $files = File::files(public_path('storage/laravel-tmp'));

    foreach ($files as $file) {
        $lastModified = Carbon::createFromTimestamp(File::lastModified($file));
        $diffHours = $lastModified->diffInHours(now());

        if ($diffHours >= 24) {
            File::delete($file);
        }
    }

})->dailyAt('01:00');