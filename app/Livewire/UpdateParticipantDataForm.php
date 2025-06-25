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
use Illuminate\Validation\Rule;

class UpdateParticipantDataForm extends Component
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

    
    public $discount = 0;
    public $competitions;

    public $user_id;
    public $member1_id;
    public $member2_id;
    public $participant_id;

    public $pass_photo_old;
    public $student_proof_old;
    public $transaction_proof_old;

    protected $rules = [
    //    rulesnya
    ];

    
    

    public function mount()
    {
        // dd($this->no_registration);
        $this->competitions = Competition::all();

        $participant = Participant::with(['competition', 'user', 'members'])->where('no_registration', $this->no_registration)->firstOrFail();

        // $this->competitions = $participant->competition;
        $this->is_team_competition = $participant->competition->is_team_competition;

        $this->user_id = $participant->user->id;
        $this->participant_id = $participant->id;

        $this->email = $participant->user->email;

        $this->source_of_information = $participant->source_of_information;
        $this->is_first_competition = $participant->is_first_competition;
        $this->reason = $participant->reason;
        $this->special_needs = $participant->special_needs;
        $this->competition = $participant->competition->id;

        $this->leader_name = $participant->leader_name;
        $this->leader_student_id = $participant->leader_student_id;
        $this->leader_date_of_birth = $participant->leader_date_of_birth;
        $this->leader_gender = $participant->leader_gender;
        $this->leader_no_wa = $participant->leader_no_wa;

        if ($participant->competition->is_team_competition) {

            $members = $participant->members->values();

            $member1 = $members->get(0);
            $member2 = $members->get(1);

            $this->member1_id = $member1->id;
            $this->member1_name = $member1->name;
            $this->member1_student_id = $member1->student_id;
            $this->member1_date_of_birth = $member1->date_of_birth;
            $this->member1_gender = $member1->gender;
            $this->member1_no_wa = $member1->no_wa;
            $this->member1_email = $member1->email;

            $this->member2_id = $member2->id;
            $this->member2_name = $member2->name;
            $this->member2_student_id = $member2->student_id;
            $this->member2_date_of_birth = $member2->date_of_birth;
            $this->member2_gender = $member2->gender;
            $this->member2_no_wa = $member2->no_wa;
            $this->member2_email = $member2->email;
        }        

        $this->institution = $participant->institution;
        $this->institution_address = $participant->institution_address;
        $this->institution_province = $participant->institution_province;
        $this->institution_city = $participant->institution_city;

        $this->parent_no_wa = $participant->parent_no_wa;
        $this->twibbon_links = $participant->twibbon_links;

        $this->coupon_code = $participant->coupon_code;
        $this->subtotal = $participant->subtotal;
        $this->discount = $participant->subtotal - $participant->total;
        $this->total = $participant->total;

        $this->pass_photo = $participant->pass_photo;
        $this->pass_photo_old = $participant->pass_photo;

        $this->student_proof = $participant->student_proof;
        $this->student_proof_old = $participant->student_proof;

        $this->transaction_proof = $participant->transaction_proof;
        $this->transaction_proof_old = $participant->transaction_proof;

    }

    public function updated($propertyName)
    {
        $this->resetErrorBag();
    }

    public function render()
    {
        if ($this->getErrorBag()->isNotEmpty()) {
            $this->dispatch('validation-errors');
        }

        return view('livewire.update-participant-data-form');
    }

    public function firstStepSubmit()
    {
        $this->validate([
            'source_of_information' => 'required',
            'is_first_competition' => 'required',
            'reason' => 'required',
            'competition' => 'required',
        ]);

        // $selectedCompetition = $this->competitions->firstWhere('id', $this->competition);
        // $selectedCompetition = $this->competitions->firstWhere('id', $this->competition);
        

        // if ($selectedCompetition) {
        //     $this->is_team_competition = $selectedCompetition->is_team_competition;
        // } else {
        //     $this->is_team_competition = false;
        // }

        // if ($selectedCompetition) {
        //     for ($i = 1; $i <= 3; $i++) {
        //         if (
        //             now()->between(
        //                 Carbon::parse(config('const.schedules.wave_' . $i . '.start')),
        //                 Carbon::parse(config('const.schedules.wave_' . $i . '.end'))
        //             )
        //         ) {
        //             $wave = 'wave_' . $i . '_price';
        //             $this->subtotal = $selectedCompetition->$wave;
        //             break;
        //         }
        //     }
        // }
        
        $this->currentStep = 2;
        $this->js("window.scrollTo({ top: 0, behavior: 'smooth' });");
    }

    public function secondStepSubmit()
    {
        // $commonRules = [
        //     'email' => 'required|email|max:255|unique:users,email. $user->id',
        //     'institution' => 'required|string|max:255',
        //     'institution_address' => 'required|string|max:500',
        //     'institution_province' => 'required|string|max:255', 
        //     'institution_city' => 'required|string|max:255',
        //     'parent_no_wa' => 'required|string|max:20',
        //     'pass_photo' => $this->pass_photo instanceof \Illuminate\Http\UploadedFile
        //         ? 'image|mimes:jpg,png|max:2048'
        //         : 'nullable',
        //     'student_proof' => $this->student_proof instanceof \Illuminate\Http\UploadedFile
        //         ? 'file|mimes:pdf|max:2048'
        //         : 'nullable',
        //     'twibbon_links' => 'required',
        //     'terms_accepted' => 'required|accepted',
        // ];

        $commonRules = [
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($this->user_id), // $this->user_id harus diset di mount()
            ],
            'institution' => 'required|string|max:255',
            'institution_address' => 'required|string|max:500',
            'institution_province' => 'required|string|max:255', 
            'institution_city' => 'required|string|max:255',
            'parent_no_wa' => 'required|string|max:20',

            'pass_photo' => $this->pass_photo instanceof \Illuminate\Http\UploadedFile
                ? 'image|mimes:jpg,png|max:2048'
                : 'nullable',

            'student_proof' => $this->student_proof instanceof \Illuminate\Http\UploadedFile
                ? 'file|mimes:pdf|max:2048'
                : 'nullable',

            'twibbon_links' => 'required',
            'terms_accepted' => 'required|accepted',
        ];

        // $leaderRules = [
        //     'leader_name' => 'required|string|max:255',
        //     'leader_student_id' => 'required|string|max:50',
        //     'leader_date_of_birth' => 'required|date',
        //     'leader_gender' => 'required',
        //     'leader_no_wa' => 'required|string|max:20|unique:participants,leader_no_wa',
        // ];
        $leaderRules = [
            'leader_name' => 'required|string|max:255',
            'leader_student_id' => 'required|string|max:50',
            'leader_date_of_birth' => 'required|date',
            'leader_gender' => 'required',
            'leader_no_wa' => [
                'required',
                'string',
                'max:20',
                Rule::unique('participants', 'leader_no_wa')->ignore($this->participant_id),
            ],
        ];

        // $memberRules = [
        //     'member1_name' => 'required_if:is_team_competition,true|string|max:255',
        //     'member1_student_id' => 'required_if:is_team_competition,true|string|max:50',
        //     'member1_date_of_birth' => 'required_if:is_team_competition,true|date',
        //     'member1_gender' => 'required_if:is_team_competition,true',
        //     'member1_no_wa' => 'required|string|max:20|unique:members,no_wa',
        //     'member1_email' => 'required_if:is_team_competition,true|email|max:255|unique:members,email',
            
        //     'member2_name' => 'required_if:is_team_competition,true|string|max:255',
        //     'member2_student_id' => 'required_if:is_team_competition,true|string|max:50',
        //     'member2_date_of_birth' => 'required_if:is_team_competition,true|date',
        //     'member2_gender' => 'required_if:is_team_competition,true',
        //     'member2_no_wa' => 'required|string|max:20|unique:members,no_wa',
        //     'member2_email' => 'required_if:is_team_competition,true|email|max:255|unique:members,email',
        // ];
        $memberRules = [
            'member1_name' => 'required_if:is_team_competition,true|string|max:255',
            'member1_student_id' => 'required_if:is_team_competition,true|string|max:50',
            'member1_date_of_birth' => 'required_if:is_team_competition,true|date',
            'member1_gender' => 'required_if:is_team_competition,true',
            'member1_no_wa' => [
                'required',
                'string',
                'max:20',
                Rule::unique('members', 'no_wa')->ignore($this->member1_id),
            ],
            'member1_email' => [
                'required_if:is_team_competition,true',
                'email',
                'max:255',
                Rule::unique('members', 'email')->ignore($this->member1_id),
            ],

            'member2_name' => 'required_if:is_team_competition,true|string|max:255',
            'member2_student_id' => 'required_if:is_team_competition,true|string|max:50',
            'member2_date_of_birth' => 'required_if:is_team_competition,true|date',
            'member2_gender' => 'required_if:is_team_competition,true',
            'member2_no_wa' => [
                'required',
                'string',
                'max:20',
                Rule::unique('members', 'no_wa')->ignore($this->member2_id),
            ],
            'member2_email' => [
                'required_if:is_team_competition,true',
                'email',
                'max:255',
                Rule::unique('members', 'email')->ignore($this->member2_id),
            ],
        ];


        if ($this->is_team_competition) {
            $this->validate(array_merge($commonRules, $leaderRules, $memberRules));
            if ($this->member1_email == $this->member2_email) {
                $this->addError('member2_email', 'Email anggota 1 dan 2 tidak boleh sama.');
            }
            if ($this->member1_no_wa == $this->member2_no_wa) {
                $this->addError('member2_no_wa', 'No. WhatsApp anggota 1 dan 2 tidak boleh sama.');
            }

            if ($this->getErrorBag()->isNotEmpty()) {
                return;
            }
        } else {
            $this->validate(array_merge($commonRules, $leaderRules));
        }
        
        // $this->total = $this->subtotal;
        $this->currentStep = 3;
        $this->js("window.scrollTo({ top: 0, behavior: 'smooth' });");
    }

    public function submitForm()
    {
        $this->validate([
            'transaction_proof' => $this->transaction_proof instanceof \Illuminate\Http\UploadedFile
                ? 'image|max:2048'
                : 'nullable',
        ]);

        // do {
        //     $this->no_registration = generateRegistrationCode();
        // } while (Participant::where('no_registration', $this->no_registration)->exists());

        $passPhotoPath = is_object($this->pass_photo)
            ? fileUpload($this->pass_photo, 'Images')
            : $this->pass_photo_old;

        $studentProofPath = is_object($this->student_proof)
            ? fileUpload($this->student_proof, 'StudentProofs')
            : $this->student_proof_old;

        $transactionProofPath = is_object($this->transaction_proof)
            ? fileUpload($this->transaction_proof, 'TransactionProofs')
            : $this->transaction_proof_old;
        
        DB::beginTransaction();
        try {

            $dataCompetition = Competition::findOrFail($this->competition);

            // $dataUser = User::create([
            //     'email' => $this->email,
            //     'password' => Hash::make($this->no_registration)
            // ]);

            $dataParticipant = Participant::where('no_registration', $this->no_registration)->firstOrFail();
            $dataParticipant->source_of_information = $this->source_of_information;
            $dataParticipant->reason = $this->reason;
            $dataParticipant->is_first_competition = $this->is_first_competition;
            $dataParticipant->special_needs = $this->special_needs;
            $dataParticipant->leader_name = $this->leader_name;
            $dataParticipant->leader_student_id = $this->leader_student_id;
            $dataParticipant->leader_date_of_birth = $this->leader_date_of_birth;
            $dataParticipant->leader_gender = $this->leader_gender;
            $dataParticipant->leader_no_wa = $this->leader_no_wa;
            $dataParticipant->institution = $this->institution;
            $dataParticipant->institution_address = $this->institution_address;
            $dataParticipant->institution_province = $this->institution_province;
            $dataParticipant->institution_city = $this->institution_city;
            $dataParticipant->parent_no_wa = $this->parent_no_wa;
            $dataParticipant->pass_photo = $passPhotoPath;
            $dataParticipant->student_proof = $studentProofPath;
            $dataParticipant->twibbon_links = $this->twibbon_links;
            $dataParticipant->subtotal = $this->subtotal;
            $dataParticipant->total = $this->total;
            $dataParticipant->coupon_code = $this->coupon_code;
            $dataParticipant->transaction_proof = $transactionProofPath;
            $dataParticipant->is_accepted = false;
            $dataParticipant->is_rejected = false;
            $dataParticipant->reject_message = null;

            $dataParticipant->save();
            
            
            if ($this->is_team_competition) {

                $member1 = Member::findOrFail($this->member1_id);
                $member1->name = $this->member1_name;
                $member1->email = $this->member1_email;
                $member1->student_id = $this->member1_student_id;
                $member1->date_of_birth = $this->member1_date_of_birth;
                $member1->no_wa = $this->member1_no_wa;
                $member1->gender = $this->member1_gender;
                $member1->save();

                $member2 = Member::findOrFail($this->member2_id);
                $member2->name = $this->member2_name;
                $member2->email = $this->member2_email;
                $member2->student_id = $this->member2_student_id;
                $member2->date_of_birth = $this->member2_date_of_birth;
                $member2->no_wa = $this->member2_no_wa;
                $member2->gender = $this->member2_gender;
                $member2->save();
                
            }

            DB::commit();
    
            Mail::to($this->email)->queue(new PasswordMail($dataParticipant->no_registration, $dataCompetition->name, $dataParticipant->leader_name ));

            $this->success = true;
            $this->currentStep = 4;
            $this->downloadInvoice();
            $this->js("window.scrollTo({ top: 0, behavior: 'smooth' });");
        } catch (\Throwable $e) {
            fileDelete($passPhotoPath);
            fileDelete($studentProofPath);
            fileDelete($transactionProofPath);
            DB::rollBack();
            session()->flash('error', 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.');
        }
    }

    public function back($step)
    {
        $this->currentStep = $step;
    }

    // public function applyCoupon()
    // {
    //     $promoCodes = config('const.promo_codes');
    //     $validPromo = collect($promoCodes)->firstWhere('code', $this->coupon_code);

    //     if ($validPromo && now()->between(
    //                     Carbon::parse($validPromo['start_date']),
    //                     Carbon::parse($validPromo['end_date']))) {
    //         $this->discount = $validPromo['value'];
    //         $this->total = $this->subtotal - $this->discount;
    //         $this->resetErrorBag('coupon_code');
    //     } else {
    //         $this->discount = 0;
    //         $this->total = $this->subtotal;
    //         $this->addError('coupon_code', 'Maaf, kode kupon tidak valid.');
    //     }
    // }

    public function downloadInvoice()
    {
        $this->dispatch('download-invoice', no_registration: $this->no_registration);
    }
}
