<?php

namespace App\Exports;

use App\Models\Participant;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromQuery;

class ParticipantExport implements  FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
    protected $competitionId;
    protected $status;

    public function __construct($competitionId = null, $status = null)
    {
        $this->competitionId = $competitionId;
        $this->status = $status;
    }

    public function query()
    {
        return Participant::with(['user', 'competition', 'members'])
            ->when($this->competitionId, fn($q) => $q->where('competition_id', $this->competitionId))
            ->when($this->status, function ($q) {
                if ($this->status === 'accepted') {
                    return $q->where('is_accepted', true);
                } elseif ($this->status === 'rejected') {
                    return $q->where('is_rejected', true);
                } elseif ($this->status === 'pending') {
                    return $q->where('is_accepted', false)->where('is_rejected', false);
                }
            });
    }

    public function map($participant): array
    {
        $m1 = $participant->members->get(0);
        $m2 = $participant->members->get(1);

        return [
            $participant->no_registration,
            $participant->no_participant,
            $participant->leader_name,
            $participant->user->email,
            $participant->token,
            $participant->competition->name,
            $participant->source_of_information,
            $participant->reason,
            $participant->is_first_competition ? 'Yes' : 'No',
            $participant->special_needs,
            $participant->leader_student_id,
            $participant->leader_date_of_birth,
            $participant->leader_gender,
            $participant->leader_no_wa,
            $participant->institution,
            $participant->institution_address,
            $participant->institution_city,
            $participant->institution_province,
            $participant->parent_no_wa,
            $participant->subtotal,
            $participant->total,
            $participant->is_accepted ? 'Yes' : 'No',
            $participant->is_rejected ? 'Yes' : 'No',
            $participant->reject_message,
            // Kolom Member 1
            $m1?->name               ?: '',
            $m1?->student_id         ?: '',
            $m1?->gender             ?: '',
            $m1?->date_of_birth      ?: '',
            $m1?->no_wa              ?: '',
            $m1?->email              ?: '',
            // Kolom Member 2
            $m2?->name               ?: '',
            $m2?->student_id         ?: '',
            $m2?->gender             ?: '',
            $m2?->date_of_birth      ?: '',
            $m2?->no_wa              ?: '',
            $m2?->email              ?: '',
            $participant->created_at,
            $participant->updated_at
        ];
    }

    public function headings(): array
    {
        return [
            'No Registration',
            'No Participant',
            'Leader Name',
            'Email',
            'Token',
            'Competition Name',
            'Source of Information',
            'Reason',
            'First Time Competing',
            'Special Needs',
            'Leader Student ID',
            'Leader Date of Birth',
            'Leader Gender',
            'Leader WhatsApp',
            'Institution',
            'Institution Address',
            'Institution City',
            'Institution Province',
            'Parent WhatsApp',
            'Subtotal',
            'Total',
            'Is Accepted',
            'Is Rejected',
            'Reject Message',
            'Member 1 Name',
            'Member 1 Student Id',
            'Member 1 Gender',
            'Member 1 Date of Birth',
            'Member 1 No WA',
            'Member 1 Email',
            'Member 2 Name',
            'Member 2 Student Id',
            'Member 2 Gender',
            'Member 2 Date of Birth',
            'Member 2 No WA',
            'Member 2 Email',
            'Created At',
            'Updated At'
        ];
    }
}
