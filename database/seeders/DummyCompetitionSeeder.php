<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DummyCompetitionSeeder extends Seeder
{
    public function run(): void
    {
        // Buat 1 kompetisi
        $competitionId = DB::table('competitions')->insertGetId([
            'name' => 'Matematika SMP',
            'slug' => 'matematika-smp',
            'code' => 'MSMP01',
            'icon_competition' => 'icon.png',
            'degree' => 'SMP',
            'wave_1_price' => 50000,
            'wave_2_price' => 60000,
            'wave_3_price' => 70000,
            'is_team_competition' => 0,
            'is_cbt' => 1,
            'is_simulation' => 0,
            'duration' => 90,
            'start_competition' => now(),
            'end_competition' => now()->addHours(2),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Buat 10 soal (2 HOT)
        $questionIds = [];
        for ($i = 1; $i <= 10; $i++) {
            $questionIds[$i] = DB::table('questions')->insertGetId([
                'competition_id' => $competitionId,
                'is_hot' => $i <= 2 ? 1 : 0,
                'question' => "Soal ke-$i",
                'question_score' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $options = [];
            for ($j=1; $j <= 4; $j++) { 
                $options[] = [
                    'question_id' => $questionIds[$i],
                    'answer_value' => "Pilihan $j",
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
            DB::table('question_answers')->insert($options);
        }

        for ($i = 1; $i <= 20; $i++) {
            // Create user first
            $userId = DB::table('users')->insertGetId([
                'email' => "participant{$i}@example.com",
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'role' => 0,
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $participantId = DB::table('participants')->insertGetId([
                'user_id' => $userId,
                'no_registration' => 'REG' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'no_participant' => 'MSMP-' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'token' => rand(100000, 999999),
                'competition_id' => $competitionId,
                'source_of_information' => 'Instagram',
                'reason' => 'Tertarik',
                'is_first_competition' => 1,
                'leader_name' => "Peserta $i",
                'leader_student_id' => "SMP2025$i",
                'leader_date_of_birth' => '2010-01-01',
                'leader_gender' => $i % 2 === 0 ? 'F' : 'M',
                'leader_no_wa' => '08123' . rand(100000, 999999),
                'institution' => 'SMP Negeri ' . $i,
                'institution_address' => 'Jl. Dummy ' . $i,
                'institution_province' => 'Bali',
                'institution_city' => 'Denpasar',
                'parent_no_wa' => '08123' . rand(100000, 999999),
                'pass_photo' => 'photo.png',
                'student_proof' => 'proof.png',
                'twibbon_links' => 'http://twibbon.com/example',
                'subtotal' => 50000,
                'total' => 50000,
                'transaction_proof' => 'proof.png',
                'is_accepted' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $score = rand(50, 100);
            $hotCorrect = rand(0, 2);
            $correctAnswer = intdiv($score, 10);
            $wrongAnswer = 10 - $correctAnswer;

            $finishAt = now()->subMinutes(rand(1, 120));

            $attemptId = DB::table('competition_attempts')->insertGetId([
                'participant_id' => $participantId,
                'correct_answer' => $correctAnswer,
                'correct_hots_question' => $hotCorrect,
                'wrong_answer' => $wrongAnswer,
                'score' => $score,
                'finish_at' => $finishAt,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            foreach ($questionIds as $qId) {
                DB::table('competition_answers')->insert([
                    'competition_attempt_id' => $attemptId,
                    'question_id' => $qId,
                    'answer_key' => null,
                    'question_number' => $qId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
