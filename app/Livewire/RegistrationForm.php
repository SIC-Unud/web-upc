<?php

namespace App\Livewire;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Member;
use Livewire\Component;
use App\Mail\PasswordMail;
use App\Models\Competition;
use App\Models\Participant;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class RegistrationForm extends Component
{
    use WithFileUploads;

    public $currentStep = 1;
    public $success = false;
    
    public $source_of_information;
    public $is_first_competition;
    public $reason;
    public $special_needs;
    public $competition;
    public $is_team_competition = false;
    
    public $leader_name;
    public $leader_student_id;
    public $leader_date_of_birth;
    public $leader_gender;
    public $leader_no_wa;
    public $email;

    public $member1_name;
    public $member1_student_id;
    public $member1_date_of_birth;
    public $member1_gender;
    public $member1_no_wa;
    public $member1_email;
    
    public $member2_name;
    public $member2_student_id;
    public $member2_date_of_birth;
    public $member2_gender;
    public $member2_no_wa;
    public $member2_email;

    public $institution;
    public $institution_address;
    public $institution_province;
    public $institution_city;

    public $parent_no_wa;
    public $pass_photo;
    public $student_proof;
    public $twibbon_links;
    public $terms_accepted = false;
    

    public $coupon_code;
    public $transaction_proof;
    public $no_registration;
    public $subtotal;
    public $total;

    public $registrationFee = 0;
    public $appFee = 1000;
    public $discount = 0;
    public $competitions;


    protected $rules = [
    //    rulesnya
    ];

    // nanti ambil dari db
    // public array $competitions = [
    //     [
    //         'name' => 'Cerdas cermat SD (kelompok)',
    //         'is_team_competition' => true,
    //     ],
    //     [
    //         'name' => 'Fisika SMP',
    //         'is_team_competition' => false,
    //     ],
    //     [
    //         'name' => 'Fisika SMA',
    //         'is_team_competition' => false,
    //     ],
    //     [
    //         'name' => 'Kebumian',
    //         'is_team_competition' => false,
    //     ],
    //     [
    //         'name' => 'Astronomi',
    //         'is_team_competition' => false,
    //     ],
    //     [
    //         'name' => 'Esai (kelompok)',
    //         'is_team_competition' => true,
    //     ],
    //     [
    //         'name' => 'Poster Ilmiah (kelompok)',
    //         'is_team_competition' => true,
    //     ],
    // ];

    public function mount()
    {
        $this->competitions = Competition::all();
    }

    public function render()
    {
        return view('livewire.register-form2');
    }

    public function firstStepSubmit()
    {
        $this->validate([
            'source_of_information' => 'required',
            'is_first_competition' => 'required',
            'reason' => 'required',
            'competition' => 'required',
        ]);

        $selectedCompetition = $this->competitions->firstWhere('id', $this->competition);

        if ($selectedCompetition) {
            $this->is_team_competition = $selectedCompetition->is_team_competition;
        } else {
            $this->is_team_competition = false;
        }

        if ($selectedCompetition) {
            for ($i = 1; $i <= 3; $i++) {
                if (
                    now()->between(
                        Carbon::parse(config('const.schedules.wave_' . $i . '.start')),
                        Carbon::parse(config('const.schedules.wave_' . $i . '.end'))
                    )
                ) {
                    $wave = 'wave_' . $i . '_price';
                    $this->subtotal = $selectedCompetition->$wave;
                    break;
                }
            }
        }
        
        $this->currentStep = 2;
        $this->js("window.scrollTo({ top: 0, behavior: 'smooth' });");
    }

    public function secondStepSubmit()
    {
        $commonRules = [
            'email' => 'required|email|max:255',
            'institution' => 'required|string|max:255',
            'institution_address' => 'required|string|max:500',
            'institution_province' => 'required|string|max:255',
            'institution_city' => 'required|string|max:255',
            'parent_no_wa' => 'required|string|max:20',
            'pass_photo' => 'required|image|mimes:jpg,png|max:2048',
            'student_proof' => 'required|file|mimes:pdf|max:2048',
            'twibbon_links' => 'required',
            'terms_accepted' => 'required|accepted',
        ];

        $leaderRules = [
            'leader_name' => 'required|string|max:255',
            'leader_student_id' => 'required|string|max:50',
            'leader_date_of_birth' => 'required|date',
            'leader_gender' => 'required',
            'leader_no_wa' => 'required|string|max:20',
        ];

        $memberRules = [
            'member1_name' => 'required_if:is_team_competition,true|string|max:255',
            'member1_student_id' => 'required_if:is_team_competition,true|string|max:50',
            'member1_date_of_birth' => 'required_if:is_team_competition,true|date',
            'member1_gender' => 'required_if:is_team_competition,true',
            'member1_no_wa' => 'required|string|max:20',
            'member1_email' => 'required_if:is_team_competition,true|email|max:255',
            
            'member2_name' => 'required_if:is_team_competition,true|string|max:255',
            'member2_student_id' => 'required_if:is_team_competition,true|string|max:50',
            'member2_date_of_birth' => 'required_if:is_team_competition,true|date',
            'member2_gender' => 'required_if:is_team_competition,true',
            'member2_no_wa' => 'required|string|max:20',
            'member2_email' => 'required_if:is_team_competition,true|email|max:255',
        ];

        if ($this->is_team_competition) {
            $this->validate(array_merge($commonRules, $leaderRules, $memberRules));
        } else {
            $this->validate(array_merge($commonRules, $leaderRules));
        }
        
        $this->total = $this->subtotal + 1000;
        $this->currentStep = 3;
        $this->js("window.scrollTo({ top: 0, behavior: 'smooth' });");
    }

    public function submitForm()
    {
        $this->validate([
            'transaction_proof' => 'required|image|max:2048',
        ]);

        do {
            $this->no_registration = generateRegistrationCode();
        } while (Participant::where('no_registration', $this->no_registration)->exists());

        $passPhotoPath = fileUpload($this->pass_photo, 'Images');
        $studentProofPath = fileUpload($this->student_proof, 'StudentProofs');
        $transactionProofPath = fileUpload($this->transaction_proof, 'TransactionProofs');
        
        DB::beginTransaction();
        try {

            $dataCompetition = Competition::findOrFail($this->competition);

            $dataUser = User::create([
                'email' => $this->email,
                'password' => Hash::make($this->no_registration)
            ]);
    
            $dataParticipant = Participant::create([
                'user_id' => $dataUser->id,
                'no_registration' => now()->format('YmdHis') . rand(100, 999),
                'competition_id' => $this->competition,
                'source_of_information' => $this->source_of_information,
                'reason' => $this->reason,
                'is_first_competition' => $this->is_first_competition,
                'special_needs' => $this->special_needs,
                'leader_name' => $this->leader_name,
                'leader_student_id' => $this->leader_student_id,
                'leader_date_of_birth' => $this->leader_date_of_birth,
                'leader_gender' => $this->leader_gender,
                'leader_no_wa' => $this->leader_no_wa,
                'institution' => $this->institution,
                'institution_address' => $this->institution_address,
                'institution_province' => $this->institution_province,
                'institution_city' => $this->institution_city,
                'parent_no_wa' => $this->parent_no_wa,
                'pass_photo' => $passPhotoPath,
                'student_proof' => $studentProofPath,
                'twibbon_links' => $this->twibbon_links,
                'subtotal' => $this->subtotal,
                'total' => $this->total,
                'transaction_proof' => $transactionProofPath,
                'is_accepted' => false,
                'is_rejected' => false,
                'reject_message' => null,
            ]);
            
            
            if ($this->is_team_competition) {
                Member::create([
                    'participant_id' => $dataParticipant->id,
                    'name' => $this->member1_name,
                    'email' => $this->member1_email,
                    'student_id' => $this->member1_student_id,
                    'date_of_birth' => $this->member1_date_of_birth,
                    'no_wa' => $this->member1_no_wa,
                    'gender' => $this->member1_gender,
                ]);

                Member::create([
                    'participant_id' => $dataParticipant->id,
                    'name' => $this->member2_name,
                    'email' => $this->member2_email,
                    'student_id' => $this->member2_student_id,
                    'date_of_birth' => $this->member2_date_of_birth,
                    'no_wa' => $this->member2_no_wa,
                    'gender' => $this->member2_gender,
                ]);
            }

            DB::commit();
    
            Mail::to($this->email)->send(new PasswordMail($dataParticipant->no_registration, $dataCompetition->name, $dataParticipant->leader_name ));
            
            // return redirect()->route('register.form')->with('download_invoice', $dataParticipant->no_registration);$participant = Participant::where('no_registration', $no_registration)->first();

            // return response()->json([
            //     'success' => true,
            //     'message' => 'Data berhasil disimpan.',
            //     'data' => $validated
            // ], 201);

            $this->success = true;
            $this->currentStep = 4;
            $this->js("window.scrollTo({ top: 0, behavior: 'smooth' });");
        } catch (\Throwable $e) {
            //ini kurang tau mau diisi apa
            // DB::rollBack();
            // Log::error('Gagal menyimpan peserta', [
            //     'message' => $e->getMessage(),
            //     'trace' => $e->getTraceAsString()
            // ]);

            // return response()->json([
            //     'success' => false,
            //     'message' => 'Terjadi kesalahan saat menyimpan data.',
            //     'error'   => $e->getMessage()
            // ], 500);
        }
    }

    public function back($step)
    {
        $this->currentStep = $step;
    }

    public function applyCoupon()
    {
        // if ($this->coupon_code === 'UPC99') {
        //     $this->total = $this->total - 10000;
        //     $this->resetErrorBag('coupon_code');
        // } else {
        //     $this->addError('coupon_code', 'Maaf kode kupon anda tidak valid');
        // }
        $valid = false;
        foreach (config('const.promo_codes') as $promo) {
            if ($promo['code'] === $this->coupon_code) {
                $this->discount = $this->registrationFee * $promo['discount'] / 100;
                $this->total = $this->total - $this->discount;
                $this->resetErrorBag('coupon_code');
                $valid = true;
                break;
            }
        }

        if (!$valid) {
            $this->discount = 0;
            $this->addError('coupon_code', 'Maaf kode kupon anda tidak valid');
        }
    }

    // public function updateDiscount()
    // {   
    //     $valid = false;
    //     foreach (config('const.promo_codes') as $promo) {
    //         if ($promo['code'] === $this->couponCode) {
    //             $this->discount = $this->registrationFee * $promo['discount'] / 100;
    //             $this->errorMessage = '';
    //             $valid = true;
    //             break;
    //         }
    //     }

    //     if (!$valid) {
    //         $this->discount = 0;
    //         $this->errorMessage = 'Maaf kode kupon anda tidak valid';
    //     }
    // }

    // public function updatedRegisterFee($value)
    // {
    //     $selected = $this->listCabang->firstWhere('id', $value);
    //     for ($i = 1; $i <= 3; $i++) {
    //         if (
    //             now()->between(
    //             Carbon::parse(config('const.schedules.wave_' . $i . '.start')),
    //             Carbon::parse(config('const.schedules.wave_' . $i . '.end')))
    //         ) {
    //             $name = 'wave_' . $i . '_price';
    //             $this->registrationFee = $selected->$name;
    //             break;
    //         }
    //     }
    // }

    public function total()
    {
        $this->total = max(0, $this->registrationFee + $this->appFee - $this->discount);
    }


}