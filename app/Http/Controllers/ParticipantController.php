<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ParticipantController extends Controller
{
    public function update(Request $request) {
        return view('update-participant');
    }
}
