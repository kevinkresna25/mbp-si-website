<?php

namespace App\Livewire;

use App\Models\DonationTarget;
use Livewire\Component;

class DonationProgress extends Component
{
    public function render()
    {
        return view('livewire.donation-progress', [
            'targets' => DonationTarget::active()->get(),
        ]);
    }
}
