<?php

// namespace App\Http\Middleware;

// use App\Models\Participant;
// use Closure;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
// use Symfony\Component\HttpFoundation\Response;

// class EnsureUpdateParticipant
// {
//     /**
//      * Handle an incoming request.
//      *
//      * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
//      */
//     public function handle(Request $request, Closure $next, $no_registration): Response {
//         if (!Auth::check()) {
//             return redirect('/login')->with('error', 'Anda harus login');
//         }
//         $user = Auth::user();

//         $participant = Participant::where('user_id', $user->id)->first();

//         if (
//             !$participant ||
//             $participant->no_registration !== $no_registration ||
//             $participant->is_rejected !== true
//         ) {
//             abort(403, 'Halaman tidak tersedia');
//         }

//         return $next($request);
//     }
// }

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Participant;

class EnsureUpdateParticipant
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  $no_registration
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check() && !$request->is('login')) {
            return redirect('/login')->with('error', 'Anda harus login');
        }

        $user = Auth::user();
        $participant = Participant::where('user_id', $user->id)->first();

        // if (
        //     !$participant ||
        //     $participant->no_registration !== $no_registration ||
        //     $participant->is_rejected !== true
        // ) {
        //     abort(403, 'Halaman tidak tersedia');
        // }

        return $next($request);
    }
}

