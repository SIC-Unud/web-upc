<?php

namespace Database\Seeders;

use App\Models\Question;
use Carbon\Carbon;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $competitions = [
            [
                'name' => 'Kompetisi Sains SD',
                'slug' => 'sains-sd',
                'code' => 'FSD',
                'icon_competition' => '/assets/competition/icon/SD.png',
                'degree' => 'SD',
                'wave_1_price' => 65000,
                'wave_2_price' => 75000,
                'wave_3_price' => 85000,
                'is_team_competition' => false,
                'is_cbt' => true,
                'start_competition' => Carbon::parse('2025-09-28 10:00:00'),
                'end_competition' => Carbon::parse('2025-09-28 12:00:00'),
            ],
            [
                'name' => 'Kompetisi Fisika SMP',
                'slug' => 'kompetisi-fisika-smp',
                'code' => 'FSMP',
                'icon_competition' => '/assets/competition/icon/SMP.png',
                'degree' => 'SMP',
                'wave_1_price' => 65000,
                'wave_2_price' => 75000,
                'wave_3_price' => 85000,
                'is_team_competition' => false,
                'is_cbt' => true,
                'start_competition' => Carbon::parse('2025-09-28 10:00:00'),
                'end_competition' => Carbon::parse('2025-09-28 12:00:00'),
            ],
            [
                'name' => 'Kompetisi Fisika SMA',
                'slug' => 'kompetisi-fisika-sma',
                'code' => 'FSMA',
                'icon_competition' => '/assets/competition/icon/SMA.png',
                'degree' => 'SMA',
                'wave_1_price' => 65000,
                'wave_2_price' => 75000,
                'wave_3_price' => 85000,
                'is_team_competition' => false,
                'is_cbt' => true,
                'start_competition' => Carbon::parse('2025-09-28 10:00:00'),
                'end_competition' => Carbon::parse('2025-09-28 12:00:00'),
            ],
            [
                'name' => 'Kompetisi Kebumian',
                'slug' => 'kompetisi-kebumian',
                'code' => 'FBMN',
                'icon_competition' => '/assets/competition/icon/kebumian.png',
                'degree' => 'SMA',
                'wave_1_price' => 65000,
                'wave_2_price' => 75000,
                'wave_3_price' => 85000,
                'is_team_competition' => false,
                'is_cbt' => true,
                'start_competition' => Carbon::parse('2025-09-28 10:00:00'),
                'end_competition' => Carbon::parse('2025-09-28 12:00:00'),
            ],
            [
                'name' => 'Kompetisi Astronomi',
                'slug' => 'kompetisi-astronomi',
                'code' => 'FAST',
                'icon_competition' => '/assets/competition/icon/astronomi.png',
                'degree' => 'SMA',
                'wave_1_price' => 65000,
                'wave_2_price' => 75000,
                'wave_3_price' => 85000,
                'is_team_competition' => false,
                'is_cbt' => true,
                'start_competition' => Carbon::parse('2025-09-28 10:00:00'),
                'end_competition' => Carbon::parse('2025-09-28 12:00:00'),
            ],
            [
                'name' => 'Kompetisi Essai',
                'slug' => 'kompetisi-essai',
                'code' => 'ESAI',
                'icon_competition' => '/assets/competition/icon/essai.png',
                'degree' => 'SMA, Mahasiswa',
                'wave_1_price' => 75000,
                'wave_2_price' => 85000,
                'wave_3_price' => 95000,
                'is_team_competition' => true,
                'is_cbt' => false,
                'start_competition' => Carbon::parse('2025-09-20 00:00:00'),
                'end_competition' => Carbon::parse('2025-09-28 23:59:00'),
            ],
            [
                'name' => 'Kompetisi Poster Ilmiah',
                'slug' => 'kompetisi-poster-ilmiah',
                'code' => 'POST',
                'icon_competition' => '/assets/competition/icon/poster_ilmiah.png',
                'degree' => 'SMA, Mahasiswa',
                'wave_1_price' => 75000,
                'wave_2_price' => 85000,
                'wave_3_price' => 95000,
                'is_team_competition' => true,
                'is_cbt' => false,
                'start_competition' => Carbon::parse('2025-09-20 00:00:00'),
                'end_competition' => Carbon::parse('2025-09-28 23:59:00'),
            ],
            [
                'name' => 'Simulasi Sistem UPC',
                'slug' => 'simulation',
                'code' => 'SMLS',
                'icon_competition' => '/assets/competition/icon/SD.png',
                'degree' => 'All',
                'wave_1_price' => 0,
                'wave_2_price' => 0,
                'wave_3_price' => 0,
                'is_team_competition' => false,
                'is_cbt' => true,
                'is_simulation' => true,
                'start_competition' => Carbon::parse('2025-09-27 10:00:00'),
                'end_competition' => Carbon::parse('2025-09-27 23:59:59'),
            ]
        ];

        foreach ($competitions as $competition) {
            $compId = DB::table('competitions')->insertGetId([
                ...$competition,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            if($competition['is_cbt']) {
                if($competition['slug'] == 'simulation' || $competition['slug'] == 'kompetisi-fisika-smp' || $competition['slug'] == 'kompetisi-kebumian') {
                    $count = 30;
                } else if($competition['slug'] == 'kompetisi-fisika-sma' || $competition['slug'] == 'kompetisi-astronomi') {
                    $count = 20;
                } else {
                    $count = 40;
                }

                // for ($i = 1; $i <= $count; $i++) {
                //     DB::table('questions')->insert([
                //         'competition_id' => $compId,
                //         'created_at'     => now(),
                //         'updated_at'     => now(),
                //     ]);
                // }
            }


            $questionIds = [];
            for ($i = 1; $i <= $count; $i++) {
                $questionIds[$i] = DB::table('questions')->insertGetId([
                    'competition_id' => $compId,
                    'is_hot' => $i <= 8 ? 1 : 0,
                    'question' => "INI Soal ke-$i (KEACAK GA?) Lorem, ipsum dolor sit amet consectetur adipisicing elit. Commodi, labore.",
                    'question_score' => 10,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                $options = [];
                for ($j = 1; $j <= 5; $j++) { 
                    $options[] = [
                        'question_id' => $questionIds[$i],
                        'answer_value' => "Pilihan $j",
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
                DB::table('question_answers')->insert($options);

                $firstOptionId = DB::table('question_answers')
                    ->where('question_id', $questionIds[$i])
                    ->orderBy('id', 'asc')
                    ->value('id');
                Question::where('id', $questionIds[$i])
                    ->update(['question_answer_key' => $firstOptionId]);
            }
        }
        DB::table('users')->insert([
            'email' => 'udayanaphysicschampionship@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('$2025uPc2o25#admn'),
            'role' => 1
        ]);

        // $this->call([
        //     DummyCompetitionSeeder::class,
        // ]);

        $this->call(ParticipantSeeder::class);
    }
}
