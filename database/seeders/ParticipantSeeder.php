<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Participant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ParticipantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i = 1; $i <= 15; $i++) {
            $user = User::create([
                'email' => "peserta$i@upc.com",
                'password' => Hash::make("password$i"),
                'role' => 0,
            ]);
    
            Participant::create([
                'user_id' => $user->id,
                'is_accepted' => 1,
                'no_registration' => "FAST-00$i",
                'no_participant' => "password$i",
                'competition_id' => [1, 2, 3][array_rand([1, 2, 3])],
                'source_of_information' => 'Media Sosial',
                'reason' => 'Ingin menguji kemampuan',
                'leader_name' => 'Peserta Uji Coba',
                'leader_student_id' => "2421541$i",
                'leader_date_of_birth' => '2005-01-01',
                'leader_gender' => 'L',
                'leader_no_wa' => "081234567890$i",
                'institution' => 'Universitas Uji Coba',
                'institution_address' => 'Jalan Uji Coba',
                'institution_province' => 'Bali',
                'institution_city' => 'Denpasar',
                'parent_no_wa' => "081234567890$i",
                'pass_photo' => 'dummy/photo.jpg',
                'student_proof' => 'dummy/student_proof.pdf',
                'twibbon_links' => 'https://instagram.com/p/123',
                'subtotal' => 50000,
                'total' => 50000,
                'transaction_proof' => 'dummy/transaction.jpg',
            ]);
        }
    }
}
