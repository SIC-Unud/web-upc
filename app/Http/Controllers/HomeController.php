<?php

namespace App\Http\Controllers;

use App\Models\Competition;
use Carbon\Carbon;

class HomeController extends Controller
{
    function formatIndoDate($date)
    {
        return Carbon::parse($date)->locale('id')->translatedFormat('d F');
    }

    public function index()
    {
        $timeline = collect(config('const.schedules'))->map(function ($item) {
            $start = $this->formatIndoDate($item['start']);
            $end = $this->formatIndoDate($item['end']);

            return [
                'title' => $item['name'],
                'date' => $start === $end ? $start : "$start - $end",
            ];
        })->values()->toArray();

        $competitions = Competition::orderBy('created_at', 'desc')->get();

        return view('landingpage', compact('timeline', 'competitions'));
    }
}
