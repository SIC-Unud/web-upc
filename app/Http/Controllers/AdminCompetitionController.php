<?php

namespace App\Http\Controllers;

use App\Models\Competition;
use App\Models\CompetitionAttempt;
use App\Models\Participant;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AdminCompetitionController extends Controller
{
    public function index() 
    {
        $all = Competition::with('questions')->get();

        $competitions = [];

        foreach ($all as $competition) {
            if ($competition->is_cbt) {
                $countNormalQuestions = $competition->questions->count();
                $countNotNullQuestions = $competition
                                            ->questions
                                            ->where('not_null_question', true)
                                            ->count();

                $start = Carbon::parse($competition->start_competition);
                $end   = Carbon::parse($competition->end_competition);

                $dateRange = $start->translatedFormat('d F Y, H:i') . ' - ' 
                        . $end->translatedFormat('d F Y, H:i') . ' WITA';

                $hasStarted = now()->greaterThanOrEqualTo($start);
                $competitions[] = [
                    'title' => $competition->name,
                    'slug' => $competition->slug,
                    'date' => $dateRange,
                    'hasStarted' => $hasStarted,
                    'countQuestion' => $countNormalQuestions,
                    'countNotNullQuestion' => $countNotNullQuestions
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
    
    public function recap(Competition $competition) 
    {
        $started_simulation_participants_count = 0;
        $finished_simulation_participants_count = 0;
        
        if($competition->is_simulation) {
            $attempts = CompetitionAttempt::with('participant')
                ->where('is_simulation', true)
                ->orderByDesc('score')
                ->orderByDesc('correct_hots_question')
                ->orderBy('finish_at')
                ->paginate(15);

           $summary = CompetitionAttempt::selectRaw("
                    COUNT(*) as total,
                    COUNT(CASE WHEN start_at IS NOT NULL THEN 1 END) as started_count,
                    COUNT(CASE WHEN finish_at IS NOT NULL THEN 1 END) as finished_count
                ")
                ->where('is_simulation', true)
                ->first();

            $started_simulation_participants_count  = $summary->started_count;
            $finished_simulation_participants_count = $summary->finished_count;
        } else {
            $attempts = CompetitionAttempt::with('participant')
                ->whereHas('participant', function ($q) use ($competition) {
                    $q->where('competition_id', $competition->id);
                })
                ->where('is_simulation', false)
                ->orderByDesc('score')
                ->orderByDesc('correct_hots_question')
                ->orderBy('finish_at')
                ->paginate(15);
        }

        $countAllParticipantAccept = Participant::where('is_accepted', true)
                                    ->whereHas('competition', function ($q) {
                                        $q->where('is_cbt', true);
                                    })->count();
        $title = 'Rekap Nilai ' . $competition->name;
        $year = 2025;
        
        return view('admin.competition-recap', compact('competition', 'attempts', 'title', 'year', 'countAllParticipantAccept', 'started_simulation_participants_count', 'finished_simulation_participants_count'));
    }

    public function scoreRecap(Competition $competition)
    {
         if($competition->is_simulation) {
            $attempts = CompetitionAttempt::with('participant')
                ->where('is_simulation', true)
                ->orderByDesc('score')
                ->orderByDesc('correct_hots_question')
                ->orderBy('finish_at')
                ->paginate(15);
        } else {
            $attempts = CompetitionAttempt::with('participant')
                ->whereHas('participant', function ($q) use ($competition) {
                    $q->where('competition_id', $competition->id);
                })
                ->where('is_simulation', false)
                ->orderByDesc('score')
                ->orderByDesc('correct_hots_question')
                ->orderBy('finish_at')
                ->paginate(15);
        }

        $data = [
            'title' => 'Rekap Nilai ' . $competition->name,
            'competition' => $competition,
            'year' => 2025,
            'attempts' => $attempts
        ];

        $pdf = Pdf::loadView('pdf.score-recap', $data)
                    ->setPaper('A4', 'portrait');

        return $pdf->download('score-recap-' . $competition->slug . '.pdf');
    }
}
