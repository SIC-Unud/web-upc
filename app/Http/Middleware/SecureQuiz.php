<?php

namespace App\Http\Middleware;

use App\Models\ForbiddenUser;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SecureQuiz
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        $participant = $user->participant->load('simulation_attempt', 'real_attempt');
        $competition = $request->route('competition');

        if(!$competition->is_simulation) {
            if ($competition->id !== $participant->competition_id) {
                abort(404);
            }
        }

        $now = now();
        
        $type = $competition->is_simulation ? 'simulation' : 'real';
        $attempt = $competition->is_simulation 
            ? $participant->simulation_attempt 
            : $participant->real_attempt;
        
        if($attempt != null) {
            $start = $attempt->start_at ? Carbon::parse($attempt->start_at) : now();
            if (!$attempt->start_at) {
                $attempt->update(['start_at' => $start]);
            }
            $est_end = (clone $start)->addMinutes((int) $competition->duration);
            $end = min($est_end, Carbon::parse($competition->end_competition));
    
            if(!$now->between($start, $end)) {
                if ($attempt && is_null($attempt->finish_at)) {
                    return redirect()->route('finish-attempt', ['competitionType' => $type]);
                }
            }
        }

        $forbidden = ForbiddenUser::where('user_id', $user->id)->first();
        if ($forbidden && $now->lessThan($forbidden->expired_at) && !$request->routeIs('forbidden.countdown')) {
            $type = $competition->is_simulation ? 'simulation' : 'real';
            return redirect()->route('forbidden.countdown', ['competitionType' => $type]);
        }

        return $next($request);
    }
}
