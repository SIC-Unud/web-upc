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
        $user = User::create([
            'email' => 'peserta@upc.com',
            'password' => Hash::make('password'),
            'role' => 0,
        ]);

        Participant::create([
            'user_id' => $user->id,
            'is_accepted' => 1,
            'no_registration' => 'UPC-TEST-001',
            'competition_id' => 1,
            'source_of_information' => 'Media Sosial',
            'reason' => 'Ingin menguji kemampuan',
            'leader_name' => 'Peserta Uji Coba',
            'leader_student_id' => '123456789',
            'leader_date_of_birth' => '2005-01-01',
            'leader_gender' => 'L',
            'leader_no_wa' => '081234567890',
            'institution' => 'Universitas Uji Coba',
            'institution_address' => 'Jalan Uji Coba No. 1',
            'institution_province' => 'Bali',
            'institution_city' => 'Denpasar',
            'parent_no_wa' => '089876543210',
            'pass_photo' => 'dummy/photo.jpg',
            'student_proof' => 'dummy/student_proof.pdf',
            'twibbon_links' => 'https://instagram.com/p/123',
            'subtotal' => 50000,
            'total' => 50000,
            'transaction_proof' => 'dummy/transaction.jpg',
        ]);
    }
}
