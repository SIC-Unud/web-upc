<?php

namespace App\Http\Controllers;

use App\Models\ForbiddenUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForbiddenUserController extends Controller
{
    public function showCountdownPage()
    {
        $forbiddenUser = ForbiddenUser::where('user_id', Auth::id())->first();

        if (!$forbiddenUser || now()->greaterThan($forbiddenUser->expired_at)) {
            return redirect()->route('participants.competition');
        }

        return view('ban_cbt', [
            'expired_at' => $forbiddenUser->expired_at
        ]);
    }
}
