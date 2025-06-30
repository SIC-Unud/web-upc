<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Broadcast;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class ParticipantDashboardController extends Controller
{
    public function profil()
    {
        $user = User::with('participant', 'participant.competition')->find(Auth::user()->id);

        return view('profil', compact('user'));
    }

    public function informasi()
    {
        $broadcasts = Broadcast::latest()->get();

        return view('informasi', compact('broadcasts'));
    }

    public function competitions()
    {
        $now = now();
        $participant = Auth::user()->participant;
        $competition = $participant->competition;

        $startTime = Carbon::parse($competition->start_competition);
        $endTime = Carbon::parse($competition->end_competition);
        $startTimeFormatted = Carbon::parse($startTime)->translatedFormat('d F Y, H:i');
        $endTimeFormatted = Carbon::parse($endTime)->translatedFormat('d F Y, H:i') . ' WITA';
        $dateRange = $startTimeFormatted . ' - ' . $endTimeFormatted;

        if ($now->gt($endTime)) {
            $status = 'Terlewati';
        } elseif ($now->between($startTime, $endTime)) {
            $status = 'Sedang Berlangsung';
        } else {
            $status = diffInDaysHuman($startTime);
        }

        $competitions[] = [
            'title' => $competition->is_cbt ? $competition->name : "Penyisihan ".$competition->name,
            'date' => $dateRange,
            'status' => $status,
            'isMissed' => $now->gt($endTime),
        ];

        if($competition->is_cbt) {
            $simulasiConfig = Config::get('const.simulation');
            $simulasiStart = Carbon::parse($simulasiConfig['start_at']);
            $simulasiEnd = Carbon::parse($simulasiConfig['end_at']);
            $simulasiStartFormatted = $simulasiStart->translatedFormat('d F Y, H:i');
            $simulasiEndFormatted = $simulasiEnd->translatedFormat('d F Y, H:i') . ' WITA';
            $simulasiDateRange = $simulasiStartFormatted . ' - ' . $simulasiEndFormatted;
    
            if ($now->gt($simulasiEnd)) {
                $simulasiStatus = 'Terlewati';
            } elseif ($now->between($simulasiStart, $simulasiEnd)) {
                $simulasiStatus = 'Sedang Berlangsung';
            } else {
                $simulasiStatus = diffInDaysHuman($simulasiStart);
            }
    
            $competitions[] = [
                'title' => 'Simulasi Kompetisi',
                'date' => $simulasiDateRange,
                'status' => $simulasiStatus,
                'isMissed' => $now->gt($simulasiEnd),
            ];
        }
        
        $competitions = collect($competitions)->sortBy('date')->values();

        return view('competition', compact('competitions'));
    }
}
