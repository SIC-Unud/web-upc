<?php

namespace App\Http\Controllers;

use App\Models\Competition;
use Carbon\Carbon;

class AdminCompetitionController extends Controller
{
    public function index() 
    {
        $all = Competition::with('questions')->get();

        $competitions = [];

        foreach ($all as $competition) {
            if ($competition->is_cbt) {
                $countNormalQuestions = $competition->questions->count();

                $start = Carbon::parse($competition->start_competition)->translatedFormat('d F Y, H:i');
                $end = Carbon::parse($competition->end_competition)->translatedFormat('d F Y, H:i') . ' WITA';
                $dateRange = $start . ' - ' . $end;

                $competitions[] = [
                    'title' => $competition->name,
                    'slug' => $competition->slug,
                    'date' => $dateRange,
                    'countQestion' => $countNormalQuestions
                ];

                // $countSimulationQuestions = $competition->questions->where('is_simulation', true)->count();
                // $simulasiStart = Carbon::parse(config('const.simulation.start_at'));
                // $simulasiEnd = Carbon::parse(config('const.simulation.end_at'));

                // $simulasiStartFormatted = $simulasiStart->translatedFormat('d F Y, H:i');
                // $simulasiEndFormatted = $simulasiEnd->translatedFormat('d F Y, H:i') . ' WITA';
                // $simulationDateRange = $simulasiStartFormatted . ' - ' . $simulasiEndFormatted;

                // $competitions[] = [
                //     'title' => 'Simulasi ' . $competition->name,
                //     'date' => $simulationDateRange,
                //     'countQestion' => $countSimulationQuestions
                // ];
            }
        }

        return view('admin.competition', ['competitions' => $competitions]);
    }

    public function manageQuiz(Competition $competition, $questionNumber = 1)
    {
        if (!$competition->exists) {
            abort(404, 'Competition not found');
        }

        $competition->load('questions');

        return view('admin.competition-questions', compact('competition', 'questionNumber'));
    }
}
