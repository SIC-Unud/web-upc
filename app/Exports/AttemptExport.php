<?php

namespace App\Exports;

use App\Models\CompetitionAttempt;
use App\Models\Participant;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AttemptExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    public $competition;
    public $is_simulation;
    protected $allData;

    public function __construct($competition, $is_simulation)
    {
        $this->competition = $competition;

        if ($is_simulation) {
            $attempts = CompetitionAttempt::with(['participant', 'competition_answers.question'])
                ->where('is_simulation', true)
                ->orderByDesc('score')
                ->orderByDesc('correct_hots_question')
                ->orderBy('finish_at')
                ->get();

            $userNotAttempts = Participant::where('is_accepted', true)
                ->whereDoesntHave('simulation_attempt')
                ->get();
        } else {
            $attempts = CompetitionAttempt::with(['participant', 'competition_answers.question'])
                ->whereHas('participant', function ($q) use ($competition) {
                    $q->where('competition_id', $competition);
                })
                ->where('is_simulation', false)
                ->orderByDesc('score')
                ->orderByDesc('correct_hots_question')
                ->orderBy('finish_at')
                ->get();

            $userNotAttempts = Participant::whereDoesntHave('real_attempt')
                ->where('is_accepted', true)
                ->where('competition_id', $competition)
                ->get();
        }

        $normalizedAttempts = $attempts->map(function ($attempt) {
            $wrong = 0;
            $empty = 0;

            foreach ($attempt->competition_answers as $ca) {
                if ($ca->answer_key === null) {
                    $empty++;
                    continue;
                }

                if ($ca->relationLoaded('question') && $ca->question) {
                    if ($ca->answer_key != $ca->question->question_answer_key) {
                        $wrong++;
                    }
                }
            }

            return [
                "id" => $attempt->id,
                "participant_id" => $attempt->participant_id,
                "start_at" => $attempt->start_at,
                "correct_answer" => $attempt->correct_answer,
                "correct_hots_question" => $attempt->correct_hots_question,
                "wrong_answer" => $wrong,
                "empty_answer" => $empty,
                "score" => $attempt->score,
                "finish_at" => $attempt->finish_at,
                "participant" => [
                    "no_participant" => $attempt->participant->no_participant ?? null,
                    "leader_name" => $attempt->participant->leader_name ?? null,
                ],
            ];
        });

        $normalizedUserNotAttempts = $userNotAttempts->map(function ($participant) {
            return [
                "id" => null,
                "participant_id" => $participant->id,
                "start_at" => null,
                "correct_answer" => null,
                "correct_hots_question" => null,
                "wrong_answer" => null,
                "empty_answer" => null,
                "score" => null,
                "finish_at" => null,
                "participant" => [
                    "no_participant" => $participant->no_participant,
                    "leader_name" => $participant->leader_name,
                ],
            ];
        });

        $this->allData = $normalizedAttempts->toBase()->merge($normalizedUserNotAttempts)->values();
    }

    public function collection()
    {
        return $this->allData;
    }

    public function headings(): array
    {
        return [
            'Peringkat',
            'No Participant',
            'Nama Participant',
            'Waktu Mulai',
            'Jumlah Jawaban Benar',
            'Jumlah Jawaban Hots Yang Benar',
            'Jumlah Jawaban Salah',
            'Jumlah Jawaban Kosong',
            'Score',
            'Waktu Selesai',
        ];
    }

    public function map($row): array
    {
        static $rank = 0;

        $status = "Belum Mulai";

        if ($row['start_at'] != null && $row['finish_at'] == null) {
            $status = "Belum Submit";
        }

        return [
            ++$rank,
            $row['participant']['no_participant'] ?? null,
            $row['participant']['leader_name'] ?? null,
            $row['start_at'] ?? $status,
            $row['correct_answer'] !== null && $row['correct_answer'] !== 0 ? $row['correct_answer'] : '0',
            $row['correct_hots_question'] !== null && $row['correct_hots_question'] !== 0 ? $row['correct_hots_question'] : '0',
            $row['wrong_answer'] !== null && $row['wrong_answer'] !== 0 ? $row['wrong_answer'] : '0',
            $row['empty_answer'] !== null && $row['empty_answer'] !== 0 ? $row['empty_answer'] : '0',
            $row['score'] !== null && $row['score'] != 0 ? $row['score'] : '0',
            $row['finish_at'] ?? $status,
        ];
    }
}