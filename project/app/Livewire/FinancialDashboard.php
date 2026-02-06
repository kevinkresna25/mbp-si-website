<?php

namespace App\Livewire;

use App\Services\FinancialService;
use Livewire\Component;

class FinancialDashboard extends Component
{
    public int $selectedYear;
    public int $selectedMonth;
    public bool $isPublic = false;

    public function mount(bool $isPublic = false): void
    {
        $this->isPublic = $isPublic;
        $this->selectedYear = now()->year;
        $this->selectedMonth = now()->month;
    }

    public function updatedSelectedYear(): void
    {
        // Triggers re-render
    }

    public function updatedSelectedMonth(): void
    {
        // Triggers re-render
    }

    public function getAvailableYearsProperty(): array
    {
        $currentYear = now()->year;
        $years = [];
        for ($y = $currentYear; $y >= $currentYear - 5; $y--) {
            $years[] = $y;
        }
        return $years;
    }

    public function getMonthsProperty(): array
    {
        return [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret',
            4 => 'April', 5 => 'Mei', 6 => 'Juni',
            7 => 'Juli', 8 => 'Agustus', 9 => 'September',
            10 => 'Oktober', 11 => 'November', 12 => 'Desember',
        ];
    }

    public function render()
    {
        $financialService = app(FinancialService::class);

        $balances = $financialService->getAllBalances();
        $monthlyReport = $financialService->getMonthlyReport($this->selectedYear, $this->selectedMonth);
        $trends = $financialService->getTransactionTrends(6);

        return view('livewire.financial-dashboard', [
            'balances' => $balances,
            'monthlyReport' => $monthlyReport,
            'trends' => $trends,
        ]);
    }
}
