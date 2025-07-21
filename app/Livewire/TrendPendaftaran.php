<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TrendPendaftaran extends Component
{
    public $selectedYear;
    public $labels = [];
    public $data = [];
    public $availableYears = [];

    public function mount()
    {
        $this->availableYears = DB::table('participants')
            ->selectRaw('YEAR(created_at) as year')
            ->distinct()
            ->orderBy('year')
            ->pluck('year')
            ->toArray();

        $this->selectedYear = date('Y');
        if (!in_array($this->selectedYear, $this->availableYears)) {
            $this->selectedYear = $this->availableYears[0] ?? date('Y');
        }

        $this->loadData();
    }

    public function onYearChange($year)
    {
        $this->selectedYear = $year;
        $this->loadData();
        $this->dispatch('update-trend-chart', [
            'labels' => $this->labels,
            'data' => $this->data,
        ]);
    }

    public function loadData()
    {
        $bulan = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Spt', 'Okt', 'Nov', 'Des'];

        $jumlahPerBulan = DB::table('participants')
            ->selectRaw('MONTH(created_at) as bulan, COUNT(*) as jumlah')
            ->whereYear('created_at', $this->selectedYear)
            ->groupBy('bulan')
            ->pluck('jumlah', 'bulan');

        $data = [];
        for ($i = 1; $i <= 12; $i++) {
            $data[] = $jumlahPerBulan[$i] ?? 0;
        }

        $this->labels = $bulan;
        $this->data = $data;
    }

    public function render()
    {
        return view('livewire.trend-pendaftaran', [
            'labels' => $this->labels,
            'data' => $this->data,
            'availableYears' => $this->availableYears,
        ]);
    }
}
