<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\CompetitionAttempt;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class FinishMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if (!$user) {
            abort(403);
        }

        // $competitionId = $user->participant->competition_id;
        // $participant_id = $user->participant->id;
        $competititonAttempt = $user->participant->real_attempt;
        $competition = $user->participant->competition;
        $now = now();
        $start = Carbon::parse($competition->start_competition);
        $end = Carbon::parse($competition->end_competition);

        // $competititonAttempt = CompetitionAttempt::where('participant_id', $participant_id)
        //     ->first();
        
        if (!$competititonAttempt || !$competition) {
            abort(403);
        }

        if (!$now->between($start, $end)) {
            abort(403);
        }

        if (!empty($competititonAttempt->finish_at)) {
            abort(403);
        }

        return $next($request);
    }
}
