<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ParticipantController extends Controller
{
    public function update($no_registration, Request $request) {
        try { 
            $participant = Participant::where('no_registration', $no_registration)->firstOrFail();
            
            \Log::info('All request data:', $request->all());

            $validatedParticipant = $request->validate([
                'source_of_information' => 'sometimes|string|max:100',
                'motivation'            => 'sometimes|string',
    
                'leader_name'           => 'sometimes|string|max:100',
                'leader_student_id'     => 'sometimes|string|max:50',
                'leader_date_of_birth'  => 'sometimes|date',
                'leader_gender'         => 'sometimes|in:L,P',
                'leader_no_wa'          => 'sometimes|string|max:20',
    
                'institution'           => 'sometimes|string|max:100',
                'institution_address'   => 'sometimes|string|max:255',
                'institution_province'  => 'sometimes|string|max:50',
                'institution_city'      => 'sometimes|string|max:100',
                'parent_no_wa'          => 'sometimes|string|max:20',
    
                'pass_photo'            => 'sometimes|file|mimes:jpg,jpeg,png|max:512',
                'student_proof'         => 'sometimes|file|mimes:pdf|max:2048',
                'twibbon_links'         => 'sometimes|string',
                'transaction_proof'     => 'sometimes|file|mimes:jpg,jpeg,png|max:512',
            ]);
    
            $validatedMembers = $request->validate([
                'members' => 'sometimes|array',
                'members.*.id' => 'required|integer|exists:members,id',
                'members.*.name' => 'sometimes|string|max:100',
                'members.*.student_id' => 'sometimes|string|max:50',
                'members.*.date_of_birth' => 'sometimes|date',
                'members.*.no_wa' => 'sometimes|string|max:20',
                // 'members.*.email' => 'sometimes|email|max:255',
            ]);
    
            $files = ['pass_photo', 'student_proof', 'transaction_proof'];
    
            foreach ($files as $file) {
                if ($request->hasFile($file)) {
                    if ($participant->$file && Storage::disk('public')->exists($participant->$file)) {
                        Storage::disk('public')->delete($participant->$file);
                    }
                    $folder = '';
                    if ($file === 'pass_photo') {
                        $folder = 'Images';
                    }
                    if ($file === 'student_proof') {
                        $folder = 'StudentProofs';
                    }
                    if ($file === 'transaction_proof') {
                        $folder = 'TransactionProofs';
                    }

                    $validatedParticipant[$file] = fileUpload($request->file($file), $folder);
                }
            }
            
            foreach ($validatedMembers['members'] ?? [] as $memberData) {
                $memberId = $memberData['id'];
    
                // Ambil member yang sesuai dengan participant_id (pastikan milik participant yang sama)
                $member = Member::where('id', $memberId)
                    ->where('participant_id', $participant->id)
                    ->first();
    
                if (!$member) {
                    // Abaikan jika member tidak ditemukan atau tidak milik participant ini
                    continue;
                }
    
                // Buat array field yang boleh di-update
                $updatableFields = ['name', 'student_id', 'date_of_birth', 'no_wa', 'email'];
                $dataToUpdate = collect($memberData)->only($updatableFields)->toArray();
    
                // Update hanya jika ada data yang diubah
                if (!empty($dataToUpdate)) {
                    $member->update($dataToUpdate);
                }
            }
    
            $validatedParticipant['is_rejected'] = false;
            $validatedParticipant['reject_message'] = null;

            \Log::info('Updating participant', [
                'id' => $participant->id,
                'validated' => $validatedParticipant
            ]);

            $updated = $participant->update($validatedParticipant);

            return response()->json([
                'message' => 'Data berhasil diperbarui',
                'updated' => $updated,
                'data' => $participant->fresh() // ambil ulang dari database
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
