<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // competitions
        $competitions = [
            [
                'name' => 'Cerdas Cermat SD',
                'slug' => 'cerdas-cermat-sd',
                'code' => 'FSD',
                'icon_competition' => '/assets/competition/icon/SD.png',
                'degree' => 'SD',
                'wave_1_price' => 50000,
                'wave_2_price' => 60000,
                'wave_3_price' => 70000,
                'is_team_competition' => true,
                'is_cbt' => false,
                'start_competition' => Carbon::parse('2025-07-01 08:00:00'),
                'end_competition' => Carbon::parse('2025-07-01 10:00:00'),
            ],
            [
                'name' => 'Kompetisi Fisika SMP',
                'slug' => 'kompetisi-fisika-smp',
                'code' => 'FSMP',
                'icon_competition' => '/assets/competition/icon/SMP.png',
                'degree' => 'SMP',
                'wave_1_price' => 55000,
                'wave_2_price' => 65000,
                'wave_3_price' => 75000,
                'is_team_competition' => false,
                'is_cbt' => true,
                'start_competition' => Carbon::parse('2025-07-02 08:00:00'),
                'end_competition' => Carbon::parse('2025-07-02 10:00:00'),
            ],
            [
                'name' => 'Kompetisi Fisika SMA',
                'slug' => 'kompetisi-fisika-sma',
                'code' => 'FSMA',
                'icon_competition' => '/assets/competition/icon/SMA.png',
                'degree' => 'SMA',
                'wave_1_price' => 60000,
                'wave_2_price' => 70000,
                'wave_3_price' => 80000,
                'is_team_competition' => false,
                'is_cbt' => true,
                'start_competition' => Carbon::parse('2025-07-03 08:00:00'),
                'end_competition' => Carbon::parse('2025-07-03 10:00:00'),
            ],
            [
                'name' => 'Kompetisi Kebumian',
                'slug' => 'kompetisi-kebumian',
                'code' => 'FBMN',
                'icon_competition' => '/assets/competition/icon/kebumian.png',
                'degree' => 'SMA',
                'wave_1_price' => 60000,
                'wave_2_price' => 70000,
                'wave_3_price' => 80000,
                'is_team_competition' => false,
                'is_cbt' => true,
                'start_competition' => Carbon::parse('2025-07-04 08:00:00'),
                'end_competition' => Carbon::parse('2025-07-04 10:00:00'),
            ],
            [
                'name' => 'Kompetisi Astronomi',
                'slug' => 'kompetisi-astronomi',
                'code' => 'FAST',
                'icon_competition' => '/assets/competition/icon/astronomi.png',
                'degree' => 'SMA',
                'wave_1_price' => 60000,
                'wave_2_price' => 70000,
                'wave_3_price' => 80000,
                'is_team_competition' => false,
                'is_cbt' => true,
                'start_competition' => Carbon::parse('2025-07-05 08:00:00'),
                'end_competition' => Carbon::parse('2025-07-05 10:00:00'),
            ],
            [
                'name' => 'Kompetisi Essai',
                'slug' => 'kompetisi-essai',
                'code' => 'ESAI',
                'icon_competition' => '/assets/competition/icon/essai.png',
                'degree' => 'SMA',
                'wave_1_price' => 40000,
                'wave_2_price' => 50000,
                'wave_3_price' => 60000,
                'is_team_competition' => true,
                'is_cbt' => false,
                'start_competition' => Carbon::parse('2025-07-06 08:00:00'),
                'end_competition' => Carbon::parse('2025-07-06 10:00:00'),
            ],
            [
                'name' => 'Kompetisi Poster Ilmiah',
                'slug' => 'kompetisi-poster-ilmiah',
                'code' => 'POST',
                'icon_competition' => '/assets/competition/icon/poster_ilmiah.png',
                'degree' => 'SMA',
                'wave_1_price' => 40000,
                'wave_2_price' => 50000,
                'wave_3_price' => 60000,
                'is_team_competition' => true,
                'is_cbt' => false,
                'start_competition' => Carbon::parse('2025-07-07 08:00:00'),
                'end_competition' => Carbon::parse('2025-07-07 10:00:00'),
            ],
        ];

        foreach ($competitions as $competition) {
            DB::table('competitions')->insert([
                ...$competition,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}