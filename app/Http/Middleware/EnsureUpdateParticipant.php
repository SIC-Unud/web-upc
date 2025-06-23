<?php

namespace App\Http\Middleware;

use App\Models\Participant;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUpdateParticipant
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, $no_registration, Closure $next): Response {
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Anda harus login');
        }
        $user = Auth::user();

        $participant = Participant::where('user_id', $user->id)->first();

        if (
            !$participant ||
            $participant->no_registration !== $no_registration ||
            $participant->is_rejected !== true
        ) {
            abort(403, 'Halaman tidak tersedia');
        }

        return $next($request);
    }
}
