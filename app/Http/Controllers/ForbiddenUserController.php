<?php

namespace App\Http\Controllers;

use App\Models\ForbiddenUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForbiddenUserController extends Controller
{
    public function recordViolation()
    {
        $user = Auth::user();

        ForbiddenUser::updateOrCreate(
            ['user_id' => $user->id],
            ['expired_at' => now()->addMinutes(3)]
        );

        return response()->json([
            'status' => 'success',
            'message' => 'User violation recorded.'
        ]);
    }

    public function showCountdownPage()
    {
        $forbiddenUser = ForbiddenUser::where('user_id', Auth::id())->first();

        if (!$forbiddenUser || now()->greaterThan($forbiddenUser->expired_at)) {
            return redirect()->route('participants.competition');
        }

        return view('ban_cbt', [ // view countdown
            'expired_at' => $forbiddenUser->expired_at
        ]);
    }
}
