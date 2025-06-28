<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function register()
    {
        if(Auth::check() && Auth::user()->participant && Auth::user()->participant->is_rejected == 1) {
            Auth::logout();
            session()->invalidate();
            session()->regenerateToken();
        }
        return view('register');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $data = User::where('email', $credentials['email'])->first();

            if($data->role) {
                $request->session()->regenerate();
                return redirect()->intended('admin');
            } else {
                $data->load(['participant:user_id,competition_id,leader_name,institution,created_at,is_accepted,is_rejected,reject_message',
                        'participant.competition:id,name']);
                if ($data->participant->is_accepted != true && $data->participant->is_rejected != true) {
                    return redirect()->route('login')->with([
                        'status' => 'Sedang divalidasi',
                        'data' => $data,
                    ]);
                } else if ($data->participant->is_rejected == true && $data->participant->is_accepted != true) {
                    $request->session()->regenerate();
                    return redirect()->route('login')->with([
                        'success' => 'Gagal divalidasi',
                        'data' => $data
                    ]);
                } else {
                    $request->session()->regenerate();
                    return redirect()->intended('competitions');
                }
            }

        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
