<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRejectedParticipant
{
    /**
     * Izinkan akses hanya jika:
     * – user sudah login,
     * – user memiliki participant dengan no-registration yang sama,
     * – participant sudah berstatus ditolak (is_rejected = true)
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if (!$user) {
            abort(403, 'Akses Ditolak');
        }

        $participant = Participant::where('user_id', $user->id)->first();

        if (
            !$participant ||
            ($participant->is_accepted != false ||
            $participant->is_rejected != true)
        ) {
            abort(403, 'Akses Ditolak');
        }

        return $next($request);
    }
}
