<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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
        $data = Participant::with(['competition', 'user'])->findOrFail($partisipant_id);

        if ($data->is_accepted) {
            abort(400, 'Peserta sudah diterima sebelumnya.');
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
        
        return back()->with('success', 'User berhasil diverifikasi.');
    }


    public function reject($partisipant_id, Request $request) {
        $data = Participant::with(['competition', 'user'])->findOrFail($partisipant_id);

        if ($data->is_accepted) {
            abort(400, 'Peserta sudah diterima sebelumnya.');
        }

        if ($data->is_rejected) {
            abort(400, 'Peserta sudah ditolak sebelumnya.');
        }

        $validatedData = $request->validate([
            'reject_message' => ['required', 'string'],
        ]);

        $data->is_rejected = true;
        $data->reject_message = $validatedData['reject_message'];
        $data->save();

        Mail::to($data->user->email)->queue(new ValidationRejectedMail( $data->competition->name, $data->no_registration, $data->reject_message));

        return back()->with('success', 'User berhasil ditolak.');
    }

    public function show(Request $request) {

        $participants = Participant::with('competition')
            ->when($request->search, function ($query, $search) {
                $query->where('leader_name', 'like', '%' . $search . '%');
            })
            ->when($request->kompetisi, function ($query, $kompetisi) {
                $query->where('competition_id', $kompetisi);
            })
            ->when($request->status, function ($query, $status) {
                if ($status == "diterima") {
                    $query->where('is_accepted', true);
                } elseif ($status == "ditolak") {
                    $query->where('is_rejected', true);
                } elseif ($status == "menunggu") {
                    $query->where('is_accepted', false)
                        ->where('is_rejected', false);
                }
            })
            ->paginate(10)
            ->withQueryString();

        $users = $participants->toArray()['data'];

        // $competitions = Competition::all();

        $headers = ['No. Reg', 'Nama lengkap', 'NISN/NIM', 'No. Tlp', 'Waktu Registrasi', 'Kompetisi', 'Status', 'Aksi'];

        return view("manajemen-user", compact('headers', 'users'));
    }
}
