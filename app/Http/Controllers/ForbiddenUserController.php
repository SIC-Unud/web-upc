<?php

namespace App\Http\Controllers;

use App\Models\ForbiddenUser;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ForbiddenUserController extends Controller
{
    public function showCountdownPage($competitionType, $number = 1)
    {
        $forbiddenUser = ForbiddenUser::where('user_id', Auth::id())->first();

        $participant = Auth::user()->participant;
        if($competitionType == 'simulation') {
            if($participant->simulation_attempt) {
                $slugCompetition = 'simulation';
            }
        } else if($competitionType == 'real') {
            if($participant->real_attempt) {
                $slugCompetition = $participant->competition->slug;
            }
        }

        if (!$forbiddenUser || now()->greaterThan($forbiddenUser->expired_at)) {
            if($slugCompetition) {
                return redirect()->route('participants.competition', [
                            'competition' => $slugCompetition,
                            'question' => $number ?? 1
                        ]);
            } else {
                return redirect()->route('participants.index');
            }
        }

        $expired_at =  Carbon::parse($forbiddenUser->expired_at)->setTimezone('Asia/Makassar')->toIso8601String();

        return view('ban_cbt', [
            'expired_at' => $expired_at
        ]);
    }
}
