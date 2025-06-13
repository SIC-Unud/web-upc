<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

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
    public $subtotal = 50000;
    public $total;

    protected $rules = [
    //    rulesnya
    ];

    // nanti ambil dari db
    public array $competitions = [
        [
            'name' => 'Cerdas cermat SD (kelompok)',
            'is_team_competition' => true,
        ],
        [
            'name' => 'Fisika SMP',
            'is_team_competition' => false,
        ],
        [
            'name' => 'Fisika SMA',
            'is_team_competition' => false,
        ],
        [
            'name' => 'Kebumian',
            'is_team_competition' => false,
        ],
        [
            'name' => 'Astronomi',
            'is_team_competition' => false,
        ],
        [
            'name' => 'Esai (kelompok)',
            'is_team_competition' => true,
        ],
        [
            'name' => 'Poster Ilmiah (kelompok)',
            'is_team_competition' => true,
        ],
    ];

    public function render()
    {
        return view('livewire.registration-form');
    }

    public function firstStepSubmit()
    {
        $this->validate([
            'source_of_information' => 'required',
            'is_first_competition' => 'required',
            'reason' => 'required',
            'competition' => 'required',
        ]);

        if (isset($this->competitions[$this->competition])) {
            $this->is_team_competition = $this->competitions[$this->competition]['is_team_competition'];
        } else {
            $this->is_team_competition = false;
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
        
        // buat logic submit form
        $this->no_registration = 12345678;
        
        $this->success = true;
        $this->currentStep = 4;
        $this->js("window.scrollTo({ top: 0, behavior: 'smooth' });");
    }

    public function back($step)
    {
        $this->currentStep = $step;
    }

    public function applyCoupon()
    {
        if ($this->coupon_code === 'UPC99') {
            $this->total = $this->total - 10000;
            $this->resetErrorBag('coupon_code');
        } else {
            $this->addError('coupon_code', 'Maaf kode kupon anda tidak valid');
        }
    }
}