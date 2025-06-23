<?php

namespace App\Http\Controllers;

use App\Models\Competition;
use App\Models\Participant;
use Illuminate\Http\Request;
use App\Mail\ValidationAcceptedMail;
use App\Mail\ValidationRejectedMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ParticipantManagementController extends Controller
{
    public function viewdata($partisipant_id) {
        $data = Participant::with('members, competition')->findOrFail($partisipant_id);

        return response()->json([
                'success' => true,
                'message' => 'Berhasil update/accepted',
                'data' => $data
        ], 200);
    }

    public function accept($partisipant_id) {
        $data = Participant::with('competition, user')->findOrFail($partisipant_id);

        if ($data->is_accepted) {
            return response()->json([
                'success' => false,
                'message' => 'Peserta sudah diterima sebelumnya.',
            ], 400);
        }

        $jumlahPartisipan = Participant::where('competition_id', $data->competition_id)
                                ->where('is_accepted', true)
                                ->count();

        $nextNo = str_pad((int) $jumlahPartisipan + 1, 3, '0', STR_PAD_LEFT);
        $noPartisipant = $data->competition->code . '_' . $nextNo;

        $token = random_int(10000, 99999);

        $data->no_participant = $noPartisipant;
        $data->token = $token;
        $data->is_accepted = true;
        $data->save();

        Mail::to($data->user->email)->queue(new ValidationAcceptedMail( $data->competition->name));
        
        return response()->json([
                'success' => true,
                'message' => 'Berhasil update (participan data accepted)',
        ], 200);
    }


    public function reject($partisipant_id, Request $request) {
        $data = Participant::with('competition, user')->findOrFail($partisipant_id);

        $validatedData = $request->validate([
            'reject_message' => ['required', 'string'],
        ]);

        $data->is_rejected = true;
        $data->reject_message = $validatedData['reject_message'];
        $data->save();

        Mail::to($data->user->email)->queue(new ValidationAcceptedMail( $data->competition->name));

        return response()->json([
            'success' => true,
            'message' => 'Partisipan berhasil ditolak dan email telah dikirim.'
        ]);
    }

    public function show(Request $request) {

        $participants = Participant::with('competition')
            ->when($request->search, function ($query, $search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->when($request->competition_id, function ($query, $competition_id) {
                $query->where('competition_id', $competition_id);
            })
            ->when($request->status, function ($query, $status) {
                if ($status == "accepted") {
                    $query->where('is_accepted', true);
                } elseif ($status == "rejected") {
                    $query->where('is_rejected', true);
                } elseif ($status == "pending") {
                    $query->where('is_accepted', false)
                        ->where('is_rejected', false);
                }
            })
            ->paginate(10)
            ->withQueryString();

        $competitions = Competition::all();

        return view('participants.index', compact('participants', 'competitions'));
    }
}
