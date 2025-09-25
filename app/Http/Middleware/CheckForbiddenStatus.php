<?php

namespace App\Http\Middleware;

use App\Models\ForbiddenUser;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckForbiddenStatus
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();
            $forbidden = ForbiddenUser::where('user_id', $user->id)->first();

            if ($forbidden && now()->lessThan($forbidden->expired_at)) {
                if (!$request->routeIs('forbidden.countdown')) {
                    $participant = Auth::user()->participant;
                    if($request->route('competition')->is_simulation) {
                        if($participant->simulation_attempt) {
                            $type = 'simulation';
                        }
                    } else if(!$request->route('competition')->is_simulation) {
                        if($participant->real_attempt) {
                            $type = 'real';
                        }
                    }
                    return redirect()->route('forbidden.countdown', [
                        'competitionType' => $type
                    ]);
                }
            }
        }

        return $next($request);
    }
}
