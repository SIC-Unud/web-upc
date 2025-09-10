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
    public $competition_name;
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

    protected $rules = [
    //    rulesnya
    ];

    public function mount()
    {
        $this->competitions = Competition::where('slug', '!=', 'simulation')->get();
        if ( now()->lt(Carbon::parse(config('const.schedules.wave_1.start'))) ) {
            return redirect()->route('registration.not-found', 'not');
        } else if(now()->gt(Carbon::parse(config('const.schedules.wave_3.end')))) {
            return redirect()->route('registration.not-found', 'late');
        }
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

        return view('livewire.registration-from');
    }

    public function firstStepSubmit()
    {
        $this->validate([
            'source_of_information' => 'required',
            'is_first_competition' => 'required',
            'reason' => 'required',
            'competition' => 'required',
        ], [
            'source_of_information.required' => 'Sumber informasi wajib diisi.',
            'is_first_competition.required' => 'Pertanyaan apakah ini kompetisi pertama wajib dijawab.',
            'reason.required' => 'Alasan mengikuti kompetisi wajib diisi.',
            'competition.required' => 'Kompetisi yang dipilih wajib diisi.',
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
                    $this->competition_name = $selectedCompetition->name.($i == 1 ? " - Gelombang 1" : ($i == 2 ? " - Gelombang 2" : ($i == 3 ? " - Gelombang 3" : "")));
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
            'email' => 'required|email|max:255|unique:users,email',
            'institution' => 'required|string|max:255',
            'institution_address' => 'required|string|max:500',
            'institution_province' => 'required|string|max:255',
            'institution_city' => 'required|string|max:255',
            'parent_no_wa' => 'required|string|max:20',
            'pass_photo' => 'required|image|mimes:jpg,png|max:500',
            'student_proof' => 'required|file|mimes:pdf|max:1024',
            'twibbon_links' => 'required',
            'terms_accepted' => 'required|accepted',
        ];

        $leaderRules = [
            'leader_name' => 'required|string|max:255',
            'leader_student_id' => 'required|string|max:50',
            'leader_date_of_birth' => 'required|date',
            'leader_gender' => 'required',
            'leader_no_wa' => 'required|string|max:20|unique:participants,leader_no_wa',
        ];

        $memberRules = [
            'member1_name' => 'required_if:is_team_competition,true|string|max:255',
            'member1_student_id' => 'required_if:is_team_competition,true|string|max:50',
            'member1_date_of_birth' => 'required_if:is_team_competition,true|date',
            'member1_gender' => 'required_if:is_team_competition,true',
            'member1_no_wa' => 'required_if:is_team_competition,true|string|max:20|unique:members,no_wa',
            'member1_email' => 'required_if:is_team_competition,true|email|max:255|unique:members,email',
            
            'member2_name' => 'nullable|string|max:255',
            'member2_student_id' => 'nullable|string|max:50|required_with:member2_name',
            'member2_date_of_birth' => 'nullable|date|required_with:member2_name',
            'member2_no_wa' => 'nullable|string|max:20|unique:members,no_wa|required_with:member2_name',
            'member2_email' => 'nullable|email|max:255|unique:members,email|required_with:member2_name',
            'member2_gender' => 'nullable|required_with:member2_name'
        ];

        if ($this->is_team_competition) {
            $this->validate(array_merge($commonRules, $leaderRules, $memberRules), [
                'email.required' => 'Email wajib diisi.',
                'email.email' => 'Format email tidak valid.',
                'email.unique' => 'Email sudah digunakan.',

                'institution.required' => 'Nama institusi wajib diisi.',
                'institution_address.required' => 'Alamat institusi wajib diisi.',
                'institution_province.required' => 'Provinsi institusi wajib diisi.',
                'institution_city.required' => 'Kota institusi wajib diisi.',
                'parent_no_wa.required' => 'Nomor WhatsApp orang tua wajib diisi.',

                'pass_photo.required' => 'Pas foto wajib diunggah.',
                'pass_photo.image' => 'Pas foto harus berupa gambar.',
                'pass_photo.mimes' => 'Pas foto harus berformat jpg atau png.',
                'pass_photo.max' => 'Ukuran pas foto maksimal 500KB.',

                'student_proof.required' => 'Bukti sebagai siswa wajib diunggah.',
                'student_proof.file' => 'Bukti harus berupa file.',
                'student_proof.mimes' => 'Bukti harus berformat PDF.',
                'student_proof.max' => 'Ukuran bukti siswa maksimal 1024KB.',

                'twibbon_links.required' => 'Link twibbon wajib diisi.',
                'terms_accepted.required' => 'Kamu harus menyetujui syarat dan ketentuan.',
                'terms_accepted.accepted' => 'Kamu harus menyetujui syarat dan ketentuan.',

                'leader_name.required' => 'Nama ketua tim wajib diisi.',
                'leader_student_id.required' => 'NIS/NISN ketua tim wajib diisi.',
                'leader_date_of_birth.required' => 'Tanggal lahir ketua tim wajib diisi.',
                'leader_gender.required' => 'Jenis kelamin ketua tim wajib diisi.',
                'leader_no_wa.required' => 'Nomor WhatsApp ketua tim wajib diisi.',
                'leader_no_wa.unique' => 'Nomor WhatsApp ini sudah digunakan.',

                'member1_name.required_if' => 'Nama anggota 1 wajib diisi.',
                'member1_email.required_if' => 'Email anggota 1 wajib diisi.',
                'member1_email.email' => 'Format email anggota 1 tidak valid.',
                'member1_email.unique' => 'Email anggota 1 sudah digunakan.',
                'member1_no_wa.required' => 'Nomor WhatsApp anggota 1 wajib diisi.',
                'member1_no_wa.unique' => 'Nomor WhatsApp anggota 1 sudah digunakan.',

                // 'member2_name.required_if' => 'Nama anggota 2 wajib diisi.',
                // 'member2_email.required_if' => 'Email anggota 2 wajib diisi.',
                'member2_email.email' => 'Format email anggota 2 tidak valid.',
                'member2_email.unique' => 'Email anggota 2 sudah digunakan.',
                // 'member2_no_wa.required' => 'Nomor WhatsApp anggota 2 wajib diisi.',
                'member2_no_wa.unique' => 'Nomor WhatsApp anggota 2 sudah digunakan.',
                'member2_student_id.required_with'   => 'NIM anggota 2 wajib diisi jika nama anggota 2 diisi.',
                'member2_date_of_birth.required_with'=> 'Tanggal lahir anggota 2 wajib diisi jika nama anggota 2 diisi.',
                'member2_no_wa.required_with' => 'No. WA anggota 2 wajib diisi jika nama anggota 2 diisi.',
                'member2_email.required_with' => 'Email anggota 2 wajib diisi jika nama anggota 2 diisi.',
                'member2_gender.required_with' => 'Jenis kelamin anggota 2 wajib diisi jika nama anggota 2 diisi.',
            ]);
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
            $this->validate(array_merge($commonRules, $leaderRules), [
                'email.required' => 'Email wajib diisi.',
                'email.email' => 'Format email tidak valid.',
                'email.unique' => 'Email sudah digunakan.',

                'institution.required' => 'Nama institusi wajib diisi.',
                'institution_address.required' => 'Alamat institusi wajib diisi.',
                'institution_province.required' => 'Provinsi institusi wajib diisi.',
                'institution_city.required' => 'Kota institusi wajib diisi.',
                'parent_no_wa.required' => 'Nomor WhatsApp orang tua wajib diisi.',

                'pass_photo.required' => 'Pas foto wajib diunggah.',
                'pass_photo.image' => 'Pas foto harus berupa gambar.',
                'pass_photo.mimes' => 'Pas foto harus berformat jpg atau png.',
                'pass_photo.max' => 'Ukuran pas foto maksimal 500KB.',

                'student_proof.required' => 'Bukti sebagai siswa wajib diunggah.',
                'student_proof.file' => 'Bukti harus berupa file.',
                'student_proof.mimes' => 'Bukti harus berformat PDF.',
                'student_proof.max' => 'Ukuran bukti maksimal 1024KB.',

                'twibbon_links.required' => 'Link twibbon wajib diisi.',
                'terms_accepted.required' => 'Kamu harus menyetujui syarat dan ketentuan.',
                'terms_accepted.accepted' => 'Kamu harus menyetujui syarat dan ketentuan.',

                'leader_name.required' => 'Nama ketua tim wajib diisi.',
                'leader_student_id.required' => 'NIS/NISN ketua tim wajib diisi.',
                'leader_date_of_birth.required' => 'Tanggal lahir ketua tim wajib diisi.',
                'leader_gender.required' => 'Jenis kelamin ketua tim wajib diisi.',
                'leader_no_wa.required' => 'Nomor WhatsApp ketua tim wajib diisi.',
                'leader_no_wa.unique' => 'Nomor WhatsApp ini sudah digunakan.'
            ]);
        }
        $this->total = $this->subtotal;
        $this->currentStep = 3;
        $this->js("window.scrollTo({ top: 0, behavior: 'smooth' });");
    }

    public function submitForm()
    {
        $this->validate([
            'transaction_proof' => 'required|image|max:500',
        ], [
            'transaction_proof.required' => 'Bukti pembayaran wajib diunggah.',
            'transaction_proof.image' => 'Bukti pembayaran harus berupa gambar.',
            'transaction_proof.max' => 'Ukuran bukti pembayaran maksimal 500KB.',
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
                'no_registration' => $this->no_registration,
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
                'coupon_code' => $this->coupon_code,
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

                if(!blank($this->member2_name)) {
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
            // dd($e);
            session()->flash('error', 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.');
        }
    }

    public function back($step)
    {
        $this->currentStep = $step;
    }

    public function applyCoupon()
    {
        $promoCodes = config('const.promo_codes');
        $validPromo = collect($promoCodes)->firstWhere('code', $this->coupon_code);

        if ($validPromo && now()->between(
                        Carbon::parse($validPromo['start_date']),
                        Carbon::parse($validPromo['end_date']))) {
            $this->discount = $validPromo['value'];
            $this->total = $this->subtotal - $this->discount;
            $this->resetErrorBag('coupon_code');
        } else {
            $this->discount = 0;
            $this->total = $this->subtotal;
            $this->addError('coupon_code', 'Maaf, kode kupon tidak valid.');
        }
    }

    public function downloadInvoice()
    {
        $this->dispatch('download-invoice', no_registration: $this->no_registration);
    }
}