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
        $user = User::with('participant.competition')->find(Auth::id());

        return view('profil', compact('user'));
    }

    public function informasi()
    {
        $informasi = Broadcast::latest()->get();

        return view('informasi', compact('informasi'));
    }

    public function kompetisi()
    {
        $penyisihan = Auth::user()->participant->competitionAttempts()
                                ->with('competition')
                                ->get();

       $simulasiConfig = Config::get('const.simulation');

        $simulasi = (object) [
            'is_simulation' => true,
            'competition' => (object) ['name' => $simulasiConfig['title']],
            'finish_at' => Carbon::parse($simulasiConfig['finish_at'])
        ];

        $all_lomba = $penyisihan->push($simulasi);

        $lomba = $all_lomba->sortBy('finish_at');

        return view('competition', compact('lomba'));
    }
}
