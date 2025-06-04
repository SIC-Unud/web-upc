<?php

namespace App\Livewire;

use Carbon\Carbon;
use Livewire\Component;

class PaymentForm extends Component
{
    public $listCabang;
    public $cabangId;
    public $registrationFee = 0;
    public $appFee = 1000;
    public $discount = 0;
    public $couponCode = '';
    public $errorMessage = '';


    public function mount($listCabang)
    {
        $this->listCabang = collect($listCabang);
    }

    public function updatedCabangId($value)
    {
        $selected = $this->listCabang->firstWhere('id', $value);
        for ($i = 1; $i <= 3; $i++) {
            if (
                now()->between(
                Carbon::parse(config('const.schedules.wave_' . $i . '.start')),
                Carbon::parse(config('const.schedules.wave_' . $i . '.end')))
            ) {
                $name = 'wave_' . $i . '_price';
                $this->registrationFee = $selected->$name;
                break;
            }
        }
    }

    public function aupdatedCouponCode()
    {   
        $valid = false;
        foreach (config('const.promo_codes') as $promo) {
            if ($promo['code'] === $this->couponCode) {
                $this->discount = $this->registrationFee * $promo['discount'] / 100;
                $this->errorMessage = '';
                $valid = true;
                break;
            }
        }

        if (!$valid) {
            $this->discount = 0;
            $this->errorMessage = 'Maaf kode kupon anda tidak valid';
        }
    }

    public function getTotalProperty()
    {
        return max(0, $this->registrationFee + $this->appFee - $this->discount);
    }

    public function render()
    {
        return view('livewire.payment-form');
    }
}
