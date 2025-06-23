<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Member;
use App\Mail\PasswordMail;
use App\Models\Competition;
use App\Models\Participant;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use function Pest\Laravel\json;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Log;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function show()
    // {
    //     $listCabang = Competition::all(); 
    //     return response()->json( [
    //         'success' => true,
    //         'data' => $listCabang
    //     ], 200);
    //     // return view('register', compact('listCabang'));
    // }

    // public function create(Request $request)
    // {
    //     $validatedEx = $request->validate([
    //         'email' => 'required|email:rfc,dns|max:255|unique:users,email',
    //         'promo_codes' => 'required|string'
    //     ]);

    //     $validated = $request->validate([
    //         'source_of_information' => 'required|string|max:50',
    //         'reason'                => 'required|string|max:50',
    //         'competition_id'        => 'required|exists:competitions,id',
    //         'is_first_competition'  => 'required|integer|min:0|max:1',
    //         'special_needs'         => 'required|string|',

    //         'leader_name'           => 'required|string|max:100',
    //         'leader_student_id'     => 'required|string|max:50',
    //         'leader_date_of_birth'  => 'required|date',
    //         'leader_gender'         => 'required|string|max:255',
    //         'leader_no_wa'          => 'required|string|max:20',

    //         'institution'           => 'required|string|max:100',
    //         'institution_address'   => 'required|string|max:255',
    //         'institution_province'  => 'required|string|max:50',
    //         'institution_city'      => 'required|string|max:100',
    //         'parent_no_wa'          => 'required|string|max:20',

    //         'pass_photo'            => 'required|file|mimes:jpg,jpeg,png|max:512',
    //         'student_proof'         => 'required|file|mimes:pdf|max:2048',
    //         'twibbon_links'         => 'required|string',

    //         'transaction_proof'     => 'required|file|mimes:jpg,jpeg,png|max:512'
    //     ]);

    //     $dataCompetition = Competition::findOrFail($validated['competition_id']);

    //     $valMembers = [];
    //     if ($dataCompetition->is_team_competition) {
    //         $validatedData = $request->validate([
    //             'members' => 'required|array|min:1',
    //             'members.*.name' => 'required|string|max:100',
    //             'members.*.email' => 'required|string|max:255',
    //             'members.*.student_id' => 'required|string|max:50',
    //             'members.*.date_of_birth' => 'required|date',
    //             'members.*.no_wa' => 'required|string|max:20',
    //             'members.*.gender' => 'required|string|max:255',
    //         ]);

    //         $valMembers = $validatedData['members'];
    //     }

        
    //     do {
    //         $validated['no_registration'] = generateRegistrationCode();
    //     } while (Participant::where('no_registration', $validated['no_registration'])->exists());

    //     $validated['pass_photo'] = fileUpload($request->file('pass_photo'), 'Images');
    //     $validated['student_proof'] = fileUpload($request->file('student_proof'), 'StudentProofs');
    //     $validated['transaction_proof'] = fileUpload($request->file('transaction_proof'), 'TransactionProofs');

    //     for ($i = 1; $i <= 3; $i++) {
    //         if (
    //             now()->between(
    //             Carbon::parse(config('const.schedules.wave_' . $i . '.start')),
    //             Carbon::parse(config('const.schedules.wave_' . $i . '.end')))
    //         ) {
    //             $name = 'wave_' . $i . '_price';
    //             $validated['subtotal'] = $dataCompetition->$name;
    //             break;
    //         }
    //     }

    //     foreach (config('const.promo_codes') as $promo) {
    //         if ($promo['code'] === $validatedEx['promo_codes']) {
    //             $validated['total'] = ((100 - $promo['discount']) / 100 * $validated['subtotal']) + 1000;
    //             break;
    //         }
    //     }

    //     if (!isset($validated['total'])) {
    //         $validated['total'] = $validated['subtotal'];
    //     }
        
    //     DB::beginTransaction();
    //     try {
    //         $dataUser = User::create([
    //             'email' => $validatedEx['email'],
    //             'password' => Hash::make($validated['no_registration'])
    //         ]);
    
    //         $validated['user_id'] = $dataUser->id;
    
    //         $dataParticipant = Participant::create($validated);
    
    //         foreach ($valMembers as $member) {
    //             Member::create([
    //                 'participant_id' => $dataParticipant->id,
    //                 'name' => $member['name'],
    //                 'email' => $member['email'],
    //                 'student_id' => $member['student_id'],
    //                 'date_of_birth' => $member['date_of_birth'],
    //                 'no_wa' => $member['no_wa'],
    //                 'gender' => $member['gender']
    //             ]);
    //         }

    //         DB::commit();
    
    //         // Mail::to($validatedEx['email'])->send(new PasswordMail($dataParticipant->no_registration, $dataCompetition->name, $dataParticipant->leader_name ));
            
    //         // return redirect()->route('register.form')->with('download_invoice', $dataParticipant->no_registration);$participant = Participant::where('no_registration', $no_registration)->first();

    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Data berhasil disimpan.',
    //             'data' => $validated
    //         ], 201);
    //     } catch (\Throwable $e) {
    //         DB::rollBack();
    //         // Log::error('Gagal menyimpan peserta', [
    //         //     'message' => $e->getMessage(),
    //         //     'trace' => $e->getTraceAsString()
    //         // ]);

    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Terjadi kesalahan saat menyimpan data.',
    //             'error'   => $e->getMessage()
    //         ], 500);
    //     }
    // }

    public function index()
    {
        return view('login');
    }

    public function register()
    {
        return view('register');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $data = User::with(['participant:user_id,competition_id,leader_name,institution,created_at,is_accepted,is_rejected,reject_message',
                        'participant.competition:id,name'])
                        ->where('email', $credentials['email'])
                        ->first();

            if ($data->participant->is_rejected === true) {
                return redirect()->route('login')->with([
                    'status' => 'Sedang divalidasi',
                    'data' => $data
                ]);
            } else if ($data->participant->is_accepted !== true) {
                $request->session()->regenerate();
                return redirect()->route('login')->with([
                    'success' => 'Gagal divalidasi',
                    'data' => $data
                ]);
            } else {
                $request->session()->regenerate();
                return redirect()->intended('dashboard');
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }


    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(string $id)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(Request $request, string $id)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(string $id)
    // {
    //     //
    // }
}
