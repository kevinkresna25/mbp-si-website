<?php

namespace App\Livewire;

use App\Services\FinancialService;
use Livewire\Component;

class DonationTrends extends Component
{
    public int $months = 6;

    public function render()
    {
        $financialService = app(FinancialService::class);

        return view('livewire.donation-trends', [
            'trends' => $financialService->getTransactionTrends($this->months),
        ]);
    }
}
