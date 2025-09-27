<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $countPartisipan = Participant::count();
        $countWaiting = Participant::where('is_accepted', 0)->where('is_rejected', 0)->count();
        $countFailed = Participant::where('is_accepted', 0)->where('is_rejected', 1)->count();
        $countSuccess = Participant::where('is_accepted', 1)->count();

        $competitionStats = DB::table('competitions')
            ->leftJoin('participants', 'competitions.id', '=', 'participants.competition_id')
            ->select('competitions.name', DB::raw('COUNT(participants.id) as total'))
            ->where('is_simulation', false)
            ->groupBy('competitions.name')
            ->orderBy('competitions.name')
            ->get();

        $labels = $competitionStats->pluck('name');
        $totals = $competitionStats->pluck('total');

        return view('admin.dashboard', compact('countPartisipan', 'countWaiting', 'countFailed', 'countSuccess', 'labels', 'totals'));
    }
}
